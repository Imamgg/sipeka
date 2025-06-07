<x-teacher-layout>
    <div class="p-6 bg-gradient-to-br from-blue-50 via-white to-amber-50 min-h-screen">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-slate-800">Detail Materi</h1>
                    <p class="mt-2 text-slate-600">Informasi lengkap materi pembelajaran</p>
                </div>
                <div class="mt-4 lg:mt-0 flex space-x-3">
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

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Material Info Card -->
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-xl font-bold text-white">{{ $material->title }}</h2>
                                <p class="text-blue-100 text-sm">{{ $material->classes->name }} •
                                    {{ $material->subject->name }}</p>
                            </div>
                            <div class="text-right">
                                @php
                                    $typeConfig = [
                                        'lesson' => [
                                            'icon' => '📚',
                                            'label' => 'Materi Pelajaran',
                                            'color' => 'bg-blue-100 text-blue-800',
                                        ],
                                        'assignment' => [
                                            'icon' => '📝',
                                            'label' => 'Tugas',
                                            'color' => 'bg-purple-100 text-purple-800',
                                        ],
                                        'quiz' => [
                                            'icon' => '🧩',
                                            'label' => 'Kuis',
                                            'color' => 'bg-green-100 text-green-800',
                                        ],
                                        'reference' => [
                                            'icon' => '📖',
                                            'label' => 'Referensi',
                                            'color' => 'bg-amber-100 text-amber-800',
                                        ],
                                    ];
                                    $config = $typeConfig[$material->type] ?? $typeConfig['lesson'];
                                @endphp
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $config['color'] }}">
                                    {{ $config['icon'] }} {{ $config['label'] }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <!-- Description -->
                        @if ($material->description)
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-slate-800 mb-3">Deskripsi</h3>
                                <div class="prose prose-slate max-w-none">
                                    <p class="text-slate-600 leading-relaxed">{{ $material->description }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- File Section -->
                        @if ($material->file_path)
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-slate-800 mb-3">File Materi</h3>
                                <div
                                    class="bg-gradient-to-r from-slate-50 to-slate-100 rounded-xl p-4 border border-slate-200">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-4">
                                            <div
                                                class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                                @php
                                                    $extension = pathinfo($material->file_path, PATHINFO_EXTENSION);
                                                    $iconClass = match (strtolower($extension)) {
                                                        'pdf' => 'text-red-600',
                                                        'doc', 'docx' => 'text-blue-600',
                                                        'ppt', 'pptx' => 'text-orange-600',
                                                        'jpg', 'jpeg', 'png', 'gif' => 'text-green-600',
                                                        'mp4', 'mp3' => 'text-purple-600',
                                                        'zip', 'rar' => 'text-amber-600',
                                                        default => 'text-slate-600',
                                                    };
                                                @endphp
                                                <svg class="w-6 h-6 {{ $iconClass }}" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="font-medium text-slate-800">
                                                    {{ $material->file_name ?? basename($material->file_path) }}</p>
                                                <div class="flex items-center space-x-3 text-sm text-slate-500">
                                                    @if ($material->file_size)
                                                        <span>{{ number_format($material->file_size / 1024, 2) }}
                                                            KB</span>
                                                    @endif
                                                    <span>{{ strtoupper($extension) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex space-x-2">
                                            <a href="{{ Storage::url($material->file_path) }}" target="_blank"
                                                class="inline-flex items-center px-3 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-all duration-200">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                    </path>
                                                </svg>
                                                Lihat
                                            </a>
                                            <a href="{{ Storage::url($material->file_path) }}" download
                                                class="inline-flex items-center px-3 py-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-all duration-200">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                    </path>
                                                </svg>
                                                Download
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="mb-6">
                                <div class="bg-amber-50 border border-amber-200 rounded-xl p-4">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-amber-600 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5C2.962 18.333 3.924 20 5.464 20z">
                                            </path>
                                        </svg>
                                        <p class="text-amber-800">Belum ada file yang diunggah untuk materi ini.</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Due Date (for assignments/quiz) -->
                        @if (in_array($material->type, ['assignment', 'quiz']) && $material->due_date)
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-slate-800 mb-3">Batas Waktu</h3>
                                <div
                                    class="flex items-center space-x-3 p-4 bg-gradient-to-r from-red-50 to-pink-50 rounded-xl border border-red-200">
                                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-red-800">Batas Pengumpulan</p>
                                        <p class="text-red-600">
                                            {{ $material->due_date->timezone('Asia/Jakarta')->format('d F Y, H:i') }}
                                            WIB</p>
                                        @php
                                            $now = now();
                                            $isOverdue = $now > $material->due_date;
                                            $timeLeft = $now->diff($material->due_date);
                                        @endphp
                                        @if ($isOverdue)
                                            <p class="text-xs text-red-500 font-medium">⚠ Sudah melewati batas waktu
                                            </p>
                                        @else
                                            <p class="text-xs text-red-500">
                                                {{ $timeLeft->days > 0 ? $timeLeft->days . ' hari ' : '' }}
                                                {{ $timeLeft->h }}:{{ sprintf('%02d', $timeLeft->i) }} lagi
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Actions Card -->
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-slate-100 to-slate-200 border-b border-slate-300">
                        <h3 class="text-lg font-bold text-slate-800">Aksi Cepat</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <a href="{{ route('teacher.materials.edit', $material) }}"
                                class="flex items-center justify-center px-4 py-3 bg-gradient-to-r from-amber-500 to-orange-600 text-white rounded-xl hover:from-amber-600 hover:to-orange-700 transition-all duration-200 transform hover:scale-[1.02] shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                                Edit Materi
                            </a>
                            <button onclick="confirmDelete()"
                                class="flex items-center justify-center px-4 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl hover:from-red-600 hover:to-red-700 transition-all duration-200 transform hover:scale-[1.02] shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                                Hapus Materi
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Material Stats -->
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-emerald-500 to-green-600">
                        <h3 class="text-lg font-bold text-white">Informasi Materi</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-slate-600">Kelas</span>
                            <span class="text-sm font-bold text-slate-800">{{ $material->classes->name }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-slate-600">Mata Pelajaran</span>
                            <span class="text-sm font-bold text-slate-800">{{ $material->subject->name }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-slate-600">Tipe</span>
                            <span class="text-sm font-bold text-slate-800">{{ $config['label'] }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-slate-600">Dibuat</span>
                            <span
                                class="text-sm font-bold text-slate-800">{{ $material->created_at->timezone('Asia/Jakarta')->format('d M Y') }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-slate-600">Diperbarui</span>
                            <span
                                class="text-sm font-bold text-slate-800">{{ $material->updated_at->timezone('Asia/Jakarta')->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-purple-500 to-purple-600">
                        <h3 class="text-lg font-bold text-white">Tautan Cepat</h3>
                    </div>
                    <div class="p-6 space-y-3">
                        <a href="{{ route('teacher.materials.create') }}"
                            class="block w-full px-4 py-3 bg-gradient-to-r from-blue-50 to-blue-100 text-blue-700 rounded-lg hover:from-blue-100 hover:to-blue-200 transition-all duration-200 text-center font-medium">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Materi Baru
                        </a>
                        <a href="{{ route('teacher.materials.index') }}"
                            class="block w-full px-4 py-3 bg-gradient-to-r from-green-50 to-green-100 text-green-700 rounded-lg hover:from-green-100 hover:to-green-200 transition-all duration-200 text-center font-medium">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                            </svg>
                            Semua Materi
                        </a>
                        <a href="{{ route('teacher.grades.index') }}"
                            class="block w-full px-4 py-3 bg-gradient-to-r from-purple-50 to-purple-100 text-purple-700 rounded-lg hover:from-purple-100 hover:to-purple-200 transition-all duration-200 text-center font-medium">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                            Kelola Nilai
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-xl max-w-md w-full mx-4">
            <div class="p-6">
                <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full mb-4">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5C2.962 18.333 3.924 20 5.464 20z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-center text-gray-900 mb-2">Hapus Materi?</h3>
                <p class="text-sm text-gray-500 text-center mb-6">
                    Apakah Anda yakin ingin menghapus materi "{{ $material->title }}"? Tindakan ini tidak dapat
                    dibatalkan.
                </p>
                <div class="flex space-x-3">
                    <button onclick="closeDeleteModal()"
                        class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all duration-200">
                        Batal
                    </button>
                    <form action="{{ route('teacher.materials.destroy', $material) }}" method="POST"
                        class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all duration-200">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete() {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteModal').classList.add('flex');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.getElementById('deleteModal').classList.remove('flex');
        }

        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });
    </script>
</x-teacher-layout>
