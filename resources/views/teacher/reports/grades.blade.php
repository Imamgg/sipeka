@extends('layouts.teacher')

@section('title', 'Laporan Nilai')

@section('content')
    <div class="p-6 bg-gradient-to-br from-blue-50 via-white to-amber-50 min-h-screen">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-slate-800">Laporan Nilai Siswa</h1>
                    <p class="mt-2 text-slate-600">Analisis dan export data nilai siswa berdasarkan kelas dan mata pelajaran
                    </p>
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
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 px-6 py-4">
                <h2 class="text-xl font-bold text-white">Filter Laporan</h2>
                <p class="text-purple-100 text-sm">Pilih kelas dan mata pelajaran untuk generate laporan</p>
            </div>
            <form action="{{ route('teacher.reports.grades') }}" method="GET" class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <!-- Class Filter -->
                    <div class="space-y-2">
                        <label for="class_id" class="block text-sm font-semibold text-slate-700">Kelas</label>
                        <select name="class_id" id="class_id" onchange="loadStudents()"
                            class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-purple-500/20 focus:border-purple-500 transition-all duration-200">
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
                            class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-purple-500/20 focus:border-purple-500 transition-all duration-200">
                            <option value="">Semua Mata Pelajaran</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}"
                                    {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Grade Type Filter -->
                    <div class="space-y-2">
                        <label for="grade_type" class="block text-sm font-semibold text-slate-700">Jenis Nilai</label>
                        <select name="grade_type" id="grade_type"
                            class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-purple-500/20 focus:border-purple-500 transition-all duration-200">
                            <option value="">Semua Jenis</option>
                            <option value="tugas" {{ request('grade_type') == 'tugas' ? 'selected' : '' }}>Tugas</option>
                            <option value="uts" {{ request('grade_type') == 'uts' ? 'selected' : '' }}>UTS</option>
                            <option value="uas" {{ request('grade_type') == 'uas' ? 'selected' : '' }}>UAS</option>
                            <option value="quiz" {{ request('grade_type') == 'quiz' ? 'selected' : '' }}>Quiz</option>
                        </select>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4">
                    <button type="submit"
                        class="flex-1 bg-gradient-to-r from-purple-500 to-purple-600 text-white font-semibold py-3 px-6 rounded-xl hover:from-purple-600 hover:to-purple-700 focus:ring-4 focus:ring-purple-500/20 transition-all duration-200 transform hover:scale-[1.02] shadow-lg">
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

        @if ($grades && count($grades) > 0)
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <!-- Average Grade -->
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-blue-100 text-sm font-medium">Rata-rata Nilai</p>
                                <p class="text-2xl font-bold text-white">{{ number_format($statistics['average'], 1) }}</p>
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

                <!-- Highest Grade -->
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-emerald-100 text-sm font-medium">Nilai Tertinggi</p>
                                <p class="text-2xl font-bold text-white">{{ $statistics['highest'] }}</p>
                            </div>
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Lowest Grade -->
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-red-100 text-sm font-medium">Nilai Terendah</p>
                                <p class="text-2xl font-bold text-white">{{ $statistics['lowest'] }}</p>
                            </div>
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Passing Rate -->
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-500 to-purple-600 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-purple-100 text-sm font-medium">Tingkat Kelulusan</p>
                                <p class="text-2xl font-bold text-white">
                                    {{ number_format($statistics['passing_rate'], 1) }}%</p>
                            </div>
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grades Table -->
            <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
                <div class="bg-gradient-to-r from-slate-100 to-slate-200 px-6 py-4 border-b border-slate-300">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold text-slate-800">Data Nilai Siswa</h3>
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                            {{ count($grades) }} data
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
                                    Jenis</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Nilai</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Grade</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            @foreach ($grades as $index => $grade)
                                <tr class="hover:bg-slate-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">{{ $index + 1 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                                <span class="text-xs font-bold text-blue-600">
                                                    {{ substr($grade->student->user->name, 0, 2) }}
                                                </span>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-slate-900">
                                                    {{ $grade->student->user->name }}</div>
                                                <div class="text-sm text-slate-500">{{ $grade->student->student_id }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                        {{ $grade->student->classes->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                        {{ $grade->subject->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        {{ $grade->grade_type == 'tugas' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $grade->grade_type == 'uts' ? 'bg-purple-100 text-purple-800' : '' }}
                                        {{ $grade->grade_type == 'uas' ? 'bg-red-100 text-red-800' : '' }}
                                        {{ $grade->grade_type == 'quiz' ? 'bg-green-100 text-green-800' : '' }}">
                                            {{ ucfirst($grade->grade_type) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="text-sm font-bold
                                        {{ $grade->grade >= 80 ? 'text-green-600' : '' }}
                                        {{ $grade->grade >= 70 && $grade->grade < 80 ? 'text-blue-600' : '' }}
                                        {{ $grade->grade >= 60 && $grade->grade < 70 ? 'text-yellow-600' : '' }}
                                        {{ $grade->grade < 60 ? 'text-red-600' : '' }}">
                                            {{ $grade->grade }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $gradeValue = $grade->grade;
                                            $gradeLetter =
                                                $gradeValue >= 80
                                                    ? 'A'
                                                    : ($gradeValue >= 70
                                                        ? 'B'
                                                        : ($gradeValue >= 60
                                                            ? 'C'
                                                            : 'D'));
                                            $gradeColor =
                                                $gradeValue >= 80
                                                    ? 'bg-green-100 text-green-800'
                                                    : ($gradeValue >= 70
                                                        ? 'bg-blue-100 text-blue-800'
                                                        : ($gradeValue >= 60
                                                            ? 'bg-yellow-100 text-yellow-800'
                                                            : 'bg-red-100 text-red-800'));
                                        @endphp
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $gradeColor }}">
                                            {{ $gradeLetter }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                        {{ $grade->created_at->format('d M Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($grades instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    <div class="px-6 py-4 bg-slate-50 border-t border-slate-200">
                        {{ $grades->links() }}
                    </div>
                @endif
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
                    <h3 class="text-lg font-semibold text-slate-700 mb-2">Belum Ada Data Nilai</h3>
                    <p class="text-slate-500 mb-4">Silakan pilih filter untuk menampilkan data nilai siswa</p>
                    <a href="{{ route('teacher.grades.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Input Nilai Baru
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
            window.location.href = "{{ route('teacher.reports.grades.export') }}?" + params.toString();
        }

        function loadStudents() {
            // Implementation for dynamic student loading if needed
            console.log('Loading students for class...');
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
