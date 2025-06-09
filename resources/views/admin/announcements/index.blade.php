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
                <span class="text-gray-900 font-medium">Kelola Pengumuman</span>
            </nav>
        </div>

        <!-- Header Section -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl shadow-sm border border-gray-200 mb-6">
            <div class="p-8">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    <div class="flex-1">
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900">Kelola Pengumuman</h1>
                                <p class="text-gray-600 mt-1">Buat dan kelola pengumuman untuk siswa dan guru
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('admin.announcements.create') }}"
                            class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            Buat Pengumuman
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter & Search -->
        {{-- <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6">
            <div class="p-6">
                <form method="GET" action="{{ route('admin.announcements.index') }}" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
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

                        <!-- Status Filter -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select name="status" id="status"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Semua Status</option>
                                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif
                                </option>
                                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Tidak
                                    Aktif</option>
                                <option value="expired" {{ request('status') === 'expired' ? 'selected' : '' }}>
                                    Kadaluarsa</option>
                            </select>
                        </div>

                        <!-- Target Filter -->
                        <div>
                            <label for="target" class="block text-sm font-medium text-gray-700 mb-2">Target</label>
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
                            <a href="{{ route('admin.announcements.index') }}"
                                class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-500">
                                Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div> --}}

        <!-- Announcements List -->
        <div class="space-y-4">
            @forelse($announcements as $announcement)
                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-all duration-200
                    border-l-4 {{ $announcement->priority === 'high' ? 'border-l-red-500' : ($announcement->priority === 'medium' ? 'border-l-yellow-500' : 'border-l-green-500') }}">
                    <div class="p-6">
                        <div class="flex items-start justify-between">
                            <!-- Content -->
                            <div class="flex-1 min-w-0">
                                <!-- Header with badges -->
                                <div class="flex items-center gap-2 mb-3">
                                    <!-- Priority Badge -->
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                                        {{ $announcement->priority === 'high' ? 'bg-red-100 text-red-800' : ($announcement->priority === 'medium' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                        @if ($announcement->priority === 'high')
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Prioritas Tinggi
                                        @elseif($announcement->priority === 'medium')
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Prioritas Sedang
                                        @else
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Prioritas Normal
                                        @endif
                                    </span>

                                    <!-- Target Badge -->
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                                        {{ $announcement->target === 'all'
                                            ? 'bg-blue-100 text-blue-800'
                                            : ($announcement->target === 'students'
                                                ? 'bg-green-100 text-green-800'
                                                : ($announcement->target === 'teachers'
                                                    ? 'bg-purple-100 text-purple-800'
                                                    : 'bg-orange-100 text-orange-800')) }}">
                                        @if ($announcement->target === 'all')
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Semua Warga Sekolah
                                        @elseif($announcement->target === 'students')
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Siswa
                                        @elseif($announcement->target === 'teachers')
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Guru
                                        @else
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Kelas Tertentu
                                        @endif
                                    </span>

                                    <!-- Status Badge -->
                                    @if ($announcement->expires_at && \Carbon\Carbon::parse($announcement->expires_at)->isPast())
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Sudah Berakhir
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Aktif
                                        </span>
                                    @endif
                                </div>

                                <!-- Title -->
                                <h3 class="text-xl font-bold text-gray-900 mb-3 leading-tight">
                                    <a href="{{ route('admin.announcements.show', $announcement->id) }}"
                                        class="hover:text-blue-600 transition-colors">
                                        {{ $announcement->title }}
                                    </a>
                                </h3>

                                <!-- Content Preview -->
                                <div class="text-gray-600 mb-4 leading-relaxed">
                                    {{ Str::limit(strip_tags($announcement->content), 200) }}
                                </div>

                                <!-- Meta Information Grid -->
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <div>
                                            <span class="font-medium">Dipublikasi:</span><br>
                                            {{ $announcement->published_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }}
                                            WIB
                                        </div>
                                    </div>

                                    @if ($announcement->expires_at)
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-orange-500" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <div>
                                                <span class="font-medium">Berakhir:</span><br>
                                                {{ $announcement->expires_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }}
                                                WIB
                                            </div>
                                        </div>
                                    @endif

                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                        <div>
                                            <span class="font-medium">Penulis:</span><br>
                                            {{ $announcement->author->user->name ?? 'Administrator' }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex-shrink-0 ml-6">
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
                                            class="p-2 {{ $announcement->is_active ? 'text-gray-400 hover:text-red-600 hover:bg-red-50' : 'text-gray-400 hover:text-green-600 hover:bg-green-50' }} rounded-lg transition-colors"
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
                                popup: 'rounded-2xl border-0 shadow-2xl',
                                confirmButton: 'rounded-xl px-6 py-3 font-semibold',
                                cancelButton: 'rounded-xl px-6 py-3 font-semibold'
                            },
                            focusConfirm: false,
                            focusCancel: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire({
                                    title: 'Menghapus Pengumuman...',
                                    text: 'Sedang memproses penghapusan pengumuman',
                                    icon: 'info',
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    showConfirmButton: false,
                                    customClass: {
                                        popup: 'rounded-2xl border-0 shadow-2xl'
                                    },
                                    didOpen: () => {
                                        Swal.showLoading();
                                    }
                                });
                                form.submit();
                            }
                        });
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
