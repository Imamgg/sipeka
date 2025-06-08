<x-student-layout>
    <div class="container mx-auto px-4 py-6">
        <!-- Back Navigation -->
        <div class="mb-8">
            <nav class="flex items-center space-x-4 text-sm">
                <a href="{{ route('student.announcements.index') }}"
                    class="inline-flex items-center text-gray-600 hover:text-blue-600 transition-colors group">
                    <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span class="font-medium">Kembali ke Pengumuman</span>
                </a>
                <span class="text-gray-400">/</span>
                <span class="text-gray-900 font-medium">{{ Str::limit($announcement->title, 50) }}</span>
            </nav>
        </div>

        <!-- Announcement Content -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-8 py-8 border-b border-gray-200">
                <div class="flex items-start justify-between mb-6">
                    <div class="flex-1">
                        <!-- Priority and Status Badges -->
                        <div class="flex items-center space-x-3 mb-4">
                            @if ($announcement->priority === 'high')
                                <span
                                    class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-red-100 text-red-800 ring-1 ring-red-200">
                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Prioritas Tinggi
                                </span>
                            @elseif($announcement->priority === 'medium')
                                <span
                                    class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 ring-1 ring-yellow-200">
                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Prioritas Sedang
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-blue-100 text-blue-800 ring-1 ring-blue-200">
                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Prioritas Normal
                                </span>
                            @endif

                            <!-- Status Badge -->
                            @if ($announcement->expires_at && \Carbon\Carbon::parse($announcement->expires_at)->isPast())
                                <span
                                    class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-gray-100 text-gray-800 ring-1 ring-gray-200">
                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Sudah Berakhir
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
                        </div>

                        <!-- Title -->
                        <h1 class="text-4xl font-bold text-gray-900 mb-6 leading-tight">{{ $announcement->title }}</h1>

                        <!-- Meta Information Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            <!-- Publication Date -->
                            <div class="flex items-center p-4 bg-white rounded-lg shadow-sm">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-xs text-gray-500 font-medium">Dipublikasi</p>
                                    <p class="text-sm font-semibold text-gray-900">
                                        {{ \Carbon\Carbon::parse($announcement->published_at)->setTimezone('Asia/Jakarta')->format('d M Y') }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ \Carbon\Carbon::parse($announcement->published_at)->setTimezone('Asia/Jakarta')->format('H:i') }}
                                        WIB
                                    </p>
                                </div>
                            </div>

                            <!-- Expiry Date -->
                            @if ($announcement->expires_at)
                                <div class="flex items-center p-4 bg-white rounded-lg shadow-sm">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-xs text-gray-500 font-medium">Berakhir</p>
                                        <p class="text-sm font-semibold text-gray-900">
                                            {{ \Carbon\Carbon::parse($announcement->expires_at)->setTimezone('Asia/Jakarta')->format('d M Y') }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            {{ \Carbon\Carbon::parse($announcement->expires_at)->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                            @endif

                            <!-- Target Audience -->
                            <div class="flex items-center p-4 bg-white rounded-lg shadow-sm">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-xs text-gray-500 font-medium">Target</p>
                                    <p class="text-sm font-semibold text-gray-900">
                                        @if ($announcement->target === 'all')
                                            Semua Pengguna
                                        @elseif($announcement->target === 'students')
                                            Siswa
                                        @elseif($announcement->target === 'classes')
                                            Kelas Tertentu
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <!-- Author -->
                            @if ($announcement->author && $announcement->author->user)
                                <div class="flex items-center p-4 bg-white rounded-lg shadow-sm">
                                    <div class="flex-shrink-0">
                                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-xs text-gray-500 font-medium">Penulis</p>
                                        <p class="text-sm font-semibold text-gray-900">
                                            {{ $announcement->author->user->name }}</p>
                                        <p class="text-xs text-gray-500">Administrator</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Section -->
        <div class="px-8 py-8 bg-white">
            <div class="max-w-none">
                <!-- Content Header -->
                <div class="mb-6 pb-4 border-b border-gray-200">
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

                <!-- Content Body -->
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                    {!! nl2br(e($announcement->content)) !!}
                </div>
            </div>
        </div>

        <!-- Attachments Section -->
        @if ($announcement->attachment)
            <div class="px-8 py-6 border-t border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50">
                <div class="mb-4">
                    <h4 class="text-lg font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                            </path>
                        </svg>
                        Lampiran
                    </h4>
                    <p class="text-sm text-gray-600 mt-1">File yang disertakan dalam pengumuman ini</p>
                </div>

                <div
                    class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div
                                class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-semibold text-gray-900">
                                    {{ basename($announcement->attachment) }}</p>
                                <p class="text-xs text-gray-500">Lampiran pengumuman</p>
                            </div>
                        </div>
                        <a href="{{ route('student.announcements.download', $announcement->id) }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors transform hover:scale-105">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Download
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Enhanced Action Buttons -->
    <div class="mt-8 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
            <!-- Back Navigation -->
            <a href="{{ route('student.announcements.index') }}"
                class="inline-flex items-center px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-all duration-200 transform hover:scale-105 shadow-md hover:shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar
            </a>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                <!-- Print Button -->
                <button onclick="window.print()"
                    class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-all duration-200 transform hover:scale-105 shadow-md hover:shadow-lg group">
                    <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                        </path>
                    </svg>
                    Cetak
                </button>

                <!-- Share Button -->
                <button onclick="shareAnnouncement()"
                    class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-all duration-200 transform hover:scale-105 shadow-md hover:shadow-lg group">
                    <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z">
                        </path>
                    </svg>
                    Bagikan
                </button>

                <!-- Bookmark Button -->
                <button onclick="bookmarkAnnouncement()"
                    class="inline-flex items-center px-6 py-3 bg-yellow-600 hover:bg-yellow-700 text-white font-medium rounded-lg transition-all duration-200 transform hover:scale-105 shadow-md hover:shadow-lg group">
                    <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                    </svg>
                    Simpan
                </button>
            </div>
        </div>
    </div>
    <script>
        function shareAnnouncement() {
            if (navigator.share) {
                navigator.share({
                    title: '{{ $announcement->title }}',
                    text: '{{ Str::limit(strip_tags($announcement->content), 100) }}',
                    url: window.location.href
                }).then(() => {
                    showNotification('Pengumuman berhasil dibagikan!', 'success');
                }).catch((error) => {
                    console.log('Error sharing', error);
                    fallbackShare();
                });
            } else {
                fallbackShare();
            }
        }

        function fallbackShare() {
            const url = window.location.href;
            navigator.clipboard.writeText(url).then(() => {
                showNotification('Link pengumuman telah disalin ke clipboard!', 'success');
            }).catch(err => {
                console.error('Could not copy text: ', err);
                const shareText = `${url}`;
                prompt('Copy link ini untuk membagikan pengumuman:', shareText);
            });
        }

        // Bookmark functionality
        function bookmarkAnnouncement() {
            const bookmarks = JSON.parse(localStorage.getItem('bookmarked_announcements') || '[]');
            const announcementId = {{ $announcement->id }};
            const announcementData = {
                id: announcementId,
                title: '{{ $announcement->title }}',
                url: window.location.href,
                bookmarked_at: new Date().toISOString()
            };

            const existingIndex = bookmarks.findIndex(bookmark => bookmark.id === announcementId);

            if (existingIndex === -1) {
                bookmarks.push(announcementData);
                localStorage.setItem('bookmarked_announcements', JSON.stringify(bookmarks));
                showNotification('Pengumuman berhasil disimpan!', 'success');
                updateBookmarkButton(true);
            } else {
                bookmarks.splice(existingIndex, 1);
                localStorage.setItem('bookmarked_announcements', JSON.stringify(bookmarks));
                showNotification('Pengumuman dihapus dari simpanan', 'info');
                updateBookmarkButton(false);
            }
        }

        function updateBookmarkButton(isBookmarked) {
            const button = document.querySelector('[onclick="bookmarkAnnouncement()"]');
            if (button) {
                const svg = button.querySelector('svg');
                const text = button.querySelector('span') || button.childNodes[button.childNodes.length - 1];

                if (isBookmarked) {
                    button.className = button.className.replace('bg-yellow-600 hover:bg-yellow-700',
                        'bg-red-600 hover:bg-red-700');
                    svg.setAttribute('fill', 'currentColor');
                    if (text.textContent) text.textContent = 'Hapus';
                } else {
                    button.className = button.className.replace('bg-red-600 hover:bg-red-700',
                        'bg-yellow-600 hover:bg-yellow-700');
                    svg.setAttribute('fill', 'none');
                    if (text.textContent) text.textContent = 'Simpan';
                }
            }
        }

        // Notification system
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-lg text-white transform transition-all duration-300 translate-x-full opacity-0 ${
                type === 'success' ? 'bg-green-500' :
                type === 'error' ? 'bg-red-500' :
                type === 'warning' ? 'bg-yellow-500' : 'bg-blue-500'
            }`;

            notification.innerHTML = `
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        ${type === 'success' ?
                            '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>' :
                            '<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>'
                        }
                    </svg>
                    <span>${message}</span>
                </div>
            `;

            document.body.appendChild(notification);

            // Animate in
            setTimeout(() => {
                notification.classList.remove('translate-x-full', 'opacity-0');
            }, 100);

            // Auto remove after 3 seconds
            setTimeout(() => {
                notification.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }

        // Initialize bookmark button state on page load
        document.addEventListener('DOMContentLoaded', function() {
            const bookmarks = JSON.parse(localStorage.getItem('bookmarked_announcements') || '[]');
            const announcementId = {{ $announcement->id }};
            const isBookmarked = bookmarks.some(bookmark => bookmark.id === announcementId);
            updateBookmarkButton(isBookmarked);

            // Add smooth scrolling to page sections
            const links = document.querySelectorAll('a[href^="#"]');
            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Add reading progress indicator
            const progressBar = document.createElement('div');
            progressBar.className = 'fixed top-0 left-0 w-0 h-1 bg-blue-600 z-50 transition-all duration-150';
            document.body.appendChild(progressBar);

            window.addEventListener('scroll', function() {
                const scrollTop = window.pageYOffset;
                const documentHeight = document.documentElement.scrollHeight - window.innerHeight;
                const scrollPercentage = (scrollTop / documentHeight) * 100;
                progressBar.style.width = scrollPercentage + '%';
            });
        });
    </script>

    <!-- Enhanced Styles -->
    <style>
        /* Print styles */
        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: white !important;
                font-size: 12pt;
                line-height: 1.5;
            }

            .container {
                max-width: none !important;
                padding: 0 !important;
                margin: 0 !important;
            }

            .bg-gradient-to-r {
                background: #f8fafc !important;
                color: #1f2937 !important;
            }

            .shadow-lg,
            .shadow-md,
            .shadow-sm {
                box-shadow: none !important;
            }

            .rounded-lg,
            .rounded-xl {
                border-radius: 4px !important;
            }
        }

        /* Enhanced prose styles */
        .prose {
            color: #374151;
            line-height: 1.75;
            font-size: 1.1rem;
        }

        .prose h1,
        .prose h2,
        .prose h3,
        .prose h4 {
            color: #111827;
            font-weight: 600;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .prose h1 {
            font-size: 2rem;
        }

        .prose h2 {
            font-size: 1.75rem;
        }

        .prose h3 {
            font-size: 1.5rem;
        }

        .prose h4 {
            font-size: 1.25rem;
        }

        .prose p {
            margin-bottom: 1.5em;
            text-align: justify;
        }

        .prose ul,
        .prose ol {
            padding-left: 2rem;
            margin-bottom: 1.5em;
        }

        .prose li {
            margin-bottom: 0.75em;
        }

        .prose a {
            color: #2563eb;
            text-decoration: underline;
            transition: color 0.2s;
        }

        .prose a:hover {
            color: #1d4ed8;
        }

        .prose blockquote {
            border-left: 4px solid #e5e7eb;
            padding-left: 1.5rem;
            margin: 2rem 0;
            font-style: italic;
            color: #6b7280;
            background: #f9fafb;
            padding: 1rem 1.5rem;
            border-radius: 0 0.5rem 0.5rem 0;
        }

        .prose code {
            background: #f3f4f6;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.9em;
            color: #dc2626;
        }

        .prose pre {
            background: #1f2937;
            color: #f9fafb;
            padding: 1.5rem;
            border-radius: 0.5rem;
            overflow-x: auto;
            margin: 1.5rem 0;
        }

        .prose pre code {
            background: none;
            color: inherit;
            padding: 0;
        }

        /* Custom animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }

        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        /* Smooth hover effects */
        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        }

        /* Reading progress bar */
        .reading-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 3px;
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
            z-index: 1000;
            transition: width 0.1s ease;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Responsive enhancements */
        @media (max-width: 640px) {
            .prose {
                font-size: 1rem;
            }

            .prose h1 {
                font-size: 1.75rem;
            }

            .prose h2 {
                font-size: 1.5rem;
            }

            .prose h3 {
                font-size: 1.25rem;
            }

            .prose h4 {
                font-size: 1.125rem;
            }

            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }

        /* Focus states for accessibility */
        .focus\:ring-blue-500:focus {
            --tw-ring-color: rgb(59 130 246 / 0.5);
        }

        .focus\:ring-2:focus {
            --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
            --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(2px + var(--tw-ring-offset-width)) var(--tw-ring-color);
            box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000);
        }

        /* Loading states */
        .loading {
            opacity: 0.7;
            pointer-events: none;
            position: relative;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</x-student-layout>
