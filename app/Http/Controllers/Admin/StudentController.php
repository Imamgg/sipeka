<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $students = Student::select('students.*', 'users.name', 'users.email')
            ->join('users', 'students.user_id', '=', 'users.id')
            ->when($request->search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('users.name', 'like', "%{$search}%")
                        ->orWhere('students.nis', 'like', "%{$search}%")
                        ->orWhere('students.nisn', 'like', "%{$search}%");
                });
            })
            ->orderBy('users.name')
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('admin/students/index', [
            'students' => $students,
            'filters' => $request->only(['search']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('admin/students/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'student'
            ]);
            $student = Student::create([
                'user_id' => $user->id,
                'nis' => $request->nis,
                'nisn' => $request->nisn,
                'place_of_birth' => $request->place_of_birth,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
            ]);

            DB::commit();

            return redirect()->route('students.index')->with('success', 'Siswa berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['general' => 'Terjadi kesalahan saat menyimpan data siswa: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $student->load('user');

        return Inertia::render('admin/students/show', [
            'student' => [
                'id' => $student->id,
                'user_id' => $student->user_id,
                'name' => $student->user->name,
                'email' => $student->user->email,
                'nis' => $student->nis,
                'nisn' => $student->nisn,
                'place_of_birth' => $student->place_of_birth,
                'date_of_birth' => $student->date_of_birth,
                'gender' => $student->gender,
                'address' => $student->address,
                'phone_number' => $student->phone_number,
                'father_name' => $student->father_name,
                'mother_name' => $student->mother_name,
                'created_at' => $student->created_at,
                'updated_at' => $student->updated_at,
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $student->load('user');

        return Inertia::render('admin/students/edit', [
            'student' => [
                'id' => $student->id,
                'user_id' => $student->user_id,
                'name' => $student->user->name,
                'email' => $student->user->email,
                'nis' => $student->nis,
                'nisn' => $student->nisn,
                'place_of_birth' => $student->place_of_birth,
                'date_of_birth' => $student->date_of_birth,
                'gender' => $student->gender,
                'address' => $student->address,
                'phone_number' => $student->phone_number,
                'father_name' => $student->father_name,
                'mother_name' => $student->mother_name,
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, Student $student)
    {
        DB::beginTransaction();

        try {
            User::where('id', $student->user_id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            if ($request->filled('password')) {
                $request->validate([
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ]);

                User::where('id', $student->user_id)->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            $student->update([
                'nis' => $request->nis,
                'nisn' => $request->nisn,
                'place_of_birth' => $request->place_of_birth,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
            ]);

            DB::commit();

            return redirect()->route('students.index')->with('success', 'Data siswa berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['general' => 'Terjadi kesalahan saat memperbarui data siswa: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        DB::beginTransaction();

        try {
            $userId = $student->user_id;

            // Delete student record
            $student->delete();

            // Delete associated user
            User::destroy($userId);

            DB::commit();

            return redirect()->route('students.index')
                ->with('success', 'Siswa berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['general' => 'Terjadi kesalahan saat menghapus data siswa: ' . $e->getMessage()]);
        }
    }
}
