<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\ClassSchedule;
use App\Models\Grade;
use App\Models\Material;
use App\Models\PresenceDetail;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StudentController extends Controller
{
  /**
   * Display the student dashboard.
   */
  public function dashboard()
  {
    $user = Auth::user();
    $student = Student::with(['classes', 'user'])->where('user_id', $user->id)->first();

    if (!$student) {
      return redirect()->route('login')->with('error', 'Student profile not found.');
    }

    // Get today's schedule
    $today = Carbon::today();
    $dayName = $today->format('l'); // Monday, Tuesday, etc

    $todaySchedule = ClassSchedule::with(['subject', 'teacher.user'])
      ->where('class_id', $student->class_id)
      ->where('day', $dayName)
      ->orderBy('start_time')
      ->get();

    // Get upcoming schedule (next 7 days)
    $upcomingSchedule = ClassSchedule::with(['subject', 'teacher.user'])
      ->where('class_id', $student->class_id)
      ->whereIn('day', ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'])
      ->orderBy('start_time')
      ->take(10)
      ->get();

    // Get recent grades
    $recentGrades = Grade::with(['subject'])
      ->where('student_id', $student->id)
      ->orderBy('created_at', 'desc')
      ->take(5)
      ->get();

    // Get recent announcements
    $announcements = Announcement::where('is_active', true)
      ->where(function ($query) use ($student) {
        $query->where('target', 'all')
          ->orWhere('target', 'students')
          ->orWhere(function ($q) use ($student) {
            $q->where('target', 'classes')
              ->whereJsonContains('class_target', $student->class_id);
          });
      })
      ->where('published_at', '<=', now())
      ->where(function ($query) {
        $query->whereNull('expires_at')
          ->orWhere('expires_at', '>=', now());
      })
      ->orderBy('published_at', 'desc')
      ->take(5)
      ->get();

    // Get recent materials
    $recentMaterials = Material::with(['subject', 'teacher.user'])
      ->where('class_id', $student->class_id)
      ->orderBy('created_at', 'desc')
      ->take(5)
      ->get();

    // Get attendance statistics
    $attendanceStats = $this->getAttendanceStats($student->id);

    return view('student.dashboard', compact(
      'student',
      'todaySchedule',
      'upcomingSchedule',
      'recentGrades',
      'announcements',
      'recentMaterials',
      'attendanceStats'
    ));
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
