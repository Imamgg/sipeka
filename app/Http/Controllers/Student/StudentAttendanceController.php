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
   * Show QR code scanner page
   */
  public function scanQr()
  {
    $user = Auth::user();
    $student = Student::where('user_id', $user->id)->first();

    if (!$student) {
      return redirect()->route('student.dashboard')->with('error', 'Data siswa tidak ditemukan.');
    }

    return view('student.attendance.scan_qr', compact('student'));
  }

  /**
   * Process QR code scan
   */
  public function processScan(Request $request)
  {
    $user = Auth::user();
    $student = Student::where('user_id', $user->id)->first();

    if (!$student) {
      return redirect()->route('student.dashboard')->with('error', 'Data siswa tidak ditemukan.');
    }

    $request->validate([
      'token' => 'required|string',
    ]);

    $token = $request->token;

    try {
      // Find the active attendance session with this token
      $attendance = Presence::with(['classSchedule.classes'])
        ->where('qr_code_token', $token)
        ->where('is_active', true)
        ->first();

      if (!$attendance) {
        return back()->with('error', 'QR code tidak valid atau tidak aktif. Silakan verifikasi kode atau hubungi guru Anda.');
      }

      // Cek apakah informasi kelas tersedia, baik dari relasi classSchedule atau langsung dari class_id
      $classId = null;
      $className = null;

      if ($attendance->classSchedule) {
        $classId = $attendance->classSchedule->class_id;
        $className = $attendance->classSchedule->classes ? $attendance->classSchedule->classes->name : 'tidak diketahui';
      } elseif ($attendance->class_id) {
        $classId = $attendance->class_id;
        $className = $attendance->classes ? $attendance->classes->name : 'tidak diketahui';
      } else {
        // Jika tidak ada informasi kelas sama sekali
        return back()->with('error', 'Informasi kelas untuk sesi absensi ini tidak ditemukan. Silakan hubungi guru Anda.');
      }

      // Check if student belongs to the class associated with this attendance session
      if ($student->class_id != $classId) {
        return back()->with('error', 'Anda tidak terdaftar di kelas ini. QR code ini untuk kelas ' .
          $className . '. Silakan hubungi admin jika ini adalah kesalahan.');
      }

      // Check if current time is within the allowed period
      $now = Carbon::now();

      // Parse waktu start dan end dengan benar
      // Mengambil hanya tanggal dari date dan menggabungkannya dengan waktu start/end
      $dateOnly = Carbon::parse($attendance->date)->format('Y-m-d');

      // Extract start_time and end_time to prevent double time specification
      $startTimeFormatted = is_string($attendance->start_time) ? $attendance->start_time : date('H:i', strtotime($attendance->start_time));
      $endTimeFormatted = is_string($attendance->end_time) ? $attendance->end_time : date('H:i', strtotime($attendance->end_time));

      $startTime = Carbon::parse($dateOnly . ' ' . $startTimeFormatted);
      $endTime = Carbon::parse($dateOnly . ' ' . $endTimeFormatted);

      if ($now->isAfter($endTime)) {
        return back()->with('error', 'Sesi absensi telah berakhir. Silakan hubungi guru Anda untuk absensi manual.');
      }

      // Find or create presence detail
      $presenceDetail = PresenceDetail::where('presence_id', $attendance->id)
        ->where('student_id', $student->id)
        ->first();

      if (!$presenceDetail) {
        $presenceDetail = new PresenceDetail();
        $presenceDetail->presence_id = $attendance->id;
        $presenceDetail->student_id = $student->id;
      } elseif ($presenceDetail->status == 'present') {
        // Already marked as present
        $isLate = strpos($presenceDetail->verification_note ?? '', 'Terlambat') !== false;
        return redirect()->route('student.attendances.success', ['id' => $presenceDetail->id])
          ->with('info', 'Anda sudah tercatat ' . ($isLate ? 'hadir (terlambat)' : 'hadir') . ' untuk sesi ini.');
      }

      // Determine status based on time
      $graceMinutes = 10; // Grace period of 10 minutes
      $lateThreshold = (clone $startTime)->addMinutes($graceMinutes);

      // Note: Based on database schema, 'late' is not a valid status
      // We'll use 'present' status for now, but record late arrival in notes
      $presenceDetail->status = 'present';

      if ($now->isAfter($lateThreshold)) {
        // Record late arrival in verification_note
        $presenceDetail->verification_note = 'Terlambat ' . $now->diffInMinutes($startTime) . ' menit';
      }

      $presenceDetail->verification_status = 'verified';
      $presenceDetail->verified_at = $now;

      try {
        $presenceDetail->save();
      } catch (\Exception $e) {
        Log::error('Error saving presence detail: ' . $e->getMessage());
        throw $e;
      }

      return redirect()->route('student.attendances.success', ['id' => $presenceDetail->id])
        ->with('success', 'Absensi berhasil dicatat!' .
          ($now->isAfter($lateThreshold) ? ' Anda tercatat terlambat ' . $now->diffInMinutes($startTime) . ' menit.' : ''));
    } catch (\Exception $e) {
      // Log the error for debugging
      Log::error('QR Attendance error: ' . $e->getMessage());
      Log::error('Token: ' . $token);

      if (isset($attendance)) {
        Log::error('Attendance ID: ' . $attendance->id);
        Log::error('Class Schedule ID: ' . ($attendance->class_schedule_id ?? 'null'));
        Log::error('Class ID: ' . ($attendance->class_id ?? 'null'));
      }

      return back()->with('error', 'Terjadi kesalahan saat memproses absensi Anda. Silakan coba lagi atau hubungi guru Anda.');
    }
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
}
