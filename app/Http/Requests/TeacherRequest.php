<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TeacherRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    $rules = [
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->user_id)],
      'nip' => ['required', 'string', 'max:20', Rule::unique('teachers')->ignore($this->teacher)],
      'place_of_birth' => ['required', 'string', 'max:255'],
      'date_of_birth' => ['required', 'date'],
      'gender' => ['required', 'in:M,F'],
      'address' => ['required', 'string'],
      'phone_number' => ['nullable', 'string', 'max:15'],
    ];

    // Add password rules only when creating a new teacher or updating password
    if (!$this->teacher || $this->filled('password')) {
      $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
    }

    return $rules;
  }

  public function messages(): array
  {
    return [
      'name.required' => 'Nama lengkap wajib diisi.',
      'email.required' => 'Email wajib diisi.',
      'email.email' => 'Format email tidak valid.',
      'email.unique' => 'Email sudah digunakan.',
      'password.required' => 'Password wajib diisi.',
      'password.min' => 'Password minimal 8 karakter.',
      'password.confirmed' => 'Konfirmasi password tidak cocok.',
      'nip.required' => 'NIP wajib diisi.',
      'nip.unique' => 'NIP sudah digunakan.',
      'place_of_birth.required' => 'Tempat lahir wajib diisi.',
      'date_of_birth.required' => 'Tanggal lahir wajib diisi.',
      'date_of_birth.date' => 'Format tanggal lahir tidak valid.',
      'gender.required' => 'Jenis kelamin wajib dipilih.',
      'gender.in' => 'Jenis kelamin tidak valid.',
      'address.required' => 'Alamat wajib diisi.',
      'phone_number.max' => 'Nomor telepon maksimal 15 karakter.',
    ];
  }
}
