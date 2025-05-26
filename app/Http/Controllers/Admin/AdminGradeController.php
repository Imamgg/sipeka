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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AdminGradeController extends Controller
{
  /**
   * Display a listing of grades for verification.
   */
  public function index(Request $request)
  {
    $query = Grade::with(['student.user', 'subject', 'teacher.user', 'verifier'])
      ->orderBy('created_at', 'desc');

    // Filter by verification status
    if ($request->has('verification_status') && $request->verification_status != 'all') {
      $query->where('verification_status', $request->verification_status);
    }

    // Filter by teacher
    if ($request->has('teacher_id') && $request->teacher_id) {
      $query->where('teacher_id', $request->teacher_id);
    }

    // Filter by subject
    if ($request->has('subject_id') && $request->subject_id) {
      $query->where('subject_id', $request->subject_id);
    }

    // Filter by student's class
    if ($request->has('class_id') && $request->class_id) {
      $query->whereHas('student', function ($q) use ($request) {
        $q->where('class_id', $request->class_id);
      });
    }

    // Filter by semester
    if ($request->has('semester') && $request->semester) {
      $query->where('semester', $request->semester);
    }

    $grades = $query->paginate(15);
    $teachers = Teacher::with('user')->get();
    $subjects = Subjects::all();
    $classes = Classes::all();

    return view('admin.grades.index', compact('grades', 'teachers', 'subjects', 'classes'));
  }

  /**
   * Show details of a specific grade.
   */
  public function show(Grade $grade)
  {
    $grade->load(['student.user', 'subject', 'teacher.user', 'verifier']);
    return view('admin.grades.show', compact('grade'));
  }

  /**
   * Verify a grade.
   */
  public function verify(Request $request, Grade $grade)
  {
    $request->validate([
      'verification_status' => 'required|in:verified,rejected',
      'verification_note' => 'nullable|string|max:500',
    ]);

    $grade->update([
      'verification_status' => $request->verification_status,
      'verified_by' => Auth::id(),
      'verified_at' => Carbon::now(),
      'verification_note' => $request->verification_note,
    ]);

    return redirect()->route('admin.grades.index')
      ->with('success', 'Grade has been ' . $request->verification_status . ' successfully.');
  }

  /**
   * Display a listing of attendance records for verification.
   */
  public function attendance(Request $request)
  {
    $query = PresenceDetail::with(['presence.classSchedule.subject', 'presence.classSchedule.teacher.user', 'student.user', 'verifier'])
      ->orderBy('created_at', 'desc');

    // Filter by verification status
    if ($request->has('verification_status') && $request->verification_status != 'all') {
      $query->where('verification_status', $request->verification_status);
    }

    // Filter by teacher
    if ($request->has('teacher_id') && $request->teacher_id) {
      $query->whereHas('presence.classSchedule', function ($q) use ($request) {
        $q->where('teacher_id', $request->teacher_id);
      });
    }

    // Filter by subject
    if ($request->has('subject_id') && $request->subject_id) {
      $query->whereHas('presence.classSchedule', function ($q) use ($request) {
        $q->where('subject_id', $request->subject_id);
      });
    }

    // Filter by student's class
    if ($request->has('class_id') && $request->class_id) {
      $query->whereHas('student', function ($q) use ($request) {
        $q->where('class_id', $request->class_id);
      });
    }

    // Filter by date range
    if ($request->has('date_from') && $request->date_from) {
      $query->whereHas('presence', function ($q) use ($request) {
        $q->whereDate('date', '>=', Carbon::parse($request->date_from));
      });
    }

    if ($request->has('date_to') && $request->date_to) {
      $query->whereHas('presence', function ($q) use ($request) {
        $q->whereDate('date', '<=', Carbon::parse($request->date_to));
      });
    }

    $attendances = $query->paginate(15);
    $teachers = Teacher::with('user')->get();
    $subjects = Subjects::all();
    $classes = Classes::all();

    return view('admin.attendances.index', compact('attendances', 'teachers', 'subjects', 'classes'));
  }

  /**
   * Show details of a specific attendance record.
   */
  public function showAttendance(PresenceDetail $attendance)
  {
    $attendance->load(['presence.classSchedule.subject', 'presence.classSchedule.teacher.user', 'student.user', 'verifier']);
    return view('admin.attendances.show', compact('attendance'));
  }

  /**
   * Verify an attendance record.
   */
  public function verifyAttendance(Request $request, PresenceDetail $attendance)
  {
    $request->validate([
      'verification_status' => 'required|in:verified,rejected',
      'verification_note' => 'nullable|string|max:500',
    ]);

    $attendance->update([
      'verification_status' => $request->verification_status,
      'verified_by' => Auth::id(),
      'verified_at' => Carbon::now(),
      'verification_note' => $request->verification_note,
    ]);

    return redirect()->route('admin.attendances.index')
      ->with('success', 'Attendance record has been ' . $request->verification_status . ' successfully.');
  }
}
