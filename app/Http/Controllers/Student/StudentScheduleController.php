<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\ClassSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentScheduleController extends Controller
{
  /**
   * Display a listing of the student's schedules.
   */
  public function index()
  {
    $user = Auth::user();
    $student = Student::with(['classes'])->where('user_id', $user->id)->first();

    $schedules = ClassSchedule::with(['subject', 'teacher.user'])
      ->where('class_id', $student->class_id)
      ->orderByRaw("FIELD(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')")
      ->orderBy('start_time')
      ->get()
      ->groupBy('day');

    return view('student.schedule.index', compact('student', 'schedules'));
  }
}
