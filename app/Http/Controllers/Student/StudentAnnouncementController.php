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
    public function index(Request $request)
    {
        $user = Auth::user();
        $student = Student::with(['classes'])->where('user_id', $user->id)->first();

        $query = Announcement::where('is_active', true)
            ->where(function ($query) use ($student) {
                $query->where('target', 'all')
                    ->orWhere('target', 'students')
                    ->orWhere(function ($q) use ($student) {
                        $q->where('target', 'classes')
                            ->whereJsonContains('class_target', (string)$student->class_id);
                    });
            })
            ->where('published_at', '<=', now())
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>=', now());
            });

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Filter by priority
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        // Order by priority and publication date
        $announcements = $query->with('author.user')
            ->orderByRaw("FIELD(priority, 'high', 'medium', 'low')")
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
                            ->whereJsonContains('class_target', (string)$student->class_id);
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
     * Download attachment file.
     */
    public function download(Announcement $announcement)
    {
        $user = Auth::user();
        $student = Student::with(['classes'])->where('user_id', $user->id)->first();

        // Check if the announcement is accessible to the student
        if (
            !$announcement->is_active ||
            $announcement->published_at > now() ||
            ($announcement->expires_at && $announcement->expires_at < now()) ||
            !($announcement->target === 'all' ||
                $announcement->target === 'students' ||
                ($announcement->target === 'classes' && $announcement->class_target && in_array($student->class_id, $announcement->class_target)))
        ) {
            abort(403, 'Anda tidak memiliki akses ke pengumuman ini');
        }

        if (!$announcement->attachment || !Storage::disk('public')->exists($announcement->attachment)) {
            abort(404, 'File tidak ditemukan');
        }

        $filePath = Storage::disk('public')->path($announcement->attachment);
        $fileName = basename($announcement->attachment);

        return response()->download($filePath, $fileName);
    }
}
