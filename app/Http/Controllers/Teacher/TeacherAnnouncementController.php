<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\ClassSchedule;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TeacherAnnouncementController extends Controller
{
    /**
     * Display a listing of announcements for teachers.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $teacher = Teacher::where('user_id', $user->id)->first();

        if (!$teacher) {
            return redirect()->route('teacher.dashboard')->with('error', 'Data guru tidak ditemukan.');
        }

        // Build query for teacher announcements
        // Get classes taught by this teacher
        $taughtClassIds = ClassSchedule::where('teacher_id', $teacher->id)
            ->distinct('class_id')
            ->pluck('class_id')
            ->toArray();

        $query = Announcement::where('is_active', true)
            ->where(function ($query) use ($taughtClassIds) {
                $query->where('target', 'all')
                    ->orWhere('target', 'teachers')
                    ->orWhere(function ($subQ) use ($taughtClassIds) {
                        $subQ->where('target', 'classes');
                        if (!empty($taughtClassIds)) {
                            $subQ->where(function ($classQ) use ($taughtClassIds) {
                                foreach ($taughtClassIds as $classId) {
                                    $classQ->orWhereJsonContains('class_target', (string)$classId);
                                }
                            });
                        }
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

        return view('teacher.announcements.index', compact('announcements', 'teacher'));
    }

    /**
     * Display the specified announcement.
     */
    public function show($id)
    {
        $user = Auth::user();
        $teacher = Teacher::where('user_id', $user->id)->first();

        if (!$teacher) {
            return redirect()->route('teacher.dashboard')->with('error', 'Data guru tidak ditemukan.');
        }

        // Get classes taught by this teacher
        $taughtClassIds = ClassSchedule::where('teacher_id', $teacher->id)
            ->distinct('class_id')
            ->pluck('class_id')
            ->toArray();

        $announcement = Announcement::where('id', $id)
            ->where('is_active', true)
            ->where(function ($query) use ($taughtClassIds) {
                $query->where('target', 'all')
                    ->orWhere('target', 'teachers')
                    ->orWhere(function ($subQ) use ($taughtClassIds) {
                        $subQ->where('target', 'classes');
                        if (!empty($taughtClassIds)) {
                            $subQ->where(function ($classQ) use ($taughtClassIds) {
                                foreach ($taughtClassIds as $classId) {
                                    $classQ->orWhereJsonContains('class_target', (string)$classId);
                                }
                            });
                        }
                    });
            })
            ->where('published_at', '<=', now())
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>=', now());
            })
            ->firstOrFail();

        $announcement->load('author.user');

        return view('teacher.announcements.show', compact('announcement', 'teacher'));
    }

    /**
     * Download attachment from announcement.
     */
    public function download($id)
    {
        $user = Auth::user();
        $teacher = Teacher::where('user_id', $user->id)->first();

        if (!$teacher) {
            return redirect()->route('teacher.dashboard')->with('error', 'Data guru tidak ditemukan.');
        }

        // Get classes taught by this teacher
        $taughtClassIds = ClassSchedule::where('teacher_id', $teacher->id)
            ->distinct('class_id')
            ->pluck('class_id')
            ->toArray();

        $announcement = Announcement::where('id', $id)
            ->where('is_active', true)
            ->where(function ($query) use ($taughtClassIds) {
                $query->where('target', 'all')
                    ->orWhere('target', 'teachers')
                    ->orWhere(function ($subQ) use ($taughtClassIds) {
                        $subQ->where('target', 'classes');
                        if (!empty($taughtClassIds)) {
                            $subQ->where(function ($classQ) use ($taughtClassIds) {
                                foreach ($taughtClassIds as $classId) {
                                    $classQ->orWhereJsonContains('class_target', (string)$classId);
                                }
                            });
                        }
                    });
            })
            ->firstOrFail();

        if (!$announcement->attachment || !Storage::disk('public')->exists($announcement->attachment)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        $pathToFile = Storage::disk('public')->path($announcement->attachment);
        return response()->download($pathToFile);
    }
}
