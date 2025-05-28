<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Kelola Pengumuman</h1>
                    <p class="text-gray-600 mt-1">Buat dan kelola pengumuman untuk siswa, guru, dan admin</p>
                </div>
                <a href="{{ route('admin.announcements.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transform hover:scale-105 transition-all duration-200 shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Buat Pengumuman
                </a>
            </div>
        </div>

        <!-- Filter & Search -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6">
            <div class="p-6">
                <form method="GET" action="{{ route('admin.announcements.index') }}" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Search -->
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari
                                Pengumuman</label>
                            <input type="text" name="search" id="search" value="{{ request('search') }}"
                                placeholder="Cari judul atau isi..."
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Status Filter -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select name="status" id="status"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Semua Status</option>
                                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif
                                </option>
                                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Tidak
                                    Aktif</option>
                                <option value="expired" {{ request('status') === 'expired' ? 'selected' : '' }}>
                                    Kadaluarsa
                                </option>
                            </select>
                        </div>

                        <!-- Target Filter -->
                        <div>
                            <label for="target" class="block text-sm font-medium text-gray-700 mb-1">Target</label>
                            <select name="target" id="target"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Semua Target</option>
                                <option value="all" {{ request('target') === 'all' ? 'selected' : '' }}>Semua
                                </option>
                                <option value="students" {{ request('target') === 'students' ? 'selected' : '' }}>Siswa
                                </option>
                                <option value="teachers" {{ request('target') === 'teachers' ? 'selected' : '' }}>Guru
                                </option>
                                <option value="classes" {{ request('target') === 'classes' ? 'selected' : '' }}>Kelas
                                    Tertentu</option>
                            </select>
                        </div>

                        <!-- Action -->
                        <div class="flex items-end space-x-2">
                            <button type="submit"
                                class="flex-1 px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                                Filter
                            </button>
                            <a href="{{ route('admin.announcements.index') }}"
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
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
                    <div class="p-6">
                        <div class="flex items-start justify-between">
                            <!-- Content -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start space-x-4">
                                    <!-- Priority Indicator -->
                                    <div class="flex-shrink-0 mt-1">
                                        @if ($announcement->priority === 'high')
                                            <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                        @elseif($announcement->priority === 'medium')
                                            <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                        @else
                                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                        @endif
                                    </div>

                                    <div class="flex-1 min-w-0">
                                        <!-- Title -->
                                        <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                            <a href="{{ route('admin.announcements.show', $announcement->id) }}"
                                                class="hover:text-blue-600 transition-colors">
                                                {{ $announcement->title }}
                                            </a>
                                        </h3>

                                        <!-- Meta Information -->
                                        <div class="flex flex-wrap items-center text-sm text-gray-600 space-x-4 mb-3">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                                {{ $announcement->published_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }}
                                                WIB
                                            </div>

                                            @if ($announcement->expires_at)
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Berakhir:
                                                    {{ $announcement->expires_at->setTimezone('Asia/Jakarta')->format('d M Y') }}
                                                    WIB
                                                </div>
                                            @endif

                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                    </path>
                                                </svg>
                                                {{ $announcement->author->user->name ?? 'Admin' }}
                                            </div>
                                        </div>

                                        <!-- Content Preview -->
                                        <div class="text-gray-600 mb-4">
                                            {{ Str::limit(strip_tags($announcement->content), 150) }}
                                        </div>

                                        <!-- Tags -->
                                        <div class="flex flex-wrap items-center gap-2">
                                            <!-- Target Badge -->
                                            @if ($announcement->target === 'all')
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    Semua
                                                </span>
                                            @elseif($announcement->target === 'students')
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    Siswa
                                                </span>
                                            @elseif($announcement->target === 'teachers')
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                    Guru
                                                </span>
                                            @elseif($announcement->target === 'classes')
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                                    Kelas Tertentu
                                                </span>
                                            @endif

                                            <!-- Priority Badge -->
                                            @if ($announcement->priority === 'high')
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    Penting
                                                </span>
                                            @elseif($announcement->priority === 'medium')
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    Sedang
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                    Biasa
                                                </span>
                                            @endif

                                            <!-- Status Badge -->
                                            @if ($announcement->is_active)
                                                @if ($announcement->expires_at && $announcement->expires_at->lt(now()))
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                        Kadaluarsa
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        Aktif
                                                    </span>
                                                @endif
                                            @else
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    Tidak Aktif
                                                </span>
                                            @endif

                                            <!-- Attachment Badge -->
                                            @if ($announcement->attachment)
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                        </path>
                                                    </svg>
                                                    Ada Lampiran
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex-shrink-0 ml-4">
                                <div class="flex items-center space-x-2">
                                    <!-- View -->
                                    <a href="{{ route('admin.announcements.show', $announcement->id) }}"
                                        class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
                                        title="Lihat Detail">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ route('admin.announcements.edit', $announcement->id) }}"
                                        class="p-2 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors"
                                        title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </a>

                                    <!-- Toggle Status -->
                                    <form method="POST"
                                        action="{{ route('admin.announcements.toggle-status', $announcement->id) }}"
                                        class="inline">
                                        @csrf
                                        <button type="submit"
                                            class="p-2 text-gray-400 hover:text-{{ $announcement->is_active ? 'red' : 'green' }}-600 hover:bg-{{ $announcement->is_active ? 'red' : 'green' }}-50 rounded-lg transition-colors"
                                            title="{{ $announcement->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                            @if ($announcement->is_active)
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728">
                                                    </path>
                                                </svg>
                                            @else
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
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
                                            class="delete-btn p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                            title="Hapus">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                        </path>
                    </svg>
                    <h3 class="text-xl font-medium text-gray-900 mb-2">Belum ada pengumuman</h3>
                    <p class="text-gray-600 mb-6">Mulai dengan membuat pengumuman pertama untuk menyampaikan informasi
                        penting.</p>
                    <a href="{{ route('admin.announcements.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Buat Pengumuman Pertama
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($announcements->hasPages())
            <div class="mt-8">
                {{ $announcements->links() }}
            </div>
        @endif
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Delete confirmation
                const deleteForms = document.querySelectorAll('.delete-form');
                deleteForms.forEach(form => {
                    const deleteBtn = form.querySelector('.delete-btn');
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
                                form.submit();
                            }
                        });
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
