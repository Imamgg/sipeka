@props(['totalStudents', 'totalTeachers', 'totalClasses', 'totalSubjects'])
<x-app-layout>
    <x-admin-header />

    <div class="px-6 py-8 space-y-8 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <x-admin-card :totalStudents="$totalStudents" :totalTeachers="$totalTeachers" :totalClasses="$totalClasses" :totalSubjects="$totalSubjects" />
        </div>
        <!-- Main Content Grid -->
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <!-- Real-time Overview Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Quick Statistics -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-orange-50 to-red-50 border-b border-gray-100">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-8 h-8 bg-gradient-to-r from-orange-500 to-red-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-sm font-semibold text-gray-900">Aktivitas Hari Ini</h3>
                                    <p class="text-xs text-gray-500">Data real-time sekolah</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-gray-600">Kelas Aktif</span>
                                <span class="text-sm font-semibold text-orange-600">{{ $totalClasses }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-gray-600">Guru Mengajar</span>
                                <span class="text-sm font-semibold text-orange-600">{{ $totalTeachers - 2 }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-gray-600">Siswa Hadir</span>
                                <span class="text-sm font-semibold text-orange-600">{{ $totalStudents - 15 }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Attendance Overview -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-emerald-50 to-green-50 border-b border-gray-100">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-8 h-8 bg-gradient-to-r from-emerald-500 to-green-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-sm font-semibold text-gray-900">Kehadiran Hari Ini</h3>
                                    <p class="text-xs text-gray-500">Persentase kehadiran</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="text-center">
                                <div class="relative inline-flex items-center justify-center w-20 h-20">
                                    <svg class="w-20 h-20 transform -rotate-90" viewBox="0 0 36 36">
                                        <path class="text-gray-200" stroke="currentColor" stroke-width="2"
                                            fill="none"
                                            d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831">
                                        </path>
                                        <path class="text-emerald-500" stroke="currentColor" stroke-width="2"
                                            fill="none" stroke-linecap="round" stroke-dasharray="87, 100"
                                            d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831">
                                        </path>
                                    </svg>
                                    <div class="absolute text-lg font-bold text-emerald-600">87%</div>
                                </div>
                                <p class="text-sm text-gray-600 mt-2">{{ $totalStudents - 15 }} dari
                                    {{ $totalStudents }} siswa hadir</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Visual Charts & Calendar Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Mini Calendar Widget -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-rose-50 to-pink-50 border-b border-gray-100">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-8 h-8 bg-gradient-to-r from-rose-500 to-pink-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-sm font-semibold text-gray-900">Kalendar Juni 2025</h3>
                                    <p class="text-xs text-gray-500">Agenda dan jadwal penting</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <!-- Mini Calendar -->
                            <div class="grid grid-cols-7 gap-1 text-center text-xs mb-4">
                                <div class="font-semibold text-gray-600 py-2">Min</div>
                                <div class="font-semibold text-gray-600 py-2">Sen</div>
                                <div class="font-semibold text-gray-600 py-2">Sel</div>
                                <div class="font-semibold text-gray-600 py-2">Rab</div>
                                <div class="font-semibold text-gray-600 py-2">Kam</div>
                                <div class="font-semibold text-gray-600 py-2">Jum</div>
                                <div class="font-semibold text-gray-600 py-2">Sab</div>

                                <!-- June 2025 Calendar -->
                                <div class="py-2 text-gray-400">1</div>
                                <div class="py-2 text-gray-400">2</div>
                                <div class="py-2 text-gray-400">3</div>
                                <div class="py-2 text-gray-400">4</div>
                                <div class="py-2 text-gray-400">5</div>
                                <div class="py-2 text-gray-400">6</div>
                                <div class="py-2 text-gray-400">7</div>

                                <div class="py-2 hover:bg-rose-100 rounded cursor-pointer">8</div>
                                <div class="py-2 hover:bg-rose-100 rounded cursor-pointer">9</div>
                                <div class="py-2 hover:bg-rose-100 rounded cursor-pointer">10</div>
                                <div class="py-2 hover:bg-rose-100 rounded cursor-pointer">11</div>
                                <div class="py-2 hover:bg-rose-100 rounded cursor-pointer">12</div>
                                <div class="py-2 hover:bg-rose-100 rounded cursor-pointer">13</div>
                                <div class="py-2 hover:bg-rose-100 rounded cursor-pointer">14</div>

                                <div class="py-2 hover:bg-rose-100 rounded cursor-pointer">15</div>
                                <div class="py-2 hover:bg-rose-100 rounded cursor-pointer">16</div>
                                <div class="py-2 hover:bg-rose-100 rounded cursor-pointer">17</div>
                                <div class="py-2 hover:bg-rose-100 rounded cursor-pointer">18</div>
                                <div class="py-2 hover:bg-rose-100 rounded cursor-pointer">19</div>
                                <div class="py-2 hover:bg-rose-100 rounded cursor-pointer">20</div>
                                <div class="py-2 hover:bg-rose-100 rounded cursor-pointer">21</div>

                                <div class="py-2 hover:bg-rose-100 rounded cursor-pointer">22</div>
                                <div class="py-2 hover:bg-rose-100 rounded cursor-pointer">23</div>
                                <div class="py-2 hover:bg-rose-100 rounded cursor-pointer">24</div>
                                <div class="py-2 hover:bg-rose-100 rounded cursor-pointer">25</div>
                                <div class="py-2 hover:bg-rose-100 rounded cursor-pointer">26</div>
                                <div class="py-2 hover:bg-rose-100 rounded cursor-pointer">27</div>
                                <div class="py-2 hover:bg-rose-100 rounded cursor-pointer">28</div>

                                <div class="py-2 hover:bg-rose-100 rounded cursor-pointer">29</div>
                                <div class="py-2 hover:bg-rose-100 rounded cursor-pointer">30</div>
                                <div class="py-2 text-gray-400">1</div>
                                <div class="py-2 text-gray-400">2</div>
                                <div class="py-2 text-gray-400">3</div>
                                <div class="py-2 text-gray-400">4</div>
                                <div class="py-2 text-gray-400">5</div>
                            </div>

                            <!-- Today's Events -->
                            <div class="pt-4 border-t border-gray-100">
                                <h4 class="text-xs font-semibold text-gray-700 mb-2">Acara Hari Ini</h4>
                                <div class="space-y-2">
                                    <div class="flex items-center text-xs">
                                        <div class="w-2 h-2 bg-blue-500 rounded-full mr-2"></div>
                                        <span>Rapat Guru - 09:00</span>
                                    </div>
                                    <div class="flex items-center text-xs">
                                        <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                        <span>Ujian Matematika - 10:00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Visual Statistics Dashboard -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-teal-50 to-cyan-50 border-b border-gray-100">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-8 h-8 bg-gradient-to-r from-teal-500 to-cyan-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-sm font-semibold text-gray-900">Grafik Pembelajaran</h3>
                                    <p class="text-xs text-gray-500">Visualisasi data akademik</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <!-- Visual Chart Representation -->
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Tingkat Kehadiran</span>
                                    <span class="text-sm font-semibold text-teal-600">87%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-3">
                                    <div class="bg-gradient-to-r from-teal-500 to-cyan-500 h-3 rounded-full relative"
                                        style="width: 87%">
                                        <div
                                            class="absolute right-0 top-0 w-3 h-3 bg-white rounded-full border-2 border-teal-500 transform translate-x-1.5">
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between mt-4">
                                    <span class="text-sm text-gray-600">Prestasi Akademik</span>
                                    <span class="text-sm font-semibold text-emerald-600">92%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-3">
                                    <div class="bg-gradient-to-r from-emerald-500 to-green-500 h-3 rounded-full relative"
                                        style="width: 92%">
                                        <div
                                            class="absolute right-0 top-0 w-3 h-3 bg-white rounded-full border-2 border-emerald-500 transform translate-x-1.5">
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between mt-4">
                                    <span class="text-sm text-gray-600">Keterlibatan Siswa</span>
                                    <span class="text-sm font-semibold text-blue-600">78%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-3">
                                    <div class="bg-gradient-to-r from-blue-500 to-indigo-500 h-3 rounded-full relative"
                                        style="width: 78%">
                                        <div
                                            class="absolute right-0 top-0 w-3 h-3 bg-white rounded-full border-2 border-blue-500 transform translate-x-1.5">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Mini Bar Chart -->
                            <div class="mt-6 pt-4 border-t border-gray-100">
                                <h4 class="text-xs font-semibold text-gray-700 mb-3">Aktivitas Mingguan</h4>
                                <div class="flex items-end justify-between h-20 space-x-1">
                                    <div class="bg-gradient-to-t from-teal-500 to-teal-300 rounded-t w-8"
                                        style="height: 60%"></div>
                                    <div class="bg-gradient-to-t from-blue-500 to-blue-300 rounded-t w-8"
                                        style="height: 80%"></div>
                                    <div class="bg-gradient-to-t from-purple-500 to-purple-300 rounded-t w-8"
                                        style="height: 45%"></div>
                                    <div class="bg-gradient-to-t from-pink-500 to-pink-300 rounded-t w-8"
                                        style="height: 70%"></div>
                                    <div class="bg-gradient-to-t from-orange-500 to-orange-300 rounded-t w-8"
                                        style="height: 90%"></div>
                                    <div class="bg-gradient-to-t from-green-500 to-green-300 rounded-t w-8"
                                        style="height: 65%"></div>
                                    <div class="bg-gradient-to-t from-indigo-500 to-indigo-300 rounded-t w-8"
                                        style="height: 85%"></div>
                                </div>
                                <div class="flex justify-between text-xs text-gray-400 mt-1">
                                    <span>S</span><span>S</span><span>S</span><span>R</span><span>K</span><span>J</span><span>S</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upcoming Schedule -->
            <div class="lg:col-span-1">
                <x-admin-upcoming-schedule />
            </div>
        </div>
        <!-- Quick Actions -->
        <x-admin-quick-actions />
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
