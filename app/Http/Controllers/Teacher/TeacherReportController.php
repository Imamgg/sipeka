<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\ClassSchedule;
use App\Models\Grade;
use App\Models\Presence;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Subjects;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherReportController extends Controller
{
  /**
   * Display reports dashboard.
   */
  public function index()
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
    $subjectIds = $teacherSchedules->pluck('subject_id')->unique();

    // Get report statistics
    $stats = [
      'total_classes' => $classIds->count(),
      'total_students' => Student::whereIn('class_id', $classIds)->count(),
      'total_grades' => Grade::where('teacher_id', $teacher->id)->count(),
      'total_attendance_records' => Presence::where('teacher_id', $teacher->id)->count(),
    ];

    return view('teacher.reports.index', compact('teacher', 'stats'));
  }

  /**
   * Generate grade report.
   */
  public function gradeReport(Request $request)
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

    $classIds = $teacherSchedules->pluck('class_id')->unique();
    $subjectIds = $teacherSchedules->pluck('subject_id')->unique();

    // Filter parameters
    $selectedClass = $request->get('class_id');
    $selectedSubject = $request->get('subject_id');
    $selectedSemester = $request->get('semester', 'current');

    // Build grades query
    $gradesQuery = Grade::with(['student.user', 'subject'])
      ->where('teacher_id', $teacher->id);

    if ($selectedClass) {
      $gradesQuery->whereHas('student', function ($query) use ($selectedClass) {
        $query->where('class_id', $selectedClass);
      });
    }

    if ($selectedSubject) {
      $gradesQuery->where('subject_id', $selectedSubject);
    }

    // Apply semester filter (assuming current academic year)
    if ($selectedSemester === 'current') {
      $currentMonth = Carbon::now()->month;
      if ($currentMonth >= 7) {
        // July-December (First semester)
        $startDate = Carbon::now()->startOfYear()->addMonths(6);
        $endDate = Carbon::now()->endOfYear();
      } else {
        // January-June (Second semester)
        $startDate = Carbon::now()->startOfYear();
        $endDate = Carbon::now()->startOfYear()->addMonths(5)->endOfMonth();
      }
      $gradesQuery->whereBetween('date', [$startDate, $endDate]);
    }

    $grades = $gradesQuery->orderBy('date', 'desc')->get();

    // Group grades by student and calculate averages
    $studentGrades = $grades->groupBy('student_id')->map(function ($studentGrades) {
      $student = $studentGrades->first()->student;
      $gradesByType = $studentGrades->groupBy('grade_type');

      $averages = [];
      $totalAverage = 0;
      $typeCount = 0;

      foreach ($gradesByType as $type => $typeGrades) {
        $average = $typeGrades->avg('score');
        $averages[$type] = round($average, 2);
        $totalAverage += $average;
        $typeCount++;
      }

      $finalAverage = $typeCount > 0 ? round($totalAverage / $typeCount, 2) : 0;

      return [
        'student' => $student,
        'grades' => $studentGrades,
        'averages' => $averages,
        'final_average' => $finalAverage,
        'letter_grade' => $this->getLetterGrade($finalAverage)
      ];
    });

    // Get filter options
    $classes = Classes::whereIn('id', $classIds)->orderBy('class_name')->get();
    $subjects = Subjects::whereIn('id', $subjectIds)->orderBy('subject_name')->get();

    return view('teacher.reports.grades', compact(
      'studentGrades',
      'classes',
      'subjects',
      'selectedClass',
      'selectedSubject',
      'selectedSemester',
      'teacher'
    ));
  }

  /**
   * Generate attendance report.
   */
  public function attendanceReport(Request $request)
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
    $selectedMonth = $request->get('month', Carbon::now()->month);
    $selectedYear = $request->get('year', Carbon::now()->year);

    // Build attendance query
    $attendanceQuery = Presence::with(['student.user', 'classes', 'subject'])
      ->where('teacher_id', $teacher->id)
      ->whereMonth('date', $selectedMonth)
      ->whereYear('date', $selectedYear);

    if ($selectedClass) {
      $attendanceQuery->where('class_id', $selectedClass);
    }

    $attendances = $attendanceQuery->get();

    // Group by student and calculate statistics
    $studentAttendance = $attendances->groupBy('student_id')->map(function ($studentAttendances) {
      $student = $studentAttendances->first()->student;
      $total = $studentAttendances->count();
      $present = $studentAttendances->where('status', 'present')->count();
      $late = $studentAttendances->where('status', 'late')->count();
      $absent = $studentAttendances->where('status', 'absent')->count();
      $sick = $studentAttendances->where('status', 'sick')->count();
      $permit = $studentAttendances->where('status', 'permit')->count();

      $attendanceRate = $total > 0 ? round((($present + $late) / $total) * 100, 2) : 0;

      return [
        'student' => $student,
        'total_sessions' => $total,
        'present' => $present,
        'late' => $late,
        'absent' => $absent,
        'sick' => $sick,
        'permit' => $permit,
        'attendance_rate' => $attendanceRate
      ];
    });    // Get filter options
    $classes = Classes::whereIn('id', $classIds)->orderBy('class_name')->get();
    $months = [
      1 => 'January',
      2 => 'February',
      3 => 'March',
      4 => 'April',
      5 => 'May',
      6 => 'June',
      7 => 'July',
      8 => 'August',
      9 => 'September',
      10 => 'October',
      11 => 'November',
      12 => 'December'
    ];
    $years = range(Carbon::now()->year - 2, Carbon::now()->year + 1);

    return view('teacher.reports.attendance', compact(
      'studentAttendance',
      'classes',
      'months',
      'years',
      'selectedClass',
      'selectedMonth',
      'selectedYear',
      'teacher'
    ));
  }

  /**
   * Generate class performance summary.
   */
  public function classPerformance(Request $request)
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

    // Get performance data for each class
    $classPerformance = Classes::whereIn('id', $classIds)
      ->with(['students'])
      ->get()
      ->map(function ($class) use ($teacher) {
        $studentIds = $class->students->pluck('id');

        // Grade statistics
        $grades = Grade::where('teacher_id', $teacher->id)
          ->whereIn('student_id', $studentIds)
          ->get();

        $gradeStats = [
          'total_grades' => $grades->count(),
          'average_score' => $grades->count() > 0 ? round($grades->avg('score'), 2) : 0,
          'highest_score' => $grades->count() > 0 ? $grades->max('score') : 0,
          'lowest_score' => $grades->count() > 0 ? $grades->min('score') : 0,
        ];

        // Attendance statistics
        $attendances = Presence::where('teacher_id', $teacher->id)
          ->whereIn('student_id', $studentIds)
          ->whereMonth('date', Carbon::now()->month)
          ->get();

        $attendanceStats = [
          'total_sessions' => $attendances->count(),
          'present_count' => $attendances->where('status', 'present')->count(),
          'attendance_rate' => $attendances->count() > 0 ?
            round(($attendances->whereIn('status', ['present', 'late'])->count() / $attendances->count()) * 100, 2) : 0
        ];

        return [
          'class' => $class,
          'student_count' => $class->students->count(),
          'grade_stats' => $gradeStats,
          'attendance_stats' => $attendanceStats
        ];
      });

    return view('teacher.reports.class-performance', compact('classPerformance', 'teacher'));
  }

  /**
   * Convert numeric grade to letter grade.
   */
  private function getLetterGrade($score)
  {
    if ($score >= 90) return 'A';
    if ($score >= 80) return 'B';
    if ($score >= 70) return 'C';
    if ($score >= 60) return 'D';
    return 'F';
  }
}
