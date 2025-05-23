<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Changed to true to allow authorized users
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'code_subject' => 'required|string|max:20|unique:subjects,code_subject',
            'subject_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ];

        // For update requests, we need to ignore the current subject's code
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['code_subject'] = 'required|string|max:20|unique:subjects,code_subject,' . $this->subject->id;
        }

        return $rules;
    }

    /**
     * Get custom error messages for validator failures.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'code_subject.required' => 'Kode mata pelajaran wajib diisi',
            'code_subject.unique' => 'Kode mata pelajaran sudah digunakan',
            'subject_name.required' => 'Nama mata pelajaran wajib diisi',
        ];
    }
}
