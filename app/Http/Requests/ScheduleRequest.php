<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
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
    return [
      'class_id' => 'required|exists:classes,id',
      'teacher_id' => 'required|exists:teachers,id',
      'subject_id' => 'required|exists:subjects,id',
      'day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
      'semester' => 'required|in:Odd,Even',
      'start_time' => 'required|date_format:H:i',
      'end_time' => 'required|date_format:H:i|after:start_time',
    ];
  }

  /**
   * Get custom error messages for validator failures.
   *
   * @return array
   */
  public function messages(): array
  {
    return [
      'class_id.required' => 'Kelas wajib dipilih',
      'class_id.exists' => 'Kelas tidak valid',
      'teacher_id.required' => 'Guru wajib dipilih',
      'teacher_id.exists' => 'Guru tidak valid',
      'subject_id.required' => 'Mata pelajaran wajib dipilih',
      'subject_id.exists' => 'Mata pelajaran tidak valid',
      'day.required' => 'Hari wajib dipilih',
      'day.in' => 'Hari tidak valid',
      'semester.required' => 'Semester wajib dipilih',
      'semester.in' => 'Semester tidak valid',
      'start_time.required' => 'Waktu mulai wajib diisi',
      'start_time.date_format' => 'Format waktu mulai tidak valid',
      'end_time.required' => 'Waktu selesai wajib diisi',
      'end_time.date_format' => 'Format waktu selesai tidak valid',
      'end_time.after' => 'Waktu selesai harus lebih lambat dari waktu mulai',
    ];
  }
}
