@props([
    'totalStudents',
    'totalTeachers',
    'totalClasses',
    'totalSubjects',
    'todayAttendance',
    'activeClassesToday',
    'teachersTeachingToday',
    'academicMetrics',
    'weeklyActivities',
    'todayEvents',
    'growthMetrics',
])
<x-app-layout>
    <x-admin-header />

    <div class="px-6 py-8 space-y-8 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <x-admin-card :totalStudents="$totalStudents" :totalTeachers="$totalTeachers" :totalClasses="$totalClasses" :totalSubjects="$totalSubjects" :todayAttendance="$todayAttendance"
                :growthMetrics="$growthMetrics" />
        </div>
        <!-- Main Content Grid -->
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
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
                                <span class="text-sm font-semibold text-orange-600">{{ $activeClassesToday }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-gray-600">Guru Mengajar</span>
                                <span class="text-sm font-semibold text-orange-600">{{ $teachersTeachingToday }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-gray-600">Siswa Hadir</span>
                                <span
                                    class="text-sm font-semibold text-orange-600">{{ $todayAttendance['present'] }}</span>
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
                                            fill="none" stroke-linecap="round"
                                            stroke-dasharray="{{ $todayAttendance['percentage'] }}, 100"
                                            d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831">
                                        </path>
                                    </svg>
                                    <div class="absolute text-lg font-bold text-emerald-600">
                                        {{ $todayAttendance['percentage'] }}%</div>
                                </div>
                                <p class="text-sm text-gray-600 mt-2">{{ $todayAttendance['present'] }} dari
                                    {{ $todayAttendance['total'] }} siswa hadir</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Visual Charts & Calendar Section -->
                <div class="grid grid-cols-1 gap-6">
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
                                    <h3 class="text-sm font-semibold text-gray-900">Kalendar {{ now()->format('F Y') }}
                                    </h3>
                                    <p class="text-xs text-gray-500">Agenda dan jadwal penting</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-7 gap-1 text-center text-xs mb-4">
                                <div class="font-semibold text-gray-600 py-2">Min</div>
                                <div class="font-semibold text-gray-600 py-2">Sen</div>
                                <div class="font-semibold text-gray-600 py-2">Sel</div>
                                <div class="font-semibold text-gray-600 py-2">Rab</div>
                                <div class="font-semibold text-gray-600 py-2">Kam</div>
                                <div class="font-semibold text-gray-600 py-2">Jum</div>
                                <div class="font-semibold text-gray-600 py-2">Sab</div>

                                @php
                                    $currentDate = now()->timezone('Asia/Jakarta');
                                    $startOfMonth = $currentDate->copy()->startOfMonth();
                                    $endOfMonth = $currentDate->copy()->endOfMonth();
                                    $startOfWeek = $startOfMonth->copy()->startOfWeek();
                                    $endOfWeek = $endOfMonth->copy()->endOfWeek();
                                    $today = $currentDate->day;
                                @endphp

                                @for ($date = $startOfWeek; $date <= $endOfWeek; $date->addDay())
                                    @if ($date->month == $currentDate->month)
                                        <div
                                            class="py-2 hover:bg-rose-100 rounded cursor-pointer {{ $date->day == $today ? 'bg-rose-200 font-semibold' : '' }}">
                                            {{ $date->day }}
                                        </div>
                                    @else
                                        <div class="py-2 text-gray-400">{{ $date->day }}</div>
                                    @endif
                                @endfor
                            </div>

                            <!-- Today's Events -->
                            <div class="pt-4 border-t border-gray-100">
                                <h4 class="text-xs font-semibold text-gray-700 mb-2">Acara Hari Ini</h4>
                                <div class="space-y-2">
                                    @if ($todayEvents->count() > 0)
                                        @foreach ($todayEvents as $event)
                                            <div class="flex items-center text-xs">
                                                <div class="w-2 h-2 bg-blue-500 rounded-full mr-2"></div>
                                                <span>{{ Str::limit($event->title, 30) }}</span>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="flex items-center text-xs">
                                            <div class="w-2 h-2 bg-gray-400 rounded-full mr-2"></div>
                                            <span>Tidak ada acara hari ini</span>
                                        </div>
                                    @endif
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
</x-app-layout>
