<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

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
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'nis' => 'required|string|max:20',
            'nisn' => 'nullable|string|max:20',
            'place_of_birth' => 'required|string|max:100',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:M,F',
            'address' => 'required|string',
            'phone_number' => 'nullable|string|max:15',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
        ];

        // For store method (creating new student)
        if (!$this->student) {
            $rules['email'] .= '|unique:users';
            $rules['nis'] .= '|unique:students';
            $rules['nisn'] .= '|unique:students';
            $rules['password'] = ['required', 'confirmed', Rules\Password::defaults()];
        }
        // For update method (editing existing student)
        else {
            $rules['email'] .= '|unique:users,email,' . $this->student->user_id;
            $rules['nis'] .= '|unique:students,nis,' . $this->student->id;
            $rules['nisn'] .= '|unique:students,nisn,' . $this->student->id;

            if ($this->filled('password')) {
                $rules['password'] = ['required', 'confirmed', Rules\Password::defaults()];
            }
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'email.unique' => 'Email sudah digunakan, gunakan email yang lain.',
            'nis.unique' => 'NIS sudah digunakan, gunakan NIS yang lain.',
            'nisn.unique' => 'NISN sudah digunakan, gunakan NISN yang lain.',
        ];
    }
}
