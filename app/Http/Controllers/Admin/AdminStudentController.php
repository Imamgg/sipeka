<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Classes;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminStudentController extends Controller
{
    /**
     * Display the student management page.
     */
    public function index()
    {
        $query = Student::with(['class', 'user']);

        if (request()->has('search') && !empty(request('search'))) {
            $search = request('search');
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhere('nis', 'like', "%{$search}%");
            });
        }

        $students = $query->get();

        return view('admin.student.index', [
            'students' => StudentResource::collection($students)
        ]);
    }

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        $classes = Classes::all();
        return view('admin.student.create', compact('classes'));
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(StudentRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'password' => Hash::make($request->password),
                'role' => 'student'
            ]);

            Student::create([
                'user_id' => $user->id,
                'nis' => $request->nis,
                'nisn' => $request->nisn,
                'class_id' => $request->class_id,
                'place_of_birth' => $request->place_of_birth,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'address' => $request->address,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
            ]);

            DB::commit();

            return redirect()->route('admin.students.index')
                ->with('toast_success', 'Data siswa berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('toast_error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified student.
     */
    public function show(Student $student)
    {
        $student->load('user');
        return view('admin.student.show', compact('student'));
    }

    /**
     * Show the form for editing the specified student.
     */
    public function edit($id)
    {
        $student = Student::with('user')->findOrFail($id);
        $classes = Classes::all();
        return view('admin.student.edit', compact('student', 'classes'));
    }

    /**
     * Update the specified student in storage.
     */
    public function update(StudentRequest $request, $id)
    {
        $student = Student::findOrFail($id);

        DB::beginTransaction();
        try {
            // Update user data
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
            ];

            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }

            $student->user->update($userData);

            // Update student data
            $student->update([
                'nis' => $request->nis,
                'nisn' => $request->nisn,
                'class_id' => $request->class_id,
                'place_of_birth' => $request->place_of_birth,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'address' => $request->address,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
            ]);

            DB::commit();

            return redirect()->route('admin.students.index')
                ->with('toast_success', 'Data siswa berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('toast_error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified student from storage.
     */
    public function destroy(Student $student)
    {
        try {
            $student->delete();
            toast('Data siswa berhasil dihapus!', 'success');
        } catch (\Exception $e) {
            toast('Gagal menghapus data siswa.', 'error');
        }
        return redirect()->route('admin.students.index');
    }
}
