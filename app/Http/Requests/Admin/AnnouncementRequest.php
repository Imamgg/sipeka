<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AnnouncementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->role === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|regex:/^[a-zA-Z0-9\s\-_.,!?()]+$/',
            'content' => 'required|string',
            'target' => 'required|in:all,students,teachers,classes',
            'class_target' => 'nullable|array',
            'class_target.*' => 'nullable|numeric|exists:classes,id',
            'priority' => 'required|in:low,medium,high',
            'published_at' => 'required|date',
            'expires_at' => 'nullable|date|after:published_at',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:5120',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul pengumuman wajib diisi.',
            'title.string' => 'Judul harus berupa teks.',
            'title.max' => 'Judul maksimal 255 karakter.',
            'title.regex' => 'Judul hanya boleh berisi huruf, angka, spasi, dan karakter khusus seperti - _ . , ! ? ( )',
            'content.required' => 'Konten pengumuman wajib diisi.',
            'target.required' => 'Target pengumuman wajib dipilih.',
            'target.in' => 'Target pengumuman tidak valid.',
            'class_target.array' => 'Target kelas harus berupa array.',
            'class_target.*.numeric' => 'ID kelas harus berupa angka.',
            'class_target.*.exists' => 'Kelas yang dipilih tidak valid.',
            'priority.required' => 'Prioritas pengumuman wajib dipilih.',
            'priority.in' => 'Prioritas pengumuman harus low, medium, atau high.',
            'published_at.required' => 'Tanggal publikasi wajib diisi.',
            'published_at.date' => 'Tanggal publikasi harus berupa tanggal yang valid.',
            'expires_at.date' => 'Tanggal kedaluwarsa harus berupa tanggal yang valid.',
            'expires_at.after' => 'Tanggal kedaluwarsa harus setelah tanggal publikasi.',
            'attachment.file' => 'Lampiran harus berupa file.',
            'attachment.mimes' => 'Lampiran harus berupa file dengan format: pdf, doc, docx, png, jpg, jpeg.',
            'attachment.max' => 'Ukuran lampiran maksimal 5 MB.',
        ];
    }
}
