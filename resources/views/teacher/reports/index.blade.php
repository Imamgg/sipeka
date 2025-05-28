@extends('layouts.teacher')

@section('title', 'Laporan')

@section('content')
    <div class="p-6 bg-gradient-to-br from-blue-50 via-white to-amber-50 min-h-screen">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-slate-800">Dashboard Laporan</h1>
                    <p class="mt-2 text-slate-600">Kelola dan unduh laporan nilai serta absensi siswa</p>
                </div>
                <div class="mt-4 lg:mt-0">
                    <div class="flex items-center space-x-3">
                        <span class="px-3 py-1 bg-cyan-100 text-cyan-800 rounded-full text-sm font-medium">
                            {{ now()->format('d F Y') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Classes -->
            <div
                class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden transform hover:scale-[1.02] transition-all duration-200">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm font-medium">Total Kelas</p>
                            <p class="text-2xl font-bold text-white">{{ $totalClasses }}</p>
                        </div>
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-2m-7 0h-2m3 0v-8a1 1 0 011-1h2a1 1 0 011 1v8m-5 0V9a1 1 0 00-1-1H9a1 1 0 00-1 1v12">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4">
                    <p class="text-xs text-slate-500">Kelas yang diampu</p>
                </div>
            </div>

            <!-- Total Students -->
            <div
                class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden transform hover:scale-[1.02] transition-all duration-200">
                <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-emerald-100 text-sm font-medium">Total Siswa</p>
                            <p class="text-2xl font-bold text-white">{{ $totalStudents }}</p>
                        </div>
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4">
                    <p class="text-xs text-slate-500">Siswa yang diajar</p>
                </div>
            </div>

            <!-- Total Grades -->
            <div
                class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden transform hover:scale-[1.02] transition-all duration-200">
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-100 text-sm font-medium">Total Nilai</p>
                            <p class="text-2xl font-bold text-white">{{ $totalGrades }}</p>
                        </div>
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4">
                    <p class="text-xs text-slate-500">Nilai yang diinput</p>
                </div>
            </div>

            <!-- Attendance Records -->
            <div
                class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden transform hover:scale-[1.02] transition-all duration-200">
                <div class="bg-gradient-to-r from-amber-500 to-amber-600 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-amber-100 text-sm font-medium">Data Absensi</p>
                            <p class="text-2xl font-bold text-white">{{ $totalAttendances }}</p>
                        </div>
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4">
                    <p class="text-xs text-slate-500">Record kehadiran</p>
                </div>
            </div>
        </div>

        <!-- Report Categories -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Grade Reports -->
            <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 px-6 py-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-white">Laporan Nilai</h3>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-slate-600 mb-4">Generate laporan nilai siswa berdasarkan kelas dan mata pelajaran</p>
                    <div class="space-y-3">
                        <a href="{{ route('teacher.reports.grades') }}"
                            class="block w-full px-4 py-3 bg-gradient-to-r from-purple-50 to-purple-100 text-purple-700 rounded-lg hover:from-purple-100 hover:to-purple-200 transition-all duration-200 text-center font-medium">
                            📊 Lihat Laporan Nilai
                        </a>
                        <button onclick="exportGrades()"
                            class="block w-full px-4 py-3 bg-gradient-to-r from-green-50 to-green-100 text-green-700 rounded-lg hover:from-green-100 hover:to-green-200 transition-all duration-200 text-center font-medium">
                            📥 Export Excel
                        </button>
                    </div>
                </div>
            </div>

            <!-- Attendance Reports -->
            <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 px-6 py-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-white">Laporan Absensi</h3>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-slate-600 mb-4">Generate laporan absensi siswa per kelas dan periode waktu</p>
                    <div class="space-y-3">
                        <a href="{{ route('teacher.reports.attendance') }}"
                            class="block w-full px-4 py-3 bg-gradient-to-r from-indigo-50 to-indigo-100 text-indigo-700 rounded-lg hover:from-indigo-100 hover:to-indigo-200 transition-all duration-200 text-center font-medium">
                            📋 Lihat Laporan Absensi
                        </a>
                        <button onclick="exportAttendance()"
                            class="block w-full px-4 py-3 bg-gradient-to-r from-green-50 to-green-100 text-green-700 rounded-lg hover:from-green-100 hover:to-green-200 transition-all duration-200 text-center font-medium">
                            📥 Export Excel
                        </button>
                    </div>
                </div>
            </div>

            <!-- Class Performance Reports -->
            <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 px-6 py-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-white">Performa Kelas</h3>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-slate-600 mb-4">Analisis performa dan statistik kelas yang diampu</p>
                    <div class="space-y-3">
                        <a href="{{ route('teacher.reports.performance') }}"
                            class="block w-full px-4 py-3 bg-gradient-to-r from-emerald-50 to-emerald-100 text-emerald-700 rounded-lg hover:from-emerald-100 hover:to-emerald-200 transition-all duration-200 text-center font-medium">
                            📈 Lihat Analisis
                        </a>
                        <button onclick="exportPerformance()"
                            class="block w-full px-4 py-3 bg-gradient-to-r from-green-50 to-green-100 text-green-700 rounded-lg hover:from-green-100 hover:to-green-200 transition-all duration-200 text-center font-medium">
                            📥 Export PDF
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Reports -->
        <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
            <div class="bg-gradient-to-r from-slate-100 to-slate-200 px-6 py-4 border-b border-slate-300">
                <h3 class="text-lg font-bold text-slate-800">Laporan Terbaru</h3>
            </div>
            <div class="p-6">
                @if ($recentReports && count($recentReports) > 0)
                    <div class="space-y-4">
                        @foreach ($recentReports as $report)
                            <div
                                class="flex items-center justify-between p-4 bg-gradient-to-r from-slate-50 to-slate-100 rounded-xl border border-slate-200">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 bg-cyan-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V7a2 2 0 012-2h10a2 2 0 012 2v12a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium text-slate-800">{{ $report['title'] }}</p>
                                        <p class="text-sm text-slate-500">{{ $report['description'] }} •
                                            {{ $report['date'] }}</p>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ $report['view_url'] }}"
                                        class="px-3 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-all duration-200">
                                        Lihat
                                    </a>
                                    <a href="{{ $report['download_url'] }}"
                                        class="px-3 py-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-all duration-200">
                                        Download
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V7a2 2 0 012-2h10a2 2 0 012 2v12a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <p class="text-slate-500 font-medium">Belum ada laporan yang dibuat</p>
                        <p class="text-sm text-slate-400">Mulai generate laporan untuk melihat riwayat di sini</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function exportGrades() {
            // Implementation for exporting grades
            window.location.href = "{{ route('teacher.reports.grades.export') }}";
        }

        function exportAttendance() {
            // Implementation for exporting attendance
            window.location.href = "{{ route('teacher.reports.attendance.export') }}";
        }

        function exportPerformance() {
            // Implementation for exporting performance report
            window.location.href = "{{ route('teacher.reports.performance.export') }}";
        }
    </script>
@endsection
