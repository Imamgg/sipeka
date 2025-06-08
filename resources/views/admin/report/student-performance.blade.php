@props(['students', 'totalStudents', 'averageGrade', 'gradeDistribution', 'topPerformers', 'needsAttention'])

<x-app-layout>
    <div class="bg-gradient-to-br from-blue-50 via-white to-indigo-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <div
                    class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-800 border border-blue-200 mb-4">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                        </path>
                    </svg>
                    Laporan Kinerja Siswa
                </div>

                <!-- Page Title -->
                <h1 class="text-4xl font-bold text-gray-900 mb-4">
                    <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                        Analisis Kinerja Siswa
                    </span>
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Pantau dan analisis prestasi akademik siswa secara menyeluruh di seluruh sekolah
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
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Students -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div
                            class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Siswa</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($totalStudents) }}</p>
                    </div>
                </div>
            </div>

            <!-- Average Grade -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div
                            class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Rata-rata Nilai</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($averageGrade, 1) }}</p>
                    </div>
                </div>
            </div>

            <!-- Grade Distribution -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div
                            class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Siswa Berprestasi</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $gradeDistribution['excellent'] ?? 0 }}</p>
                        <p class="text-xs text-gray-500">Nilai ≥ 85</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Performance Analysis -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Top Performers -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                            </path>
                        </svg>
                        Siswa Berprestasi Terbaik
                    </h3>
                </div>
                <div class="p-6">
                    @if ($topPerformers && count($topPerformers) > 0)
                        <div class="space-y-4">
                            @foreach ($topPerformers as $index => $student)
                                <div
                                    class="flex items-center space-x-4 p-4 rounded-lg bg-gradient-to-r from-yellow-50 to-amber-50 border border-yellow-200">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="w-10 h-10 bg-gradient-to-r from-yellow-400 to-amber-500 rounded-full flex items-center justify-center text-white font-bold">
                                            {{ $index + 1 }}
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold text-gray-900">
                                            {{ $student['student']->user->name }}</p>
                                        <p class="text-xs text-gray-600">
                                            {{ $student['student']->classes->class_name ?? 'N/A' }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-lg font-bold text-yellow-600">
                                            {{ number_format($student['final_average'], 1) }}</p>
                                        <p class="text-xs text-gray-500">Rata-rata</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
                                </path>
                            </svg>
                            <p class="text-gray-500">Belum ada data siswa berprestasi</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Students Needing Attention -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                            </path>
                        </svg>
                        Siswa Perlu Perhatian
                    </h3>
                </div>
                <div class="p-6">
                    @if ($needsAttention && count($needsAttention) > 0)
                        <div class="space-y-4">
                            @foreach ($needsAttention as $student)
                                <div
                                    class="flex items-center space-x-4 p-4 rounded-lg bg-gradient-to-r from-red-50 to-pink-50 border border-red-200">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="w-10 h-10 bg-gradient-to-r from-red-400 to-red-500 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold text-gray-900">
                                            {{ $student['student']->user->name }}</p>
                                        <p class="text-xs text-gray-600">
                                            {{ $student['student']->classes->class_name ?? 'N/A' }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-lg font-bold text-red-600">
                                            {{ number_format($student['final_average'], 1) }}</p>
                                        <p class="text-xs text-gray-500">Rata-rata</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 text-green-400 mx-auto mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-green-600 font-medium">Semua siswa memiliki performa baik!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Grade Distribution Chart -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Distribusi Nilai</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <!-- Excellent (85-100) -->
                    <div
                        class="text-center p-4 rounded-lg bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200">
                        <div class="text-3xl font-bold text-green-600 mb-2">{{ $gradeDistribution['excellent'] ?? 0 }}
                        </div>
                        <div class="text-sm font-medium text-green-800 mb-1">Sangat Baik</div>
                        <div class="text-xs text-green-600">85 - 100</div>
                    </div>

                    <!-- Good (70-84) -->
                    <div
                        class="text-center p-4 rounded-lg bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200">
                        <div class="text-3xl font-bold text-blue-600 mb-2">{{ $gradeDistribution['good'] ?? 0 }}</div>
                        <div class="text-sm font-medium text-blue-800 mb-1">Baik</div>
                        <div class="text-xs text-blue-600">70 - 84</div>
                    </div>

                    <!-- Average (60-69) -->
                    <div
                        class="text-center p-4 rounded-lg bg-gradient-to-r from-yellow-50 to-amber-50 border border-yellow-200">
                        <div class="text-3xl font-bold text-yellow-600 mb-2">{{ $gradeDistribution['average'] ?? 0 }}
                        </div>
                        <div class="text-sm font-medium text-yellow-800 mb-1">Cukup</div>
                        <div class="text-xs text-yellow-600">60 - 69</div>
                    </div>

                    <!-- Poor (<60) -->
                    <div
                        class="text-center p-4 rounded-lg bg-gradient-to-r from-red-50 to-pink-50 border border-red-200">
                        <div class="text-3xl font-bold text-red-600 mb-2">{{ $gradeDistribution['poor'] ?? 0 }}</div>
                        <div class="text-sm font-medium text-red-800 mb-1">Kurang</div>
                        <div class="text-xs text-red-600">
                            < 60</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detailed Student List -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Daftar Siswa Detail</h3>
                        <div class="flex items-center space-x-2">
                            <button
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                Export PDF
                            </button>
                            <button
                                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a4 4 0 01-4-4V5a4 4 0 014-4h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a4 4 0 01-4 4z">
                                    </path>
                                </svg>
                                Export Excel
                            </button>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Siswa
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kelas
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Rata-rata Nilai
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jumlah Mata Pelajaran
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($students && count($students) > 0)
                                @foreach ($students as $student)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <div
                                                        class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center text-white font-semibold">
                                                        {{ substr($student['student']->user->name, 0, 1) }}
                                                    </div>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $student['student']->user->name }}</div>
                                                    <div class="text-sm text-gray-500">
                                                        {{ $student['student']->nisn ?? 'N/A' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $student['student']->classes->class_name ?? 'N/A' }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-semibold text-gray-900">
                                                {{ number_format($student['final_average'], 1) }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $student['grades_count'] ?? 0 }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($student['final_average'] >= 85)
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    Sangat Baik
                                                </span>
                                            @elseif($student['final_average'] >= 70)
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    Baik
                                                </span>
                                            @elseif($student['final_average'] >= 60)
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    Cukup
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    Perlu Perhatian
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                                            </path>
                                        </svg>
                                        <p class="text-gray-500">Belum ada data siswa</p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</x-app-layout>
