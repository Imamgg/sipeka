<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\PresenceDetail;
use App\Models\Presence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class StudentAttendanceController extends Controller
{
    /**
     * Display a listing of the student's attendance.
     */
    public function index()
    {
        $user = Auth::user();
        $student = Student::with(['classes'])->where('user_id', $user->id)->first();

        $attendances = PresenceDetail::with(['presence.classSchedule.subject'])
            ->where('student_id', $student->id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $stats = $this->getAttendanceStats($student->id);

        return view('student.attendance.index', compact('student', 'attendances', 'stats'));
    }

    /**
     * Show QR code form for attendance.
     */
    public function create()
    {
        $user = Auth::user();
        $student = Student::with(['classes'])->where('user_id', $user->id)->first();

        // Get active presence sessions for today
        $today = Carbon::today();
        $activePresences = Presence::with(['classSchedule.subject'])
            ->whereHas('classSchedule', function ($query) use ($student) {
                $query->where('class_id', $student->class_id);
            })
            ->where('date', $today)
            ->where('is_active', true)
            ->get();

        return view('student.attendance.qr', compact('student', 'activePresences'));
    }

    /**
     * Store attendance via QR code.
     */
    public function store(Request $request)
    {
        $request->validate([
            'qr_token' => 'required|string',
        ]);

        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->first();

        $presence = Presence::where('qr_code_token', $request->qr_token)
            ->where('is_active', true)
            ->first();

        if (!$presence) {
            return back()->with('error', 'QR code tidak valid atau sudah expired!');
        }

        // Check if student already attended
        $existingAttendance = PresenceDetail::where('presence_id', $presence->id)
            ->where('student_id', $student->id)
            ->first();

        if ($existingAttendance) {
            return back()->with('error', 'Anda sudah melakukan absensi untuk sesi ini!');
        }

        // Create attendance record
        PresenceDetail::create([
            'presence_id' => $presence->id,
            'student_id' => $student->id,
            'status' => 'present',
        ]);

        return back()->with('success', 'Absensi berhasil dicatat!');
    }

    /**
     * Show QR code scanner page or process token if provided
     */
    public function scanQr(Request $request)
    {
        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->first();

        if (!$student) {
            return redirect()->route('student.dashboard')->with('error', 'Data siswa tidak ditemukan.');
        }

        // Check if token is provided in URL (automatic QR scan processing)
        if ($request->has('token')) {
            // Log the automatic scan attempt
            Log::info('Automatic QR scan detected', [
                'student_id' => $student->id,
                'token' => $request->token,
                'url' => $request->fullUrl()
            ]);

            // Validate token parameter
            try {
                $request->validate([
                    'token' => 'required|string',
                ]);

                // Process the attendance automatically
                return $this->processAutomaticScan($request, $student);
            } catch (\Exception $e) {
                Log::error('Error in automatic QR scan validation', [
                    'student_id' => $student->id,
                    'token' => $request->token,
                    'error' => $e->getMessage()
                ]);

                return redirect()->route('student.attendances.scan')
                    ->with('error', 'Token QR code tidak valid. Silakan scan ulang atau hubungi guru Anda.');
            }
        }

        // If no token, show the scanner page
        return view('student.attendance.scan_qr', compact('student'));
    }

    /**
     * Show success page after QR scan
     */
    public function scanSuccess($id)
    {
        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->first();

        if (!$student) {
            return redirect()->route('student.dashboard')->with('error', 'Data siswa tidak ditemukan.');
        }

        $presenceDetail = PresenceDetail::with(['presence', 'presence.classes', 'presence.subject'])
            ->where('id', $id)
            ->where('student_id', $student->id)
            ->firstOrFail();

        return view('student.attendance.scan_success', compact('student', 'presenceDetail'));
    }

    /**
     * Get attendance statistics.
     */
    private function getAttendanceStats($studentId)
    {
        $total = PresenceDetail::where('student_id', $studentId)->count();
        $present = PresenceDetail::where('student_id', $studentId)->where('status', 'present')->count();
        $absent = PresenceDetail::where('student_id', $studentId)->where('status', 'absent')->count();
        $late = PresenceDetail::where('student_id', $studentId)->where('status', 'late')->count();

        $percentage = $total > 0 ? round(($present / $total) * 100, 1) : 0;

        return [
            'total' => $total,
            'present' => $present,
            'absent' => $absent,
            'late' => $late,
            'percentage' => $percentage,
        ];
    }

    /**
     * Process automatic QR code scan from URL access
     */
    private function processAutomaticScan(Request $request, Student $student)
    {
        // Use the shared processing method for automatic scans
        return $this->processAttendance($request->token, $student, true);
    }

    /**
     * Shared method to process attendance for both manual and automatic scans
     */
    private function processAttendance($token, Student $student, $isAutomatic = false)
    {
        try {
            Log::info('Processing attendance scan', [
                'student_id' => $student->id,
                'student_name' => $student->name,
                'token' => $token,
                'is_automatic' => $isAutomatic,
                'timestamp' => now()
            ]);

            // Find the active attendance session with this token
            $attendance = Presence::with(['classSchedule.classes', 'classes', 'subject'])
                ->where('qr_code_token', $token)
                ->where('is_active', true)
                ->first();

            if (!$attendance) {
                Log::warning('Invalid or inactive QR token used', [
                    'student_id' => $student->id,
                    'token' => $token,
                    'is_automatic' => $isAutomatic
                ]);

                $errorMessage = 'QR code tidak valid atau tidak aktif. Silakan verifikasi kode atau hubungi guru Anda.';

                if ($isAutomatic) {
                    return redirect()->route('student.attendances.scan')->with('error', $errorMessage);
                } else {
                    return back()->with('error', $errorMessage);
                }
            }

            Log::info('Found attendance session', [
                'attendance_id' => $attendance->id,
                'attendance_date' => $attendance->date,
                'start_time' => $attendance->start_time,
                'end_time' => $attendance->end_time,
                'is_automatic' => $isAutomatic
            ]);

            // Determine class information
            $classId = null;
            $className = null;

            if ($attendance->classSchedule && $attendance->classSchedule->classes) {
                $classId = $attendance->classSchedule->class_id;
                $className = $attendance->classSchedule->classes->name;
            } elseif ($attendance->classes) {
                $classId = $attendance->class_id;
                $className = $attendance->classes->name;
            } elseif ($attendance->class_id) {
                $classId = $attendance->class_id;
                $className = 'Kelas ID: ' . $attendance->class_id;
            } else {
                Log::error('No class information found for attendance session', [
                    'attendance_id' => $attendance->id,
                    'student_id' => $student->id,
                    'is_automatic' => $isAutomatic
                ]);

                $errorMessage = 'Informasi kelas untuk sesi absensi ini tidak ditemukan. Silakan hubungi guru Anda.';

                if ($isAutomatic) {
                    return redirect()->route('student.attendances.scan')->with('error', $errorMessage);
                } else {
                    return back()->with('error', $errorMessage);
                }
            }

            // Check if student belongs to the class associated with this attendance session
            if ($student->class_id != $classId) {
                Log::warning('Student tried to access attendance for wrong class', [
                    'student_id' => $student->id,
                    'student_class_id' => $student->class_id,
                    'attendance_class_id' => $classId,
                    'class_name' => $className,
                    'is_automatic' => $isAutomatic
                ]);

                $errorMessage = 'Anda tidak terdaftar di kelas ini. QR code ini untuk kelas ' . $className . '. Silakan hubungi guru jika ini adalah kesalahan.';

                if ($isAutomatic) {
                    return redirect()->route('student.attendances.scan')->with('error', $errorMessage);
                } else {
                    return back()->with('error', $errorMessage);
                }
            }

            // Check if current time is within the allowed period
            $now = Carbon::now();
            $dateOnly = Carbon::parse($attendance->date)->format('Y-m-d');

            // Format time properly
            $startTimeFormatted = is_string($attendance->start_time) ? $attendance->start_time : date('H:i', strtotime($attendance->start_time));
            $endTimeFormatted = is_string($attendance->end_time) ? $attendance->end_time : date('H:i', strtotime($attendance->end_time));

            $startTime = Carbon::parse($dateOnly . ' ' . $startTimeFormatted);
            $endTime = Carbon::parse($dateOnly . ' ' . $endTimeFormatted);

            Log::info('Time validation', [
                'current_time' => $now->format('Y-m-d H:i:s'),
                'start_time' => $startTime->format('Y-m-d H:i:s'),
                'end_time' => $endTime->format('Y-m-d H:i:s'),
                'is_automatic' => $isAutomatic
            ]);

            if ($now->isAfter($endTime)) {
                Log::warning('Attendance session has ended', [
                    'current_time' => $now->format('Y-m-d H:i:s'),
                    'end_time' => $endTime->format('Y-m-d H:i:s'),
                    'is_automatic' => $isAutomatic
                ]);

                $errorMessage = 'Sesi absensi telah berakhir. Silakan hubungi guru Anda untuk absensi manual.';

                if ($isAutomatic) {
                    return redirect()->route('student.attendances.scan')->with('error', $errorMessage);
                } else {
                    return back()->with('error', $errorMessage);
                }
            }

            // Check for existing attendance record
            $presenceDetail = PresenceDetail::where('presence_id', $attendance->id)
                ->where('student_id', $student->id)
                ->first();

            if ($presenceDetail && $presenceDetail->status == 'present') {
                // Already marked as present
                $isLate = strpos($presenceDetail->verification_note ?? '', 'Terlambat') !== false;

                Log::info('Student already marked present', [
                    'student_id' => $student->id,
                    'presence_detail_id' => $presenceDetail->id,
                    'is_late' => $isLate,
                    'is_automatic' => $isAutomatic
                ]);

                return redirect()->route('student.attendances.success', ['id' => $presenceDetail->id])
                    ->with('info', 'Anda sudah tercatat ' . ($isLate ? 'hadir (terlambat)' : 'hadir') . ' untuk sesi ini.');
            }

            // Create or update presence detail
            if (!$presenceDetail) {
                $presenceDetail = new PresenceDetail();
                $presenceDetail->presence_id = $attendance->id;
                $presenceDetail->student_id = $student->id;

                Log::info('Creating new presence detail', [
                    'student_id' => $student->id,
                    'presence_id' => $attendance->id,
                    'is_automatic' => $isAutomatic
                ]);
            } else {
                Log::info('Updating existing presence detail', [
                    'presence_detail_id' => $presenceDetail->id,
                    'is_automatic' => $isAutomatic
                ]);
            }

            // Determine status based on time
            $graceMinutes = 10; // Grace period of 10 minutes
            $lateThreshold = (clone $startTime)->addMinutes($graceMinutes);

            $presenceDetail->status = 'present';
            $presenceDetail->verification_status = 'verified';
            $presenceDetail->verified_at = $now;

            $lateMessage = '';
            if ($now->isAfter($lateThreshold)) {
                // Record late arrival
                $minutesLate = $now->diffInMinutes($startTime);
                $presenceDetail->verification_note = 'Terlambat ' . $minutesLate . ' menit';
                $lateMessage = ' Anda tercatat terlambat ' . $minutesLate . ' menit.';

                Log::info('Student marked as late', [
                    'student_id' => $student->id,
                    'minutes_late' => $minutesLate,
                    'is_automatic' => $isAutomatic
                ]);
            }

            // Save the attendance record
            $presenceDetail->save();

            Log::info('Attendance successfully recorded', [
                'student_id' => $student->id,
                'presence_detail_id' => $presenceDetail->id,
                'status' => $presenceDetail->status,
                'verification_note' => $presenceDetail->verification_note,
                'is_automatic' => $isAutomatic
            ]);

            $successMessage = $isAutomatic ?
                'Absensi berhasil dicatat secara otomatis!' . $lateMessage :
                'Absensi berhasil dicatat!' . $lateMessage;

            return redirect()->route('student.attendances.success', ['id' => $presenceDetail->id])
                ->with('success', $successMessage);
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Attendance processing error', [
                'student_id' => $student->id,
                'token' => $token,
                'is_automatic' => $isAutomatic,
                'error_message' => $e->getMessage(),
                'error_trace' => $e->getTraceAsString()
            ]);

            $errorMessage = 'Terjadi kesalahan saat memproses absensi Anda. Silakan coba lagi atau hubungi guru Anda.';

            if ($isAutomatic) {
                return redirect()->route('student.attendances.scan')->with('error', $errorMessage);
            } else {
                return back()->with('error', $errorMessage);
            }
        }
    }
}
