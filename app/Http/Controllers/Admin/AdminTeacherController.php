<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRequest;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminTeacherController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $teachers = Teacher::with('user')
      ->when($request->search, function ($query, $search) {
        $query->whereHas('user', function ($q) use ($search) {
          $q->where('name', 'like', "%{$search}%");
        })
          ->orWhere('nip', 'like', "%{$search}%");
      })
      ->orderBy('created_at', 'desc')
      ->paginate(10)
      ->withQueryString();

    return view('admin.teacher.index', compact('teachers'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('admin.teacher.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(TeacherRequest $request)
  {
    DB::beginTransaction();
    try {
      $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'teacher'
      ]);

      $teacher = Teacher::create([
        'user_id' => $user->id,
        'nip' => $request->nip,
        'place_of_birth' => $request->place_of_birth,
        'date_of_birth' => $request->date_of_birth,
        'gender' => $request->gender,
        'address' => $request->address,
        'phone_number' => $request->phone_number,
      ]);
      DB::commit();
      return redirect()->route('admin.teachers.index')
        ->with('toast_success', 'Data guru berhasil ditambahkan!');
    } catch (\Exception $e) {
      DB::rollback();
      return back()->with('toast_error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(Teacher $teacher)
  {
    $teacher->load('user');
    return view('admin.teacher.show', compact('teacher'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Teacher $teacher)
  {
    $teacher->load('user');
    return view('admin.teacher.edit', compact('teacher'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(TeacherRequest $request, Teacher $teacher)
  {
    DB::beginTransaction();
    try {
      $user = $teacher->user;
      $user->update([
        'name' => $request->name,
        'email' => $request->email
      ]);

      if ($request->filled('password')) {
        $user->update([
          'password' => Hash::make($request->password)
        ]);
      }

      $teacher->update([
        'nip' => $request->nip,
        'place_of_birth' => $request->place_of_birth,
        'date_of_birth' => $request->date_of_birth,
        'gender' => $request->gender,
        'address' => $request->address,
        'phone_number' => $request->phone_number,
      ]);
      DB::commit();
      return redirect()->route('admin.teachers.index')
        ->with('toast_success', 'Data guru berhasil diperbarui!');
    } catch (\Exception $e) {
      DB::rollback();
      return back()->with('toast_error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Teacher $teacher)
  {
    DB::beginTransaction();
    try {
      $userId = $teacher->user_id;
      $teacher->delete();
      User::destroy($userId);
      DB::commit();
      return redirect()->route('admin.teachers.index')
        ->with('toast_success', 'Data guru berhasil dihapus!');
    } catch (\Exception $e) {
      DB::rollback();
      return back()->with('toast_error', 'Tidak dapat menghapus guru yang masih memiliki jadwal kelas. Hapus atau transfer jadwal terlebih dahulu.');
    }
  }
}
