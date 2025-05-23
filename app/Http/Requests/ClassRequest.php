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
    return [
      'class_name' => 'required|string|max:255',
      'level' => 'required|integer|between:10,12',
      'major' => 'required|in:IPA,IPS',
      'homeroom_teacher_id' => 'nullable|exists:teachers,id',
      'academic_year' => 'required|string|max:9',
    ];
  }
}
