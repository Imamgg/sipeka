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
        return view('admin.classes.create', compact('teachers'));
    }

    /**
     * Store a newly created class in storage.
     */
    public function store(ClassRequest $request)
    {
        Classes::create($request->validated());

        return redirect()->route('admin.classes.index')
            ->with('toast_success', 'Data kelas berhasil ditambahkan!');
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
        return view('admin.classes.edit', compact('class', 'teachers'));
    }

    /**
     * Update the specified class in storage.
     */
    public function update(ClassRequest $request, Classes $class)
    {
        $class->update($request->validated());

        return redirect()->route('admin.classes.index')
            ->with('toast_success', 'Data kelas berhasil diperbarui!');
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
