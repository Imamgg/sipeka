<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassRequest;
use App\Models\Classes;
use App\Models\Teacher;
use Illuminate\Http\Request;

class AdminClassesController extends Controller
{
    /**
     * Display a listing of the classes.
     */
    public function index()
    {
        $classes = Classes::with('teacher.user')->latest()->get();
        return view('admin.classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new class.
     */
    public function create()
    {
        $teachers = Teacher::with('user')->get();

        // Get teachers who are already assigned as homeroom teachers with their class names
        $assignedTeachers = Classes::with('teacher.user')
            ->whereNotNull('homeroom_teacher_id')
            ->get()
            ->keyBy('homeroom_teacher_id');

        return view('admin.classes.create', compact('teachers', 'assignedTeachers'));
    }

    /**
     * Store a newly created class in storage.
     */
    public function store(ClassRequest $request)
    {
        try {
            Classes::create($request->validated());

            return redirect()->route('admin.classes.index')
                ->with('toast_success', 'Data kelas berhasil ditambahkan!');
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle unique constraint violation
            if ($e->getCode() == 23000) {
                return redirect()->back()
                    ->with('toast_error', 'Guru yang dipilih sudah menjadi wali kelas di kelas lain.')
                    ->withInput();
            }

            return redirect()->back()
                ->with('toast_error', 'Terjadi kesalahan saat menyimpan data kelas.')
                ->withInput();
        }
    }

    /**
     * Display the specified class.
     */
    public function show(Classes $class)
    {
        $class->load('teacher.user', 'students.user');
        return view('admin.classes.show', compact('class'));
    }
    /**
     * Show the form for editing the specified class.
     */
    public function edit(Classes $class)
    {
        $teachers = Teacher::with('user')->get();

        // Get teachers who are already assigned as homeroom teachers with their class names (excluding current class)
        $assignedTeachers = Classes::with('teacher.user')
            ->whereNotNull('homeroom_teacher_id')
            ->where('id', '!=', $class->id)
            ->get()
            ->keyBy('homeroom_teacher_id');

        return view('admin.classes.edit', compact('class', 'teachers', 'assignedTeachers'));
    }

    /**
     * Update the specified class in storage.
     */
    public function update(ClassRequest $request, Classes $class)
    {
        try {
            $class->update($request->validated());

            return redirect()->route('admin.classes.index')
                ->with('toast_success', 'Data kelas berhasil diperbarui!');
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle unique constraint violation
            if ($e->getCode() == 23000) {
                return redirect()->back()
                    ->with('toast_error', 'Guru yang dipilih sudah menjadi wali kelas di kelas lain.')
                    ->withInput();
            }

            return redirect()->back()
                ->with('toast_error', 'Terjadi kesalahan saat memperbarui data kelas.')
                ->withInput();
        }
    }

    /**
     * Remove the specified class from storage.
     */
    public function destroy(Classes $class)
    {
        if ($class->students()->count() > 0) {
            return redirect()->route('admin.classes.index')
                ->with('toast_error', 'Tidak dapat menghapus kelas yang memiliki siswa!');
        }

        $class->delete();

        return redirect()->route('admin.classes.index')
            ->with('toast_success', 'Data kelas berhasil dihapus!');
    }
}
