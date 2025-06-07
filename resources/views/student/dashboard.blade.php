<x-student-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold">Selamat Datang, {{ $student->user->name }}!</h3>
                            <p class="text-blue-100 mt-2">NIS: {{ $student->nis }} | Kelas:
                                {{ $student->classes->class_name ?? 'Belum ditetapkan' }}</p>
                        </div>
                        <div class="hidden md:block">
                            <svg class="w-16 h-16 text-blue-200" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.84L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.84l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Kehadiran</div>
                                <div class="text-2xl font-bold text-gray-900">{{ $attendanceStats['percentage'] }}%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Hari Ini</div>
                                <div class="text-2xl font-bold text-gray-900">{{ $todaySchedule->count() }}</div>
                                <div class="text-xs text-gray-500">Mata Pelajaran</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Nilai Terbaru</div>
                                <div class="text-2xl font-bold text-gray-900">{{ $recentGrades->count() }}</div>
                                <div class="text-xs text-gray-500">Data Nilai</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Pengumuman</div>
                                <div class="text-2xl font-bold text-gray-900">{{ $announcements->count() }}</div>
                                <div class="text-xs text-gray-500">Terbaru</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Today's Schedule -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Jadwal Hari Ini</h3>
                            <a href="{{ route('student.schedules.index') }}"
                                class="text-blue-600 hover:text-blue-800 text-sm">
                                Lihat Semua
                            </a>
                        </div>

                        @if ($todaySchedule->count() > 0)
                            <div class="space-y-3">
                                @foreach ($todaySchedule as $schedule)
                                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                        <div class="flex-shrink-0">
                                            <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
                                        </div>
                                        <div class="ml-3 flex-1">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $schedule->subject->name }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                {{ $schedule->teacher->user->name ?? 'Guru tidak ditemukan' }}
                                            </div>
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} -
                                            {{ Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8 text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4M8 7h8l1 12H7L8 7z" />
                                </svg>
                                <p class="mt-2">Tidak ada jadwal untuk hari ini</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Recent Materials -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Materi Terbaru</h3>
                            <a href="{{ route('student.materials.index') }}"
                                class="text-blue-600 hover:text-blue-800 text-sm">
                                Lihat Semua
                            </a>
                        </div>

                        @if (isset($recentMaterials) && $recentMaterials->count() > 0)
                            <div class="space-y-3">
                                @foreach ($recentMaterials as $material)
                                    <div class="p-3 bg-gray-50 rounded-lg">
                                        <div class="text-sm font-medium text-gray-900 mb-1">
                                            {{ Str::limit($material->title, 30) }}
                                        </div>
                                        <div class="text-xs text-gray-500 mb-1">
                                            {{ $material->subject->name }} - {{ $material->teacher->user->name }}
                                        </div>
                                        <div class="flex items-center text-xs text-gray-500">
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                                {{ $material->type === 'materi' ? 'bg-blue-100 text-blue-800' : 'bg-orange-100 text-orange-800' }}">
                                                {{ ucfirst($material->type) }}
                                            </span>
                                            <span class="ml-2">{{ $material->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8 text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <p class="mt-2">Belum ada materi tersedia</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Recent Grades -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Nilai Terbaru</h3>
                            <a href="{{ route('student.grades.index') }}"
                                class="text-blue-600 hover:text-blue-800 text-sm">
                                Lihat Semua
                            </a>
                        </div>

                        @if ($recentGrades->count() > 0)
                            <div class="space-y-3">
                                @foreach ($recentGrades as $grade)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div class="flex-1">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $grade->subject->name }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                {{ ucfirst($grade->type_assessment) }}
                                            </div>
                                        </div>
                                        <div class="text-lg font-bold text-blue-600">
                                            {{ $grade->grade }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8 text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                <p class="mt-2">Belum ada nilai yang tersedia</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Recent Announcements -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg lg:col-span-2">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Pengumuman Terbaru</h3>
                            <a href="{{ route('student.announcements.index') }}"
                                class="text-blue-600 hover:text-blue-800 text-sm">
                                Lihat Semua
                            </a>
                        </div>

                        @if ($announcements->count() > 0)
                            <div class="space-y-3">
                                @foreach ($announcements as $announcement)
                                    <div class="p-3 bg-gray-50 rounded-lg">
                                        <div class="text-sm font-medium text-gray-900 mb-1">
                                            {{ Str::limit($announcement->title, 50) }}
                                        </div>
                                        <div class="text-xs text-gray-500 mb-2">
                                            {{ $announcement->published_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }}
                                            WIB
                                        </div>
                                        <div class="text-xs text-gray-600">
                                            {{ Str::limit(strip_tags($announcement->content), 100) }}
                                        </div>
                                        <a href="{{ route('student.announcements.show', $announcement->id) }}"
                                            class="text-xs text-blue-600 hover:text-blue-800 mt-2 inline-block">
                                            Baca selengkapnya
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8 text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                </svg>
                                <p class="mt-2">Belum ada pengumuman</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Attendance Summary -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Ringkasan Absensi</h3>
                            <a href="{{ route('student.attendances.index') }}"
                                class="text-blue-600 hover:text-blue-800 text-sm">
                                Lihat Detail
                            </a>
                        </div>

                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Total Pertemuan</span>
                                <span class="text-sm font-medium">{{ $attendanceStats['total'] }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Hadir</span>
                                <span
                                    class="text-sm font-medium text-green-600">{{ $attendanceStats['present'] }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Tidak Hadir</span>
                                <span class="text-sm font-medium text-red-600">{{ $attendanceStats['absent'] }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Terlambat</span>
                                <span
                                    class="text-sm font-medium text-yellow-600">{{ $attendanceStats['late'] }}</span>
                            </div>

                            <!-- Progress Bar -->
                            <div class="mt-4">
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-gray-600">Persentase Kehadiran</span>
                                    <span class="font-medium">{{ $attendanceStats['percentage'] }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-600 h-2 rounded-full"
                                        style="width: {{ $attendanceStats['percentage'] }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h3>
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                        <a href="{{ route('student.profile.edit') }}"
                            class="flex flex-col items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                            <svg class="w-8 h-8 text-blue-600 mb-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="text-sm font-medium text-blue-600">Edit Profil</span>
                        </a>

                        <a href="{{ route('student.schedules.index') }}"
                            class="flex flex-col items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors">
                            <svg class="w-8 h-8 text-green-600 mb-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-4 8V9a1 1 0 011-1h2a1 1 0 011 1v6m-4 0a1 1 0 01-1-1V9a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1m-4 0h8">
                                </path>
                            </svg>
                            <span class="text-sm font-medium text-green-600">Jadwal</span>
                        </a>

                        <a href="{{ route('student.grades.index') }}"
                            class="flex flex-col items-center p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition-colors">
                            <svg class="w-8 h-8 text-yellow-600 mb-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                </path>
                            </svg>
                            <span class="text-sm font-medium text-yellow-600">Nilai</span>
                        </a>

                        <a href="{{ route('student.materials.index') }}"
                            class="flex flex-col items-center p-4 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition-colors">
                            <svg class="w-8 h-8 text-indigo-600 mb-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                            <span class="text-sm font-medium text-indigo-600">Materi</span>
                        </a>

                        <a href="{{ route('student.attendances.scan') }}"
                            class="flex flex-col items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                            <svg class="w-8 h-8 text-purple-600 mb-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z">
                                </path>
                            </svg>
                            <span class="text-sm font-medium text-purple-600">QR Absensi</span>
                        </a>

                        <a href="{{ route('student.announcements.index') }}"
                            class="flex flex-col items-center p-4 bg-red-50 rounded-lg hover:bg-red-100 transition-colors">
                            <svg class="w-8 h-8 text-red-600 mb-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                                </path>
                            </svg>
                            <span class="text-sm font-medium text-red-600">Pengumuman</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-student-layout>
