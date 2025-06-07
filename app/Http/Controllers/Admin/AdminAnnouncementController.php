<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminAnnouncementController extends Controller
{
  /**
   * Display a listing of announcements.
   */
  public function index(Request $request)
  {
    $query = Announcement::with('author.user');

    // Filter berdasarkan status
    if ($request->filled('status')) {
      if ($request->status === 'active') {
        $query->where('is_active', true);
      } elseif ($request->status === 'inactive') {
        $query->where('is_active', false);
      } elseif ($request->status === 'expired') {
        $query->where('expires_at', '<', now());
      }
    }

    // Filter berdasarkan target
    if ($request->filled('target')) {
      $query->where('target', $request->target);
    }

    // Search
    if ($request->filled('search')) {
      $query->where(function ($q) use ($request) {
        $q->where('title', 'like', '%' . $request->search . '%')
          ->orWhere('content', 'like', '%' . $request->search . '%');
      });
    }

    $announcements = $query->latest('published_at')->paginate(10);
    $classes = Classes::all();

    return view('admin.announcements.index', compact('announcements', 'classes'));
  }

  /**
   * Show the form for creating a new announcement.
   */
  public function create()
  {
    $classes = Classes::all();
    return view('admin.announcements.create', compact('classes'));
  }

  /**
   * Store a newly created announcement in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required|string|max:255',
      'content' => 'required|string',
      'target' => 'required|in:all,students,teachers,classes',
      'class_target' => 'nullable|array',
      'priority' => 'required|in:low,medium,high',
      'published_at' => 'required|date',
      'expires_at' => 'nullable|date|after:published_at',
      'attachment' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:5120', // 5MB
    ]);

    // Get the admin record for the current user
    $admin = \App\Models\Admin::where('user_id', Auth::id())->first();

    if (!$admin) {
      return redirect()->route('admin.announcements.index')
        ->with('toast_error', 'Data admin tidak ditemukan.');
    }

    $data = $request->all();
    $data['user_id'] = $admin->id; // Use admin ID, not user ID
    $data['is_active'] = true;

    // Handle file upload
    if ($request->hasFile('attachment')) {
      $file = $request->file('attachment');
      $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
      $data['attachment'] = $file->storeAs('announcements', $fileName, 'public');
    }

    // Jika target bukan classes, hapus class_target
    if ($data['target'] !== 'classes') {
      $data['class_target'] = null;
    }

    Announcement::create($data);

    return redirect()->route('admin.announcements.index')
      ->with('toast_success', 'Pengumuman berhasil dibuat!');
  }

  /**
   * Display the specified announcement.
   */
  public function show(Announcement $announcement)
  {
    $announcement->load('author.user');
    return view('admin.announcements.show', compact('announcement'));
  }

  /**
   * Show the form for editing the specified announcement.
   */
  public function edit(Announcement $announcement)
  {
    $classes = Classes::all();
    return view('admin.announcements.edit', compact('announcement', 'classes'));
  }

  /**
   * Update the specified announcement in storage.
   */
  public function update(Request $request, Announcement $announcement)
  {
    $request->validate([
      'title' => 'required|string|max:255',
      'content' => 'required|string',
      'target' => 'required|in:all,students,teachers,classes',
      'class_target' => 'nullable|array',
      'priority' => 'required|in:low,medium,high',
      'published_at' => 'required|date',
      'expires_at' => 'nullable|date|after:published_at',
      'attachment' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:5120',
    ]);

    $data = $request->all();

    // Handle file upload
    if ($request->hasFile('attachment')) {
      // Delete old file
      if ($announcement->attachment) {
        Storage::disk('public')->delete($announcement->attachment);
      }

      $file = $request->file('attachment');
      $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
      $data['attachment'] = $file->storeAs('announcements', $fileName, 'public');
    }

    // Remove attachment if requested
    if ($request->has('remove_attachment') && $request->remove_attachment) {
      if ($announcement->attachment) {
        Storage::disk('public')->delete($announcement->attachment);
      }
      $data['attachment'] = null;
    }

    // Jika target bukan classes, hapus class_target
    if ($data['target'] !== 'classes') {
      $data['class_target'] = null;
    }

    $announcement->update($data);

    return redirect()->route('admin.announcements.index')
      ->with('toast_success', 'Pengumuman berhasil diperbarui!');
  }

  /**
   * Remove the specified announcement from storage.
   */
  public function destroy(Announcement $announcement)
  {
    try {
      // Delete attachment file if exists
      if ($announcement->attachment) {
        Storage::disk('public')->delete($announcement->attachment);
      }

      $announcement->delete();

      return redirect()->route('admin.announcements.index')
        ->with('toast_success', 'Pengumuman berhasil dihapus!');
    } catch (\Exception $e) {
      return redirect()->route('admin.announcements.index')
        ->with('toast_error', 'Gagal menghapus pengumuman: ' . $e->getMessage());
    }
  }

  /**
   * Toggle announcement status (active/inactive).
   */
  public function toggleStatus(Announcement $announcement)
  {
    $announcement->update([
      'is_active' => !$announcement->is_active
    ]);

    $status = $announcement->is_active ? 'diaktifkan' : 'dinonaktifkan';

    return redirect()->back()
      ->with('toast_success', "Pengumuman berhasil {$status}!");
  }

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
