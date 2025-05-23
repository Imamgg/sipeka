@props(['totalStudents', 'totalTeachers', 'totalClasses'])
<x-app-layout>
    <main class="p-6 space-y-6 mt-16 overflow-y-auto">
        <!-- Quick Stats Row -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-blue-600 rounded-lg shadow-lg p-6 transition-transform duration-300 hover:scale-105"
                data-category="students">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-blue-100">Total Siswa</p>
                        <h3 class="text-2xl font-bold text-white">{{ $totalStudents }}</h3>
                    </div>
                    <div class="bg-blue-500 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <p class="text-blue-100 text-sm flex items-center">
                        <span class="text-green-300 mr-1">↑ 12%</span> dari bulan lalu
                    </p>
                </div>
            </div>

            <div class="bg-purple-600 rounded-lg shadow-lg p-6 transition-transform duration-300 hover:scale-105"
                data-category="teachers">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-purple-100">Total Guru</p>
                        <h3 class="text-2xl font-bold text-white">{{ $totalTeachers }}</h3>
                    </div>
                    <div class="bg-purple-500 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <p class="text-purple-100 text-sm flex items-center">
                        <span class="text-green-300 mr-1">↑ 5%</span> dari bulan lalu
                    </p>
                </div>
            </div>

            <div class="bg-amber-600 rounded-lg shadow-lg p-6 transition-transform duration-300 hover:scale-105"
                data-category="classes">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-amber-100">Total Kelas</p>
                        <h3 class="text-2xl font-bold text-white">{{ $totalClasses }}</h3>
                    </div>
                    <div class="bg-amber-500 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <p class="text-amber-100 text-sm flex items-center">
                        <span class="text-green-300 mr-1">↑ 2%</span> dari bulan lalu
                    </p>
                </div>
            </div>

            <div class="bg-emerald-600 rounded-lg shadow-lg p-6 transition-transform duration-300 hover:scale-105"
                data-category="subjects">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-emerald-100">Mata Pelajaran</p>
                        <h3 class="text-2xl font-bold text-white">24</h3>
                    </div>
                    <div class="bg-emerald-500 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <p class="text-emerald-100 text-sm flex items-center">
                        <span class="text-lime-300 mr-1">↔ 0%</span> tidak ada perubahan
                    </p>
                </div>
            </div>
        </div>

        <!-- Two Cards in Second Row -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Activities -->
            <div class="bg-gray-800 rounded-lg shadow-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-white">Aktivitas Terbaru</h3>
                    <a href="#"
                        class="text-sm text-blue-400 hover:text-blue-300 transition-colors duration-200">Lihat
                        Semua</a>
                </div>
                <div class="space-y-5">
                    <div class="flex items-start">
                        <div
                            class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-white text-sm font-medium">Ahmad Budi ditambahkan ke kelas X IPA
                                2</p>
                            <p class="text-gray-400 text-xs">2 jam yang lalu</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div
                            class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-r from-purple-500 to-purple-600 flex items-center justify-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-white text-sm font-medium">Jadwal kelas XI IPS 1 diperbarui</p>
                            <p class="text-gray-400 text-xs">5 jam yang lalu</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div
                            class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-r from-amber-500 to-amber-600 flex items-center justify-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-white text-sm font-medium">Nilai semester 1 telah difinalisasi
                            </p>
                            <p class="text-gray-400 text-xs">1 hari yang lalu</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div
                            class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-r from-emerald-500 to-emerald-600 flex items-center justify-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-white text-sm font-medium">Bu Siti Nurjanah menjadi wali kelas X
                                IPA 1</p>
                            <p class="text-gray-400 text-xs">2 hari yang lalu</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upcoming Schedule -->
            <div class="bg-gray-800 rounded-lg shadow-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-white">Jadwal Mendatang</h3>
                    <div class="flex space-x-1">
                        <button class="p-1 text-blue-400 hover:text-blue-300 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                        </button>
                        <button class="p-1 text-blue-400 hover:text-blue-300 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="bg-gray-700 rounded-lg p-4 border-l-4 border-blue-500">
                        <div class="flex justify-between">
                            <h4 class="text-white font-medium">Rapat Guru</h4>
                            <span class="text-xs text-gray-400">08:00 - 10:00</span>
                        </div>
                        <p class="text-gray-400 text-sm mt-1">Ruang Guru - Pembahasan Kurikulum</p>
                    </div>
                    <div class="bg-gray-700 rounded-lg p-4 border-l-4 border-purple-500">
                        <div class="flex justify-between">
                            <h4 class="text-white font-medium">Ujian Matematika</h4>
                            <span class="text-xs text-gray-400">10:30 - 12:30</span>
                        </div>
                        <p class="text-gray-400 text-sm mt-1">Kelas XI IPA 1, XI IPA 2</p>
                    </div>
                    <div class="bg-gray-700 rounded-lg p-4 border-l-4 border-amber-500">
                        <div class="flex justify-between">
                            <h4 class="text-white font-medium">Pembagian Rapor</h4>
                            <span class="text-xs text-gray-400">13:00 - 15:00</span>
                        </div>
                        <p class="text-gray-400 text-sm mt-1">Aula Utama - Semua Wali Kelas</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Third Row with Single Card -->
        <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-700 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-white">Data Siswa Terbaru</h3>
                <a href="#"
                    class="text-sm text-blue-400 hover:text-blue-300 transition-colors duration-200">Lihat
                    Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead class="bg-gray-700">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                Nama</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                NIS</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                Kelas</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                Status</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-800 divide-y divide-gray-700">
                        <tr class="hover:bg-gray-700 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div
                                        class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-600 flex items-center justify-center text-white">
                                        AF
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-white">Ahmad Farhan</div>
                                        <div class="text-sm text-gray-400">farhan@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-white">20230001</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-white">X IPA 1</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                <a href="#"
                                    class="text-blue-400 hover:text-blue-300 hover:underline mr-3 tooltip"
                                    data-tooltip="Edit data siswa">Edit</a>
                                <a href="#" class="text-red-400 hover:text-red-300 hover:underline tooltip"
                                    data-tooltip="Hapus data siswa">Delete</a>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-700 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div
                                        class="flex-shrink-0 h-10 w-10 rounded-full bg-purple-600 flex items-center justify-center text-white">
                                        RN
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-white">Rizki Nugraha</div>
                                        <div class="text-sm text-gray-400">rizki@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-white">20230002</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-white">X IPA 2</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                <a href="#"
                                    class="text-blue-400 hover:text-blue-300 hover:underline mr-3 tooltip"
                                    data-tooltip="Edit data siswa">Edit</a>
                                <a href="#" class="text-red-400 hover:text-red-300 hover:underline tooltip"
                                    data-tooltip="Hapus data siswa">Delete</a>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-700 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div
                                        class="flex-shrink-0 h-10 w-10 rounded-full bg-amber-600 flex items-center justify-center text-white">
                                        SI
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-white">Siti Indah</div>
                                        <div class="text-sm text-gray-400">siti@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-white">20230003</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-white">X IPA 1</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Izin</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                <a href="#"
                                    class="text-blue-400 hover:text-blue-300 hover:underline mr-3 tooltip"
                                    data-tooltip="Edit data siswa">Edit</a>
                                <a href="#" class="text-red-400 hover:text-red-300 hover:underline tooltip"
                                    data-tooltip="Hapus data siswa">Delete</a>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-700 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div
                                        class="flex-shrink-0 h-10 w-10 rounded-full bg-emerald-600 flex items-center justify-center text-white">
                                        DA
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-white">Dimas Anggara</div>
                                        <div class="text-sm text-gray-400">dimas@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-white">20230004</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-white">X IPA 3</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                <a href="#"
                                    class="text-blue-400 hover:text-blue-300 hover:underline mr-3 tooltip"
                                    data-tooltip="Edit data siswa">Edit</a>
                                <a href="#" class="text-red-400 hover:text-red-300 hover:underline tooltip"
                                    data-tooltip="Hapus data siswa">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <script>
        // Handle sidebar toggle for mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        });

        // Handle sidebar toggle for desktop
        document.getElementById('sidebarToggleDesktop').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const contentArea = document.querySelector('.flex-1');
            const header = document.querySelector('header');

            sidebar.classList.toggle('-translate-x-full');
            contentArea.classList.toggle('md:ml-0');
            contentArea.classList.toggle('md:ml-64');

            // Adjust header width when sidebar is toggled
            if (sidebar.classList.contains('-translate-x-full')) {
                header.classList.remove('md:w-[calc(100%-16rem)]');
                header.classList.add('w-full');
            } else {
                header.classList.add('md:w-[calc(100%-16rem)]');
                header.classList.remove('w-full');
            }
        });

        // Handle user menu dropdown
        document.getElementById('userMenuBtn').addEventListener('click', function() {
            document.getElementById('userMenu').classList.toggle('hidden');
        });
    </script>
</x-app-layout>
