@props(['totalStudents', 'totalTeachers', 'totalClasses', 'totalSubjects'])
<x-app-layout>
    <div class="bg-gradient-to-br from-indigo-50 via-white to-blue-50 relative overflow-hidden border-b border-gray-100">
        <div class="relative px-6 py-12 sm:px-10">
            <div class="max-w-7xl mx-auto">
                <div class="text-center">
                    <div
                        class="inline-flex items-center px-4 py-2 rounded-full bg-indigo-100 text-indigo-700 text-sm font-medium mb-6">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Dashboard Administrator
                    </div>
                    <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">
                        Selamat Datang, <span
                            class="bg-gradient-to-r from-indigo-600 to-blue-600 bg-clip-text text-transparent">Admin</span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">Kelola sistem pendidikan SIPEKA dengan
                        efisien dan mudah melalui dashboard yang terintegrasi</p>
                    <div
                        class="inline-flex items-center space-x-8 bg-white rounded-2xl shadow-lg px-8 py-6 border border-gray-200">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-gray-900" id="current-date">
                                {{ \Carbon\Carbon::now()->format('d') }}</div>
                            <div class="text-gray-500 text-sm font-medium">
                                {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</div>
                        </div>
                        <div class="w-px bg-gray-300 h-12"></div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-gray-900" id="current-time">
                                {{ \Carbon\Carbon::now()->translatedFormat('H:i') }}</div>
                            <div class="text-gray-500 text-sm font-medium">
                                {{ \Carbon\Carbon::now()->translatedFormat('l') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="px-6 py-8 space-y-8 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <x-admin-card :totalStudents="$totalStudents" :totalTeachers="$totalTeachers" :totalClasses="$totalClasses" :totalSubjects="$totalSubjects" />
        </div>

        <!-- Main Content Grid -->
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
                    <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Aktivitas Terbaru</h3>
                                    <p class="text-sm text-gray-500">Pantau aktivitas sistem secara real-time</p>
                                </div>
                            </div>
                            <a href="#"
                                class="inline-flex items-center text-sm text-indigo-600 hover:text-indigo-700 font-medium transition-colors group">
                                Lihat Semua
                                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div
                                class="flex items-start space-x-4 p-4 rounded-xl bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100 group hover:from-blue-100 hover:to-indigo-100 transition-all duration-200">
                                <div
                                    class="flex-shrink-0 w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center group-hover:scale-105 transition-transform shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p
                                        class="text-sm font-semibold text-gray-900 group-hover:text-blue-700 transition-colors">
                                        Ahmad Budi ditambahkan ke kelas X IPA 2
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1 flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        2 jam yang lalu
                                    </p>
                                </div>
                                <div class="flex-shrink-0">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                        <span class="w-1.5 h-1.5 bg-blue-500 rounded-full mr-1.5"></span>
                                        Siswa Baru
                                    </span>
                                </div>
                            </div>

                            <div
                                class="flex items-start space-x-4 p-4 rounded-xl bg-gradient-to-r from-purple-50 to-violet-50 border border-purple-100 group hover:from-purple-100 hover:to-violet-100 transition-all duration-200">
                                <div
                                    class="flex-shrink-0 w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl flex items-center justify-center group-hover:scale-105 transition-transform shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p
                                        class="text-sm font-semibold text-gray-900 group-hover:text-purple-700 transition-colors">
                                        Jadwal kelas XI IPS 1 diperbarui
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1 flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        5 jam yang lalu
                                    </p>
                                </div>
                                <div class="flex-shrink-0">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800 border border-purple-200">
                                        <span class="w-1.5 h-1.5 bg-purple-500 rounded-full mr-1.5"></span>
                                        Jadwal
                                    </span>
                                </div>
                            </div>

                            <div
                                class="flex items-start space-x-4 p-4 rounded-xl bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-100 group hover:from-amber-100 hover:to-orange-100 transition-all duration-200">
                                <div
                                    class="flex-shrink-0 w-12 h-12 bg-gradient-to-r from-amber-500 to-amber-600 rounded-xl flex items-center justify-center group-hover:scale-105 transition-transform shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p
                                        class="text-sm font-semibold text-gray-900 group-hover:text-amber-700 transition-colors">
                                        Nilai semester 1 telah difinalisasi
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1 flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        1 hari yang lalu
                                    </p>
                                </div>
                                <div class="flex-shrink-0">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800 border border-amber-200">
                                        <span class="w-1.5 h-1.5 bg-amber-500 rounded-full mr-1.5"></span>
                                        Penilaian
                                    </span>
                                </div>
                            </div>

                            <div
                                class="flex items-start space-x-4 p-4 rounded-xl bg-gradient-to-r from-emerald-50 to-green-50 border border-emerald-100 group hover:from-emerald-100 hover:to-green-100 transition-all duration-200">
                                <div
                                    class="flex-shrink-0 w-12 h-12 bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center group-hover:scale-105 transition-transform shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p
                                        class="text-sm font-semibold text-gray-900 group-hover:text-emerald-700 transition-colors">
                                        Bu Siti Nurjanah menjadi wali kelas X IPA 1
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1 flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        2 hari yang lalu
                                    </p>
                                </div>
                                <div class="flex-shrink-0">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-1.5"></span>
                                        Wali Kelas
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upcoming Schedule - Takes 1 column -->
            <div class="lg:col-span-1">
                <x-admin-upcoming-schedule />
            </div>
        </div> <!-- Quick Actions -->
        <div class="max-w-7xl mx-auto">
            <div
                class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
                <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
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
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
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
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
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
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
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
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <span
                                class="relative text-sm font-semibold text-gray-700 group-hover:text-emerald-700 text-center transition-colors duration-300">Buat
                                Jadwal</span>
                            <span
                                class="relative text-xs text-gray-500 group-hover:text-emerald-600 text-center mt-1 transition-colors duration-300">Penjadwalan
                                kelas</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        setInterval(function() {
            const now = new Date();
            const timeElement = document.getElementById('current-time');
            if (timeElement) {
                timeElement.textContent = now.toLocaleTimeString('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit'
                });
            }
        }, 1000);
    </script>
</x-app-layout>
