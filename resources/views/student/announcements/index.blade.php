<x-student-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6">
            <div class="p-6">
                <form method="GET" action="{{ route('student.announcements.index') }}" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Search -->
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Cari
                                Pengumuman</label>
                            <div class="relative">
                                <input type="text" name="search" id="search" value="{{ request('search') }}"
                                    placeholder="Cari berdasarkan judul atau isi..."
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Priority Filter -->
                        <div>
                            <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">Tingkat
                                Prioritas</label>
                            <select name="priority" id="priority"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Semua Prioritas</option>
                                <option value="high" {{ request('priority') === 'high' ? 'selected' : '' }}>Prioritas
                                    Tinggi
                                </option>
                                <option value="medium" {{ request('priority') === 'medium' ? 'selected' : '' }}>
                                    Prioritas
                                    Sedang
                                </option>
                                <option value="low" {{ request('priority') === 'low' ? 'selected' : '' }}>Prioritas
                                    Rendah
                                </option>
                            </select>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-end space-x-2">
                            <button type="submit"
                                class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Filter
                            </button>
                            <a href="{{ route('student.announcements.index') }}"
                                class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                                Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Announcements List -->
        <div class="space-y-6">
            @forelse($announcements as $announcement)
                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-lg transition-all duration-300 group">
                    <div class="p-6">
                        <!-- Header -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <div class="flex items-center space-x-3 mb-3">
                                    <!-- Priority Indicator -->
                                    @if ($announcement->priority === 'high')
                                        <div class="w-3 h-3 bg-red-500 rounded-full animate-pulse"></div>
                                    @elseif($announcement->priority === 'medium')
                                        <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                    @else
                                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                    @endif

                                    @if ($announcement->priority === 'high')
                                        <span
                                            class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-red-100 text-red-800 ml-4">
                                            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Prioritas Tinggi
                                        </span>
                                    @elseif($announcement->priority === 'medium')
                                        <span
                                            class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 ml-4">
                                            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Prioritas Sedang
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-blue-100 text-blue-800 ml-4">
                                            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Prioritas Rendah
                                        </span>
                                    @endif
                                </div>

                                <h3
                                    class="text-xl font-semibold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">
                                    <a href="{{ route('student.announcements.show', $announcement->id) }}"
                                        class="hover:text-blue-600 transition-colors">
                                        {{ $announcement->title }}
                                    </a>
                                </h3>

                                <!-- Meta Information -->
                                <div class="flex items-center text-sm text-gray-600 space-x-4 mb-4">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <span class="font-medium">Dipublikasi:</span>
                                        <span class="ml-1">
                                            {{ \Carbon\Carbon::parse($announcement->published_at)->setTimezone('Asia/Jakarta')->format('d M Y') }}
                                        </span>
                                    </div>

                                    @if ($announcement->expires_at)
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span class="font-medium">Berakhir:</span>
                                            <span class="ml-1">
                                                {{ \Carbon\Carbon::parse($announcement->expires_at)->setTimezone('Asia/Jakarta')->format('d M Y') }}
                                                WIB
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Content Preview -->
                                <div class="text-gray-600 mb-4 line-clamp-3 leading-relaxed">
                                    {!! Str::limit(strip_tags($announcement->content), 200) !!}
                                </div>

                                <!-- Target Audience and Attachment Info -->
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex items-center text-sm text-gray-500">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                                </path>
                                            </svg>
                                            @if ($announcement->target === 'all')
                                                Untuk semua
                                            @elseif($announcement->target === 'students')
                                                Untuk siswa
                                            @elseif($announcement->target === 'classes')
                                                Untuk kelas tertentu
                                            @endif
                                        </div>

                                        @if ($announcement->attachment)
                                            <div class="flex items-center text-sm text-blue-600">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                    </path>
                                                </svg>
                                                Lampiran tersedia
                                            </div>
                                        @endif
                                    </div>

                                    <a href="{{ route('student.announcements.show', $announcement->id) }}"
                                        class="inline-flex items-center px-4 py-2 text-blue-600 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 font-medium text-sm rounded-lg transition-all duration-200 group-hover:shadow-md">
                                        Baca selengkapnya
                                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                    <div class="text-gray-500">
                        <svg class="mx-auto h-20 w-20 text-gray-400 mb-6" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                            </path>
                        </svg>
                        <h3 class="text-2xl font-semibold text-gray-900 mb-3">Belum ada pengumuman</h3>
                        <p class="text-gray-600 text-lg mb-6">
                            @if (request()->hasAny(['search', 'priority']))
                                Tidak ada pengumuman yang sesuai dengan filter yang dipilih.
                            @else
                                Pengumuman terbaru akan muncul di sini ketika admin mempublikasikannya.
                            @endif
                        </p>
                        @if (request()->hasAny(['search', 'priority']))
                            <a href="{{ route('student.announcements.index') }}"
                                class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                    </path>
                                </svg>
                                Lihat Semua Pengumuman
                            </a>
                        @endif
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($announcements->hasPages())
            <div class="mt-8">
                <div class="bg-white rounded-lg border border-gray-200 p-4">
                    {{ $announcements->appends(request()->query())->links() }}
                </div>
            </div>
        @endif
    </div>

    <!-- Custom Styles -->
    <style>
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        @media (prefers-reduced-motion: no-preference) {
            .animate-pulse {
                animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            }
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: .5;
            }
        }
    </style>

    <!-- JavaScript for Enhanced Interactions -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-submit form on select change for better UX
            const prioritySelect = document.getElementById('priority');
            if (prioritySelect) {
                prioritySelect.addEventListener('change', function() {
                    this.closest('form').submit();
                });
            }

            // Enhanced search with debounce
            const searchInput = document.getElementById('search');
            let searchTimeout;

            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        // Auto-submit after 1 second of no typing
                        // this.closest('form').submit();
                    }, 1000);
                });
            }

            // Add smooth scrolling for better UX
            const announcements = document.querySelectorAll('[href*="announcements/"]');
            announcements.forEach(link => {
                link.addEventListener('click', function(e) {
                    // Add a subtle loading indication
                    this.style.opacity = '0.7';
                });
            });
        });
    </script>
</x-student-layout>
