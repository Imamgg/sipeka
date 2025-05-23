<?php

namespace App\Http\Requests;

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
        $userId = $studentId ? \App\Models\Student::find($studentId)?->user_id : null;

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($userId)],
            'phone_number' => ['nullable', 'string', 'max:15'],
            'password' => [$this->isMethod('POST') ? 'required' : 'nullable', Password::defaults(), 'confirmed'],
            'nis' => ['required', 'string', 'max:20', Rule::unique('students')->ignore($studentId)],
            'nisn' => ['nullable', 'string', 'max:20', Rule::unique('students')->ignore($studentId)],
            'class_id' => ['nullable', 'exists:classes,id'],
            'place_of_birth' => ['required', 'string', 'max:100'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required', 'in:M,F'],
            'address' => ['required', 'string'],
            'father_name' => ['nullable', 'string', 'max:255'],
            'mother_name' => ['nullable', 'string', 'max:255'],
        ];
    }
}
