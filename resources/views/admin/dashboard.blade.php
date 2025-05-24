@props(['totalStudents', 'totalTeachers', 'totalClasses', 'totalSubjects'])
<x-app-layout>
    <main class="px-10 py-6 space-y-6 mt-16 overflow-y-auto">
        <x-admin-card :totalStudents="$totalStudents" :totalTeachers="$totalTeachers" :totalClasses="$totalClasses" :totalSubjects="$totalSubjects" />
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
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
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
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
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
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
            <x-admin-upcoming-schedule />
        </div>
    </main>
</x-app-layout>
