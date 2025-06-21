<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <!-- Back Navigation -->
        <div class="mb-4 sm:mb-8">
            <!-- Action Buttons -->
            <div class="flex flex-wrap gap-2 sm:gap-0 sm:items-center sm:space-x-3 sm:ml-6">
                <a href="{{ route('admin.announcements.index') }}"
                    class="inline-flex items-center text-gray-600 hover:text-blue-600 transition-colors group mb-2 sm:mb-0">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1 sm:mr-2 group-hover:-translate-x-1 transition-transform"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span class="font-medium">Kembali ke Kelola Pengumuman</span>
                </a>
            </div>

            <!-- Announcement Content -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                <!-- Header Section -->
                <div
                    class="bg-gradient-to-r from-blue-50 to-indigo-50 px-4 sm:px-8 py-4 sm:py-8 border-b border-gray-200">
                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between mb-6">
                        <div class="flex-1 mb-4 sm:mb-0">
                            <!-- Priority and Status Badges -->
                            <div class="flex flex-wrap items-center gap-2 mb-4">
                                @if ($announcement->priority === 'high')
                                    <span
                                        class="inline-flex items-center px-2 sm:px-3 py-1 sm:py-1.5 rounded-full text-xs sm:text-sm font-medium bg-red-100 text-red-800 ring-1 ring-red-200">
                                        <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1 sm:mr-1.5" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Prioritas Tinggi
                                    </span>
                                @elseif($announcement->priority === 'medium')
                                    <span
                                        class="inline-flex items-center px-2 sm:px-3 py-1 sm:py-1.5 rounded-full text-xs sm:text-sm font-medium bg-yellow-100 text-yellow-800 ring-1 ring-yellow-200">
                                        <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1 sm:mr-1.5" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Prioritas Sedang
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2 sm:px-3 py-1 sm:py-1.5 rounded-full text-xs sm:text-sm font-medium bg-green-100 text-green-800 ring-1 ring-green-200">
                                        <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1 sm:mr-1.5" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Prioritas Rendah
                                    </span>
                                @endif

                                <!-- Status Badge -->
                                @if ($announcement->is_active)
                                    @if ($announcement->expires_at && $announcement->expires_at->lt(now()))
                                        <span
                                            class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-gray-100 text-gray-800 ring-1 ring-gray-200">
                                            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Kadaluarsa
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-green-100 text-green-800 ring-1 ring-green-200">
                                            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Aktif
                                        </span>
                                    @endif
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-red-100 text-red-800 ring-1 ring-red-200">
                                        <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Tidak Aktif
                                    </span>
                                @endif

                                <!-- Target Badge -->
                                @if ($announcement->target === 'all')
                                    <span
                                        class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-blue-100 text-blue-800 ring-1 ring-blue-200">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                            </path>
                                        </svg>
                                        Semua Pengguna
                                    </span>
                                @elseif($announcement->target === 'students')
                                    <span
                                        class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-purple-100 text-purple-800 ring-1 ring-purple-200">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                            </path>
                                        </svg>
                                        Siswa
                                    </span>
                                @elseif($announcement->target === 'teachers')
                                    <span
                                        class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800 ring-1 ring-indigo-200">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                            </path>
                                        </svg>
                                        Guru
                                    </span>
                                @elseif($announcement->target === 'classes')
                                    <span
                                        class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-teal-100 text-teal-800 ring-1 ring-teal-200">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                            </path>
                                        </svg>
                                        Kelas Tertentu
                                    </span>
                                @endif
                            </div>

                            <!-- Title -->
                            <h1 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-900 leading-tight mb-4">
                                {{ $announcement->title }}
                            </h1>

                            <!-- Meta info summary -->
                            <div class="text-gray-600 text-sm">
                                Dipublikasikan
                                {{ $announcement->published_at->setTimezone('Asia/Jakarta')->diffForHumans() }}
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-wrap gap-2 sm:gap-0 sm:items-center sm:space-x-3 sm:ml-6">
                            <!-- Edit -->
                            <a href="{{ route('admin.announcements.edit', $announcement->id) }}"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                                Edit
                            </a>

                            <!-- Toggle Status -->
                            <form method="POST"
                                action="{{ route('admin.announcements.toggle-status', $announcement->id) }}"
                                class="inline">
                                @csrf
                                <button type="submit"
                                    class="inline-flex items-center px-3 sm:px-4 py-2 {{ $announcement->is_active ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} text-white text-sm font-semibold rounded-lg transition-colors">
                                    @if ($announcement->is_active)
                                        <svg class="w-4 h-4 mr-1 sm:mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728">
                                            </path>
                                        </svg>
                                        <span class="whitespace-nowrap">Nonaktifkan</span>
                                    @else
                                        <svg class="w-4 h-4 mr-1 sm:mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span>Aktifkan</span>
                                    @endif
                                </button>
                            </form>

                            <!-- Delete -->
                            <form method="POST"
                                action="{{ route('admin.announcements.destroy', $announcement->id) }}"
                                class="inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    class="delete-btn inline-flex items-center px-3 sm:px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-lg hover:bg-red-700 transition-colors">
                                    <svg class="w-4 h-4 mr-1 sm:mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- Content Section -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden mt-4">
                <!-- Class Target Info -->
                @if ($announcement->target === 'classes' && $announcement->class_target)
                    <div class="px-4 sm:px-8 py-4 bg-blue-50 border-b border-gray-200">
                        <h4 class="text-sm font-medium text-blue-900 mb-2">Target Kelas:</h4>
                        <div class="flex flex-wrap gap-2">
                            @php
                                $targetClasses = \App\Models\Classes::whereIn('id', $announcement->class_target)->get();
                            @endphp
                            @foreach ($targetClasses as $class)
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $class->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Content -->
                <div class="px-4 sm:px-8 py-4 sm:py-8">
                    <div class="mb-4 sm:mb-6 pb-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Isi Pengumuman
                        </h3>
                    </div>

                    <div class="prose prose-sm sm:prose-base lg:prose-lg max-w-none">
                        {!! $announcement->content !!}
                    </div>
                </div>

                <!-- Attachments Section -->
                @if ($announcement->attachment)
                    <div class="px-4 sm:px-8 py-4 sm:py-6 bg-gray-50 border-t border-gray-200">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div
                                        class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-3 sm:ml-4">
                                    <h4 class="text-sm font-medium text-gray-900">File Lampiran</h4>
                                    <p class="text-xs sm:text-sm text-gray-500 truncate max-w-[200px] sm:max-w-xs">
                                        {{ basename($announcement->attachment) }}</p>
                                </div>
                            </div>
                            <a href="{{ route('admin.announcements.download', $announcement->id) }}"
                                class="inline-flex items-center px-3 sm:px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                                <svg class="w-4 h-4 mr-1 sm:mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                Download
                            </a>
                        </div>
                    </div>
                @endif

                <!-- Footer -->
                <div class="px-4 sm:px-8 py-3 sm:py-4 bg-gray-50 border-t border-gray-200">
                    <div
                        class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 text-xs sm:text-sm text-gray-500">
                        <div class="flex items-center">
                            <svg class="flex-shrink-0 w-3.5 h-3.5 sm:w-4 sm:h-4 mr-1 sm:mr-2" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Dibuat: {{ $announcement->created_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }}
                            WIB
                        </div>
                        @if ($announcement->updated_at != $announcement->created_at)
                            <div class="flex items-center mt-1 sm:mt-0">
                                <svg class="flex-shrink-0 w-3.5 h-3.5 sm:w-4 sm:h-4 mr-1 sm:mr-2" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                    </path>
                                </svg>
                                Terakhir diperbarui:
                                {{ $announcement->updated_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const deleteForm = document.querySelector('.delete-form');
                    const deleteBtn = deleteForm.querySelector('.delete-btn');

                    deleteBtn.addEventListener('click', function(e) {
                        e.preventDefault();

                        Swal.fire({
                            title: 'Hapus Pengumuman?',
                            text: "Pengumuman yang dihapus tidak dapat dikembalikan!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#dc2626',
                            cancelButtonColor: '#6b7280',
                            confirmButtonText: 'Ya, Hapus!',
                            cancelButtonText: 'Batal',
                            reverseButtons: true,
                            customClass: {
                                popup: 'rounded-2xl',
                                confirmButton: 'rounded-xl px-6 py-2.5',
                                cancelButton: 'rounded-xl px-6 py-2.5'
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                deleteForm.submit();
                            }
                        });
                    });
                });
            </script>
        @endpush
</x-app-layout>
