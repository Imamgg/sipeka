<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Grade;
use App\Models\Presence;
use App\Models\PresenceDetail;
use App\Models\Student;
use App\Models\Subjects;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminReportController extends Controller
{
  /**
   * Display the admin reports dashboard.
   */
  public function index()
  {
    // Get overview statistics
    $totalStudents = Student::count();
    $totalTeachers = Teacher::count();
    $totalClasses = Classes::count();
    $totalSubjects = Subjects::count();

    // Calculate average grade
    $averageGrade = Grade::avg('score') ?? 0;

    // Calculate average attendance rate
    $totalPresences = Presence::count();
    $presentCount = Presence::where('status', 'present')->count();
    $averageAttendance = $totalPresences > 0 ? ($presentCount / $totalPresences) * 100 : 0;    // Recent activity
    $recentGrades = Grade::with(['student.user', 'student.classes', 'subject', 'teacher.user'])
      ->orderBy('created_at', 'desc')
      ->take(5)
      ->get();

    $recentAttendances = Presence::with(['student.user', 'classes', 'subject'])
      ->orderBy('date', 'desc')
      ->take(5)
      ->get();

    // Monthly performance trends
    $monthlyGrades = Grade::selectRaw('MONTH(created_at) as month, AVG(score) as avg_score')
      ->whereYear('created_at', now()->year)
      ->groupBy('month')
      ->orderBy('month')
      ->get();

    $monthlyAttendance = Presence::selectRaw('MONTH(date) as month, 
                COUNT(*) as total,
                SUM(CASE WHEN status = "present" THEN 1 ELSE 0 END) as present_count')
      ->whereYear('date', now()->year)
      ->groupBy('month')
      ->orderBy('month')
      ->get();

    return view('admin.report.index', compact(
      'totalStudents',
      'totalTeachers',
      'totalClasses',
      'totalSubjects',
      'averageGrade',
      'averageAttendance',
      'recentGrades',
      'recentAttendances',
      'monthlyGrades',
      'monthlyAttendance'
    ));
  }

  /**
   * School-wide student performance report.
   */
  public function studentPerformance(Request $request)
  {
    $selectedClass = $request->get('class_id');
    $selectedSubject = $request->get('subject_id');
    $selectedSemester = $request->get('semester', 'current');

    // Build grades query
    $gradesQuery = Grade::with(['student.user', 'student.classes', 'subject', 'teacher.user']);

    if ($selectedClass) {
      $gradesQuery->whereHas('student', function ($query) use ($selectedClass) {
        $query->where('class_id', $selectedClass);
      });
    }

    if ($selectedSubject) {
      $gradesQuery->where('subject_id', $selectedSubject);
    }

    // Apply semester filter
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

    // Calculate student performance statistics
    $studentPerformance = $grades->groupBy('student_id')->map(function ($studentGrades) {
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
        'grades_count' => $studentGrades->count(),
        'averages' => $averages,
        'final_average' => $finalAverage,
        'letter_grade' => $this->getLetterGrade($finalAverage),
        'performance_status' => $this->getPerformanceStatus($finalAverage)
      ];
    })->sortByDesc('final_average');

    // Grade distribution analysis
    $gradeDistribution = $grades->groupBy(function ($grade) {
      return $this->getLetterGrade($grade->score);
    })->map(function ($gradeGroup) {
      return $gradeGroup->count();
    });

    // Class performance comparison
    $classPerformance = Classes::with(['students'])
      ->get()
      ->map(function ($class) use ($selectedSubject, $selectedSemester) {
        $studentIds = $class->students->pluck('id');

        $query = Grade::whereIn('student_id', $studentIds);

        if ($selectedSubject) {
          $query->where('subject_id', $selectedSubject);
        }

        if ($selectedSemester === 'current') {
          $currentMonth = Carbon::now()->month;
          if ($currentMonth >= 7) {
            $startDate = Carbon::now()->startOfYear()->addMonths(6);
            $endDate = Carbon::now()->endOfYear();
          } else {
            $startDate = Carbon::now()->startOfYear();
            $endDate = Carbon::now()->startOfYear()->addMonths(5)->endOfMonth();
          }
          $query->whereBetween('date', [$startDate, $endDate]);
        }

        $classGrades = $query->get();

        return [
          'class' => $class,
          'student_count' => $studentIds->count(),
          'grades_count' => $classGrades->count(),
          'average_score' => $classGrades->count() > 0 ? round($classGrades->avg('score'), 2) : 0,
          'highest_score' => $classGrades->count() > 0 ? $classGrades->max('score') : 0,
          'lowest_score' => $classGrades->count() > 0 ? $classGrades->min('score') : 0,
        ];
      })->sortByDesc('average_score');    // Get filter options
    $classes = Classes::orderBy('class_name')->get();
    $subjects = Subjects::orderBy('subject_name')->get();

    // Transform data for the view
    $students = $studentPerformance;
    $totalStudents = Student::count();
    $averageGrade = $grades->count() > 0 ? $grades->avg('score') : 0;

    // Top performers (top 10)
    $topPerformers = $studentPerformance->take(10);

    // Students needing attention (bottom performers)
    $needsAttention = $studentPerformance->filter(function ($student) {
      return $student['final_average'] < 70;
    });

    return view('admin.report.student-performance', compact(
      'students',
      'totalStudents',
      'averageGrade',
      'gradeDistribution',
      'topPerformers',
      'needsAttention',
      'classPerformance',
      'classes',
      'subjects',
      'selectedClass',
      'selectedSubject',
      'selectedSemester'
    ));
  }

  /**
   * Teacher performance and activity report.
   */
  public function teacherPerformance(Request $request)
  {
    $selectedTeacher = $request->get('teacher_id');
    $selectedMonth = $request->get('month', Carbon::now()->month);
    $selectedYear = $request->get('year', Carbon::now()->year);

    // Build teacher performance query
    $teachersQuery = Teacher::with(['user', 'classes']);

    if ($selectedTeacher) {
      $teachersQuery->where('id', $selectedTeacher);
    }

    $teachers = $teachersQuery->get();

    $teacherPerformance = $teachers->map(function ($teacher) use ($selectedMonth, $selectedYear) {
      // Get grades input by teacher
      $gradesQuery = Grade::where('teacher_id', $teacher->id)
        ->whereMonth('created_at', $selectedMonth)
        ->whereYear('created_at', $selectedYear);

      $grades = $gradesQuery->get();

      // Get attendance records by teacher
      $attendanceQuery = Presence::where('teacher_id', $teacher->id)
        ->whereMonth('date', $selectedMonth)
        ->whereYear('date', $selectedYear);

      $attendances = $attendanceQuery->get();

      // Calculate statistics
      $gradeStats = [
        'total_grades' => $grades->count(),
        'average_score' => $grades->count() > 0 ? round($grades->avg('score'), 2) : 0,
        'grade_distribution' => $grades->groupBy(function ($grade) {
          return $this->getLetterGrade($grade->score);
        })->map->count()
      ];

      $attendanceStats = [
        'total_sessions' => $attendances->count(),
        'present_count' => $attendances->where('status', 'present')->count(),
        'attendance_rate' => $attendances->count() > 0 ?
          round(($attendances->where('status', 'present')->count() / $attendances->count()) * 100, 2) : 0
      ];

      // Get classes taught and main subject through ClassSchedule
      $classSchedules = $teacher->classSchedules()->with(['classes', 'subject'])->get();
      $classesTaught = $classSchedules->pluck('classes')->filter()->unique('id');
      $subjects = $classSchedules->pluck('subject')->filter()->unique('id');
      $mainSubject = $subjects->first()?->name ?? 'N/A';

      // Count classes taught
      $classesCount = $classesTaught->count();

      // Format classes taught list
      $classesNames = $classesTaught->pluck('name')->implode(', ');
      if (empty($classesNames)) {
        $classesNames = 'N/A';
      }      // Count materials (assuming there's a materials relationship or count)
      $materialsCount = 0; // Default to 0 since materials table might not exist yet

      return [
        'id' => $teacher->id,
        'name' => $teacher->user->name ?? 'N/A',
        'nip' => $teacher->nip ?? 'N/A',
        'subject' => $mainSubject,
        'classes_names' => $classesNames,
        'class_average' => $gradeStats['average_score'],
        'total_grades' => $gradeStats['total_grades'],
        'attendance_rate' => $attendanceStats['attendance_rate'],
        'classes_count' => $classesCount,
        'materials_count' => $materialsCount,
        'classes_taught' => $classesTaught,
        'grade_stats' => $gradeStats,
        'attendance_stats' => $attendanceStats,
        'activity_score' => $this->calculateActivityScore($gradeStats, $attendanceStats)
      ];
    })->sortByDesc('activity_score');

    // Get filter options
    $teachers = Teacher::with('user')->orderBy('nip')->get();
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
    $years = range(Carbon::now()->year - 2, Carbon::now()->year + 1);    // Transform data for the view
    $totalTeachers = Teacher::count();
    $averageClassPerformance = Grade::avg('score') ?? 0;

    // Teacher statistics
    $teacherStats = [
      'active' => Teacher::count(),
      'total_materials' => 0, // Assuming no materials table yet
      'avg_attendance' => 95.0, // Mock data
      'active_classes' => Classes::count()
    ];

    // Top teachers (top 5)
    $topTeachers = $teacherPerformance->take(5);    // Recent teacher activities (mock data)
    $teacherActivities = collect([
      [
        'teacher' => 'Sample Teacher',
        'activity' => 'Uploaded new material',
        'time' => '2 hours ago'
      ]
    ]);

    return view('admin.report.teacher-performance', compact(
      'totalTeachers',
      'averageClassPerformance',
      'teacherStats',
      'topTeachers',
      'teacherActivities',
      'teacherPerformance',
      'selectedTeacher',
      'selectedMonth',
      'selectedYear'
    ));
  }
  /**
   * School-wide attendance statistics.
   */
  public function attendanceStatistics(Request $request)
  {
    $selectedClass = $request->get('class_id');
    $selectedMonth = $request->get('month', Carbon::now()->month);
    $selectedYear = $request->get('year', Carbon::now()->year);

    // Build attendance query
    $attendanceQuery = Presence::with(['student.user', 'student.classes', 'subject', 'teacher.user'])
      ->whereMonth('date', $selectedMonth)
      ->whereYear('date', $selectedYear);

    if ($selectedClass) {
      $attendanceQuery->where('class_id', $selectedClass);
    }

    $attendances = $attendanceQuery->get();

    // Attendance statistics for the view
    $attendanceStats = [
      'total_attendance' => $attendances->count(),
      'present' => $attendances->where('status', 'present')->count(),
      'absent' => $attendances->where('status', 'absent')->count(),
      'late' => $attendances->where('status', 'late')->count(),
      'permission' => $attendances->where('status', 'permit')->count(),
      'sick' => $attendances->where('status', 'sick')->count(),
      'late_students' => $attendances->where('status', 'late')->count(),
      'absent_students' => $attendances->where('status', 'absent')->count(),
    ];

    $attendanceStats['attendance_rate'] = $attendanceStats['total_attendance'] > 0 ?
      round((($attendanceStats['present'] + $attendanceStats['late']) / $attendanceStats['total_attendance']) * 100, 2) : 0;

    // Class attendance comparison
    $classAttendance = Classes::with(['students', 'teacher.user'])
      ->get()
      ->map(function ($class) use ($selectedMonth, $selectedYear) {
        $attendances = Presence::where('class_id', $class->id)
          ->whereMonth('date', $selectedMonth)
          ->whereYear('date', $selectedYear)
          ->get();

        $total = $attendances->count();
        $present = $attendances->where('status', 'present')->count();
        $late = $attendances->where('status', 'late')->count();
        $absent = $attendances->where('status', 'absent')->count();
        $permission = $attendances->where('status', 'permit')->count();
        $sick = $attendances->where('status', 'sick')->count();

        return [
          'class_name' => $class->class_name,
          'teacher_name' => $class->teacher->user->name ?? 'N/A',
          'total_students' => $class->students->count(),
          'present' => $present,
          'absent' => $absent,
          'late' => $late,
          'permission' => $permission,
          'sick' => $sick,
          'attendance_rate' => $total > 0 ? round((($present + $late) / $total) * 100, 2) : 0
        ];
      })->sortByDesc('attendance_rate');

    // Students with poor attendance (below 75%)
    $poorAttendanceStudents = Student::with(['user', 'classes'])
      ->get()
      ->map(function ($student) use ($selectedMonth, $selectedYear) {
        $studentAttendances = Presence::where('student_id', $student->id)
          ->whereMonth('date', $selectedMonth)
          ->whereYear('date', $selectedYear)
          ->get();

        $totalDays = $studentAttendances->count();
        $presentDays = $studentAttendances->where('status', 'present')->count();
        $lateDays = $studentAttendances->where('status', 'late')->count();
        $absentDays = $studentAttendances->where('status', 'absent')->count();

        $attendanceRate = $totalDays > 0 ? round((($presentDays + $lateDays) / $totalDays) * 100, 2) : 0;

        return [
          'id' => $student->id,
          'name' => $student->user->name,
          'student_id' => $student->nisn,
          'class_name' => $student->classes->class_name ?? 'N/A',
          'total_days' => $totalDays,
          'present_days' => $presentDays,
          'absent_days' => $absentDays,
          'attendance_rate' => $attendanceRate
        ];
      })
      ->filter(function ($student) {
        return $student['attendance_rate'] < 75 && $student['total_days'] > 0;
      })
      ->sortBy('attendance_rate');

    // Attendance trend (last 7 days)
    $attendanceTrend = [
      'dates' => [],
      'rates' => []
    ];

    for ($i = 6; $i >= 0; $i--) {
      $date = Carbon::now()->subDays($i);
      $dayAttendances = Presence::whereDate('date', $date)->get();

      $total = $dayAttendances->count();
      $present = $dayAttendances->where('status', 'present')->count();
      $late = $dayAttendances->where('status', 'late')->count();

      $rate = $total > 0 ? round((($present + $late) / $total) * 100, 2) : 0;

      $attendanceTrend['dates'][] = $date->format('d/m');
      $attendanceTrend['rates'][] = $rate;
    }

    // Get filter options
    $classes = Classes::orderBy('class_name')->get();
    return view('admin.report.attendance-statistics', compact(
      'attendanceStats',
      'classAttendance',
      'poorAttendanceStudents',
      'attendanceTrend',
      'classes',
      'selectedClass',
      'selectedMonth',
      'selectedYear'
    ));
  }
  /**
   * Grade distribution analysis.
   */
  public function gradeDistribution(Request $request)
  {
    $selectedClass = $request->get('class_id');
    $selectedSubject = $request->get('subject_id');
    $selectedPeriod = $request->get('period', 'current_semester');

    // Build grades query
    $gradesQuery = Grade::with(['student.user', 'student.classes', 'subject', 'teacher.user']);

    if ($selectedClass) {
      $gradesQuery->whereHas('student', function ($query) use ($selectedClass) {
        $query->where('class_id', $selectedClass);
      });
    }

    if ($selectedSubject) {
      $gradesQuery->where('subject_id', $selectedSubject);
    }

    // Apply period filter
    if ($selectedPeriod === 'current_semester') {
      $currentMonth = Carbon::now()->month;
      if ($currentMonth >= 7) {
        $startDate = Carbon::now()->startOfYear()->addMonths(6);
        $endDate = Carbon::now()->endOfYear();
      } else {
        $startDate = Carbon::now()->startOfYear();
        $endDate = Carbon::now()->startOfYear()->addMonths(5)->endOfMonth();
      }
      $gradesQuery->whereBetween('created_at', [$startDate, $endDate]);
    }

    $grades = $gradesQuery->get();

    // Grade statistics for the view
    $gradeStats = [
      'average_grade' => $grades->count() > 0 ? $grades->avg('score') : 0,
      'highest_grade' => $grades->count() > 0 ? $grades->max('score') : 0,
      'lowest_grade' => $grades->count() > 0 ? $grades->min('score') : 0,
      'total_grades' => $grades->count(),
    ];

    // Grade distribution for chart
    $gradeDistribution = [
      $grades->whereBetween('score', [90, 100])->count(), // A
      $grades->whereBetween('score', [80, 89])->count(),  // B
      $grades->whereBetween('score', [70, 79])->count(),  // C
      $grades->whereBetween('score', [60, 69])->count(),  // D
      $grades->where('score', '<', 60)->count(),          // E
    ];

    // Subject-wise grade analysis
    $subjectGrades = Subjects::with(['teacher.user'])
      ->get()
      ->map(function ($subject) use ($grades) {
        $subjectGrades = $grades->where('subject_id', $subject->id);

        return [
          'name' => $subject->subject_name,
          'teacher_name' => $subject->teacher->user->name ?? 'N/A',
          'student_count' => $subjectGrades->groupBy('student_id')->count(),
          'average' => $subjectGrades->count() > 0 ? $subjectGrades->avg('score') : 0,
          'highest' => $subjectGrades->count() > 0 ? $subjectGrades->max('score') : 0,
          'lowest' => $subjectGrades->count() > 0 ? $subjectGrades->min('score') : 0,
          'grade_a' => $subjectGrades->whereBetween('score', [90, 100])->count(),
          'grade_b' => $subjectGrades->whereBetween('score', [80, 89])->count(),
          'grade_c' => $subjectGrades->whereBetween('score', [70, 79])->count(),
          'grade_d' => $subjectGrades->whereBetween('score', [60, 69])->count(),
          'grade_e' => $subjectGrades->where('score', '<', 60)->count(),
        ];
      })
      ->filter(function ($subject) {
        return $subject['student_count'] > 0;
      })
      ->sortByDesc('average');

    // Class-wise grade analysis
    $classGrades = Classes::with(['teacher.user', 'students'])
      ->get()
      ->map(function ($class) use ($grades) {
        $classGrades = $grades->whereIn('student_id', $class->students->pluck('id'));

        $topStudent = $classGrades->groupBy('student_id')
          ->map(function ($studentGrades) {
            return [
              'student' => $studentGrades->first()->student,
              'average' => $studentGrades->avg('score')
            ];
          })
          ->sortByDesc('average')
          ->first();

        return [
          'name' => $class->class_name,
          'teacher_name' => $class->teacher->user->name ?? 'N/A',
          'student_count' => $class->students->count(),
          'average' => $classGrades->count() > 0 ? $classGrades->avg('score') : 0,
          'highest_grade' => $classGrades->count() > 0 ? $classGrades->max('score') : 0,
          'top_student' => $topStudent ? $topStudent['student']->user->name : 'N/A',
          'grade_a' => $classGrades->whereBetween('score', [90, 100])->count(),
          'grade_b' => $classGrades->whereBetween('score', [80, 89])->count(),
          'grade_c' => $classGrades->whereBetween('score', [70, 79])->count(),
        ];
      })
      ->filter(function ($class) {
        return $class['student_count'] > 0;
      })
      ->sortByDesc('average')
      ->values();

    // Students needing attention (average < 70)
    $studentsNeedingAttention = Student::with(['user', 'classes'])
      ->get()
      ->map(function ($student) use ($grades) {
        $studentGrades = $grades->where('student_id', $student->id);

        if ($studentGrades->count() == 0) return null;

        $averageGrade = $studentGrades->avg('score');

        if ($averageGrade >= 70) return null;

        $problematicSubjects = $studentGrades->groupBy('subject_id')
          ->filter(function ($subjectGrades) {
            return $subjectGrades->avg('score') < 70;
          })
          ->map(function ($subjectGrades) {
            return $subjectGrades->first()->subject->subject_name;
          })
          ->values()
          ->toArray();

        return [
          'id' => $student->id,
          'name' => $student->user->name,
          'student_id' => $student->nisn,
          'class_name' => $student->classes->class_name ?? 'N/A',
          'average_grade' => $averageGrade,
          'problematic_subjects' => $problematicSubjects,
          'trend' => 'stable' // Simplified for now
        ];
      })
      ->filter()
      ->sortBy('average_grade');

    // Grade trend over months
    $gradeTrend = [
      'months' => [],
      'averages' => []
    ];

    for ($i = 5; $i >= 0; $i--) {
      $month = Carbon::now()->subMonths($i);
      $monthGrades = Grade::whereMonth('created_at', $month->month)
        ->whereYear('created_at', $month->year)
        ->get();

      $gradeTrend['months'][] = $month->format('M Y');
      $gradeTrend['averages'][] = $monthGrades->count() > 0 ? $monthGrades->avg('score') : 0;
    }

    // Get filter options
    $classes = Classes::orderBy('class_name')->get();
    $subjects = Subjects::orderBy('subject_name')->get();

    return view('admin.report.grade-distribution', compact(
      'gradeStats',
      'gradeDistribution',
      'subjectGrades',
      'classGrades',
      'studentsNeedingAttention',
      'gradeTrend',
      'classes',
      'subjects',
      'selectedClass',
      'selectedSubject',
      'selectedPeriod'
    ));
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

  /**
   * Get performance status based on average score.
   */
  private function getPerformanceStatus($score)
  {
    if ($score >= 90) return 'excellent';
    if ($score >= 80) return 'good';
    if ($score >= 70) return 'average';
    return 'needs_improvement';
  }

  /**
   * Calculate teacher activity score.
   */
  private function calculateActivityScore($gradeStats, $attendanceStats)
  {
    $gradeScore = min($gradeStats['total_grades'] * 2, 50); // Max 50 points for grading activity
    $attendanceScore = min($attendanceStats['total_sessions'] * 1, 30); // Max 30 points for attendance activity
    $qualityScore = $attendanceStats['attendance_rate'] * 0.2; // Max 20 points for attendance quality

    return round($gradeScore + $attendanceScore + $qualityScore, 2);
  }
}
