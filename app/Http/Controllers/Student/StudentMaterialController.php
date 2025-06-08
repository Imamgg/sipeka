<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\ClassSchedule;
use App\Models\Subjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentMaterialController extends Controller
{
    /**
     * Display a listing of materials for the student.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $student = $user->student;

        if (!$student || !$student->class_id) {
            return redirect()->route('student.dashboard')->with('error', 'Data siswa atau kelas tidak ditemukan.');
        }

        // Get filter parameters
        $selectedSubject = $request->get('subject_id');
        $selectedType = $request->get('type');

        // Get materials for student's class
        $materialsQuery = Material::with(['subject', 'teacher.user', 'classes'])
            ->where('class_id', $student->class_id);

        if ($selectedSubject) {
            $materialsQuery->where('subject_id', $selectedSubject);
        }

        if ($selectedType) {
            $materialsQuery->where('type', $selectedType);
        }

        $materials = $materialsQuery->orderBy('created_at', 'desc')->paginate(12);

        // Get subjects for filter dropdown
        $subjects = Subjects::whereHas('classSchedules', function ($query) use ($student) {
            $query->where('class_id', $student->class_id);
        })->orderBy('subject_name')->get();

        // Get statistics
        $totalMaterials = Material::where('class_id', $student->class_id)
            ->whereIn('type', ['lesson', 'reference'])
            ->count();
        $totalAssignments = Material::where('class_id', $student->class_id)
            ->whereIn('type', ['assignment', 'quiz'])
            ->count();
        $totalUploads = Material::where('class_id', $student->class_id)
            ->count();

        $pendingAssignments = Material::where('class_id', $student->class_id)
            ->whereIn('type', ['assignment', 'quiz'])
            ->where('due_date', '>=', now())
            ->count();

        return view('student.materials.index', compact(
            'materials',
            'subjects',
            'selectedSubject',
            'selectedType',
            'student',
            'totalMaterials',
            'totalAssignments',
            'totalUploads',
            'pendingAssignments'
        ));
    }

    /**
     * Display the specified material.
     */
    public function show(Material $material)
    {
        $user = Auth::user();
        $student = $user->student;

        if (!$student || !$student->class_id) {
            return redirect()->route('student.dashboard')->with('error', 'Data siswa tidak ditemukan.');
        }

        // Check if student has access to this material
        if ($material->class_id !== $student->class_id) {
            return redirect()->route('student.materials.index')
                ->with('error', 'Anda tidak memiliki akses ke materi ini.');
        }

        $material->load(['subject', 'teacher.user', 'classes']);

        // Get related materials from the same subject
        $relatedMaterials = Material::with(['subject', 'teacher.user'])
            ->where('class_id', $student->class_id)
            ->where('subject_id', $material->subject_id)
            ->where('id', '!=', $material->id)
            ->latest()
            ->take(5)
            ->get();

        return view('student.materials.show', compact('material', 'student', 'relatedMaterials'));
    }
    /**
     * Download material file.
     */
    public function download(Material $material)
    {
        $user = Auth::user();
        $student = $user->student;

        if (!$student || !$student->class_id) {
            return redirect()->route('student.dashboard')->with('error', 'Data siswa tidak ditemukan.');
        }

        // Check if student has access to this material
        if ($material->class_id !== $student->class_id) {
            return redirect()->route('student.materials.index')
                ->with('error', 'Anda tidak memiliki akses ke materi ini.');
        }

        if (!$material->file_path || !Storage::disk('public')->exists($material->file_path)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        $fileName = $material->file_name ?? basename($material->file_path);
        $filePath = storage_path('app/public/' . $material->file_path);

        return response()->download($filePath, $fileName);
    }
}
