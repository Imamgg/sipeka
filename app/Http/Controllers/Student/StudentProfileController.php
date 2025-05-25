<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentProfileController extends Controller
{
  /**
   * Show the form for editing the student's profile.
   */
  public function edit()
  {
    $user = Auth::user();
    $student = Student::with(['class', 'user'])->where('user_id', $user->id)->first();

    return view('student.profile.edit', compact('student'));
  }

  /**
   * Update the student's profile.
   */
  public function update(Request $request)
  {
    $user = Auth::user();
    $student = Student::where('user_id', $user->id)->first();

    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|email|unique:users,email,' . $user->id,
      'phone_number' => 'nullable|string|max:20',
      'address' => 'nullable|string',
      'current_password' => 'nullable|required_with:new_password|current_password',
      'new_password' => 'nullable|min:8|confirmed',
    ]);

    DB::beginTransaction();
    try {
      // Update user data
      $userData = [
        'name' => $request->name,
        'email' => $request->email,
        'phone_number' => $request->phone_number,
      ];
      if ($request->filled('new_password')) {
        $userData['password'] = Hash::make($request->new_password);
      }

      User::where('id', $user->id)->update($userData);

      // Update student data
      $student->update([
        'address' => $request->address,
      ]);
      DB::commit();
      return redirect()->route('student.profile.edit')
        ->with('success', 'Profil berhasil diperbarui!');
    } catch (\Exception $e) {
      DB::rollBack();
      return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
  }
}
