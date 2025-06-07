<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\ClassSchedule;
use App\Models\Material;
use App\Models\Subject;
use App\Models\Subjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TeacherMaterialController extends Controller
{
    /**
     * Display list of materials.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $teacher = $user->teacher;

        if (!$teacher) {
            return redirect()->route('teacher.dashboard')->with('error', 'Teacher data not found.');
        }

        // Get teacher's subjects and classes
        $teacherSchedules = ClassSchedule::with(['subject', 'classes'])
            ->where('teacher_id', $teacher->id)
            ->get();

        $subjectIds = $teacherSchedules->pluck('subject_id')->unique();
        $classIds = $teacherSchedules->pluck('class_id')->unique();

        // Filter parameters
        $selectedClass = $request->get('class_id');
        $selectedSubject = $request->get('subject_id');
        $selectedType = $request->get('type');

        // Get materials query
        $materialsQuery = Material::with(['subject', 'classes'])
            ->where('teacher_id', $teacher->id);

        if ($selectedClass) {
            $materialsQuery->where('class_id', $selectedClass);
        }

        if ($selectedSubject) {
            $materialsQuery->where('subject_id', $selectedSubject);
        }

        if ($selectedType) {
            $materialsQuery->where('type', $selectedType);
        }

        $materials = $materialsQuery->orderBy('created_at', 'desc')->paginate(15);

        // Get filter options
        $classes = Classes::whereIn('id', $classIds)->orderBy('class_name')->get();
        $subjects = Subjects::whereIn('id', $subjectIds)->orderBy('subject_name')->get();

        // Get statistics
        $allMaterials = Material::where('teacher_id', $teacher->id);
        $totalMaterials = $allMaterials->whereIn('type', ['lesson', 'reference'])->count();
        $totalAssignments = $allMaterials->whereIn('type', ['assignment', 'quiz'])->count();
        $recentUploads = $allMaterials->where('created_at', '>=', now()->subWeek())->count();
        $totalDownloads = 0; // Placeholder for download tracking

        return view('teacher.materials.index', compact(
            'materials',
            'classes',
            'subjects',
            'selectedClass',
            'selectedSubject',
            'selectedType',
            'teacher',
            'totalMaterials',
            'totalAssignments',
            'recentUploads',
            'totalDownloads'
        ));
    }

    /**
     * Show form for creating new material.
     */
    public function create()
    {
        $user = Auth::user();
        $teacher = $user->teacher;

        if (!$teacher) {
            return redirect()->route('teacher.dashboard')->with('error', 'Teacher data not found.');
        }

        // Get teacher's subjects and classes
        $teacherSchedules = ClassSchedule::with(['subject', 'classes'])
            ->where('teacher_id', $teacher->id)
            ->get();

        $classes = $teacherSchedules->groupBy('class_id')->map(function ($schedules) {
            return $schedules->first()->classes;
        });

        $subjects = $teacherSchedules->groupBy('subject_id')->map(function ($schedules) {
            return $schedules->first()->subject;
        });

        return view('teacher.materials.create', compact('classes', 'subjects', 'teacher'));
    }

    /**
     * Store new material.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $teacher = $user->teacher;

        if (!$teacher) {
            return redirect()->route('teacher.dashboard')->with('error', 'Teacher data not found.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'subject_id' => 'required|exists:subjects,id',
            'class_id' => 'required|exists:classes,id',
            'type' => 'required|in:lesson,assignment,quiz,reference',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,jpg,jpeg,png,zip|max:10240',
            'due_date' => 'nullable|date|after:today'
        ]);

        // Verify teacher has access to this class and subject
        $hasAccess = ClassSchedule::where('teacher_id', $teacher->id)
            ->where('class_id', $request->class_id)
            ->where('subject_id', $request->subject_id)
            ->exists();

        if (!$hasAccess) {
            return back()->withErrors(['error' => 'You do not have permission to create materials for this class and subject.']);
        }

        $materialData = [
            'title' => $request->title,
            'description' => $request->description,
            'subject_id' => $request->subject_id,
            'class_id' => $request->class_id,
            'teacher_id' => $teacher->id,
            'type' => $request->type,
            'due_date' => $request->due_date,
        ];

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('materials', $fileName, 'public');

            $materialData['file_path'] = $filePath;
            $materialData['file_name'] = $file->getClientOriginalName();
            $materialData['file_size'] = $file->getSize();
        }

        Material::create($materialData);

        return redirect()->route('teacher.materials.index')
            ->with('success', 'Material uploaded successfully!');
    }

    /**
     * Show material details.
     */  public function show(Material $material)
    {
        $user = Auth::user();
        $teacher = $user->teacher;

        if (!$teacher || $material->teacher_id !== $teacher->id) {
            return redirect()->route('teacher.materials.index')
                ->with('error', 'You do not have permission to view this material.');
        }
        $material->load(['subject', 'classes']);

        return view('teacher.materials.show', compact('material', 'teacher'));
    }

    /**
     * Show form for editing material.
     */
    public function edit(Material $material)
    {
        $user = Auth::user();
        $teacher = $user->teacher;

        if (!$teacher || $material->teacher_id !== $teacher->id) {
            return redirect()->route('teacher.materials.index')
                ->with('error', 'You do not have permission to edit this material.');
        }

        // Get teacher's subjects and classes
        $teacherSchedules = ClassSchedule::with(['subject', 'classes'])
            ->where('teacher_id', $teacher->id)
            ->get();
        $classes = $teacherSchedules->groupBy('class_id')->map(function ($schedules) {
            return $schedules->first()->classes;
        });

        $subjects = $teacherSchedules->groupBy('subject_id')->map(function ($schedules) {
            return $schedules->first()->subject;
        });
        $material->load(['subject', 'classes']);

        return view('teacher.materials.edit', compact('material', 'classes', 'subjects', 'teacher'));
    }

    /**
     * Update material.
     */
    public function update(Request $request, Material $material)
    {
        $user = Auth::user();
        $teacher = $user->teacher;

        if (!$teacher || $material->teacher_id !== $teacher->id) {
            return redirect()->route('teacher.materials.index')
                ->with('error', 'You do not have permission to edit this material.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'subject_id' => 'required|exists:subjects,id',
            'class_id' => 'required|exists:classes,id',
            'type' => 'required|in:lesson,assignment,quiz,reference',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,jpg,jpeg,png,zip|max:10240',
            'due_date' => 'nullable|date|after:today'
        ]);

        // Verify teacher has access to this class and subject
        $hasAccess = ClassSchedule::where('teacher_id', $teacher->id)
            ->where('class_id', $request->class_id)
            ->where('subject_id', $request->subject_id)
            ->exists();

        if (!$hasAccess) {
            return back()->withErrors(['error' => 'You do not have permission to edit materials for this class and subject.']);
        }

        $materialData = [
            'title' => $request->title,
            'description' => $request->description,
            'subject_id' => $request->subject_id,
            'class_id' => $request->class_id,
            'type' => $request->type,
            'due_date' => $request->due_date,
        ];

        // Handle new file upload
        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($material->file_path && Storage::disk('public')->exists($material->file_path)) {
                Storage::disk('public')->delete($material->file_path);
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('materials', $fileName, 'public');

            $materialData['file_path'] = $filePath;
            $materialData['file_name'] = $file->getClientOriginalName();
            $materialData['file_size'] = $file->getSize();
        }

        $material->update($materialData);

        return redirect()->route('teacher.materials.index')
            ->with('success', 'Material updated successfully!');
    }

    /**
     * Delete material.
     */
    public function destroy(Material $material)
    {
        $user = Auth::user();
        $teacher = $user->teacher;

        if (!$teacher || $material->teacher_id !== $teacher->id) {
            return redirect()->route('teacher.materials.index')
                ->with('error', 'You do not have permission to delete this material.');
        }

        // Delete file if exists
        if ($material->file_path && Storage::disk('public')->exists($material->file_path)) {
            Storage::disk('public')->delete($material->file_path);
        }

        $material->delete();

        return redirect()->route('teacher.materials.index')
            ->with('success', 'Material deleted successfully!');
    }

    /**
     * Download material file.
     */
    public function download(Material $material)
    {
        $user = Auth::user();
        $teacher = $user->teacher;

        if (!$teacher || $material->teacher_id !== $teacher->id) {
            return redirect()->route('teacher.materials.index')
                ->with('error', 'You do not have permission to download this material.');
        }

        if (!$material->file_path || !Storage::disk('public')->exists($material->file_path)) {
            return redirect()->route('teacher.materials.index')
                ->with('error', 'File not found.');
        }

        return response()->download(storage_path('app/public/' . $material->file_path), $material->file_name);
    }
}
