<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                        <svg class="w-8 h-8 mr-3 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        Edit Pengumuman
                    </h1>
                    <p class="text-gray-600 mt-1">Ubah informasi pengumuman yang telah ada</p>
                </div>
                <a href="{{ route('admin.announcements.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6">
                <form action="{{ route('admin.announcements.update', $announcement) }}" method="POST"
                    enctype="multipart/form-data" id="announcementForm" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Main Content -->
                        <div class="lg:col-span-2 space-y-6">
                            <!-- Title -->
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                    Judul Pengumuman <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-300 @enderror"
                                    id="title" name="title" value="{{ old('title', $announcement->title) }}"
                                    placeholder="Masukkan judul pengumuman yang menarik" required>
                                @error('title')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Content -->
                            <div>
                                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                                    Konten Pengumuman <span class="text-red-500">*</span>
                                </label>
                                <div
                                    class="border rounded-lg overflow-hidden @error('content') border-red-300 @enderror">
                                    <!-- Toolbar -->
                                    <div class="bg-gray-50 border-b border-gray-200 px-4 py-2">
                                        <div class="flex items-center space-x-2">
                                            <button type="button"
                                                class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded"
                                                onclick="formatText('bold')" title="Bold">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5zm0 2h10v10H5V5z" />
                                                    <path d="M7 7h2a1 1 0 011 1v4a1 1 0 01-1 1H7V7zm2 1H8v2h1V8z" />
                                                </svg>
                                            </button>
                                            <button type="button"
                                                class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded"
                                                onclick="formatText('italic')" title="Italic">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M8 3a1 1 0 00-1 1v12a1 1 0 102 0V6h2a1 1 0 100-2H8z" />
                                                </svg>
                                            </button>
                                            <button type="button"
                                                class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded"
                                                onclick="formatText('underline')" title="Underline">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M4 17h12v1H4v-1zm2-13v6a4 4 0 008 0V4a1 1 0 112 0v6a6 6 0 01-12 0V4a1 1 0 112 0z" />
                                                </svg>
                                            </button>
                                            <div class="border-l h-6 mx-2"></div>
                                            <button type="button"
                                                class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded"
                                                onclick="insertList('ul')" title="Bullet List">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M3 4a1 1 0 100 2 1 1 0 000-2zM7 5a1 1 0 011-1h8a1 1 0 110 2H8a1 1 0 01-1-1zM3 9a1 1 0 100 2 1 1 0 000-2zM8 10a1 1 0 100 2h8a1 1 0 100-2H8zM3 14a1 1 0 100 2 1 1 0 000-2zM8 15a1 1 0 100 2h8a1 1 0 100-2H8z" />
                                                </svg>
                                            </button>
                                            <button type="button"
                                                class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded"
                                                onclick="insertList('ol')" title="Numbered List">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M2 4a1 1 0 011-1h14a1 1 0 110 2H3a1 1 0 01-1-1zM2 8a1 1 0 011-1h14a1 1 0 110 2H3a1 1 0 01-1-1zM2 12a1 1 0 011-1h14a1 1 0 110 2H3a1 1 0 01-1-1zM2 16a1 1 0 011-1h14a1 1 0 110 2H3a1 1 0 01-1-1z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <textarea class="w-full px-4 py-3 border-0 focus:ring-0 resize-none" id="content" name="content" rows="8"
                                        placeholder="Tulis konten pengumuman di sini..." required>{{ old('content', $announcement->content) }}</textarea>
                                </div>
                                @error('content')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- File Attachment -->
                            <div>
                                <label for="attachment" class="block text-sm font-medium text-gray-700 mb-2">
                                    File Lampiran (Opsional)
                                </label>

                                @if ($announcement->attachment)
                                    <div class="mb-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <svg class="w-8 h-8 text-blue-500 mr-3" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                    </path>
                                                </svg>
                                                <div>
                                                    <p class="text-sm font-medium text-blue-900">File saat ini:</p>
                                                    <p class="text-sm text-blue-700">
                                                        {{ basename($announcement->attachment) }}</p>
                                                </div>
                                            </div>
                                            <a href="{{ route('admin.announcements.download', $announcement) }}"
                                                class="inline-flex items-center px-3 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition-colors">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                    </path>
                                                </svg>
                                                Unduh
                                            </a>
                                        </div>
                                    </div>
                                @endif

                                <div
                                    class="flex justify-center px-6 pt-5 pb-6 border-2 border-dashed rounded-lg hover:border-gray-400 transition-colors">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                            fill="none" viewBox="0 0 48 48">
                                            <path
                                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="attachment"
                                                class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                <span>Pilih file baru</span>
                                                <input id="attachment" name="attachment" type="file"
                                                    class="sr-only @error('attachment') border-red-300 @enderror"
                                                    accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.jpg,.jpeg,.png,.zip,.rar">
                                            </label>
                                            <p class="pl-1">atau drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PDF, DOC, XLS, PPT, JPG, PNG, ZIP hingga 10MB
                                        </p>
                                        <p class="text-xs text-gray-400">Kosongkan jika tidak ingin mengubah file</p>
                                    </div>
                                </div>
                                @error('attachment')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div> <!-- Sidebar -->
                        <div class="lg:col-span-1 space-y-6">
                            <!-- Status -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Pengaturan Publikasi</h3>

                                <div class="space-y-4">
                                    <!-- Status -->
                                    <div>
                                        <label for="is_active"
                                            class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                        <select
                                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('is_active') border-red-300 @enderror"
                                            id="is_active" name="is_active">
                                            <option value="1"
                                                {{ old('is_active', $announcement->is_active) == 1 ? 'selected' : '' }}>
                                                ✅ Aktif
                                            </option>
                                            <option value="0"
                                                {{ old('is_active', $announcement->is_active) == 0 ? 'selected' : '' }}>
                                                ❌ Nonaktif
                                            </option>
                                        </select>
                                        @error('is_active')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Priority -->
                                    <div>
                                        <label for="priority"
                                            class="block text-sm font-medium text-gray-700 mb-2">Prioritas</label>
                                        <select
                                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('priority') border-red-300 @enderror"
                                            id="priority" name="priority">
                                            <option value="low"
                                                {{ old('priority', $announcement->priority) == 'low' ? 'selected' : '' }}>
                                                🔵 Rendah
                                            </option>
                                            <option value="medium"
                                                {{ old('priority', $announcement->priority) == 'medium' ? 'selected' : '' }}>
                                                🟡 Sedang
                                            </option>
                                            <option value="high"
                                                {{ old('priority', $announcement->priority) == 'high' ? 'selected' : '' }}>
                                                🔴 Tinggi
                                            </option>
                                        </select>
                                        @error('priority')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Target -->
                                    <div>
                                        <label for="target"
                                            class="block text-sm font-medium text-gray-700 mb-2">Target
                                            Pengumuman</label>
                                        <select
                                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('target') border-red-300 @enderror"
                                            id="target" name="target" onchange="toggleClassSelector()">
                                            <option value="all"
                                                {{ old('target', $announcement->target) == 'all' ? 'selected' : '' }}>
                                                👥 Semua Pengguna
                                            </option>
                                            <option value="students"
                                                {{ old('target', $announcement->target) == 'students' ? 'selected' : '' }}>
                                                🎓 Siswa
                                            </option>
                                            <option value="teachers"
                                                {{ old('target', $announcement->target) == 'teachers' ? 'selected' : '' }}>
                                                👨‍🏫 Guru
                                            </option>
                                            <option value="classes"
                                                {{ old('target', $announcement->target) == 'classes' ? 'selected' : '' }}>
                                                🏫 Kelas Tertentu
                                            </option>
                                        </select>
                                        @error('target')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div> <!-- Target Classes -->
                                    <div id="targetClassesDiv"
                                        class="{{ old('target', $announcement->target) == 'classes' ? '' : 'hidden' }}">
                                        <label for="class_target"
                                            class="block text-sm font-medium text-gray-700 mb-2">Pilih Kelas</label>
                                        <select
                                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('class_target') border-red-300 @enderror"
                                            id="class_target" name="class_target[]" multiple size="4">
                                            @foreach ($classes as $class)
                                                <option value="{{ $class->id }}"
                                                    {{ in_array($class->id, old('class_target', $announcement->class_target ?? [])) ? 'selected' : '' }}>
                                                    {{ $class->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <p class="mt-1 text-xs text-gray-500">Tahan Ctrl untuk memilih beberapa kelas
                                        </p>
                                        @error('class_target')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div> <!-- Published At -->
                                    <div>
                                        <label for="published_at"
                                            class="block text-sm font-medium text-gray-700 mb-2">Waktu
                                            Publikasi</label>
                                        <input type="datetime-local"
                                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('published_at') border-red-300 @enderror"
                                            id="published_at" name="published_at"
                                            value="{{ old('published_at', $announcement->published_at ? $announcement->published_at->setTimezone('Asia/Jakarta')->format('Y-m-d\TH:i') : '') }}">
                                        <p class="mt-1 text-xs text-gray-500">Kosongkan untuk publikasi sekarang (WIB)
                                        </p>
                                        @error('published_at')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div> <!-- Expires At -->
                                    <div>
                                        <label for="expires_at"
                                            class="block text-sm font-medium text-gray-700 mb-2">Tanggal Berakhir
                                            (Opsional)</label>
                                        <input type="datetime-local"
                                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('expires_at') border-red-300 @enderror"
                                            id="expires_at" name="expires_at"
                                            value="{{ old('expires_at', $announcement->expires_at ? $announcement->expires_at->setTimezone('Asia/Jakarta')->format('Y-m-d\TH:i') : '') }}">
                                        <p class="mt-1 text-xs text-gray-500">Kosongkan jika tidak ada batas waktu
                                            (WIB)</p>
                                        @error('expires_at')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="space-y-3">
                                <button type="submit"
                                    class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transform hover:scale-105 transition-all duration-200 shadow-lg"
                                    id="submitBtn">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Update Pengumuman
                                </button>

                                <a href="{{ route('admin.announcements.show', $announcement) }}"
                                    class="w-full flex items-center justify-center px-4 py-3 bg-white border text-gray-700 font-semibold rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                    Lihat Pengumuman
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> @push('scripts')
        <script>
            function toggleClassSelector() {
                const target = document.getElementById('target').value;
                const classDiv = document.getElementById('targetClassesDiv');

                if (target === 'classes') {
                    classDiv.classList.remove('hidden');
                } else {
                    classDiv.classList.add('hidden');
                }
            }

            function formatText(command) {
                const textarea = document.getElementById('content');
                const start = textarea.selectionStart;
                const end = textarea.selectionEnd;
                const selectedText = textarea.value.substring(start, end);

                if (selectedText) {
                    let formattedText = '';
                    switch (command) {
                        case 'bold':
                            formattedText = `<strong>${selectedText}</strong>`;
                            break;
                        case 'italic':
                            formattedText = `<em>${selectedText}</em>`;
                            break;
                        case 'underline':
                            formattedText = `<u>${selectedText}</u>`;
                            break;
                    }

                    textarea.value = textarea.value.substring(0, start) + formattedText + textarea.value.substring(end);
                    textarea.focus();
                    textarea.setSelectionRange(start, start + formattedText.length);
                }
            }

            function insertList(type) {
                const textarea = document.getElementById('content');
                const start = textarea.selectionStart;
                const end = textarea.selectionEnd;
                const selectedText = textarea.value.substring(start, end);

                const listTag = type === 'ul' ? 'ul' : 'ol';
                const items = selectedText ? selectedText.split('\n').filter(line => line.trim()) : ['Item 1', 'Item 2',
                    'Item 3'
                ];

                let listHTML = `<${listTag}>\n`;
                items.forEach(item => {
                    listHTML += `  <li>${item.trim()}</li>\n`;
                });
                listHTML += `</${listTag}>`;

                textarea.value = textarea.value.substring(0, start) + listHTML + textarea.value.substring(end);
                textarea.focus();
            }

            // Form validation and submission
            document.getElementById('announcementForm').addEventListener('submit', function(e) {
                const title = document.getElementById('title').value.trim();
                const content = document.getElementById('content').value.trim();

                if (!title || !content) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Form Tidak Lengkap',
                        text: 'Judul dan konten pengumuman harus diisi!',
                        customClass: {
                            popup: 'rounded-2xl',
                            confirmButton: 'rounded-xl px-6 py-2.5'
                        }
                    });
                    return false;
                }

                // Show loading state
                const submitBtn = document.getElementById('submitBtn');
                const originalContent = submitBtn.innerHTML;
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Mengupdate...
                `;

                // Reset button if form submission fails
                setTimeout(() => {
                    if (submitBtn.disabled) {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalContent;
                    }
                }, 10000);
            });

            // Initialize on page load
            document.addEventListener('DOMContentLoaded', function() {
                toggleClassSelector();

                // File upload preview
                const fileInput = document.getElementById('attachment');
                if (fileInput) {
                    fileInput.addEventListener('change', function(e) {
                        const file = e.target.files[0];
                        if (file) {
                            const fileName = file.name;
                            const fileSize = (file.size / 1024 / 1024).toFixed(2);

                            if (file.size > 10 * 1024 * 1024) { // 10MB limit
                                Swal.fire({
                                    icon: 'error',
                                    title: 'File Terlalu Besar',
                                    text: 'Ukuran file maksimal 10MB!',
                                    customClass: {
                                        popup: 'rounded-2xl',
                                        confirmButton: 'rounded-xl px-6 py-2.5'
                                    }
                                });
                                e.target.value = '';
                                return;
                            }

                            console.log(`File selected: ${fileName} (${fileSize}MB)`);
                        }
                    });
                }
            });
        </script>
    @endpush
</x-app-layout>
