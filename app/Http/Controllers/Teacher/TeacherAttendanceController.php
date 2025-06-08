<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\ClassSchedule;
use App\Models\Presence;
use App\Models\PresenceDetail;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Subjects;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TeacherAttendanceController extends Controller
{
    /**
     * Display attendance records.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $teacher = $user->teacher;

        if (!$teacher) {
            return redirect()->route('teacher.dashboard')->with('error', 'Data guru tidak ditemukan.');
        }

        // Get teacher's classes
        $teacherSchedules = ClassSchedule::with(['classes', 'subject'])
            ->where('teacher_id', $teacher->id)
            ->get();

        $classIds = $teacherSchedules->pluck('class_id')->unique();
        $classes = Classes::whereIn('id', $classIds)->get();
        $subjects = Subjects::whereHas('classSchedules', function ($query) use ($teacher) {
            $query->where('teacher_id', $teacher->id);
        })->get();

        // Filter parameters
        $selectedClass = $request->get('class_id');
        $selectedSubject = $request->get('subject_id');
        $dateFrom = $request->get('date_from', Carbon::today()->format('Y-m-d'));
        $dateTo = $request->get('date_to', Carbon::today()->addDays(7)->format('Y-m-d')); // Show next 7 days by default
        $status = $request->get('status');

        // Get attendance records (QR sessions)
        $attendanceQuery = Presence::with(['classes', 'subject', 'presenceDetails', 'presenceDetails.student'])
            ->where('teacher_id', $teacher->id);

        if ($selectedClass) {
            $attendanceQuery->where('class_id', $selectedClass);
        }

        if ($selectedSubject) {
            $attendanceQuery->where('subject_id', $selectedSubject);
        }

        if ($status) {
            $attendanceQuery->where('is_active', $status === 'active');
        }

        $attendanceQuery->whereBetween('date', [$dateFrom, $dateTo]);

        $attendances = $attendanceQuery->orderBy('date', 'desc')
            ->orderBy('class_id')
            ->paginate(20);

        // Count attendance statistics
        foreach ($attendances as $attendance) {
            $attendance->present_count = $attendance->presenceDetails->where('status', 'present')->count();
            $attendance->late_count = $attendance->presenceDetails->where('status', 'late')->count();
            $attendance->absent_count = $attendance->presenceDetails->where('status', 'absent')->count();
            $attendance->total_students = $attendance->presenceDetails->count();
            $attendance->attendance_rate = $attendance->total_students > 0
                ? round((($attendance->present_count + $attendance->late_count) / $attendance->total_students) * 100)
                : 0;
        }

        // Get active QR sessions (regardless of date) for quick access
        $activeQrSessions = Presence::with(['classes', 'subject'])
            ->where('teacher_id', $teacher->id)
            ->where('is_active', true)
            ->orderBy('date', 'asc')
            ->orderBy('start_time', 'asc')
            ->take(5)
            ->get();

        return view('teacher.attendance.index', compact(
            'attendances',
            'classes',
            'subjects',
            'selectedClass',
            'selectedSubject',
            'dateFrom',
            'dateTo',
            'status',
            'teacher',
            'activeQrSessions'
        ));
    }

    /**
     * Show form for creating attendance record.
     */
    public function create(Request $request)
    {
        $user = Auth::user();
        $teacher = $user->teacher;

        if (!$teacher) {
            return redirect()->route('teacher.dashboard')->with('error', 'Data guru tidak ditemukan.');
        }

        // Get teacher's classes and subjects
        $teacherSchedules = ClassSchedule::with(['classes', 'subject'])
            ->where('teacher_id', $teacher->id)
            ->get();

        $classes = $teacherSchedules->groupBy('class_id')->map(function ($schedules) {
            return $schedules->first()->classes;
        });

        $subjects = $teacherSchedules->groupBy('subject_id')->map(function ($schedules) {
            return $schedules->first()->subject;
        });

        // If class is pre-selected, get students
        $students = collect();
        if ($request->has('class_id')) {
            $studentsResponse = $this->getStudents($request);
            $students = json_decode($studentsResponse->getContent());
        }

        return view('teacher.attendance.create', compact('classes', 'subjects', 'students', 'teacher'));
    }

    /**
     * Store attendance records.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $teacher = $user->teacher;

        if (!$teacher) {
            return redirect()->route('teacher.dashboard')->with('error', 'Data guru tidak ditemukan.');
        }

        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'date' => 'required|date',
            'attendances' => 'required|array',
            'attendances.*' => 'required|in:present,absent,late,sick,permit'
        ]);

        // Verify teacher has access to this class and subject
        $hasAccess = ClassSchedule::where('teacher_id', $teacher->id)
            ->where('class_id', $request->class_id)
            ->where('subject_id', $request->subject_id)
            ->exists();

        if (!$hasAccess) {
            return back()->withErrors(['error' => 'Anda tidak memiliki izin untuk membuat absensi untuk kelas dan mata pelajaran ini.']);
        }

        // Check if attendance already exists for this date, class, and subject
        $existingAttendance = Presence::where('class_id', $request->class_id)
            ->where('subject_id', $request->subject_id)
            ->whereDate('date', $request->date)
            ->exists();

        if ($existingAttendance) {
            return back()->withErrors(['error' => 'Absensi untuk kelas, mata pelajaran, dan tanggal ini sudah ada.']);
        }

        // Create attendance records
        foreach ($request->attendances as $studentId => $status) {
            Presence::create([
                'student_id' => $studentId,
                'class_id' => $request->class_id,
                'subject_id' => $request->subject_id,
                'teacher_id' => $teacher->id,
                'date' => $request->date,
                'status' => $status,
                'notes' => $request->input("notes.{$studentId}", null)
            ]);
        }

        return redirect()->route('teacher.attendance.index')
            ->with('success', 'Absensi berhasil dicatat!');
    }

    /**
     * Show form for editing attendance.
     */
    public function edit(Request $request)
    {
        $user = Auth::user();
        $teacher = $user->teacher;

        if (!$teacher) {
            return redirect()->route('teacher.dashboard')->with('error', 'Data guru tidak ditemukan.');
        }

        $classId = $request->get('class_id');
        $subjectId = $request->get('subject_id');
        $date = $request->get('date');

        if (!$classId || !$subjectId || !$date) {
            return redirect()->route('teacher.attendance.index')
                ->with('error', 'Parameter yang dibutuhkan tidak lengkap.');
        }

        // Verify teacher has access
        $hasAccess = ClassSchedule::where('teacher_id', $teacher->id)
            ->where('class_id', $classId)
            ->where('subject_id', $subjectId)
            ->exists();

        if (!$hasAccess) {
            return redirect()->route('teacher.attendance.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit absensi ini.');
        }

        // Get attendance records
        $attendances = Presence::with(['student.user'])
            ->where('class_id', $classId)
            ->where('subject_id', $subjectId)
            ->whereDate('date', $date)
            ->where('teacher_id', $teacher->id)
            ->get()
            ->keyBy('student_id');

        $class = Classes::findOrFail($classId);
        $subject = Subjects::findOrFail($subjectId);

        return view('teacher.attendance.edit', compact(
            'attendances',
            'classes',
            'subject',
            'date',
            'teacher'
        ));
    }

    /**
     * Update attendance records.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $teacher = $user->teacher;

        if (!$teacher) {
            return redirect()->route('teacher.dashboard')->with('error', 'Data guru tidak ditemukan.');
        }

        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'date' => 'required|date',
            'attendances' => 'required|array',
            'attendances.*' => 'required|in:present,absent,late,sick,permit'
        ]);

        // Verify teacher has access
        $hasAccess = ClassSchedule::where('teacher_id', $teacher->id)
            ->where('class_id', $request->class_id)
            ->where('subject_id', $request->subject_id)
            ->exists();

        if (!$hasAccess) {
            return redirect()->route('teacher.attendance.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit absensi ini.');
        }

        // Update attendance records
        foreach ($request->attendances as $studentId => $status) {
            Presence::where('student_id', $studentId)
                ->where('class_id', $request->class_id)
                ->where('subject_id', $request->subject_id)
                ->whereDate('date', $request->date)
                ->where('teacher_id', $teacher->id)
                ->update([
                    'status' => $status,
                    'notes' => $request->input("notes.{$studentId}", null)
                ]);
        }

        return redirect()->route('teacher.attendance.index')
            ->with('success', 'Absensi berhasil diperbarui!');
    }

    /**
     * Get students for a specific class (AJAX).
     */
    public function getStudents(Request $request)
    {
        $user = Auth::user();
        $teacher = $user->teacher;
        $classId = $request->get('class_id');

        if (!$teacher || !$classId) {
            return response()->json([]);
        }

        // Verify teacher has access to this class
        $hasAccess = ClassSchedule::where('teacher_id', $teacher->id)
            ->where('class_id', $classId)
            ->exists();

        if (!$hasAccess) {
            return response()->json([]);
        }
        $students = Student::with('user')
            ->where('class_id', $classId)
            ->join('users', 'students.user_id', '=', 'users.id')
            ->orderBy('users.name')
            ->select('students.*')
            ->get()
            ->map(function ($student) {
                return [
                    'id' => $student->id,
                    'name' => $student->user->name,
                    'nisn' => $student->nisn
                ];
            });

        return response()->json($students);
    }

    /**
     * Create new QR code attendance session
     */
    public function createQrSession()
    {
        $user = Auth::user();
        $teacher = $user->teacher;

        if (!$teacher) {
            return redirect()->route('teacher.dashboard')->with('error', 'Data guru tidak ditemukan.');
        }

        // Get teacher's classes and subjects
        $teacherSchedules = ClassSchedule::with(['classes', 'subject'])
            ->where('teacher_id', $teacher->id)
            ->get();

        $classes = $teacherSchedules->groupBy('class_id')->map(function ($schedules) {
            return $schedules->first()->classes;
        });

        $subjects = $teacherSchedules->groupBy('subject_id')->map(function ($schedules) {
            return $schedules->first()->subject;
        });

        return view('teacher.attendance.create_qr', compact('classes', 'subjects', 'teacher'));
    }

    /**
     * Store new QR code attendance session
     */
    public function storeQrSession(Request $request)
    {
        $user = Auth::user();
        $teacher = $user->teacher;

        if (!$teacher) {
            return redirect()->route('teacher.dashboard')->with('error', 'Data guru tidak ditemukan.');
        }

        // Validate the request
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'description' => 'nullable|string',
        ]);

        // Verify teacher has access to this class and subject
        $classSchedule = ClassSchedule::where('teacher_id', $teacher->id)
            ->where('class_id', $request->class_id)
            ->where('subject_id', $request->subject_id)
            ->first();

        if (!$classSchedule) {
            return back()->withErrors(['error' => 'Anda tidak memiliki izin untuk membuat absensi untuk kelas dan mata pelajaran ini.']);
        }

        // Generate QR Code token
        $qrCodeToken = 'QR' . time() . rand(1000, 9999);

        // Create attendance session
        $attendance = Presence::create([
            'class_schedule_id' => $classSchedule->id, // Tambahkan referensi ke class schedule
            'class_id' => $request->class_id,
            'subject_id' => $request->subject_id,
            'teacher_id' => $teacher->id,
            'date' => $request->date,
            'topic' => $request->title,
            'note' => $request->description,
            'qr_code_token' => $qrCodeToken,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'is_active' => true,
        ]);

        // Create presence details for all students in the class
        $students = Student::where('class_id', $request->class_id)->get();
        foreach ($students as $student) {
            PresenceDetail::create([
                'presence_id' => $attendance->id,
                'student_id' => $student->id,
                'status' => 'absent', // Default status is absent until scanned
            ]);
        }

        return redirect()->route('teacher.attendance.show', $attendance->id)
            ->with('success', 'Sesi absensi QR berhasil dibuat!');
    }

    /**
     * Show QR code attendance session details
     */
    public function show($id)
    {
        $user = Auth::user();
        $teacher = $user->teacher;

        if (!$teacher) {
            return redirect()->route('teacher.dashboard')->with('error', 'Data guru tidak ditemukan.');
        }

        $attendance = Presence::with(['classes', 'subject', 'presenceDetails', 'presenceDetails.student', 'presenceDetails.student.user'])
            ->where('id', $id)
            ->where('teacher_id', $teacher->id)
            ->firstOrFail();

        // Generate QR code
        $qrUrl = route('student.attendances.scan', ['token' => $attendance->qr_code_token]);
        $qrCode = QrCode::size(300)->generate($qrUrl);

        // Count attendance statistics
        $presentCount = $attendance->presenceDetails->where('status', 'present')->count();
        $lateCount = $attendance->presenceDetails->where('status', 'late')->count();
        $absentCount = $attendance->presenceDetails->where('status', 'absent')->count();
        $totalStudents = $attendance->presenceDetails->count();
        $attendanceRate = $totalStudents > 0
            ? round((($presentCount + $lateCount) / $totalStudents) * 100)
            : 0;

        return view('teacher.attendance.show', compact(
            'attendance',
            'qrCode',
            'qrUrl',
            'presentCount',
            'lateCount',
            'absentCount',
            'totalStudents',
            'attendanceRate'
        ));
    }

    /**
     * Toggle QR session active status
     */
    /**
     * Toggle QR session status (active/inactive)
     */
    public function toggleStatus($id)
    {
        $user = Auth::user();
        $teacher = $user->teacher;

        if (!$teacher) {
            return redirect()->route('teacher.dashboard')->with('error', 'Data guru tidak ditemukan.');
        }

        $attendance = Presence::where('id', $id)
            ->where('teacher_id', $teacher->id)
            ->firstOrFail();

        // Toggle status
        $attendance->is_active = !$attendance->is_active;

        // Ketika mengaktifkan kembali QR code, pastikan semua data relasi masih terhubung dengan benar
        if ($attendance->is_active) {
            // Verifikasi class_schedule_id masih valid
            if (!$attendance->class_schedule_id && $attendance->class_id) {
                // Jika tidak ada class_schedule_id tapi ada class_id, coba cari jadwal yang cocok
                $possibleSchedule = ClassSchedule::where('class_id', $attendance->class_id)
                    ->where('subject_id', $attendance->subject_id)
                    ->where('teacher_id', $attendance->teacher_id)
                    ->first();

                if ($possibleSchedule) {
                    $attendance->class_schedule_id = $possibleSchedule->id;
                }
            }
        }

        $attendance->save();

        $status = $attendance->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->route('teacher.attendance.show', $attendance->id)
            ->with('success', "Sesi absensi QR berhasil {$status}!");
    }

    /**
     * Delete QR session
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $teacher = $user->teacher;

        if (!$teacher) {
            return redirect()->route('teacher.dashboard')->with('error', 'Data guru tidak ditemukan.');
        }

        $attendance = Presence::where('id', $id)
            ->where('teacher_id', $teacher->id)
            ->firstOrFail();

        // Delete all presence details first
        PresenceDetail::where('presence_id', $attendance->id)->delete();

        // Then delete the attendance
        $attendance->delete();

        return redirect()->route('teacher.attendance.index')
            ->with('success', 'Sesi absensi QR berhasil dihapus!');
    }

    /**
     * Update student attendance status manually
     */
    public function updateStudentStatus(Request $request, $id)
    {
        $user = Auth::user();
        $teacher = $user->teacher;

        if (!$teacher) {
            return redirect()->route('teacher.dashboard')->with('error', 'Data guru tidak ditemukan.');
        }

        $request->validate([
            'student_id' => 'required|exists:students,id',
            'status' => 'required|in:present,absent,permission,sick',
        ]);

        $attendance = Presence::where('id', $id)
            ->where('teacher_id', $teacher->id)
            ->firstOrFail();

        $presenceDetail = PresenceDetail::where('presence_id', $attendance->id)
            ->where('student_id', $request->student_id)
            ->first();

        if (!$presenceDetail) {
            return back()->withErrors(['error' => 'Data kehadiran siswa tidak ditemukan.']);
        }

        $presenceDetail->status = $request->status;
        $presenceDetail->verification_status = 'verified';
        $presenceDetail->verified_by = $user->id;
        $presenceDetail->verified_at = now();
        $presenceDetail->verification_note = $request->note ?? 'Diperbarui manual oleh guru';
        $presenceDetail->save();

        return redirect()->route('teacher.attendance.show', $attendance->id)
            ->with('success', 'Status kehadiran siswa berhasil diperbarui!');
    }

    /**
     * Export attendance records to CSV
     */
    public function export(Request $request)
    {
        $user = Auth::user();
        $teacher = $user->teacher;

        if (!$teacher) {
            return redirect()->route('teacher.dashboard')->with('error', 'Data guru tidak ditemukan.');
        }

        // Filter parameters
        $classId = $request->get('class_id');
        $subjectId = $request->get('subject_id');
        $dateFrom = $request->get('date_from', Carbon::today()->format('Y-m-d'));
        $dateTo = $request->get('date_to', Carbon::today()->format('Y-m-d'));

        // Get attendance records
        $attendanceQuery = Presence::with(['classes', 'subject', 'presenceDetails', 'presenceDetails.student'])
            ->where('teacher_id', $teacher->id);

        if ($classId) {
            $attendanceQuery->where('class_id', $classId);
        }

        if ($subjectId) {
            $attendanceQuery->where('subject_id', $subjectId);
        }

        $attendanceQuery->whereBetween('date', [$dateFrom, $dateTo]);

        $attendances = $attendanceQuery->orderBy('date', 'desc')
            ->orderBy('class_id')
            ->get();

        // Prepare CSV data
        $filename = 'attendance_report_' . Carbon::now()->format('Y-m-d_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($attendances) {
            $file = fopen('php://output', 'w');

            // Add CSV header row
            fputcsv($file, [
                'Date',
                'Class',
                'Subject',
                'Session Time',
                'Student ID',
                'Student Name',
                'Status',
                'Verification Status',
                'Notes'
            ]);

            // Add data rows
            foreach ($attendances as $attendance) {
                foreach ($attendance->presenceDetails as $detail) {
                    fputcsv($file, [
                        $attendance->date,
                        $attendance->classes->name,
                        $attendance->subject->name,
                        $attendance->start_time . ' - ' . $attendance->end_time,
                        $detail->student->student_id,
                        $detail->student->user->name,
                        ucfirst($detail->status),
                        ucfirst($detail->verification_status ?? 'N/A'),
                        $detail->notes ?? '-'
                    ]);
                }
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export specific attendance session details to CSV
     */
    public function exportSession($id)
    {
        $user = Auth::user();
        $teacher = $user->teacher;

        if (!$teacher) {
            return redirect()->route('teacher.dashboard')->with('error', 'Data guru tidak ditemukan.');
        }

        // Get attendance session
        $attendance = Presence::with(['classes', 'subject', 'presenceDetails', 'presenceDetails.student'])
            ->where('id', $id)
            ->where('teacher_id', $teacher->id)
            ->firstOrFail();

        // Prepare CSV data
        $filename = 'attendance_session_' . $attendance->date . '_' . $attendance->classes->name . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($attendance) {
            $file = fopen('php://output', 'w');

            // Add CSV header row
            fputcsv($file, [
                'Student ID',
                'Student Name',
                'Status',
                'Time Recorded',
                'Verification Status',
                'Notes'
            ]);

            // Add data rows
            foreach ($attendance->presenceDetails as $detail) {
                fputcsv($file, [
                    $detail->student->student_id,
                    $detail->student->user->name,
                    ucfirst($detail->status),
                    $detail->created_at ? $detail->created_at->format('H:i:s') : '-',
                    ucfirst($detail->verification_status ?? 'N/A'),
                    $detail->notes ?? '-'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Send email notifications to absent students' parents
     */
    public function sendAbsenceNotifications($id)
    {
        return redirect()->route('teacher.attendance.show', $id)
            ->with('error', 'Fitur ini belum tersedia. Masih dalam pengembangan😁.');

        // $user = Auth::user();
        // $teacher = $user->teacher;

        // if (!$teacher) {
        //     return redirect()->route('teacher.dashboard')->with('error', 'Data guru tidak ditemukan.');
        // }

        // $attendance = Presence::with(['classes', 'subject', 'presenceDetails', 'presenceDetails.student'])
        //     ->where('id', $id)
        //     ->where('teacher_id', $teacher->id)
        //     ->firstOrFail();

        // $absentCount = 0;

        // foreach ($attendance->presenceDetails as $detail) {
        //     if ($detail->status === 'absent') {
        //         $student = $detail->student;
        //         $parent = User::where('email', $student->parent_email)->first();

        //         if ($parent && $parent->email) {
        //             try {
        //                 Mail::to($parent->email)->send(new \App\Mail\AbsenceNotification($student, $attendance, $parent));
        //                 $absentCount++;
        //             } catch (\Exception $e) {
        //                 Log::error('Gagal mengirim notifikasi ketidakhadiran: ' . $e->getMessage());
        //             }
        //         }
        //     }
        // }

        // return redirect()->route('teacher.attendance.show', $id)
        //     ->with('success', "Notifikasi berhasil dikirim kepada {$absentCount} orang tua siswa yang tidak hadir.");
    }
}
