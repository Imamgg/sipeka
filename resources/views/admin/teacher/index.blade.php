@props(['teachers'])
<x-app-layout>
    <!-- Header Section with Gradient Background -->
    <div class="bg-gradient-to-br from-indigo-50 via-white to-blue-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <!-- Page Badge -->
                <div
                    class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-800 border border-blue-200 mb-4">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z">
                        </path>
                    </svg>
                    Data Guru
                </div>

                <!-- Main Title -->
                <h1 class="text-4xl font-bold text-gray-900 mb-3">
                    <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                        Manajemen Data Guru
                    </span>
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-8">
                    Kelola informasi guru dengan mudah dan efisien. Tambah, edit, dan pantau data guru dalam sistem
                </p>

                <!-- Action Section -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <!-- Search Input -->
                    <div class="relative w-full max-w-md">
                        <input type="text" name="search" id="searchInput" value="{{ request('search') }}"
                            autocomplete="off" placeholder="Cari berdasarkan nama atau NIP..."
                            oninput="performSearch(this.value)"
                            class="w-full rounded-2xl border border-gray-300 bg-white/80 backdrop-blur-sm px-6 py-3 pr-12 text-sm placeholder-gray-500 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200 transition-all duration-200 shadow-sm hover:shadow-md">
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4">
                            <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>

                    <!-- Add Button -->
                    <a href="{{ route('admin.teachers.create') }}"
                        class="inline-flex items-center justify-center px-6 py-3 rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-medium hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-4 focus:ring-blue-200 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Guru Baru
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @if ($teachers->count() > 0)
                <!-- Teachers Grid -->
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($teachers as $teacher)
                        <div
                            class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg hover:border-blue-200 transition-all duration-200 group">
                            <!-- Card Header -->
                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 border-b border-gray-100">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-xl flex items-center justify-center text-white font-bold text-lg">
                                            {{ strtoupper(substr($teacher->user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <h3
                                                class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                                                {{ $teacher->user->name }}
                                            </h3>
                                            <p class="text-sm text-gray-600">NIP: {{ $teacher->nip }}</p>
                                        </div>
                                    </div>

                                    <!-- Gender Badge -->
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                                    {{ $teacher->gender === 'M' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                        {{ $teacher->gender === 'M' ? 'L' : 'P' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Card Content -->
                            <div class="p-6">
                                <div class="space-y-4">
                                    <!-- Email -->
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                                </path>
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm text-gray-500">Email</p>
                                            <p class="text-sm font-medium text-gray-900 truncate">
                                                {{ $teacher->user->email }}</p>
                                        </div>
                                    </div>

                                    <!-- Phone -->
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-sm text-gray-500">Telepon</p>
                                            <p class="text-sm font-medium text-gray-900">
                                                {{ $teacher->phone_number ?? 'Tidak tersedia' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Footer -->
                            <div class="bg-gray-50 px-6 py-4 border-t border-gray-100">
                                <div class="flex items-center justify-between">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                    {{ $teacher->gender === 'M' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                        <div
                                            class="w-2 h-2 {{ $teacher->gender === 'M' ? 'bg-blue-400' : 'bg-pink-400' }} rounded-full mr-2">
                                        </div>
                                        {{ $teacher->gender === 'M' ? 'Laki-laki' : 'Perempuan' }}
                                    </span>

                                    <div class="flex items-center space-x-2">
                                        <!-- View Button -->
                                        <a href="{{ route('admin.teachers.show', $teacher) }}"
                                            class="inline-flex items-center p-2 text-sm font-medium text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 hover:text-blue-700 transition-all duration-200 group/btn"
                                            title="Lihat Detail">
                                            <svg class="w-4 h-4 group-hover/btn:scale-110 transition-transform"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>

                                        <!-- Edit Button -->
                                        <a href="{{ route('admin.teachers.edit', $teacher->id) }}"
                                            class="inline-flex items-center p-2 text-sm font-medium text-amber-600 bg-amber-50 rounded-lg hover:bg-amber-100 hover:text-amber-700 transition-all duration-200 group/btn"
                                            title="Edit Data">
                                            <svg class="w-4 h-4 group-hover/btn:scale-110 transition-transform"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('admin.teachers.destroy', $teacher) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="delete-btn inline-flex items-center p-2 text-sm font-medium text-red-600 bg-red-50 rounded-lg hover:bg-red-100 hover:text-red-700 transition-all duration-200 group/btn"
                                                title="Hapus Data">
                                                <svg class="w-4 h-4 group-hover/btn:scale-110 transition-transform"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-12 max-w-md mx-auto">
                        <div
                            class="w-16 h-16 bg-gradient-to-r from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Data Guru</h3>
                        <p class="text-gray-600 mb-6">Mulai dengan menambahkan data guru pertama ke dalam sistem</p>
                        <a href="{{ route('admin.teachers.create') }}"
                            class="inline-flex items-center px-6 py-3 rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-medium hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Guru Pertama
                        </a>
                    </div>
                </div>
            @endif
        </div>

        @push('scripts')
            <script>
                let searchTimer;

                function performSearch(value) {
                    clearTimeout(searchTimer);
                    searchTimer = setTimeout(() => {
                        const searchParams = new URLSearchParams(window.location.search);
                        searchParams.set('search', value);
                        window.location.search = searchParams.toString();
                    }, 500);
                }

                document.addEventListener('DOMContentLoaded', function() {
                    const deleteButtons = document.querySelectorAll('.delete-btn');
                    deleteButtons.forEach(button => {
                        button.addEventListener('click', function(e) {
                            const form = this.closest('form');
                            e.preventDefault();
                            Swal.fire({
                                title: 'Konfirmasi Hapus',
                                text: "Data guru yang dihapus tidak dapat dikembalikan!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#ef4444',
                                cancelButtonColor: '#6b7280',
                                confirmButtonText: 'Ya, hapus!',
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
                                        title: 'Menghapus...',
                                        text: 'Sedang memproses penghapusan data',
                                        allowOutsideClick: false,
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
