@extends('layouts.teacher')

@section('title', 'Laporan Absensi')

@section('content')
    <div class="p-6 bg-gradient-to-br from-blue-50 via-white to-amber-50 min-h-screen">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-slate-800">Laporan Absensi Siswa</h1>
                    <p class="mt-2 text-slate-600">Analisis dan export data kehadiran siswa berdasarkan kelas dan periode</p>
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
            <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 px-6 py-4">
                <h2 class="text-xl font-bold text-white">Filter Laporan</h2>
                <p class="text-indigo-100 text-sm">Pilih kelas dan periode untuk generate laporan absensi</p>
            </div>
            <form action="{{ route('teacher.reports.attendance') }}" method="GET" class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                    <!-- Class Filter -->
                    <div class="space-y-2">
                        <label for="class_id" class="block text-sm font-semibold text-slate-700">Kelas</label>
                        <select name="class_id" id="class_id"
                            class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200">
                            <option value="">Semua Kelas</option>
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
                            class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200">
                            <option value="">Semua Mata Pelajaran</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}"
                                    {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Start Date -->
                    <div class="space-y-2">
                        <label for="start_date" class="block text-sm font-semibold text-slate-700">Tanggal Mulai</label>
                        <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}"
                            class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200">
                    </div>

                    <!-- End Date -->
                    <div class="space-y-2">
                        <label for="end_date" class="block text-sm font-semibold text-slate-700">Tanggal Akhir</label>
                        <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}"
                            class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200">
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4">
                    <button type="submit"
                        class="flex-1 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white font-semibold py-3 px-6 rounded-xl hover:from-indigo-600 hover:to-indigo-700 focus:ring-4 focus:ring-indigo-500/20 transition-all duration-200 transform hover:scale-[1.02] shadow-lg">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Generate Laporan
                    </button>
                    <button type="button" onclick="exportExcel()"
                        class="flex-1 bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold py-3 px-6 rounded-xl hover:from-green-600 hover:to-green-700 focus:ring-4 focus:ring-green-500/20 transition-all duration-200 transform hover:scale-[1.02] shadow-lg">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        Export Excel
                    </button>
                </div>
            </form>
        </div>

        @if ($attendances && count($attendances) > 0)
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <!-- Present Rate -->
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-green-100 text-sm font-medium">Tingkat Kehadiran</p>
                                <p class="text-2xl font-bold text-white">
                                    {{ number_format($statistics['present_rate'], 1) }}%</p>
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

                <!-- Total Present -->
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-blue-100 text-sm font-medium">Total Hadir</p>
                                <p class="text-2xl font-bold text-white">{{ $statistics['total_present'] }}</p>
                            </div>
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Absent -->
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-red-100 text-sm font-medium">Total Absen</p>
                                <p class="text-2xl font-bold text-white">{{ $statistics['total_absent'] }}</p>
                            </div>
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364L18.364 5.636">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Late -->
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-amber-500 to-amber-600 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-amber-100 text-sm font-medium">Total Terlambat</p>
                                <p class="text-2xl font-bold text-white">{{ $statistics['total_late'] }}</p>
                            </div>
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Attendance Table -->
            <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
                <div class="bg-gradient-to-r from-slate-100 to-slate-200 px-6 py-4 border-b border-slate-300">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold text-slate-800">Data Absensi Siswa</h3>
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                            {{ count($attendances) }} data
                        </span>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-slate-50 border-b border-slate-200">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    No</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Nama Siswa</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Kelas</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Mata Pelajaran</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Tanggal</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            @foreach ($attendances as $index => $attendance)
                                <tr class="hover:bg-slate-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">{{ $index + 1 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                                <span class="text-xs font-bold text-blue-600">
                                                    {{ substr($attendance->student->user->name, 0, 2) }}
                                                </span>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-slate-900">
                                                    {{ $attendance->student->user->name }}</div>
                                                <div class="text-sm text-slate-500">{{ $attendance->student->student_id }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                        {{ $attendance->student->classes->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                        {{ $attendance->subject->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusConfig = [
                                                'present' => [
                                                    'label' => 'Hadir',
                                                    'color' => 'bg-green-100 text-green-800',
                                                    'icon' => '✓',
                                                ],
                                                'absent' => [
                                                    'label' => 'Absen',
                                                    'color' => 'bg-red-100 text-red-800',
                                                    'icon' => '✗',
                                                ],
                                                'late' => [
                                                    'label' => 'Terlambat',
                                                    'color' => 'bg-amber-100 text-amber-800',
                                                    'icon' => '⏰',
                                                ],
                                                'excused' => [
                                                    'label' => 'Izin',
                                                    'color' => 'bg-blue-100 text-blue-800',
                                                    'icon' => 'ℹ',
                                                ],
                                                'sick' => [
                                                    'label' => 'Sakit',
                                                    'color' => 'bg-purple-100 text-purple-800',
                                                    'icon' => '🏥',
                                                ],
                                            ];
                                            $config = $statusConfig[$attendance->status] ?? $statusConfig['absent'];
                                        @endphp
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $config['color'] }}">
                                            {{ $config['icon'] }} {{ $config['label'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                        {{ $attendance->date->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-500">
                                        {{ $attendance->notes ?? '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($attendances instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    <div class="px-6 py-4 bg-slate-50 border-t border-slate-200">
                        {{ $attendances->links() }}
                    </div>
                @endif
            </div>

            <!-- Summary by Student -->
            @if (isset($attendanceSummary) && count($attendanceSummary) > 0)
                <div class="mt-8 bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-cyan-500 to-cyan-600 px-6 py-4 border-b border-cyan-700">
                        <h3 class="text-lg font-bold text-white">Ringkasan Absensi per Siswa</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($attendanceSummary as $summary)
                                <div
                                    class="bg-gradient-to-r from-slate-50 to-slate-100 rounded-xl p-4 border border-slate-200">
                                    <div class="flex items-center space-x-3 mb-3">
                                        <div class="w-10 h-10 bg-cyan-100 rounded-full flex items-center justify-center">
                                            <span class="text-sm font-bold text-cyan-600">
                                                {{ substr($summary['name'], 0, 2) }}
                                            </span>
                                        </div>
                                        <div>
                                            <p class="font-medium text-slate-800">{{ $summary['name'] }}</p>
                                            <p class="text-xs text-slate-500">{{ $summary['class'] }}</p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2 gap-2 text-xs">
                                        <div class="bg-green-50 p-2 rounded">
                                            <p class="text-green-600 font-medium">Hadir: {{ $summary['present'] }}</p>
                                        </div>
                                        <div class="bg-red-50 p-2 rounded">
                                            <p class="text-red-600 font-medium">Absen: {{ $summary['absent'] }}</p>
                                        </div>
                                        <div class="bg-amber-50 p-2 rounded">
                                            <p class="text-amber-600 font-medium">Terlambat: {{ $summary['late'] }}</p>
                                        </div>
                                        <div class="bg-blue-50 p-2 rounded">
                                            <p class="text-blue-600 font-medium">Rate: {{ $summary['rate'] }}%</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
                <div class="p-12 text-center">
                    <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                        </path>
                    </svg>
                    <h3 class="text-lg font-semibold text-slate-700 mb-2">Belum Ada Data Absensi</h3>
                    <p class="text-slate-500 mb-4">Silakan pilih filter untuk menampilkan data absensi siswa</p>
                    <a href="{{ route('teacher.attendance.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Input Absensi Baru
                    </a>
                </div>
            </div>
        @endif
    </div>

    <script>
        function printReport() {
            window.print();
        }

        function exportExcel() {
            const params = new URLSearchParams(window.location.search);
            params.set('export', 'excel');
            window.location.href = "{{ route('teacher.reports.attendance.export') }}?" + params.toString();
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
