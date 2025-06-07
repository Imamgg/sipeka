<x-teacher-layout>
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                        <svg class="w-8 h-8 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Detail Jadwal
                    </h1>
                    <p class="text-gray-600 mt-2">Lihat informasi detail tentang jadwal ini</p>
                </div>
                <div class="mt-4 sm:mt-0">
                    <a href="{{ route('teacher.schedules.index') }}"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Jadwal
                    </a>
                </div>
            </div>

            <!-- Alert Messages -->
            @if (session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-4 rounded-r-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-green-800">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4 rounded-r-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-red-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-red-800">{{ session('error') }}</span>
                    </div>
                </div>
            @endif <!-- Schedule Information -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Schedule Details Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-blue-600 px-6 py-4">
                        <h2 class="text-lg font-semibold text-white flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Informasi Jadwal
                        </h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-start justify-between py-3 border-b border-gray-100 last:border-b-0">
                            <span class="text-sm font-medium text-gray-500 w-24">Mata Pelajaran:</span>
                            <span class="text-sm text-gray-900 font-semibold">{{ $schedule->subject->name }}</span>
                        </div>
                        <div class="flex items-start justify-between py-3 border-b border-gray-100 last:border-b-0">
                            <span class="text-sm font-medium text-gray-500 w-24">Kelas:</span>
                            <span
                                class="inline-flex px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                {{ $schedule->classes->name }}
                            </span>
                        </div>
                        <div class="flex items-start justify-between py-3 border-b border-gray-100 last:border-b-0">
                            <span class="text-sm font-medium text-gray-500 w-24">Hari:</span>
                            <span class="text-sm text-gray-900">{{ $schedule->day }}</span>
                        </div>
                        <div class="flex items-start justify-between py-3 border-b border-gray-100 last:border-b-0">
                            <span class="text-sm font-medium text-gray-500 w-24">Waktu:</span>
                            <span class="text-sm text-gray-900 flex items-center">
                                <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ date('H:i', strtotime($schedule->start_time)) }} -
                                {{ date('H:i', strtotime($schedule->end_time)) }}
                            </span>
                        </div>
                        <div class="flex items-start justify-between py-3">
                            <span class="text-sm font-medium text-gray-500 w-24">Durasi:</span>
                            <span class="text-sm text-gray-900">
                                @php
                                    $start = \Carbon\Carbon::parse($schedule->start_time);
                                    $end = \Carbon\Carbon::parse($schedule->end_time);
                                    $duration = $start->diffInMinutes($end);
                                @endphp
                                {{ $duration }} menit
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Class Information Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-emerald-600 px-6 py-4">
                        <h2 class="text-lg font-semibold text-white flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Informasi Kelas
                        </h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-start justify-between py-3 border-b border-gray-100 last:border-b-0">
                            <span class="text-sm font-medium text-gray-500 w-32">Nama Kelas:</span>
                            <span class="text-sm text-gray-900 font-semibold">{{ $schedule->classes->name }}</span>
                        </div>
                        <div class="flex items-start justify-between py-3 border-b border-gray-100 last:border-b-0">
                            <span class="text-sm font-medium text-gray-500 w-32">Total Siswa:</span>
                            <span
                                class="inline-flex px-2 py-1 text-xs font-medium bg-emerald-100 text-emerald-800 rounded-full">
                                {{ $schedule->classes->students->count() }} siswa
                            </span>
                        </div>
                        @if ($schedule->classes->description)
                            <div class="flex items-start justify-between py-3">
                                <span class="text-sm font-medium text-gray-500 w-32">Deskripsi:</span>
                                <span class="text-sm text-gray-900">{{ $schedule->classes->description }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div> <!-- Students in Class -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-8">
                <div class="bg-indigo-600 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-white flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                            </svg>
                            Siswa di {{ $schedule->classes->name }}
                        </h2>
                        <span class="inline-flex px-2 py-1 text-xs font-medium bg-white text-indigo-800 rounded-full">
                            {{ $schedule->classes->students->count() }} siswa
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    @if ($schedule->classes->students->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            No</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nama</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Email</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($schedule->classes->students as $index => $student)
                                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $index + 1 }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-8 w-8">
                                                        <div
                                                            class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center">
                                                            <span class="text-sm font-medium text-indigo-800">
                                                                {{ substr($student->user->name, 0, 1) }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="ml-3">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $student->user->name }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $student->user->email ?? '-' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <a href="{{ route('teacher.students.show', $student) }}"
                                                    class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada siswa ditemukan</h3>
                            <p class="text-gray-500">Kelas ini belum memiliki siswa.</p>
                        </div>
                    @endif
                </div>
            </div> <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-amber-500 px-6 py-4">
                    <h2 class="text-lg font-semibold text-white flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Tindakan Cepat
                    </h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <a href="{{ route('teacher.attendance.create', ['class_id' => $schedule->classes->id, 'subject_id' => $schedule->subject->id]) }}"
                            class="group flex flex-col items-center p-6 bg-green-50 border border-green-200 rounded-lg hover:bg-green-100 hover:border-green-300 transition-all duration-200 hover:shadow-md">
                            <div
                                class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-lg group-hover:bg-green-200 transition-colors duration-200">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="mt-3 text-sm font-medium text-gray-900 text-center">Ambil Kehadiran</h3>
                            <p class="mt-1 text-xs text-gray-500 text-center">Catat kehadiran siswa</p>
                        </a>

                        <a href="{{ route('teacher.grades.create', ['class_id' => $schedule->classes->id, 'subject_id' => $schedule->subject->id]) }}"
                            class="group flex flex-col items-center p-6 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 hover:border-blue-300 transition-all duration-200 hover:shadow-md">
                            <div
                                class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-lg group-hover:bg-blue-200 transition-colors duration-200">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <h3 class="mt-3 text-sm font-medium text-gray-900 text-center">Tambah Nilai</h3>
                            <p class="mt-1 text-xs text-gray-500 text-center">Catat nilai siswa</p>
                        </a>

                        <a href="{{ route('teacher.materials.create', ['class_id' => $schedule->classes->id, 'subject_id' => $schedule->subject->id]) }}"
                            class="group flex flex-col items-center p-6 bg-purple-50 border border-purple-200 rounded-lg hover:bg-purple-100 hover:border-purple-300 transition-all duration-200 hover:shadow-md">
                            <div
                                class="flex items-center justify-center w-12 h-12 bg-purple-100 rounded-lg group-hover:bg-purple-200 transition-colors duration-200">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                            </div>
                            <h3 class="mt-3 text-sm font-medium text-gray-900 text-center">Upload Materi</h3>
                            <p class="mt-1 text-xs text-gray-500 text-center">Bagikan materi pembelajaran</p>
                        </a>

                        <a href="{{ route('teacher.students.index', ['class_id' => $schedule->classes->id]) }}"
                            class="group flex flex-col items-center p-6 bg-orange-50 border border-orange-200 rounded-lg hover:bg-orange-100 hover:border-orange-300 transition-all duration-200 hover:shadow-md">
                            <div
                                class="flex items-center justify-center w-12 h-12 bg-orange-100 rounded-lg group-hover:bg-orange-200 transition-colors duration-200">
                                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <h3 class="mt-3 text-sm font-medium text-gray-900 text-center">Lihat Siswa</h3>
                            <p class="mt-1 text-xs text-gray-500 text-center">Kelola siswa kelas ini</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-teacher-layout>
