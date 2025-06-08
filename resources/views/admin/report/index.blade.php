@props([
    'totalStudents',
    'totalTeachers',
    'totalClasses',
    'totalSubjects',
    'averageAttendance',
    'averageGrade',
    'recentGrades',
    'recentAttendances',
])

<x-app-layout>
    <div class="bg-gradient-to-br from-indigo-50 via-white to-purple-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <div
                    class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-gradient-to-r from-purple-100 to-indigo-100 text-purple-800 border border-purple-200 mb-4">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                        </path>
                    </svg>
                    Dashboard Laporan
                </div>

                <!-- Page Title -->
                <h1 class="text-4xl font-bold text-gray-900 mb-4">
                    <span class="bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">
                        Dashboard Laporan Admin
                    </span>
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Pantau dan analisis data sekolah secara menyeluruh dengan dashboard laporan yang terintegrasi
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Report Navigation Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Student Performance Report -->
            <a href="{{ route('admin.reports.student-performance') }}"
                class="group bg-white rounded-xl shadow-lg border border-gray-200 p-6 hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div
                        class="w-12 h-12 bg-gradient-to-r from-blue-100 to-blue-200 rounded-lg flex items-center justify-center group-hover:from-blue-500 group-hover:to-blue-600 transition-all duration-300">
                        <svg class="w-6 h-6 text-blue-600 group-hover:text-white transition-colors duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                            </path>
                        </svg>
                    </div>
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600 transition-colors duration-300"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                        </path>
                    </svg>
                </div>
                <h3
                    class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors duration-300">
                    Kinerja Siswa</h3>
                <p class="text-sm text-gray-600">Analisis mendalam tentang prestasi akademik siswa di sekolah
                </p>
            </a>

            <!-- Teacher Performance Report -->
            <a href="{{ route('admin.reports.teacher-performance') }}"
                class="group bg-white rounded-xl shadow-lg border border-gray-200 p-6 hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div
                        class="w-12 h-12 bg-gradient-to-r from-emerald-100 to-emerald-200 rounded-lg flex items-center justify-center group-hover:from-emerald-500 group-hover:to-emerald-600 transition-all duration-300">
                        <svg class="w-6 h-6 text-emerald-600 group-hover:text-white transition-colors duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-emerald-600 transition-colors duration-300"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                        </path>
                    </svg>
                </div>
                <h3
                    class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-emerald-600 transition-colors duration-300">
                    Kinerja Guru</h3>
                <p class="text-sm text-gray-600">Evaluasi aktivitas dan efektivitas pengajaran guru di sekolah</p>
            </a>

            <!-- Attendance Statistics Report -->
            <a href="{{ route('admin.reports.attendance-statistics') }}"
                class="group bg-white rounded-xl shadow-lg border border-gray-200 p-6 hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div
                        class="w-12 h-12 bg-gradient-to-r from-purple-100 to-purple-200 rounded-lg flex items-center justify-center group-hover:from-purple-500 group-hover:to-purple-600 transition-all duration-300">
                        <svg class="w-6 h-6 text-purple-600 group-hover:text-white transition-colors duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-purple-600 transition-colors duration-300"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                        </path>
                    </svg>
                </div>
                <h3
                    class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-purple-600 transition-colors duration-300">
                    Statistik Kehadiran</h3>
                <p class="text-sm text-gray-600">Analisis komprehensif data kehadiran siswa dan guru</p>
            </a>

            <!-- Grade Distribution Report -->
            <a href="{{ route('admin.reports.grade-distribution') }}"
                class="group bg-white rounded-xl shadow-lg border border-gray-200 p-6 hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div
                        class="w-12 h-12 bg-gradient-to-r from-amber-100 to-amber-200 rounded-lg flex items-center justify-center group-hover:from-amber-500 group-hover:to-amber-600 transition-all duration-300">
                        <svg class="w-6 h-6 text-amber-600 group-hover:text-white transition-colors duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-amber-600 transition-colors duration-300"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                        </path>
                    </svg>
                </div>
                <h3
                    class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-amber-600 transition-colors duration-300">
                    Distribusi Nilai</h3>
                <p class="text-sm text-gray-600">Trend dan analisis distribusi nilai siswa per mata pelajaran</p>
            </a>
        </div>

        <!-- Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Grades -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Nilai Terbaru</h3>
                        <a href="{{ route('admin.reports.grade-distribution') }}"
                            class="text-sm text-blue-600 hover:text-blue-800">Lihat Semua</a>
                    </div>
                </div>
                <div class="p-6">
                    @if ($recentGrades && $recentGrades->count() > 0)
                        <div class="space-y-4">
                            @foreach ($recentGrades->take(5) as $grade)
                                <div
                                    class="flex items-center justify-between py-2 border-b border-gray-100 last:border-b-0">
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ $grade->student->user->name ?? 'N/A' }}</p>
                                        <p class="text-xs text-gray-500">{{ $grade->subject->subject_name ?? 'N/A' }}
                                            - {{ $grade->student->classes->class_name ?? 'N/A' }}</p>
                                    </div>
                                    <div class="text-right">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $grade->score >= 80 ? 'bg-green-100 text-green-800' : ($grade->score >= 70 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                            {{ $grade->score }}
                                        </span>
                                        <p class="text-xs text-gray-500 mt-1">
                                            {{ $grade->created_at->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            <p class="text-gray-500">Belum ada data nilai</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Attendance -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Kehadiran Terbaru</h3>
                        <a href="{{ route('admin.reports.attendance-statistics') }}"
                            class="text-sm text-blue-600 hover:text-blue-800">Lihat Semua</a>
                    </div>
                </div>
                <div class="p-6">
                    @if ($recentAttendances && $recentAttendances->count() > 0)
                        <div class="space-y-4">
                            @foreach ($recentAttendances->take(5) as $attendance)
                                <div
                                    class="flex items-center justify-between py-2 border-b border-gray-100 last:border-b-0">
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ $attendance->student->user->name ?? 'N/A' }}</p>
                                        <p class="text-xs text-gray-500">
                                            {{ $attendance->student->classes->class_name ?? 'N/A' }}</p>
                                    </div>
                                    <div class="text-right">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $attendance->status === 'present' ? 'bg-green-100 text-green-800' : ($attendance->status === 'late' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                            @if ($attendance->status === 'present')
                                                Hadir
                                            @elseif($attendance->status === 'late')
                                                Terlambat
                                            @elseif($attendance->status === 'absent')
                                                Tidak Hadir
                                            @else
                                                {{ ucfirst($attendance->status) }}
                                            @endif
                                        </span>
                                        <p class="text-xs text-gray-500 mt-1">
                                            {{ $attendance->created_at->format('d/m/Y') }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-gray-500">Belum ada data kehadiran</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
