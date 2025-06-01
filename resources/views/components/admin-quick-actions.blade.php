<div class="max-w-7xl mx-auto">
    <div
        class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
        <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
            <div class="flex items-center space-x-3">
                <div
                    class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Aksi Cepat</h3>
                    <p class="text-sm text-gray-500">Akses cepat ke fungsi utama sistem</p>
                </div>
            </div>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="{{ route('admin.students.create') }}"
                    class="group relative overflow-hidden flex flex-col items-center p-6 rounded-2xl border-2 border-blue-100 hover:border-blue-300 bg-gradient-to-br from-blue-50 to-indigo-50 hover:from-blue-100 hover:to-indigo-100 transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-blue-500 to-indigo-600 opacity-0 group-hover:opacity-5 transition-opacity duration-300">
                    </div>
                    <div
                        class="relative w-14 h-14 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>
                    <span
                        class="relative text-sm font-semibold text-gray-700 group-hover:text-blue-700 text-center transition-colors duration-300">Tambah
                        Siswa</span>
                    <span
                        class="relative text-xs text-gray-500 group-hover:text-blue-600 text-center mt-1 transition-colors duration-300">Data
                        siswa baru</span>
                </a>

                <a href="{{ route('admin.teachers.create') }}"
                    class="group relative overflow-hidden flex flex-col items-center p-6 rounded-2xl border-2 border-purple-100 hover:border-purple-300 bg-gradient-to-br from-purple-50 to-violet-50 hover:from-purple-100 hover:to-violet-100 transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-purple-500 to-violet-600 opacity-0 group-hover:opacity-5 transition-opacity duration-300">
                    </div>
                    <div
                        class="relative w-14 h-14 bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <span
                        class="relative text-sm font-semibold text-gray-700 group-hover:text-purple-700 text-center transition-colors duration-300">Tambah
                        Guru</span>
                    <span
                        class="relative text-xs text-gray-500 group-hover:text-purple-600 text-center mt-1 transition-colors duration-300">Data
                        tenaga pengajar</span>
                </a>

                <a href="{{ route('admin.classes.create') }}"
                    class="group relative overflow-hidden flex flex-col items-center p-6 rounded-2xl border-2 border-amber-100 hover:border-amber-300 bg-gradient-to-br from-amber-50 to-orange-50 hover:from-amber-100 hover:to-orange-100 transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-amber-500 to-orange-600 opacity-0 group-hover:opacity-5 transition-opacity duration-300">
                    </div>
                    <div
                        class="relative w-14 h-14 bg-gradient-to-r from-amber-500 to-amber-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <span
                        class="relative text-sm font-semibold text-gray-700 group-hover:text-amber-700 text-center transition-colors duration-300">Tambah
                        Kelas</span>
                    <span
                        class="relative text-xs text-gray-500 group-hover:text-amber-600 text-center mt-1 transition-colors duration-300">Manajemen
                        kelas</span>
                </a>

                <a href="{{ route('admin.schedules.create') }}"
                    class="group relative overflow-hidden flex flex-col items-center p-6 rounded-2xl border-2 border-emerald-100 hover:border-emerald-300 bg-gradient-to-br from-emerald-50 to-green-50 hover:from-emerald-100 hover:to-green-100 transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-emerald-500 to-green-600 opacity-0 group-hover:opacity-5 transition-opacity duration-300">
                    </div>
                    <div
                        class="relative w-14 h-14 bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <span
                        class="relative text-sm font-semibold text-gray-700 group-hover:text-emerald-700 text-center transition-colors duration-300">Buat
                        Jadwal</span> <span
                        class="relative text-xs text-gray-500 group-hover:text-emerald-600 text-center mt-1 transition-colors duration-300">Penjadwalan
                        kelas</span>
                </a>

                <a href="{{ route('admin.announcements.create') }}"
                    class="group relative overflow-hidden flex flex-col items-center p-6 rounded-2xl border-2 border-red-100 hover:border-red-300 bg-gradient-to-br from-red-50 to-pink-50 hover:from-red-100 hover:to-pink-100 transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-red-500 to-pink-600 opacity-0 group-hover:opacity-5 transition-opacity duration-300">
                    </div>
                    <div
                        class="relative w-14 h-14 bg-gradient-to-r from-red-500 to-red-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                        </svg>
                    </div>
                    <span
                        class="relative text-sm font-semibold text-gray-700 group-hover:text-red-700 text-center transition-colors duration-300">Buat
                        Pengumuman</span>
                    <span
                        class="relative text-xs text-gray-500 group-hover:text-red-600 text-center mt-1 transition-colors duration-300">Informasi
                        untuk seluruh sekolah</span>
                </a>
            </div>
        </div>
    </div>
</div>
