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
    $allClassIds = $taughtClassIds->merge($homeroomClassIds)->unique();

    // If teacher has no classes, return empty view
    if ($allClassIds->isEmpty()) {
      return view('teacher.students.index', ['classes' => collect(), 'teacher' => $teacher]);
    }

    // Get classes with students, ensuring proper loading
    $classes = Classes::with(['students' => function ($query) {
      $query->whereNotNull('class_id')  // Ensure students have a class assigned
        ->with('user')  // Load user relationship
        ->join('users', 'students.user_id', '=', 'users.id')
        ->orderBy('users.name')
        ->select('students.*');  // Select only student fields to avoid column conflicts
    }])
      ->whereIn('id', $allClassIds)
      ->orderBy('class_name')
      ->get();

    // Filter out any classes without students or with null class_id students
    $classes = $classes->map(function ($class) {
      $class->students = $class->students->filter(function ($student) {
        return $student->class_id && $student->user;
      });
      return $class;
    })->filter(function ($class) {
      return $class->students->count() > 0;
    });

    return view('teacher.students.index', compact('classes', 'teacher'));
  }

  /**
   * Show details of a specific student.
   */
  public function show($studentId)
  {
    $user = Auth::user();
    $teacher = $user->teacher;

    if (!$teacher) {
      return redirect()->route('teacher.dashboard')->with('error', 'Teacher data not found.');
    }

    // Find student by ID with necessary relations
    $student = Student::with(['user', 'classes'])
      ->find($studentId);

    // Check if student exists
    if (!$student) {
      return redirect()->route('teacher.students.index')
        ->with('error', 'Student not found.');
    }

    // Check if teacher has access to this student
    $hasAccess = $this->checkStudentAccess($teacher, $student);

    if (!$hasAccess) {
      return redirect()->route('teacher.students.index')
        ->with('error', 'You do not have access to this student.');
    }

    // Load additional relations
    $student->load(['grades.subject', 'presences' => function ($query) {
      $query->orderBy('date', 'desc')->take(10);
    }]);

    return view('teacher.students.show', compact('student', 'teacher'));
  }

  /**
   * Get students for a specific class (AJAX endpoint)
   */
  public function getStudentsByClass(Request $request)
  {
    $user = Auth::user();
    $teacher = $user->teacher;
    $classId = $request->get('class_id');

    if (!$teacher || !$classId) {
      return response()->json([]);
    }

    // Verify teacher has access to this class
    $hasAccess = $this->checkClassAccess($teacher, $classId);

    if (!$hasAccess) {
      return response()->json([]);
    }

    $students = Student::with('user')
      ->where('class_id', $classId)
      ->whereHas('user')  // Ensure user exists
      ->get()
      ->map(function ($student) {
        return [
          'id' => $student->id,
          'name' => $student->user->name,
          'nis' => $student->nis,
          'nisn' => $student->nisn
        ];
      });

    return response()->json($students);
  }

  /**
   * Check if teacher has access to a student.
   */
  private function checkStudentAccess($teacher, $student)
  {
    // Ensure student has a class assigned
    if (!$student->class_id) {
      return false;
    }

    // Check if teacher teaches in student's class (from schedules)
    $teachesInClass = ClassSchedule::where('teacher_id', $teacher->id)
      ->where('class_id', $student->class_id)
      ->exists();

    // Check if teacher is homeroom teacher of student's class
    $isHomeroomTeacher = Classes::where('id', $student->class_id)
      ->where('homeroom_teacher_id', $teacher->id)
      ->exists();


    return $teachesInClass || $isHomeroomTeacher;
  }

  /**
   * Check if teacher has access to a specific class
   */
  private function checkClassAccess($teacher, $classId)
  {
    // Check if teacher teaches in this class
    $teachesInClass = ClassSchedule::where('teacher_id', $teacher->id)
      ->where('class_id', $classId)
      ->exists();

    // Check if teacher is homeroom teacher of this class
    $isHomeroomTeacher = Classes::where('id', $classId)
      ->where('homeroom_teacher_id', $teacher->id)
      ->exists();

    return $teachesInClass || $isHomeroomTeacher;
  }
}
