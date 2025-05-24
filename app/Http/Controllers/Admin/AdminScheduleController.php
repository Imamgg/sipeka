<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest;
use App\Http\Resources\ScheduleResource;
use App\Models\ClassSchedule;
use App\Models\Classes;
use App\Models\Subjects;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminScheduleController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $query = ClassSchedule::with(['class', 'teacher.user', 'subject']);

    // Filter by class if specified
    if ($request->has('class_id') && $request->class_id) {
      $query->where('class_id', $request->class_id);
    }

    // Filter by teacher if specified
    if ($request->has('teacher_id') && $request->teacher_id) {
      $query->where('teacher_id', $request->teacher_id);
    }

    // Filter by subject if specified
    if ($request->has('subject_id') && $request->subject_id) {
      $query->where('subject_id', $request->subject_id);
    }

    // Filter by day if specified
    if ($request->has('day') && $request->day) {
      $query->where('day', $request->day);
    }

    // Filter by semester if specified
    if ($request->has('semester') && $request->semester) {
      $query->where('semester', $request->semester);
    }

    $schedules = $query->latest()->paginate(10);
    $classes = Classes::all();
    $teachers = Teacher::with('user')->get();
    $subjects = Subjects::all();

    return view('admin.schedules.index', compact('schedules', 'classes', 'teachers', 'subjects'));
  }

  /**
   * Show the form for creating a new resource.
   */  public function create()
  {
    $classes = Classes::all();
    $teachers = Teacher::with('user')->get();
    $subjects = Subjects::all();
    $days = [
      'Monday' => 'Senin',
      'Tuesday' => 'Selasa',
      'Wednesday' => 'Rabu',
      'Thursday' => 'Kamis',
      'Friday' => 'Jumat',
      'Saturday' => 'Sabtu'
    ];
    $semesters = [
      'Odd' => 'Ganjil',
      'Even' => 'Genap'
    ];

    return view('admin.schedules.create', compact('classes', 'teachers', 'subjects', 'days', 'semesters'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(ScheduleRequest $request)
  {
    try {
      DB::beginTransaction();      // Check if a schedule with the same time slot and class already exists
      $conflictingSchedule = ClassSchedule::where('class_id', $request->class_id)
        ->where('day', $request->day)
        ->where(function ($query) use ($request) {
          $query->where(function ($q) use ($request) {
            // Start time falls within existing schedule
            $q->where('start_time', '<=', $request->start_time)
              ->where('end_time', '>', $request->start_time);
          })
            ->orWhere(function ($q) use ($request) {
              // End time falls within existing schedule
              $q->where('start_time', '<', $request->end_time)
                ->where('end_time', '>=', $request->end_time);
            })
            ->orWhere(function ($q) use ($request) {
              // Schedule completely contains the new time slot
              $q->where('start_time', '>=', $request->start_time)
                ->where('end_time', '<=', $request->end_time);
            });
        })->first();

      if ($conflictingSchedule) {
        DB::rollBack();
        return redirect()->back()
          ->with('toast_error', 'Jadwal bertabrakan dengan jadwal yang sudah ada')
          ->withInput();
      }      // Check if the teacher is already scheduled at the same time
      $teacherConflict = ClassSchedule::where('teacher_id', $request->teacher_id)
        ->where('day', $request->day)
        ->where(function ($query) use ($request) {
          $query->where(function ($q) use ($request) {
            // Start time falls within existing schedule
            $q->where('start_time', '<=', $request->start_time)
              ->where('end_time', '>', $request->start_time);
          })
            ->orWhere(function ($q) use ($request) {
              // End time falls within existing schedule
              $q->where('start_time', '<', $request->end_time)
                ->where('end_time', '>=', $request->end_time);
            })
            ->orWhere(function ($q) use ($request) {
              // Schedule completely contains the new time slot
              $q->where('start_time', '>=', $request->start_time)
                ->where('end_time', '<=', $request->end_time);
            });
        })->first();

      if ($teacherConflict) {
        DB::rollBack();
        return redirect()->back()
          ->with('toast_error', 'Guru sudah memiliki jadwal pada waktu yang sama')
          ->withInput();
      }

      $schedule = ClassSchedule::create($request->validated());

      DB::commit();

      return redirect()->route('admin.schedules.index')
        ->with('toast_success', 'Jadwal berhasil ditambahkan');
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()->back()
        ->with('toast_error', 'Gagal menambahkan jadwal: ' . $e->getMessage())
        ->withInput();
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(ClassSchedule $schedule)
  {
    $schedule->load(['class', 'teacher.user', 'subject']);
    return view('admin.schedules.show', compact('schedule'));
  }

  /**
   * Show the form for editing the specified resource.
   */  public function edit(ClassSchedule $schedule)
  {
    $classes = Classes::all();
    $teachers = Teacher::with('user')->get();
    $subjects = Subjects::all();
    $days = [
      'Monday' => 'Senin',
      'Tuesday' => 'Selasa',
      'Wednesday' => 'Rabu',
      'Thursday' => 'Kamis',
      'Friday' => 'Jumat',
      'Saturday' => 'Sabtu'
    ];
    $semesters = [
      'Odd' => 'Ganjil',
      'Even' => 'Genap'
    ];

    return view('admin.schedules.edit', compact('schedule', 'classes', 'teachers', 'subjects', 'days', 'semesters'));
  }
  /**
   * Update the specified resource in storage.
   */
  public function update(ScheduleRequest $request, ClassSchedule $schedule)
  {
    try {
      DB::beginTransaction();

      // Ensure time formats are correct
      $startTime = date('H:i', strtotime($request->start_time));
      $endTime = date('H:i', strtotime($request->end_time));

      // Check if a schedule with the same time slot and class already exists (excluding current schedule)
      $conflictingSchedule = ClassSchedule::where('class_id', $request->class_id)
        ->where('day', $request->day)
        ->where('id', '!=', $schedule->id)
        ->where(function ($query) use ($startTime, $endTime) {
          $query->where(function ($q) use ($startTime, $endTime) {
            // Start time falls within existing schedule
            $q->where('start_time', '<=', $startTime)
              ->where('end_time', '>', $startTime);
          })
            ->orWhere(function ($q) use ($startTime, $endTime) {
              // End time falls within existing schedule
              $q->where('start_time', '<', $endTime)
                ->where('end_time', '>=', $endTime);
            })
            ->orWhere(function ($q) use ($startTime, $endTime) {
              // Schedule completely contains the new time slot
              $q->where('start_time', '>=', $startTime)
                ->where('end_time', '<=', $endTime);
            });
        })->first();

      if ($conflictingSchedule) {
        DB::rollBack();
        return redirect()->back()
          ->with('toast_error', 'Jadwal bertabrakan dengan jadwal yang sudah ada')
          ->withInput();
      }

      // Check if the teacher is already scheduled at the same time (excluding current schedule)
      $teacherConflict = ClassSchedule::where('teacher_id', $request->teacher_id)
        ->where('day', $request->day)
        ->where('id', '!=', $schedule->id)
        ->where(function ($query) use ($startTime, $endTime) {
          $query->where(function ($q) use ($startTime, $endTime) {
            // Start time falls within existing schedule
            $q->where('start_time', '<=', $startTime)
              ->where('end_time', '>', $startTime);
          })
            ->orWhere(function ($q) use ($startTime, $endTime) {
              // End time falls within existing schedule
              $q->where('start_time', '<', $endTime)
                ->where('end_time', '>=', $endTime);
            })
            ->orWhere(function ($q) use ($startTime, $endTime) {
              // Schedule completely contains the new time slot
              $q->where('start_time', '>=', $startTime)
                ->where('end_time', '<=', $endTime);
            });
        })->first();

      if ($teacherConflict) {
        DB::rollBack();
        return redirect()->back()
          ->with('toast_error', 'Guru sudah memiliki jadwal pada waktu yang sama')
          ->withInput();
      }

      // Update the schedule with properly formatted times
      $validatedData = $request->validated();
      $validatedData['start_time'] = $startTime;
      $validatedData['end_time'] = $endTime;
      $schedule->update($validatedData);

      DB::commit();

      return redirect()->route('admin.schedules.index')
        ->with('toast_success', 'Jadwal berhasil diperbarui');
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()->back()
        ->with('toast_error', 'Gagal memperbarui jadwal: ' . $e->getMessage())
        ->withInput();
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(ClassSchedule $schedule)
  {
    try {
      DB::beginTransaction();

      // Check if the schedule is used in presences before deleting
      if ($schedule->presences()->count() > 0) {
        return redirect()->back()
          ->with('toast_error', 'Jadwal tidak dapat dihapus karena sudah digunakan dalam presensi');
      }

      $schedule->delete();

      DB::commit();

      return redirect()->route('admin.schedules.index')
        ->with('toast_success', 'Jadwal berhasil dihapus');
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()->back()
        ->with('toast_error', 'Gagal menghapus jadwal: ' . $e->getMessage());
    }
  }
}
