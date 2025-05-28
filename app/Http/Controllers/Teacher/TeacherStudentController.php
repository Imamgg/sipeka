<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\ClassSchedule;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherStudentController extends Controller
{
  /**
   * Display list of students in classes taught by this teacher.
   */
  public function index()
  {
    $user = Auth::user();
    $teacher = $user->teacher;

    if (!$teacher) {
      return redirect()->route('teacher.dashboard')->with('error', 'Teacher data not found.');
    }

    // Get all classes where this teacher teaches (from schedules)
    $taughtClassIds = ClassSchedule::where('teacher_id', $teacher->id)
      ->distinct('class_id')
      ->pluck('class_id');

    // Get homeroom classes
    $homeroomClassIds = Classes::where('homeroom_teacher_id', $teacher->id)
      ->pluck('id');

    // Combine both types of classes
    $allClassIds = $taughtClassIds->merge($homeroomClassIds)->unique();    // Get classes with students
    $classes = Classes::with(['students.user', 'students' => function ($query) {
      $query->join('users', 'students.user_id', '=', 'users.id')
        ->orderBy('users.name');
    }])
      ->whereIn('id', $allClassIds)
      ->orderBy('class_name')
      ->get();

    return view('teacher.students.index', compact('classes', 'teacher'));
  }

  /**
   * Show details of a specific student.
   */
  public function show(Student $student)
  {
    $user = Auth::user();
    $teacher = $user->teacher;

    if (!$teacher) {
      return redirect()->route('teacher.dashboard')->with('error', 'Teacher data not found.');
    }

    // Check if teacher has access to this student
    $hasAccess = $this->checkStudentAccess($teacher, $student);

    if (!$hasAccess) {
      return redirect()->route('teacher.students.index')
        ->with('error', 'You do not have access to this student.');
    }

    // Load student with relations
    $student->load(['user', 'classes', 'grades.subject', 'presences' => function ($query) {
      $query->orderBy('date', 'desc')->take(10);
    }]);

    return view('teacher.students.show', compact('student', 'teacher'));
  }

  /**
   * Check if teacher has access to a student.
   */
  private function checkStudentAccess($teacher, $student)
  {
    // Check if teacher teaches in student's class
    $teachesInClass = ClassSchedule::where('teacher_id', $teacher->id)
      ->where('class_id', $student->class_id)
      ->exists();

    // Check if teacher is homeroom teacher of student's class
    $isHomeroomTeacher = Classes::where('id', $student->class_id)
      ->where('homeroom_teacher_id', $teacher->id)
      ->exists();

    return $teachesInClass || $isHomeroomTeacher;
  }
}
