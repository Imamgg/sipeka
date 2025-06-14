<?php

namespace App\Http\Requests\Admin;

use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $studentId = $this->route('student');
        $userId = $studentId ? Student::find($studentId)?->user_id : null;

        return [
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s\.\']+$/'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($userId)],
            'phone_number' => ['nullable', 'string', 'regex:/^[0-9]+$/', 'digits_between:11,15'],
            'password' => [$this->isMethod('POST') ? 'required' : 'nullable', Password::defaults(), 'confirmed'],
            'nis' => ['required', 'numeric', Rule::unique('students')->ignore($studentId)],
            'nisn' => ['nullable', 'numeric', Rule::unique('students')->ignore($studentId)],
            'class_id' => ['nullable', 'numeric', 'exists:classes,id'],
            'place_of_birth' => ['required', 'string', 'max:100', 'regex:/^[a-zA-Z\s\.\']+$/'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required', 'in:M,F'],
            'address' => ['required', 'string', 'max:255'],
            'father_name' => ['nullable', 'string', 'max:255', 'regex:/^[a-zA-Z\s\.\']+$/'],
            'mother_name' => ['nullable', 'string', 'max:255', 'regex:/^[a-zA-Z\s\.\']+$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.regex' => 'Nama lengkap hanya boleh berisi huruf dan spasi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'phone_number.regex' => 'Nomor telepon hanya boleh berisi angka.',
            'phone_number.digits_between' => 'Nomor telepon harus antara 11-15 digit.',
            'password.required' => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'nis.required' => 'NIS wajib diisi.',
            'nis.unique' => 'NIS sudah digunakan.',
            'nisn.unique' => 'NISN sudah digunakan.',
            'class_id.exists' => 'Kelas yang dipilih tidak valid.',
            'place_of_birth.required' => 'Tempat lahir wajib diisi.',
            'date_of_birth.required' => 'Tanggal lahir wajib diisi.',
            'date_of_birth.date' => 'Format tanggal lahir tidak valid.',
            'gender.required' => 'Jenis kelamin wajib dipilih.',
            'address.required' => 'Alamat wajib diisi.',
            'father_name.regex' => 'Nama ayah hanya boleh berisi huruf dan spasi.',
            'mother_name.regex' => 'Nama ibu hanya boleh berisi huruf dan spasi.',
        ];
    }
}
