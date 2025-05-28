<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\ClassSchedule;
use App\Models\Classes;
use App\Models\Grade;
use App\Models\Presence;
use App\Models\Student;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherDashboardController extends Controller
{
    /**
     * Display the teacher dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        $teacher = $user->teacher;

        if (!$teacher) {
            return redirect()->route('dashboard')->with('error', 'Teacher data not found.');
        }

        // Get teacher's classes (as homeroom teacher)
        $homeroomClasses = Classes::where('homeroom_teacher_id', $teacher->id)
            ->withCount('students')
            ->get();

        // Get today's schedules for this teacher
        $today = Carbon::now();
        $todaySchedule = ClassSchedule::with(['subject', 'classes'])
            ->where('teacher_id', $teacher->id)
            ->where('day', $today->format('l'))
            ->orderBy('start_time')
            ->get();

        // Get this week's schedules
        $weeklySchedule = ClassSchedule::with(['subject', 'classes'])
            ->where('teacher_id', $teacher->id)
            ->orderBy('day')
            ->orderBy('start_time')
            ->get()
            ->groupBy('day');

        // Get total students under teacher's supervision (homeroom classes)
        $totalStudents = Student::whereIn('class_id', $homeroomClasses->pluck('id'))->count();

        // Get recent grades input by this teacher
        $recentGrades = Grade::with(['student.user', 'subject'])
            ->where('teacher_id', $teacher->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Get attendance statistics for teacher's homeroom classes
        $attendanceStats = [
            'total_sessions' => 0,
            'present_count' => 0,
            'absent_count' => 0,
            'late_count' => 0,
            'percentage' => 0
        ];

        if ($homeroomClasses->count() > 0) {
            $classIds = $homeroomClasses->pluck('id');
            $presences = Presence::whereIn('class_id', $classIds)
                ->whereMonth('date', Carbon::now()->month)
                ->get();

            $attendanceStats['total_sessions'] = $presences->count();
            $attendanceStats['present_count'] = $presences->where('status', 'present')->count();
            $attendanceStats['absent_count'] = $presences->where('status', 'absent')->count();
            $attendanceStats['late_count'] = $presences->where('status', 'late')->count();

            if ($attendanceStats['total_sessions'] > 0) {
                $attendanceStats['percentage'] = round(
                    ($attendanceStats['present_count'] / $attendanceStats['total_sessions']) * 100,
                    2
                );
            }
        }

        // Get recent announcements
        $announcements = Announcement::where('is_active', true)
            ->where(function ($query) {
                $query->where('target', 'all')
                    ->orWhere('target', 'teachers');
            })
            ->orderBy('published_at', 'desc')
            ->take(5)
            ->get();

        // Get subjects taught by this teacher
        $subjectsCount = ClassSchedule::where('teacher_id', $teacher->id)
            ->distinct('subject_id')
            ->count();

        return view('teacher.dashboard', compact(
            'teacher',
            'homeroomClasses',
            'todaySchedule',
            'weeklySchedule',
            'totalStudents',
            'recentGrades',
            'attendanceStats',
            'announcements',
            'subjectsCount'
        ));
    }
}
