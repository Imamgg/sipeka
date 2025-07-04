<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class TeacherProfileController extends Controller
{
    /**
     * Show the teacher profile edit form.
     */
    public function edit()
    {
        $user = Auth::user();
        $teacher = $user->teacher;

        if (!$teacher) {
            return redirect()->route('teacher.dashboard')->with('error', 'Teacher data not found.');
        }

        return view('teacher.profile.edit', compact('teacher', 'user'));
    }

    /**
     * Update the teacher profile.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $teacher = $user->teacher;

        if (!$teacher) {
            return redirect()->route('teacher.dashboard')->with('error', 'Teacher data not found.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'nip' => 'required|string|max:20|unique:teachers,nip,' . $teacher->id,
            'place_of_birth' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:M,F',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string|max:20',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'current_password' => 'nullable|required_with:password',
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        // Update user data
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // Store new profile picture
            $profilePicturePath = $request->file('profile_picture')->store('profile-pictures', 'public');
            $userData['profile_picture'] = $profilePicturePath;
        }

        // Check if password change is requested
        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'The current password is incorrect.']);
            }
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        // Update teacher data
        $teacher->update([
            'nip' => $request->nip,
            'place_of_birth' => $request->place_of_birth,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->route('teacher.profile.edit')->with('profile_success', 'Profile updated successfully!');
    }
}
