<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.announcements.index') }}"
                    class="group inline-flex items-center gap-2 rounded-xl bg-gray-100 px-4 py-2.5 text-sm font-medium text-gray-700 transition-all duration-200 hover:bg-gray-200 hover:scale-105">
                    <svg class="h-4 w-4 transition-transform group-hover:-translate-x-1" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Buat Pengumuman</h1>
                    <p class="text-gray-600 mt-1">Buat pengumuman baru untuk menyampaikan informasi penting</p>
                </div>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.announcements.store') }}" method="POST" enctype="multipart/form-data"
            class="space-y-8">
            @csrf

            <!-- Basic Information -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Informasi Dasar</h2>
                </div>
                <div class="p-6 space-y-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul
                            Pengumuman</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required
                            class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('title') border-red-500 @enderror"
                            placeholder="Masukkan judul pengumuman yang jelas dan menarik">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Isi
                            Pengumuman</label>
                        <textarea name="content" id="content" rows="6" required
                            class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('content') border-red-500 @enderror"
                            placeholder="Tulis isi pengumuman dengan jelas dan lengkap...">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Anda dapat menggunakan format HTML sederhana untuk
                            mempercantik tampilan.</p>
                    </div>
                </div>
            </div>

            <!-- Target & Priority -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-green-50 to-emerald-50 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Target & Prioritas</h2>
                </div>
                <div class="p-6 space-y-6">
                    <!-- Target -->
                    <div>
                        <label for="target" class="block text-sm font-medium text-gray-700 mb-2">Target
                            Pengumuman</label>
                        <select name="target" id="target" required
                            class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('target') border-red-500 @enderror">
                            <option value="">Pilih target pengumuman</option>
                            <option value="all" {{ old('target') === 'all' ? 'selected' : '' }}>Semua Pengguna
                            </option>
                            <option value="students" {{ old('target') === 'students' ? 'selected' : '' }}>Siswa</option>
                            <option value="teachers" {{ old('target') === 'teachers' ? 'selected' : '' }}>Guru</option>
                            <option value="classes" {{ old('target') === 'classes' ? 'selected' : '' }}>Kelas Tertentu
                            </option>
                        </select>
                        @error('target')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Class Target (Hidden by default) -->
                    <div id="class-target-section" class="hidden">
                        <label for="class_target" class="block text-sm font-medium text-gray-700 mb-2">Pilih
                            Kelas</label>
                        <div class="space-y-2 max-h-48 overflow-y-auto border rounded-xl p-4">
                            @foreach ($classes as $class)
                                <label class="flex items-center">
                                    <input type="checkbox" name="class_target[]" value="{{ $class->id }}"
                                        {{ in_array($class->id, old('class_target', [])) ? 'checked' : '' }}
                                        class="rounded text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">{{ $class->name }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('class_target')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Priority -->
                    <div>
                        <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">Prioritas</label>
                        <select name="priority" id="priority" required
                            class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('priority') border-red-500 @enderror">
                            <option value="">Pilih prioritas</option>
                            <option value="low" {{ old('priority') === 'low' ? 'selected' : '' }}>Rendah</option>
                            <option value="medium" {{ old('priority') === 'medium' ? 'selected' : '' }}>Sedang</option>
                            <option value="high" {{ old('priority') === 'high' ? 'selected' : '' }}>Tinggi</option>
                        </select>
                        @error('priority')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Prioritas tinggi akan ditampilkan lebih mencolok kepada
                            pengguna.</p>
                    </div>
                </div>
            </div>

            <!-- Schedule & Attachment -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-purple-50 to-pink-50 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Jadwal & Lampiran</h2>
                </div>
                <div class="p-6 space-y-6"> <!-- Published At -->
                    <div>
                        <label for="published_at" class="block text-sm font-medium text-gray-700 mb-2">Tanggal & Waktu
                            Publikasi</label>
                        <input type="datetime-local" name="published_at" id="published_at"
                            value="{{ old('published_at', now()->setTimezone('Asia/Jakarta')->format('Y-m-d\TH:i')) }}"
                            required
                            class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('published_at') border-red-500 @enderror">
                        @error('published_at')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Pengumuman akan otomatis dipublikasikan pada waktu yang
                            ditentukan (WIB).</p>
                    </div>

                    <!-- Expires At -->
                    <div>
                        <label for="expires_at" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Berakhir
                            (Opsional)</label>
                        <input type="datetime-local" name="expires_at" id="expires_at" value="{{ old('expires_at') }}"
                            class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('expires_at') border-red-500 @enderror">
                        @error('expires_at')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Kosongkan jika pengumuman tidak memiliki batas waktu
                            (WIB).</p>
                    </div>

                    <!-- Attachment -->
                    <div>
                        <label for="attachment" class="block text-sm font-medium text-gray-700 mb-2">Lampiran File
                            (Opsional)</label>
                        <input type="file" name="attachment" id="attachment"
                            accept=".pdf,.doc,.docx,.png,.jpg,.jpeg"
                            class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('attachment') border-red-500 @enderror">
                        @error('attachment')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">File yang didukung: PDF, DOC, DOCX, PNG, JPG, JPEG.
                            Maksimal
                            5MB.</p>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-end space-x-4">
                <a href="{{ route('admin.announcements.index') }}"
                    class="px-6 py-3 border text-gray-700 font-semibold rounded-xl hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm hover:shadow-md">
                    Batal
                </a>
                <button type="submit"
                    class="px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transform hover:scale-105 transition-all duration-200 shadow-lg">
                    <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                        </path>
                    </svg>
                    Buat Pengumuman
                </button>
            </div>
        </form>
    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const targetSelect = document.getElementById('target');
                const classTargetSection = document.getElementById('class-target-section');

                // Toggle class target section
                function toggleClassTarget() {
                    if (targetSelect.value === 'classes') {
                        classTargetSection.classList.remove('hidden');
                    } else {
                        classTargetSection.classList.add('hidden');
                        // Uncheck all checkboxes
                        const checkboxes = classTargetSection.querySelectorAll('input[type="checkbox"]');
                        checkboxes.forEach(checkbox => checkbox.checked = false);
                    }
                }

                targetSelect.addEventListener('change', toggleClassTarget);

                // Initialize on page load
                toggleClassTarget();

                // Rich text editor for content (simple implementation)
                const contentTextarea = document.getElementById('content');

                // Add some basic formatting buttons (optional)
                const toolbar = document.createElement('div');
                toolbar.className = 'flex items-center space-x-2 mb-2 p-2 bg-gray-50 rounded-lg border';

                const boldBtn = document.createElement('button');
                boldBtn.type = 'button';
                boldBtn.innerHTML = '<strong>B</strong>';
                boldBtn.className =
                    'px-2 py-1 text-sm font-bold bg-white border rounded hover:bg-gray-100';
                boldBtn.onclick = () => insertTag('strong');

                const italicBtn = document.createElement('button');
                italicBtn.type = 'button';
                italicBtn.innerHTML = '<em>I</em>';
                italicBtn.className =
                    'px-2 py-1 text-sm italic bg-white border rounded hover:bg-gray-100';
                italicBtn.onclick = () => insertTag('em');

                toolbar.appendChild(boldBtn);
                toolbar.appendChild(italicBtn);

                contentTextarea.parentNode.insertBefore(toolbar, contentTextarea);

                function insertTag(tag) {
                    const start = contentTextarea.selectionStart;
                    const end = contentTextarea.selectionEnd;
                    const selectedText = contentTextarea.value.substring(start, end);
                    const replacement = `<${tag}>${selectedText}</${tag}>`;

                    contentTextarea.value = contentTextarea.value.substring(0, start) + replacement + contentTextarea
                        .value.substring(end);
                    contentTextarea.focus();
                }
            });
        </script>
    @endpush
</x-app-layout>
