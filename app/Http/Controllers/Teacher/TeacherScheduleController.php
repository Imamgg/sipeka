<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\ClassSchedule;
use App\Models\Classes;
use App\Models\Subjects;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherScheduleController extends Controller
{
    /**
     * Display teacher's class schedules.
     */
    public function index()
    {
        $user = Auth::user();
        $teacher = $user->teacher;

        if (!$teacher) {
            return redirect()->route('teacher.dashboard')->with('error', 'Teacher data not found.');
        }

        // Get teacher's schedules
        $schedules = ClassSchedule::with(['classes', 'subject'])
            ->where('teacher_id', $teacher->id)
            ->orderBy('day')
            ->orderBy('start_time')
            ->get();

        // Group schedules by day
        $schedulesByDay = $schedules->groupBy('day');

        // Get today's schedules
        $today = Carbon::now()->format('l'); // Full day name
        $todaySchedules = $schedules->where('day', $today);

        return view('teacher.schedules.index', compact(
            'schedules',
            'schedulesByDay',
            'todaySchedules',
            'teacher'
        ));
    }

    /**
     * Show schedule details.
     */
    public function show(ClassSchedule $schedule)
    {
        $user = Auth::user();
        $teacher = $user->teacher;

        if (!$teacher || $schedule->teacher_id !== $teacher->id) {
            return redirect()->route('teacher.schedules.index')
                ->with('error', 'You do not have permission to view this schedule.');
        }

        $schedule->load(['classes.students', 'subject']);

        return view('teacher.schedules.show', compact('schedule', 'teacher'));
    }
}
