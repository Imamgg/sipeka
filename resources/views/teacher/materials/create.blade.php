<x-teacher-layout>
    <div class="p-6 bg-gradient-to-br from-blue-50 via-white to-amber-50 min-h-screen">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-slate-800">Upload Materi Baru</h1>
                    <p class="mt-2 text-slate-600">Tambahkan materi pembelajaran atau tugas untuk siswa</p>
                </div>
                <div class="mt-4 lg:mt-0">
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
            <div class="bg-gradient-to-r from-rose-500 to-pink-600 px-6 py-4">
                <h2 class="text-xl font-bold text-white">Form Upload Materi</h2>
                <p class="text-rose-100 text-sm">Isi informasi materi yang akan diunggah</p>
            </div>

            <form action="{{ route('teacher.materials.store') }}" method="POST" enctype="multipart/form-data"
                class="p-6">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <!-- Class Selection -->
                    <div class="space-y-2">
                        <label for="class_id" class="block text-sm font-semibold text-slate-700">
                            Kelas <span class="text-red-500">*</span>
                        </label>
                        <select name="class_id" id="class_id"
                            class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-rose-500/20 focus:border-rose-500 transition-all duration-200">
                            <option value="">Pilih Kelas</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}"
                                    {{ old('class_id') == $class->id ? 'selected' : '' }}>
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
                            class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-rose-500/20 focus:border-rose-500 transition-all duration-200">
                            <option value="">Pilih Mata Pelajaran</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}"
                                    {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
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
                        <input type="text" name="title" id="title" value="{{ old('title') }}"
                            class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-rose-500/20 focus:border-rose-500 transition-all duration-200"
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
                            class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-rose-500/20 focus:border-rose-500 transition-all duration-200">
                            <option value="">Pilih Tipe</option>
                            <option value="lesson" {{ old('type') == 'lesson' ? 'selected' : '' }}>📚 Materi Pelajaran
                            </option>
                            <option value="assignment" {{ old('type') == 'assignment' ? 'selected' : '' }}>📝 Tugas
                            </option>
                            <option value="quiz" {{ old('type') == 'quiz' ? 'selected' : '' }}>🧩 Kuis</option>
                            <option value="reference" {{ old('type') == 'reference' ? 'selected' : '' }}>📖 Referensi
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
                        class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-rose-500/20 focus:border-rose-500 transition-all duration-200"
                        placeholder="Jelaskan tentang materi ini...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

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
                            Upload File Materi
                        </label>
                        <input type="file" name="file" id="file"
                            accept=".pdf,.doc,.docx,.ppt,.pptx,.jpg,.jpeg,.png,.gif,.mp4,.mp3,.zip,.rar"
                            class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-rose-50 file:text-rose-700 hover:file:bg-rose-100 transition-all duration-200">
                        <p class="text-xs text-slate-500 mt-2">
                            Format: PDF, DOC, DOCX, PPT, PPTX, JPG, PNG, MP4, MP3, ZIP, RAR (Max: 50MB)
                        </p>
                        @error('file')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Due Date (for assignments) -->
                <div id="due-date-section" class="mb-6 hidden">
                    <label for="due_date" class="block text-sm font-semibold text-slate-700 mb-2">
                        Batas Waktu Pengumpulan
                    </label>
                    <input type="datetime-local" name="due_date" id="due_date" value="{{ old('due_date') }}"
                        class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-rose-500/20 focus:border-rose-500 transition-all duration-200">
                    @error('due_date')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-slate-200">
                    <button type="submit"
                        class="flex-1 bg-gradient-to-r from-rose-500 to-pink-600 text-white font-semibold py-3 px-6 rounded-xl hover:from-rose-600 hover:to-pink-700 focus:ring-4 focus:ring-rose-500/20 transition-all duration-200 transform hover:scale-[1.02] shadow-lg">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                            </path>
                        </svg>
                        Upload Materi
                    </button>
                    <a href="{{ route('teacher.materials.index') }}"
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

            // Initialize on page load
            if (typeSelect.value === 'assignment' || typeSelect.value === 'quiz') {
                dueDateSection.classList.remove('hidden');
            }
        });
    </script>
</x-teacher-layout>
