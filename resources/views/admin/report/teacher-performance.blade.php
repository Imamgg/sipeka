@props([
    'totalTeachers',
    'averageClassPerformance',
    'teacherStats',
    'topTeachers',
    'teacherActivities',
    'teacherPerformance',
])

<x-app-layout>
    <div class="bg-gradient-to-br from-emerald-50 via-white to-green-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <div
                    class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-gradient-to-r from-emerald-100 to-green-100 text-emerald-800 border border-emerald-200 mb-4">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Laporan Kinerja Guru
                </div>

                <!-- Page Title -->
                <h1 class="text-4xl font-bold text-gray-900 mb-4">
                    <span class="bg-gradient-to-r from-emerald-600 to-green-600 bg-clip-text text-transparent">
                        Analisis Kinerja Guru
                    </span>
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Evaluasi aktivitas dan efektivitas pengajaran guru di seluruh sekolah
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Back Button -->
        <div class="mb-8">
            <a href="{{ route('admin.reports.index') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm hover:shadow-md">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Dashboard Laporan
            </a>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Total Teachers -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div
                            class="w-12 h-12 bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Guru</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($totalTeachers) }}</p>
                    </div>
                </div>
            </div>

            <!-- Active Teachers -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div
                            class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Guru Aktif</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $teacherStats['active'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <!-- Average Class Performance -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div
                            class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Rata-rata Kelas</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($averageClassPerformance, 1) }}</p>
                    </div>
                </div>
            </div>

            <!-- Materials Uploaded -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div
                            class="w-12 h-12 bg-gradient-to-r from-amber-500 to-amber-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Materi</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $teacherStats['total_materials'] ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                            </path>
                        </svg>
                        Guru Terbaik
                    </h3>
                </div>
                <div class="p-6">
                    @if ($topTeachers && count($topTeachers) > 0)
                        <div class="space-y-4">
                            @foreach ($topTeachers as $index => $teacher)
                                <div
                                    class="flex items-center space-x-4 p-4 rounded-lg bg-gradient-to-r from-yellow-50 to-amber-50 border border-yellow-200">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="w-10 h-10 bg-gradient-to-r from-yellow-400 to-amber-500 rounded-full flex items-center justify-center text-white font-bold">
                                            {{ $index + 1 }}
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold text-gray-900">{{ $teacher['name'] }}</p>
                                        <p class="text-xs text-gray-600">{{ $teacher['subject'] ?? 'N/A' }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-lg font-bold text-yellow-600">
                                            {{ number_format($teacher['class_average'], 1) }}</p>
                                        <p class="text-xs text-gray-500">Rata-rata Kelas</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <p class="text-gray-500">Belum ada data guru</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Teacher Activities -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Aktivitas Terbaru
                    </h3>
                </div>
                <div class="p-6">
                    @if ($teacherActivities && count($teacherActivities) > 0)
                        <div class="space-y-4">
                            @foreach ($teacherActivities as $activity)
                                <div
                                    class="flex items-start space-x-4 p-3 rounded-lg bg-gray-50 border border-gray-200">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="w-8 h-8 bg-gradient-to-r from-blue-400 to-blue-500 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">{{ $activity['teacher'] }}</p>
                                        <p class="text-xs text-gray-600 mb-1">{{ $activity['activity'] }}</p>
                                        <p class="text-xs text-gray-500">{{ $activity['time'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            <p class="text-gray-500">Belum ada aktivitas terbaru</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Teacher Performance Metrics -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Metrik Kinerja Guru</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Materials Created -->
                    <div
                        class="text-center p-6 rounded-lg bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200">
                        <div
                            class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-blue-800 mb-2">Materi Dibuat</h4>
                        <p class="text-3xl font-bold text-blue-600">{{ $teacherStats['total_materials'] ?? 0 }}</p>
                        <p class="text-sm text-blue-600 mt-1">Total materi pembelajaran</p>
                    </div>

                    <!-- Average Attendance -->
                    <div
                        class="text-center p-6 rounded-lg bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200">
                        <div
                            class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-green-800 mb-2">Rata-rata Kehadiran</h4>
                        <p class="text-3xl font-bold text-green-600">
                            {{ number_format($teacherStats['avg_attendance'] ?? 0, 1) }}%</p>
                        <p class="text-sm text-green-600 mt-1">Kehadiran siswa di kelas</p>
                    </div>

                    <!-- Active Classes -->
                    <div
                        class="text-center p-6 rounded-lg bg-gradient-to-r from-purple-50 to-violet-50 border border-purple-200">
                        <div
                            class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-purple-800 mb-2">Kelas Aktif</h4>
                        <p class="text-3xl font-bold text-purple-600">{{ $teacherStats['active_classes'] ?? 0 }}</p>
                        <p class="text-sm text-purple-600 mt-1">Kelas yang diajar</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
