<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\PresenceDetail;
use App\Models\Presence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StudentAttendanceController extends Controller
{
  /**
   * Display a listing of the student's attendance.
   */
  public function index()
  {
    $user = Auth::user();
    $student = Student::with(['class'])->where('user_id', $user->id)->first();

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
    $student = Student::with(['class'])->where('user_id', $user->id)->first();

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
