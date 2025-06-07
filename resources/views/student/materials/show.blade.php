<x-student-layout>
    <div class="p-6 bg-gradient-to-br from-blue-50 via-white to-purple-50 min-h-screen">
        <!-- Header Navigation -->
        <div class="mb-6">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('student.materials.index') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                            Materi & Tugas
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $material->title }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Material Header Card -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                    <div
                        class="px-6 py-4 bg-gradient-to-r {{ $material->type === 'assignment'
                            ? 'from-green-500 to-green-600'
                            : ($material->type === 'quiz'
                                ? 'from-purple-500 to-purple-600'
                                : ($material->type === 'reference'
                                    ? 'from-orange-500 to-orange-600'
                                    : 'from-blue-500 to-blue-600')) }}">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="p-3 bg-white/20 rounded-lg mr-4">
                                    @if ($material->type === 'assignment')
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                            </path>
                                        </svg>
                                    @elseif($material->type === 'quiz')
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                            </path>
                                        </svg>
                                    @elseif($material->type === 'reference')
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    @else
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                            </path>
                                        </svg>
                                    @endif
                                </div>
                                <div>
                                    <h1 class="text-2xl font-bold text-white">{{ $material->title }}</h1>
                                    <p class="text-white/80">{{ $material->subject->subject_name }}</p>
                                </div>
                            </div>
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white/20 text-white">
                                @if ($material->type === 'assignment')
                                    📝 Tugas
                                @elseif($material->type === 'quiz')
                                    🧩 Kuis
                                @elseif($material->type === 'reference')
                                    📖 Referensi
                                @else
                                    📚 Materi Pelajaran
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="p-6">
                        <!-- Description -->
                        @if ($material->description)
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3">Deskripsi</h3>
                                <div class="prose prose-blue max-w-none">
                                    <p class="text-gray-700 leading-relaxed">{{ $material->description }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Due Date (for assignments/quiz) -->
                        @if (in_array($material->type, ['assignment', 'quiz']) && $material->due_date)
                            <div class="mb-6">
                                <div
                                    class="bg-{{ $material->due_date->isPast() ? 'red' : 'orange' }}-50 border border-{{ $material->due_date->isPast() ? 'red' : 'orange' }}-200 rounded-xl p-4">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-{{ $material->due_date->isPast() ? 'red' : 'orange' }}-500 mr-2"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z">
                                            </path>
                                        </svg>
                                        <div>
                                            <p
                                                class="text-sm font-medium text-{{ $material->due_date->isPast() ? 'red' : 'orange' }}-800">
                                                @if ($material->due_date->isPast())
                                                    Batas waktu telah berakhir
                                                @else
                                                    Batas waktu pengumpulan
                                                @endif
                                            </p>
                                            <p
                                                class="text-{{ $material->due_date->isPast() ? 'red' : 'orange' }}-600 text-sm">
                                                {{ $material->due_date->format('d M Y, H:i') }} WIB
                                                @if (!$material->due_date->isPast())
                                                    ({{ $material->due_date->diffForHumans() }})
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- File Section -->
                        @if ($material->file_path)
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3">File Lampiran</h3>
                                <div class="bg-green-50 border border-green-200 rounded-xl p-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-green-800">
                                                    {{ $material->file_name ?? basename($material->file_path) }}
                                                </p>
                                                @if ($material->file_size)
                                                    <p class="text-sm text-green-600">
                                                        {{ number_format($material->file_size / 1024, 2) }} KB
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                        <a href="{{ route('student.materials.download', $material) }}"
                                            class="inline-flex items-center px-4 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-colors duration-200">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                            Unduh File
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="mb-6">
                                <div class="bg-amber-50 border border-amber-200 rounded-xl p-4">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-amber-500 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5C2.962 18.333 3.924 20 5.464 20z">
                                            </path>
                                        </svg>
                                        <p class="text-amber-800">Tidak ada file yang dilampirkan untuk materi ini.</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Material Info -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-slate-500 to-slate-600">
                        <h3 class="text-lg font-bold text-white">Informasi Materi</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-slate-600">Mata Pelajaran</span>
                            <span
                                class="text-sm font-bold text-slate-800">{{ $material->subject->subject_name }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-slate-600">Kelas</span>
                            <span class="text-sm font-bold text-slate-800">{{ $material->classes->class_name }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-slate-600">Pengajar</span>
                            <span class="text-sm font-bold text-slate-800">{{ $material->teacher->user->name }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-slate-600">Diunggah</span>
                            <span
                                class="text-sm font-bold text-slate-800">{{ $material->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-slate-600">Diperbarui</span>
                            <span
                                class="text-sm font-bold text-slate-800">{{ $material->updated_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-blue-500 to-blue-600">
                        <h3 class="text-lg font-bold text-white">Aksi Cepat</h3>
                    </div>
                    <div class="p-6 space-y-3">
                        <a href="{{ route('student.materials.index') }}"
                            class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-slate-100 to-slate-200 text-slate-700 font-semibold rounded-xl hover:from-slate-200 hover:to-slate-300 transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z">
                                </path>
                            </svg>
                            Kembali ke Daftar
                        </a>
                        @if ($material->file_path)
                            <a href="{{ route('student.materials.download', $material) }}"
                                class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold rounded-xl hover:from-green-600 hover:to-green-700 transition-all duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                Unduh File
                            </a>
                        @endif
                        <a href="{{ route('student.materials.index', ['subject_id' => $material->subject_id]) }}"
                            class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-purple-500 to-purple-600 text-white font-semibold rounded-xl hover:from-purple-600 hover:to-purple-700 transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                            Materi Serupa
                        </a>
                    </div>
                </div>

                <!-- Related Materials -->
                @if ($relatedMaterials->count() > 0)
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-amber-500 to-amber-600">
                            <h3 class="text-lg font-bold text-white">Materi Terkait</h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-3">
                                @foreach ($relatedMaterials as $related)
                                    <a href="{{ route('student.materials.show', $related) }}"
                                        class="block p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                        <div class="flex items-start">
                                            <div
                                                class="p-2 bg-{{ $related->type === 'assignment' ? 'green' : ($related->type === 'quiz' ? 'purple' : ($related->type === 'reference' ? 'orange' : 'blue')) }}-100 rounded-lg mr-3 mt-1">
                                                <svg class="w-4 h-4 text-{{ $related->type === 'assignment' ? 'green' : ($related->type === 'quiz' ? 'purple' : ($related->type === 'reference' ? 'orange' : 'blue')) }}-600"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    @if ($related->type === 'assignment')
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                                        </path>
                                                    @else
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                                        </path>
                                                    @endif
                                                </svg>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 line-clamp-2">
                                                    {{ $related->title }}</p>
                                                <p class="text-xs text-gray-500 mt-1">
                                                    {{ $related->created_at->format('d M Y') }}</p>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-student-layout>
