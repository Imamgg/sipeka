<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequest;
use App\Http\Resources\SubjectResource;
use App\Models\Subjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminSubjectController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $subjects = Subjects::latest()->paginate(10);
    return view('admin.subjects.index', compact('subjects'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('admin.subjects.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(SubjectRequest $request)
  {
    try {
      DB::beginTransaction();

      $subject = Subjects::create($request->validated());

      DB::commit();

      return redirect()->route('admin.subjects.index')
        ->with('toast_success', 'Mata pelajaran berhasil ditambahkan');
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()->back()
        ->with('toast_error', 'Gagal menambahkan mata pelajaran: ' . $e->getMessage())
        ->withInput();
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(Subjects $subject)
  {
    return view('admin.subjects.show', compact('subject'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Subjects $subject)
  {
    return view('admin.subjects.edit', compact('subject'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(SubjectRequest $request, Subjects $subject)
  {
    try {
      DB::beginTransaction();

      $subject->update($request->validated());

      DB::commit();

      return redirect()->route('admin.subjects.index')
        ->with('toast_success', 'Mata pelajaran berhasil diperbarui');
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()->back()
        ->with('toast_error', 'Gagal memperbarui mata pelajaran: ' . $e->getMessage())
        ->withInput();
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Subjects $subject)
  {
    try {
      DB::beginTransaction();

      // Check if the subject is used in class schedules before deleting
      if ($subject->classSchedules()->count() > 0) {
        DB::rollBack();
        return redirect()->back()
          ->with('toast_error', 'Mata pelajaran tidak dapat dihapus karena masih digunakan dalam jadwal kelas');
      }

      $subject->delete();

      DB::commit();

      return redirect()->route('admin.subjects.index')
        ->with('toast_success', 'Mata pelajaran berhasil dihapus');
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()->back()
        ->with('toast_error', 'Gagal menghapus mata pelajaran: ' . $e->getMessage());
    }
  }
}
