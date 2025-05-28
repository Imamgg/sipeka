<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\ClassSchedule;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Subjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherGradeController extends Controller
{
  /**
   * Display list of grades for teacher's subjects.
   */
  public function index(Request $request)
  {
    $user = Auth::user();
    $teacher = $user->teacher;

    if (!$teacher) {
      return redirect()->route('teacher.dashboard')->with('error', 'Teacher data not found.');
    }

    // Get teacher's subjects and classes
    $teacherSchedules = ClassSchedule::with(['subject', 'classes'])
      ->where('teacher_id', $teacher->id)
      ->get();

    $subjectIds = $teacherSchedules->pluck('subject_id')->unique();
    $classIds = $teacherSchedules->pluck('class_id')->unique();

    // Filter parameters
    $selectedClass = $request->get('class_id');
    $selectedSubject = $request->get('subject_id');    // Get grades query
    $gradesQuery = Grade::with(['student.user', 'subject', 'student.classes'])
      ->where('teacher_id', $teacher->id);

    if ($selectedClass) {
      $gradesQuery->whereHas('student', function ($query) use ($selectedClass) {
        $query->where('class_id', $selectedClass);
      });
    }
    if ($selectedSubject) {
      $gradesQuery->where('subject_id', $selectedSubject);
    }

    $grades = $gradesQuery->orderBy('created_at', 'desc')->paginate(20);
    $classes = Classes::whereIn('id', $classIds)->orderBy('class_name')->get();
    $subjects = Subjects::whereIn('id', $subjectIds)->orderBy('subject_name')->get();

    return view('teacher.grades.index', compact(
      'grades',
      'classes',
      'subjects',
      'selectedClass',
      'selectedSubject',
      'teacher'
    ));
  }

  /**
   * Show form for creating new grade entry.
   */
  public function create(Request $request)
  {
    $user = Auth::user();
    $teacher = $user->teacher;

    if (!$teacher) {
      return redirect()->route('teacher.dashboard')->with('error', 'Teacher data not found.');
    }    // Get teacher's subjects and classes
    $teacherSchedules = ClassSchedule::with(['subject', 'classes'])
      ->where('teacher_id', $teacher->id)
      ->get();

    $classes = $teacherSchedules->groupBy('class_id')->map(function ($schedules) {
      return $schedules->first()->classes;
    });

    $subjects = $teacherSchedules->groupBy('subject_id')->map(function ($schedules) {
      return $schedules->first()->subject;
    });    // If class is pre-selected, get students
    $students = collect();
    if ($request->has('class_id')) {
      $classId = $request->get('class_id');
      $students = Student::with('user')
        ->where('class_id', $classId)
        ->join('users', 'students.user_id', '=', 'users.id')
        ->orderBy('users.name')
        ->select('students.*')
        ->get();
    }

    return view('teacher.grades.create', compact('classes', 'subjects', 'students', 'teacher'));
  }

  /**
   * Store new grade entry.
   */
  public function store(Request $request)
  {
    $user = Auth::user();
    $teacher = $user->teacher;

    if (!$teacher) {
      return redirect()->route('teacher.dashboard')->with('error', 'Teacher data not found.');
    }

    $request->validate([
      'student_id' => 'required|exists:students,id',
      'subject_id' => 'required|exists:subjects,id',
      'grade_type' => 'required|in:assignment,quiz,midterm,final,daily',
      'score' => 'required|numeric|min:0|max:100',
      'description' => 'nullable|string|max:255',
      'date' => 'required|date'
    ]);

    // Verify teacher has access to this student and subject
    $student = Student::findOrFail($request->student_id);
    $hasAccess = ClassSchedule::where('teacher_id', $teacher->id)
      ->where('class_id', $student->class_id)
      ->where('subject_id', $request->subject_id)
      ->exists();

    if (!$hasAccess) {
      return back()->withErrors(['error' => 'You do not have permission to grade this student in this subject.']);
    }

    Grade::create([
      'student_id' => $request->student_id,
      'subject_id' => $request->subject_id,
      'teacher_id' => $teacher->id,
      'grade_type' => $request->grade_type,
      'score' => $request->score,
      'description' => $request->description,
      'date' => $request->date,
    ]);

    return redirect()->route('teacher.grades.index')
      ->with('success', 'Grade recorded successfully!');
  }

  /**
   * Show form for editing grade.
   */
  public function edit(Grade $grade)
  {
    $user = Auth::user();
    $teacher = $user->teacher;

    if (!$teacher || $grade->teacher_id !== $teacher->id) {
      return redirect()->route('teacher.grades.index')
        ->with('error', 'You do not have permission to edit this grade.');
    }
    $grade->load(['student.user', 'subject', 'student.classes']);

    return view('teacher.grades.edit', compact('grade', 'teacher'));
  }

  /**
   * Update grade entry.
   */
  public function update(Request $request, Grade $grade)
  {
    $user = Auth::user();
    $teacher = $user->teacher;

    if (!$teacher || $grade->teacher_id !== $teacher->id) {
      return redirect()->route('teacher.grades.index')
        ->with('error', 'You do not have permission to edit this grade.');
    }

    $request->validate([
      'grade_type' => 'required|in:assignment,quiz,midterm,final,daily',
      'score' => 'required|numeric|min:0|max:100',
      'description' => 'nullable|string|max:255',
      'date' => 'required|date'
    ]);

    $grade->update([
      'grade_type' => $request->grade_type,
      'score' => $request->score,
      'description' => $request->description,
      'date' => $request->date,
    ]);

    return redirect()->route('teacher.grades.index')
      ->with('success', 'Grade updated successfully!');
  }

  /**
   * Delete grade entry.
   */
  public function destroy(Grade $grade)
  {
    $user = Auth::user();
    $teacher = $user->teacher;

    if (!$teacher || $grade->teacher_id !== $teacher->id) {
      return redirect()->route('teacher.grades.index')
        ->with('error', 'You do not have permission to delete this grade.');
    }

    $grade->delete();

    return redirect()->route('teacher.grades.index')
      ->with('success', 'Grade deleted successfully!');
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
}
