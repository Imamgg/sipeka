<x-teacher-layout>
    <div class="p-6 bg-gradient-to-br from-blue-50 via-white to-amber-50 min-h-screen">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-slate-800">Edit Materi</h1>
                    <p class="mt-2 text-slate-600">Perbarui informasi materi pembelajaran</p>
                </div>
                <div class="mt-4 lg:mt-0 flex space-x-3">
                    <a href="{{ route('teacher.materials.show', $material) }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-100 border border-blue-300 rounded-lg text-sm font-medium text-blue-700 hover:bg-blue-200 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg>
                        Lihat Detail
                    </a>
                    <a href="{{ route('teacher.materials.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-slate-100 border border-slate-300 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-200 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                        Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Form Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
            <div class="bg-gradient-to-r from-amber-500 to-orange-600 px-6 py-4">
                <h2 class="text-xl font-bold text-white">Form Edit Materi</h2>
                <p class="text-amber-100 text-sm">Perbarui informasi materi pembelajaran</p>
            </div>

            <form action="{{ route('teacher.materials.update', $material) }}" method="POST"
                enctype="multipart/form-data" class="p-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <!-- Class Selection -->
                    <div class="space-y-2">
                        <label for="class_id" class="block text-sm font-semibold text-slate-700">
                            Kelas <span class="text-red-500">*</span>
                        </label>
                        <select name="class_id" id="class_id"
                            class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-amber-500/20 focus:border-amber-500 transition-all duration-200">
                            <option value="">Pilih Kelas</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}"
                                    {{ old('class_id', $material->class_id) == $class->id ? 'selected' : '' }}>
                                    {{ $class->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('class_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Subject Selection -->
                    <div class="space-y-2">
                        <label for="subject_id" class="block text-sm font-semibold text-slate-700">
                            Mata Pelajaran <span class="text-red-500">*</span>
                        </label>
                        <select name="subject_id" id="subject_id"
                            class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-amber-500/20 focus:border-amber-500 transition-all duration-200">
                            <option value="">Pilih Mata Pelajaran</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}"
                                    {{ old('subject_id', $material->subject_id) == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('subject_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <!-- Material Title -->
                    <div class="space-y-2">
                        <label for="title" class="block text-sm font-semibold text-slate-700">
                            Judul Materi <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title" id="title"
                            value="{{ old('title', $material->title) }}"
                            class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-amber-500/20 focus:border-amber-500 transition-all duration-200"
                            placeholder="Masukkan judul materi...">
                        @error('title')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Material Type -->
                    <div class="space-y-2">
                        <label for="type" class="block text-sm font-semibold text-slate-700">
                            Tipe Materi <span class="text-red-500">*</span>
                        </label>
                        <select name="type" id="type"
                            class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-amber-500/20 focus:border-amber-500 transition-all duration-200">
                            <option value="">Pilih Tipe</option>
                            <option value="lesson" {{ old('type', $material->type) == 'lesson' ? 'selected' : '' }}>📚
                                Materi Pelajaran</option>
                            <option value="assignment"
                                {{ old('type', $material->type) == 'assignment' ? 'selected' : '' }}>📝 Tugas</option>
                            <option value="quiz" {{ old('type', $material->type) == 'quiz' ? 'selected' : '' }}>🧩
                                Kuis
                            </option>
                            <option value="reference"
                                {{ old('type', $material->type) == 'reference' ? 'selected' : '' }}>📖 Referensi
                            </option>
                        </select>
                        @error('type')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">
                        Deskripsi Materi
                    </label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-amber-500/20 focus:border-amber-500 transition-all duration-200"
                        placeholder="Jelaskan tentang materi ini...">{{ old('description', $material->description) }}</textarea>
                    @error('description')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Current File Info -->
                @if ($material->file_path)
                    <div class="mb-6 p-4 bg-green-50 rounded-xl border border-green-200">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-green-800">File Saat Ini:</p>
                                    <p class="text-sm text-green-600">
                                        {{ $material->file_name ?? basename($material->file_path) }}</p>
                                    @if ($material->file_size)
                                        <p class="text-xs text-green-500">
                                            {{ number_format($material->file_size / 1024, 2) }} KB</p>
                                    @endif
                                </div>
                            </div>
                            <a href="{{ Storage::url($material->file_path) }}" target="_blank"
                                class="text-green-600 hover:text-green-800 font-medium text-sm">
                                Download
                            </a>
                        </div>
                    </div>
                @endif

                <!-- File Upload Section -->
                <div
                    class="mb-6 p-6 bg-gradient-to-br from-slate-50 to-slate-100 rounded-xl border-2 border-dashed border-slate-300">
                    <div class="text-center">
                        <svg class="mx-auto h-12 w-12 text-slate-400 mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                            </path>
                        </svg>
                        <label for="file" class="block text-sm font-semibold text-slate-700 mb-2">
                            Ganti File Materi (Opsional)
                        </label>
                        <input type="file" name="file" id="file"
                            accept=".pdf,.doc,.docx,.ppt,.pptx,.jpg,.jpeg,.png,.gif,.mp4,.mp3,.zip,.rar"
                            class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 transition-all duration-200">
                        <p class="text-xs text-slate-500 mt-2">
                            Format: PDF, DOC, DOCX, PPT, PPTX, JPG, PNG, MP4, MP3, ZIP, RAR (Max: 50MB)
                        </p>
                        <p class="text-xs text-amber-600 mt-1">
                            Kosongkan jika tidak ingin mengganti file
                        </p>
                        @error('file')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Due Date (for assignments) -->
                <div id="due-date-section"
                    class="mb-6 {{ in_array($material->type, ['assignment', 'quiz']) ? '' : 'hidden' }}">
                    <label for="due_date" class="block text-sm font-semibold text-slate-700 mb-2">
                        Batas Waktu Pengumpulan
                    </label>
                    <input type="datetime-local" name="due_date" id="due_date"
                        value="{{ old('due_date', $material->due_date ? $material->due_date->format('Y-m-d\TH:i') : '') }}"
                        class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-amber-500/20 focus:border-amber-500 transition-all duration-200">
                    @error('due_date')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-slate-200">
                    <button type="submit"
                        class="flex-1 bg-gradient-to-r from-amber-500 to-orange-600 text-white font-semibold py-3 px-6 rounded-xl hover:from-amber-600 hover:to-orange-700 focus:ring-4 focus:ring-amber-500/20 transition-all duration-200 transform hover:scale-[1.02] shadow-lg">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Perbarui Materi
                    </button>
                    <a href="{{ route('teacher.materials.show', $material) }}"
                        class="flex-1 bg-slate-100 text-slate-700 font-semibold py-3 px-6 rounded-xl hover:bg-slate-200 focus:ring-4 focus:ring-slate-500/20 transition-all duration-200 text-center">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeSelect = document.getElementById('type');
            const dueDateSection = document.getElementById('due-date-section');

            // Show/hide due date based on material type
            typeSelect.addEventListener('change', function() {
                if (this.value === 'assignment' || this.value === 'quiz') {
                    dueDateSection.classList.remove('hidden');
                } else {
                    dueDateSection.classList.add('hidden');
                }
            });
        });
    </script>
</x-teacher-layout>
