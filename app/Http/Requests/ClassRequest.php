<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassRequest extends FormRequest
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
     */  public function rules(): array
    {
        $rules = [
            'class_name' => 'required|string|max:255',
            'level' => 'required|integer|between:10,12',
            'major' => 'required|in:IPA,IPS',
            'homeroom_teacher_id' => 'nullable|exists:teachers,id',
            'academic_year' => 'required|string|max:9',
        ];

        if ($this->homeroom_teacher_id) {
            $classId = $this->route('class') ? $this->route('class')->id : null;

            if ($classId) {
                $rules['homeroom_teacher_id'] .= '|unique:classes,homeroom_teacher_id,' . $classId;
            } else {
                $rules['homeroom_teacher_id'] .= '|unique:classes,homeroom_teacher_id';
            }
        }

        return $rules;
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'class_name.required' => 'Nama kelas wajib diisi.',
            'class_name.string' => 'Nama kelas harus berupa teks.',
            'class_name.max' => 'Nama kelas maksimal 255 karakter.',
            'level.required' => 'Tingkat kelas wajib dipilih.',
            'level.integer' => 'Tingkat kelas harus berupa angka.',
            'level.between' => 'Tingkat kelas harus antara 10-12.',
            'major.required' => 'Jurusan wajib dipilih.',
            'major.in' => 'Jurusan harus IPA atau IPS.',
            'homeroom_teacher_id.exists' => 'Guru yang dipilih tidak valid.',
            'homeroom_teacher_id.unique' => 'Guru ini sudah menjadi wali kelas di kelas lain. Satu guru hanya bisa menjadi wali kelas untuk satu kelas.',
            'academic_year.required' => 'Tahun akademik wajib diisi.',
            'academic_year.string' => 'Tahun akademik harus berupa teks.',
            'academic_year.max' => 'Tahun akademik maksimal 9 karakter.',
        ];
    }
}
