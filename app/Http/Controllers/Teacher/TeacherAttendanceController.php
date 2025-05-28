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
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
      return redirect()->route('teacher.dashboard')->with('error', 'Teacher data not found.');
    }

    // Get teacher's classes
    $teacherSchedules = ClassSchedule::with(['classes', 'subject'])
      ->where('teacher_id', $teacher->id)
      ->get();

    $classIds = $teacherSchedules->pluck('class_id')->unique();

    // Filter parameters
    $selectedClass = $request->get('class_id');
    $selectedDate = $request->get('date', Carbon::today()->format('Y-m-d'));

    // Get attendance records
    $attendanceQuery = Presence::with(['student.user', 'classes', 'subject'])
      ->whereHas('classes', function ($query) use ($classIds) {
        $query->whereIn('id', $classIds);
      });

    if ($selectedClass) {
      $attendanceQuery->where('class_id', $selectedClass);
    }

    if ($selectedDate) {
      $attendanceQuery->whereDate('date', $selectedDate);
    }
    $attendances = $attendanceQuery->orderBy('date', 'desc')
      ->orderBy('class_id')
      ->paginate(20);

    // Get filter options
    $classes = Classes::whereIn('id', $classIds)->orderBy('class_name')->get();

    return view('teacher.attendance.index', compact(
      'attendances',
      'classes',
      'selectedClass',
      'selectedDate',
      'teacher',
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
      return redirect()->route('teacher.dashboard')->with('error', 'Teacher data not found.');
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

    // If class is pre-selected, get students    $students = collect();
    if ($request->has('class_id')) {
      $classId = $request->get('class_id');
      $students = Student::with('user')
        ->where('class_id', $classId)
        ->join('users', 'students.user_id', '=', 'users.id')
        ->orderBy('users.name')
        ->select('students.*')
        ->get();
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
      return redirect()->route('teacher.dashboard')->with('error', 'Teacher data not found.');
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
      return back()->withErrors(['error' => 'You do not have permission to record attendance for this class and subject.']);
    }

    // Check if attendance already exists for this date, class, and subject
    $existingAttendance = Presence::where('class_id', $request->class_id)
      ->where('subject_id', $request->subject_id)
      ->whereDate('date', $request->date)
      ->exists();

    if ($existingAttendance) {
      return back()->withErrors(['error' => 'Attendance for this class, subject, and date already exists.']);
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
      ->with('success', 'Attendance recorded successfully!');
  }

  /**
   * Show form for editing attendance.
   */
  public function edit(Request $request)
  {
    $user = Auth::user();
    $teacher = $user->teacher;

    if (!$teacher) {
      return redirect()->route('teacher.dashboard')->with('error', 'Teacher data not found.');
    }

    $classId = $request->get('class_id');
    $subjectId = $request->get('subject_id');
    $date = $request->get('date');

    if (!$classId || !$subjectId || !$date) {
      return redirect()->route('teacher.attendance.index')
        ->with('error', 'Missing required parameters.');
    }

    // Verify teacher has access
    $hasAccess = ClassSchedule::where('teacher_id', $teacher->id)
      ->where('class_id', $classId)
      ->where('subject_id', $subjectId)
      ->exists();

    if (!$hasAccess) {
      return redirect()->route('teacher.attendance.index')
        ->with('error', 'You do not have permission to edit this attendance.');
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
      return redirect()->route('teacher.dashboard')->with('error', 'Teacher data not found.');
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
        ->with('error', 'You do not have permission to edit this attendance.');
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
      ->with('success', 'Attendance updated successfully!');
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
