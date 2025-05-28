@extends('layouts.teacher')

@section('title', 'Laporan Performa Kelas')

@section('content')
    <div class="p-6 bg-gradient-to-br from-blue-50 via-white to-amber-50 min-h-screen">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-slate-800">Laporan Performa Kelas</h1>
                    <p class="mt-2 text-slate-600">Analisis mendalam performa akademik dan kehadiran siswa per kelas</p>
                </div>
                <div class="mt-4 lg:mt-0 flex space-x-3">
                    <button onclick="printReport()"
                        class="inline-flex items-center px-4 py-2 bg-blue-100 border border-blue-300 rounded-lg text-sm font-medium text-blue-700 hover:bg-blue-200 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                            </path>
                        </svg>
                        Print Laporan
                    </button>
                    <a href="{{ route('teacher.reports.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-slate-100 border border-slate-300 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-200 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 px-6 py-4">
                <h2 class="text-xl font-bold text-white">Filter Analisis</h2>
                <p class="text-emerald-100 text-sm">Pilih kelas dan periode untuk analisis performa</p>
            </div>
            <form action="{{ route('teacher.reports.performance') }}" method="GET" class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <!-- Class Filter -->
                    <div class="space-y-2">
                        <label for="class_id" class="block text-sm font-semibold text-slate-700">Kelas</label>
                        <select name="class_id" id="class_id"
                            class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-200">
                            <option value="">Pilih Kelas</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}"
                                    {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                    {{ $class->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Subject Filter -->
                    <div class="space-y-2">
                        <label for="subject_id" class="block text-sm font-semibold text-slate-700">Mata Pelajaran</label>
                        <select name="subject_id" id="subject_id"
                            class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-200">
                            <option value="">Semua Mata Pelajaran</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}"
                                    {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Period Filter -->
                    <div class="space-y-2">
                        <label for="period" class="block text-sm font-semibold text-slate-700">Periode</label>
                        <select name="period" id="period"
                            class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-200">
                            <option value="all" {{ request('period') == 'all' ? 'selected' : '' }}>Semua Periode</option>
                            <option value="this_month" {{ request('period') == 'this_month' ? 'selected' : '' }}>Bulan Ini
                            </option>
                            <option value="last_month" {{ request('period') == 'last_month' ? 'selected' : '' }}>Bulan Lalu
                            </option>
                            <option value="this_semester" {{ request('period') == 'this_semester' ? 'selected' : '' }}>
                                Semester Ini</option>
                            <option value="last_semester" {{ request('period') == 'last_semester' ? 'selected' : '' }}>
                                Semester Lalu</option>
                        </select>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4">
                    <button type="submit"
                        class="flex-1 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white font-semibold py-3 px-6 rounded-xl hover:from-emerald-600 hover:to-emerald-700 focus:ring-4 focus:ring-emerald-500/20 transition-all duration-200 transform hover:scale-[1.02] shadow-lg">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                        Analisis Performa
                    </button>
                    <button type="button" onclick="exportPDF()"
                        class="flex-1 bg-gradient-to-r from-red-500 to-red-600 text-white font-semibold py-3 px-6 rounded-xl hover:from-red-600 hover:to-red-700 focus:ring-4 focus:ring-red-500/20 transition-all duration-200 transform hover:scale-[1.02] shadow-lg">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        Export PDF
                    </button>
                </div>
            </form>
        </div>

        @if (isset($performanceData) && $performanceData)
            <!-- Overview Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Class Average -->
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-blue-100 text-sm font-medium">Rata-rata Kelas</p>
                                <p class="text-2xl font-bold text-white">
                                    {{ number_format($performanceData['class_average'], 1) }}</p>
                            </div>
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Attendance Rate -->
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-green-100 text-sm font-medium">Tingkat Kehadiran</p>
                                <p class="text-2xl font-bold text-white">
                                    {{ number_format($performanceData['attendance_rate'], 1) }}%</p>
                            </div>
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Students -->
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-500 to-purple-600 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-purple-100 text-sm font-medium">Total Siswa</p>
                                <p class="text-2xl font-bold text-white">{{ $performanceData['total_students'] }}</p>
                            </div>
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Performance Trend -->
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-amber-500 to-amber-600 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-amber-100 text-sm font-medium">Tren Performa</p>
                                <div class="flex items-center">
                                    <p class="text-2xl font-bold text-white mr-2">
                                        {{ $performanceData['trend'] > 0 ? '+' : '' }}{{ number_format($performanceData['trend'], 1) }}%
                                    </p>
                                    @if ($performanceData['trend'] > 0)
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                                        </svg>
                                    @elseif($performanceData['trend'] < 0)
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 12H4"></path>
                                        </svg>
                                    @endif
                                </div>
                            </div>
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grade Distribution Chart -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Grade Distribution -->
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 px-6 py-4">
                        <h3 class="text-lg font-bold text-white">Distribusi Nilai</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach ($performanceData['grade_distribution'] as $grade => $data)
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="w-8 h-8 bg-{{ $data['color'] }}-100 rounded-lg flex items-center justify-center">
                                            <span
                                                class="text-{{ $data['color'] }}-600 font-bold text-sm">{{ $grade }}</span>
                                        </div>
                                        <span class="text-slate-700 font-medium">Grade {{ $grade }}</span>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <div class="w-24 bg-slate-200 rounded-full h-2">
                                            <div class="bg-{{ $data['color'] }}-500 h-2 rounded-full"
                                                style="width: {{ $data['percentage'] }}%"></div>
                                        </div>
                                        <span class="text-sm font-medium text-slate-600 w-12">{{ $data['count'] }}
                                            ({{ number_format($data['percentage'], 1) }}%)</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Attendance Trend -->
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-cyan-500 to-cyan-600 px-6 py-4">
                        <h3 class="text-lg font-bold text-white">Tren Kehadiran</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach ($performanceData['attendance_breakdown'] as $status => $data)
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-3 h-3 bg-{{ $data['color'] }}-500 rounded-full"></div>
                                        <span class="text-slate-700 font-medium">{{ $data['label'] }}</span>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <div class="w-24 bg-slate-200 rounded-full h-2">
                                            <div class="bg-{{ $data['color'] }}-500 h-2 rounded-full"
                                                style="width: {{ $data['percentage'] }}%"></div>
                                        </div>
                                        <span class="text-sm font-medium text-slate-600 w-12">{{ $data['count'] }}
                                            ({{ number_format($data['percentage'], 1) }}%)</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Student Performance Details -->
            <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
                <div class="bg-gradient-to-r from-slate-100 to-slate-200 px-6 py-4 border-b border-slate-300">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold text-slate-800">Detail Performa Siswa</h3>
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                            {{ count($performanceData['students']) }} siswa
                        </span>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-slate-50 border-b border-slate-200">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Ranking</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Nama Siswa</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Rata-rata Nilai</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Grade</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Kehadiran</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Total Nilai</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            @foreach ($performanceData['students'] as $index => $student)
                                <tr class="hover:bg-slate-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            @if ($index < 3)
                                                <div
                                                    class="w-8 h-8 bg-gradient-to-r 
                                                {{ $index === 0 ? 'from-yellow-400 to-yellow-500' : '' }}
                                                {{ $index === 1 ? 'from-gray-300 to-gray-400' : '' }}
                                                {{ $index === 2 ? 'from-orange-400 to-orange-500' : '' }}
                                                rounded-full flex items-center justify-center">
                                                    <span class="text-white font-bold text-sm">{{ $index + 1 }}</span>
                                                </div>
                                            @else
                                                <span class="text-slate-600 font-medium">{{ $index + 1 }}</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                                <span class="text-xs font-bold text-blue-600">
                                                    {{ substr($student['name'], 0, 2) }}
                                                </span>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-slate-900">{{ $student['name'] }}
                                                </div>
                                                <div class="text-sm text-slate-500">{{ $student['student_id'] }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="text-lg font-bold 
                                        {{ $student['average'] >= 80 ? 'text-green-600' : '' }}
                                        {{ $student['average'] >= 70 && $student['average'] < 80 ? 'text-blue-600' : '' }}
                                        {{ $student['average'] >= 60 && $student['average'] < 70 ? 'text-yellow-600' : '' }}
                                        {{ $student['average'] < 60 ? 'text-red-600' : '' }}">
                                            {{ number_format($student['average'], 1) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $avg = $student['average'];
                                            $gradeLetter =
                                                $avg >= 80 ? 'A' : ($avg >= 70 ? 'B' : ($avg >= 60 ? 'C' : 'D'));
                                            $gradeColor =
                                                $avg >= 80
                                                    ? 'bg-green-100 text-green-800'
                                                    : ($avg >= 70
                                                        ? 'bg-blue-100 text-blue-800'
                                                        : ($avg >= 60
                                                            ? 'bg-yellow-100 text-yellow-800'
                                                            : 'bg-red-100 text-red-800'));
                                        @endphp
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $gradeColor }}">
                                            {{ $gradeLetter }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="text-sm font-medium {{ $student['attendance_rate'] >= 90 ? 'text-green-600' : ($student['attendance_rate'] >= 80 ? 'text-blue-600' : 'text-red-600') }}">
                                            {{ number_format($student['attendance_rate'], 1) }}%
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                        {{ $student['total_grades'] }} nilai
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        {{ $student['status'] === 'excellent' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $student['status'] === 'good' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $student['status'] === 'average' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $student['status'] === 'needs_improvement' ? 'bg-red-100 text-red-800' : '' }}">
                                            {{ $student['status_label'] }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Performance Analysis -->
            <div class="mt-8 bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
                <div class="bg-gradient-to-r from-violet-500 to-violet-600 px-6 py-4">
                    <h3 class="text-lg font-bold text-white">Analisis dan Rekomendasi</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Strengths -->
                        <div class="space-y-4">
                            <h4 class="text-lg font-semibold text-green-700 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Kekuatan Kelas
                            </h4>
                            <div class="space-y-2">
                                @foreach ($performanceData['analysis']['strengths'] as $strength)
                                    <div class="flex items-start space-x-2">
                                        <div class="w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                        <p class="text-slate-700">{{ $strength }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Areas for Improvement -->
                        <div class="space-y-4">
                            <h4 class="text-lg font-semibold text-amber-700 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5C2.962 18.333 3.924 20 5.464 20z">
                                    </path>
                                </svg>
                                Area Pengembangan
                            </h4>
                            <div class="space-y-2">
                                @foreach ($performanceData['analysis']['improvements'] as $improvement)
                                    <div class="flex items-start space-x-2">
                                        <div class="w-2 h-2 bg-amber-500 rounded-full mt-2"></div>
                                        <p class="text-slate-700">{{ $improvement }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Recommendations -->
                    <div class="mt-6 pt-6 border-t border-slate-200">
                        <h4 class="text-lg font-semibold text-blue-700 flex items-center mb-4">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
                                </path>
                            </svg>
                            Rekomendasi Tindakan
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach ($performanceData['analysis']['recommendations'] as $recommendation)
                                <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                                    <p class="text-blue-800 font-medium">{{ $recommendation['title'] }}</p>
                                    <p class="text-blue-600 text-sm mt-1">{{ $recommendation['description'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
                <div class="p-12 text-center">
                    <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                        </path>
                    </svg>
                    <h3 class="text-lg font-semibold text-slate-700 mb-2">Pilih Kelas untuk Analisis</h3>
                    <p class="text-slate-500 mb-4">Silakan pilih kelas dari filter di atas untuk melihat analisis performa
                    </p>
                </div>
            </div>
        @endif
    </div>

    <script>
        function printReport() {
            window.print();
        }

        function exportPDF() {
            const params = new URLSearchParams(window.location.search);
            params.set('export', 'pdf');
            window.location.href = "{{ route('teacher.reports.performance.export') }}?" + params.toString();
        }
    </script>

    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            .print-break {
                page-break-after: always;
            }
        }
    </style>
@endsection
