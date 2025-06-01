<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Announcement;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAnnouncementController extends Controller
{
  /**
   * Display a listing of announcements.
   */
  public function index()
  {
    $user = Auth::user();
    $student = Student::with(['classes'])->where('user_id', $user->id)->first();

    $announcements = Announcement::where('is_active', true)
      ->where(function ($query) use ($student) {
        $query->where('target', 'all')
          ->orWhere('target', 'students')
          ->orWhere(function ($q) use ($student) {
            $q->where('target', 'classes')
              ->whereJsonContains('class_target', $student->class_id);
          });
      })
      ->where('published_at', '<=', now())
      ->where(function ($query) {
        $query->whereNull('expires_at')
          ->orWhere('expires_at', '>=', now());
      })
      ->orderBy('published_at', 'desc')
      ->paginate(10);

    return view('student.announcements.index', compact('student', 'announcements'));
  }

  /**
   * Display the specified announcement.
   */
  public function show($id)
  {
    $user = Auth::user();
    $student = Student::with(['classes'])->where('user_id', $user->id)->first();

    $announcement = Announcement::where('id', $id)
      ->where('is_active', true)
      ->where(function ($query) use ($student) {
        $query->where('target', 'all')
          ->orWhere('target', 'students')
          ->orWhere(function ($q) use ($student) {
            $q->where('target', 'classes')
              ->whereJsonContains('class_target', $student->class_id);
          });
      })
      ->where('published_at', '<=', now())
      ->where(function ($query) {
        $query->whereNull('expires_at')
          ->orWhere('expires_at', '>=', now());
      })
      ->firstOrFail();

    return view('student.announcements.show', compact('student', 'announcement'));
  }

  /**
   * Download the attachment of the specified announcement.
   */
  /**
   * Download attachment file.
   */  public function download(Announcement $announcement)
  {
    if (!$announcement->attachment || !Storage::disk('public')->exists($announcement->attachment)) {
      abort(404, 'File tidak ditemukan');
    }

    $filePath = Storage::disk('public')->path($announcement->attachment);
    $fileName = basename($announcement->attachment);

    return response()->download($filePath, $fileName);
  }
}
