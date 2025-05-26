@props(['students'])
<x-app-layout>
    <div
        class="bg-gradient-to-br from-indigo-50 via-white to-blue-50 relative overflow-hidden border-b border-gray-100 rounded-xl mb-6">
        <div class="relative px-6 py-8 sm:px-10">
            <div class="max-w-7xl mx-auto">
                <div class="text-center">
                    <div
                        class="inline-flex items-center px-4 py-2 rounded-full bg-blue-100 text-blue-700 text-sm font-medium mb-4">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Manajemen Data Siswa
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-3">
                        Kelola <span
                            class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Data
                            Siswa</span>
                    </h1>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">Kelola informasi siswa dengan mudah dan
                        efisien
                        melalui sistem terintegrasi SIPEKA</p>
                </div>
            </div>
        </div>
    </div>

    <div class="px-6 py-8 space-y-8 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <!-- Search and Add Button Section -->
            <div
                class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200 mb-8">
                <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-10 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Pencarian & Filter</h3>
                                <p class="text-sm text-gray-500">Cari siswa berdasarkan nama atau NIS</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div class="relative w-full sm:max-w-md">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" name="search" id="searchInput" value="{{ request('search') }}"
                                autocomplete="off" placeholder="Cari berdasarkan nama atau NIS..."
                                oninput="performSearch(this.value)"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white shadow-sm transition-all">
                        </div>
                        <a href="{{ route('admin.students.create') }}"
                            class="group relative overflow-hidden inline-flex items-center justify-center px-6 py-3 rounded-xl border-2 border-blue-100 hover:border-blue-300 bg-gradient-to-br from-blue-50 to-indigo-50 hover:from-blue-100 hover:to-indigo-100 transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-blue-500 to-indigo-600 opacity-0 group-hover:opacity-5 transition-opacity duration-300">
                            </div>
                            <div
                                class="relative w-5 h-5 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                            <span
                                class="relative text-sm font-semibold text-gray-700 group-hover:text-blue-700 transition-colors duration-300">Tambah
                                Siswa Baru</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Student Table Section -->
            <div
                class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                    <div class="flex items-center space-x-1">
                                        <x-icons.user class="w-4 h-4" />
                                        <span>Nama</span>
                                    </div>
                                </th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                    <div class="flex items-center space-x-1">
                                        <x-icons.note class="w-4 h-4" />
                                        <span>NIS</span>
                                    </div>
                                </th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                    NISN</th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                    <div class="flex items-center space-x-1">
                                        <x-icons.mail class="w-4 h-4" />
                                        <span>Email</span>
                                    </div>
                                </th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                    <div class="flex items-center space-x-1">
                                        <x-icons.apartment class="w-4 h-4" />
                                        <span>Kelas</span>
                                    </div>
                                </th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                    Jenis Kelamin</th>
                                <th scope="col"
                                    class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-gray-600">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse($students as $student)
                                <tr
                                    class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-200 group">
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex items-center">
                                            <div
                                                class="flex-shrink-0 w-10 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-medium text-sm">
                                                {{ strtoupper(substr($student->user->name, 0, 2)) }}
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-semibold text-gray-900">
                                                    {{ $student->user->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                            {{ $student->nis }}
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">
                                        {{ $student->nisn ?? '-' }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">
                                        {{ $student->user->email }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        @if ($student->class)
                                            <div
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">
                                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-1.5"></span>
                                                {{ $student->class->class_name }}
                                            </div>
                                        @else
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">-</span>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $student->gender === 'M' ? 'bg-blue-100 text-blue-800 border border-blue-200' : 'bg-pink-100 text-pink-800 border border-pink-200' }}">
                                            @if ($student->gender === 'M')
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10 2L3 9h4v9h6v-9h4l-7-7z" />
                                                </svg>
                                                Laki-laki
                                            @else
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 2a6 6 0 110 12 6 6 0 010-12z" />
                                                </svg>
                                                Perempuan
                                            @endif
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-center">
                                        <div
                                            class="flex justify-center space-x-2 opacity-70 group-hover:opacity-100 transition-opacity">
                                            <a href="{{ route('admin.students.show', $student) }}"
                                                class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 hover:scale-110 transition-all duration-200"
                                                title="Detail">
                                                <x-icons.eye class="w-4 h-4" />
                                            </a>
                                            <a href="{{ route('admin.students.edit', $student->id) }}"
                                                class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-amber-100 text-amber-600 hover:bg-amber-200 hover:scale-110 transition-all duration-200"
                                                title="Edit">
                                                <x-icons.edit class="w-4 h-4" />
                                            </a>
                                            <form action="{{ route('admin.students.destroy', $student->id) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 hover:scale-110 transition-all duration-200 delete-btn"
                                                    title="Hapus">
                                                    <x-icons.trash class="w-4 h-4" />
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center space-y-3">
                                            <div
                                                class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center">
                                                <svg class="w-8 h-8 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                            </div>
                                            <div class="text-center">
                                                <h3 class="text-lg font-medium text-gray-900 mb-1">Belum ada data
                                                    siswa
                                                </h3>
                                                <p class="text-sm text-gray-500 mb-4">Mulai tambahkan siswa baru
                                                    untuk
                                                    melihat daftar lengkap</p>
                                                <a href="{{ route('admin.students.create') }}"
                                                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M12 4v16m8-8H4" />
                                                    </svg>
                                                    Tambah Siswa Pertama
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            let searchTimer;

            function performSearch(value) {
                clearTimeout(searchTimer);
                searchTimer = setTimeout(() => {
                    const currentUrl = new URL(window.location.href);
                    if (value) {
                        currentUrl.searchParams.set('search', value);
                    } else {
                        currentUrl.searchParams.delete('search');
                    }
                    window.location.href = currentUrl.toString();
                }, 500);
            }

            document.addEventListener('DOMContentLoaded', function() {
                const deleteButtons = document.querySelectorAll('.delete-btn');
                deleteButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const form = this.closest('form');

                        Swal.fire({
                            title: 'Konfirmasi Hapus',
                            text: "Data siswa yang dihapus tidak dapat dikembalikan!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#ef4444',
                            cancelButtonColor: '#6b7280',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal',
                            reverseButtons: true,
                            customClass: {
                                popup: 'rounded-xl shadow-2xl',
                                confirmButton: 'rounded-lg px-6 py-2.5',
                                cancelButton: 'rounded-lg px-6 py-2.5'
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire({
                                    title: 'Menghapus...',
                                    text: 'Sedang memproses penghapusan data',
                                    allowOutsideClick: false,
                                    showConfirmButton: false,
                                    customClass: {
                                        popup: 'rounded-xl shadow-2xl'
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
