<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRequest;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $teachers = Teacher::select('teachers.*', 'users.name', 'users.email')
            ->join('users', 'teachers.user_id', '=', 'users.id')
            ->when($request->search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('users.name', 'like', "%{$search}%")
                        ->orWhere('teachers.nip', 'like', "%{$search}%");
                });
            })
            ->orderBy('users.name')
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('admin/teachers/index', [
            'teachers' => $teachers,
            'filters' => $request->only(['search']),
        ]);
    }

    public function create()
    {
        return Inertia::render('admin/teachers/create');
    }

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

            return redirect()->route('teachers.index')->with('success', 'Guru berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['general' => 'Terjadi kesalahan saat menyimpan data guru: ' . $e->getMessage()])->withInput();
        }
    }

    public function show(Teacher $teacher)
    {
        $teacher->load('user');

        return Inertia::render('admin/teachers/show', [
            'teacher' => [
                'id' => $teacher->id,
                'user_id' => $teacher->user_id,
                'name' => $teacher->user->name,
                'email' => $teacher->user->email,
                'nip' => $teacher->nip,
                'place_of_birth' => $teacher->place_of_birth,
                'date_of_birth' => $teacher->date_of_birth,
                'gender' => $teacher->gender,
                'address' => $teacher->address,
                'phone_number' => $teacher->phone_number,
                'created_at' => $teacher->created_at,
                'updated_at' => $teacher->updated_at,
            ]
        ]);
    }

    public function edit(Teacher $teacher)
    {
        $teacher->load('user');

        return Inertia::render('admin/teachers/edit', [
            'teacher' => [
                'id' => $teacher->id,
                'user_id' => $teacher->user_id,
                'name' => $teacher->user->name,
                'email' => $teacher->user->email,
                'nip' => $teacher->nip,
                'place_of_birth' => $teacher->place_of_birth,
                'date_of_birth' => $teacher->date_of_birth,
                'gender' => $teacher->gender,
                'address' => $teacher->address,
                'phone_number' => $teacher->phone_number,
            ]
        ]);
    }

    public function update(TeacherRequest $request, Teacher $teacher)
    {
        DB::beginTransaction();

        try {
            User::where('id', $teacher->user_id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            if ($request->filled('password')) {
                $request->validate([
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ]);

                User::where('id', $teacher->user_id)->update([
                    'password' => Hash::make($request->password),
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

            return redirect()->route('teachers.index')->with('success', 'Data guru berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['general' => 'Terjadi kesalahan saat memperbarui data guru: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy(Teacher $teacher)
    {
        DB::beginTransaction();

        try {
            $userId = $teacher->user_id;

            // Delete teacher record
            $teacher->delete();

            // Delete associated user
            User::destroy($userId);

            DB::commit();

            return redirect()->route('teachers.index')
                ->with('success', 'Guru berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['general' => 'Terjadi kesalahan saat menghapus data guru: ' . $e->getMessage()]);
        }
    }
}
