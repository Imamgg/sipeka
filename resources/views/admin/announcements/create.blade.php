<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <!-- Breadcrumb Navigation -->
        <div class="mb-8">
            <nav class="flex items-center space-x-4 text-sm">
                <a href="{{ route('admin.dashboard') }}"
                    class="inline-flex items-center text-gray-600 hover:text-blue-600 transition-colors group">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 1v6m8-6v6"></path>
                    </svg>
                    <span class="font-medium">Dashboard</span>
                </a>
                <span class="text-gray-400">/</span>
                <a href="{{ route('admin.announcements.index') }}"
                    class="inline-flex items-center text-gray-600 hover:text-blue-600 transition-colors group">
                    <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                        </path>
                    </svg>
                    <span class="font-medium">Kelola Pengumuman</span>
                </a>
                <span class="text-gray-400">/</span>
                <span class="text-gray-900 font-medium">Buat Pengumuman</span>
            </nav>
        </div>

        <!-- Header Section -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl shadow-sm border border-gray-200 mb-6">
            <div class="p-8">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Buat Pengumuman</h1>
                        <p class="text-gray-600 mt-1">Buat pengumuman baru untuk menyampaikan informasi penting</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="max-w-7xl mx-auto">
            <form action="{{ route('admin.announcements.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf

                <!-- Row 1: Basic Information (Full Width) -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-8 py-4 bg-gray-50 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Informasi Dasar
                        </h2>
                    </div>
                    <div class="p-6">
                        <!-- Title -->
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul
                                Pengumuman</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" required
                                class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('title') border-red-500 @enderror"
                                placeholder="Masukkan judul pengumuman">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Isi
                                Pengumuman</label>
                            <textarea name="content" id="content" rows="4" required
                                class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('content') border-red-500 @enderror"
                                placeholder="Tulis isi pengumuman dengan jelas dan lengkap...">{{ old('content') }}</textarea>
                            @error('content')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">Tulis isi pengumuman dengan jelas dan lengkap.</p>
                        </div>
                    </div>
                </div>

                <!-- Row 2: Grid Layout for Target, Priority, and Schedule -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Target & Class Selection -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                                Target
                            </h2>
                        </div>
                        <div class="p-6 space-y-4">
                            <!-- Target -->
                            <div>
                                <label for="target" class="block text-sm font-medium text-gray-700 mb-2">Target
                                    Pengumuman</label>
                                <select name="target" id="target" required
                                    class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('target') border-red-500 @enderror">
                                    <option value="">Pilih target pengumuman</option>
                                    <option value="all" {{ old('target') === 'all' ? 'selected' : '' }}>Semua
                                        Pengguna
                                    </option>
                                    <option value="students" {{ old('target') === 'students' ? 'selected' : '' }}>Siswa
                                    </option>
                                    <option value="teachers" {{ old('target') === 'teachers' ? 'selected' : '' }}>Guru
                                    </option>
                                    <option value="classes" {{ old('target') === 'classes' ? 'selected' : '' }}>Kelas
                                        Tertentu
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
                                <div class="space-y-2 max-h-32 overflow-y-auto border rounded-xl p-3">
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
                        </div>
                    </div>

                    <!-- Priority & Settings -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-orange-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.866-.833-2.598 0L3.226 16.5c-.77.833.192 2.5 1.732 2.5z">
                                    </path>
                                </svg>
                                Prioritas
                            </h2>
                        </div>
                        <div class="p-6">
                            <div>
                                <label for="priority"
                                    class="block text-sm font-medium text-gray-700 mb-2">Prioritas</label>
                                <select name="priority" id="priority" required
                                    class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('priority') border-red-500 @enderror">
                                    <option value="">Pilih prioritas</option>
                                    <option value="low" {{ old('priority') === 'low' ? 'selected' : '' }}>Rendah
                                    </option>
                                    <option value="medium" {{ old('priority') === 'medium' ? 'selected' : '' }}>Sedang
                                    </option>
                                    <option value="high" {{ old('priority') === 'high' ? 'selected' : '' }}>Tinggi
                                    </option>
                                </select>
                                @error('priority')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-2 text-sm text-gray-500">Prioritas tinggi akan ditampilkan lebih mencolok
                                    kepada pengguna.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Schedule & Attachment -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                Jadwal
                            </h2>
                        </div>
                        <div class="p-6 space-y-4">
                            <!-- Published At -->
                            <div>
                                <label for="published_at" class="block text-sm font-medium text-gray-700 mb-2">Tanggal
                                    Publikasi</label>
                                <input type="datetime-local" name="published_at" id="published_at"
                                    value="{{ old('published_at', now()->setTimezone('Asia/Jakarta')->format('Y-m-d\TH:i')) }}"
                                    required
                                    class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('published_at') border-red-500 @enderror">
                                @error('published_at')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Waktu publikasi (WIB)</p>
                            </div>

                            <!-- Expires At -->
                            <div>
                                <label for="expires_at" class="block text-sm font-medium text-gray-700 mb-2">Tanggal
                                    Berakhir</label>
                                <input type="datetime-local" name="expires_at" id="expires_at"
                                    value="{{ old('expires_at') }}"
                                    class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('expires_at') border-red-500 @enderror">
                                @error('expires_at')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Kosongkan jika tidak ada batas</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Row 3: Attachment (Full Width) -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                </path>
                            </svg>
                            Lampiran File
                        </h2>
                    </div>
                    <div class="p-6">
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
                                Maksimal 5MB.</p>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-8">
                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('admin.announcements.index') }}"
                                class="px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-200">
                                Batal
                            </a>
                            <button type="submit"
                                class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-lg">
                                <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7">
                                    </path>
                                </svg>
                                Buat Pengumuman
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const targetSelect = document.getElementById('target');
                const classTargetSection = document.getElementById('class-target-section');

                function toggleClassTarget() {
                    if (targetSelect.value === 'classes') {
                        classTargetSection.classList.remove('hidden');
                    } else {
                        classTargetSection.classList.add('hidden');
                        const checkboxes = classTargetSection.querySelectorAll('input[type="checkbox"]');
                        checkboxes.forEach(checkbox => checkbox.checked = false);
                    }
                }

                targetSelect.addEventListener('change', toggleClassTarget);
                toggleClassTarget();
            });
        </script>
    @endpush
</x-app-layout>
