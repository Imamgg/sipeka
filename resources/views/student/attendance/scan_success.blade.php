<x-student-layout>
    <div class="p-6">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Absensi Berhasil</h1>
                    <p class="text-gray-600">Kehadiran Anda telah tercatat dalam sistem</p>
                </div>
                <a href="{{ route('student.attendances.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg font-semibold transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Daftar
                </a>
            </div>
        </div>

        <div class="max-w-4xl mx-auto">
            <!-- Success Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <!-- Success Header with Gradient -->
                <div class="bg-gradient-to-r from-emerald-500 via-green-500 to-teal-500 p-8">
                    <div class="text-center">
                        <div
                            class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-white mb-2">Absensi Berhasil!</h2>
                        <p class="text-emerald-100 text-lg">Kehadiran Anda telah tercatat dalam sistem</p>
                    </div>
                </div>

                <div class="p-8">
                    <!-- Main Information Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <!-- Student Information Card -->
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-100">
                            <div class="flex items-start">
                                <div
                                    class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-sm font-semibold text-blue-600 mb-2">Informasi Siswa</h3>
                                    <p class="text-xl font-bold text-blue-900 mb-1">{{ $student->user->name }}</p>
                                    <div class="space-y-1 text-sm text-blue-700">
                                        <p><span class="font-medium">NISN:</span> {{ $student->nisn }}</p>
                                        <p><span class="font-medium">Kelas:</span> {{ $student->classes->class_name }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Attendance Status Card -->
                        <div
                            class="bg-gradient-to-br from-emerald-50 to-green-50 rounded-2xl p-6 border border-emerald-100">
                            <div class="flex items-start">
                                <div
                                    class="w-12 h-12 bg-emerald-500 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-sm font-semibold text-emerald-600 mb-2">Status Kehadiran</h3>
                                    <div class="flex items-center space-x-3 mb-2">
                                        @if ($presenceDetail->status == 'present')
                                            <span
                                                class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Hadir
                                            </span>
                                        @elseif($presenceDetail->status == 'late')
                                            <span
                                                class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-amber-100 text-amber-800 border border-amber-200">
                                                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Terlambat
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-blue-100 text-blue-800 border border-blue-200">
                                                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                {{ ucfirst($presenceDetail->status) }}
                                            </span>
                                        @endif
                                    </div>
                                    <p class="text-sm text-emerald-700">
                                        Tercatat pada
                                        {{ \Carbon\Carbon::parse($presenceDetail->verified_at)->timezone('Asia/Jakarta')->format('H:i:s') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Session Details Card -->
                    <div
                        class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-6 border border-purple-100 mb-8">
                        <div class="flex items-start">
                            <div
                                class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-sm font-semibold text-purple-600 mb-3">Detail Sesi Pembelajaran</h3>
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-xl font-bold text-purple-900">
                                            {{ $presenceDetail->presence->topic }}</p>
                                        <p class="text-lg text-purple-700 font-semibold">
                                            {{ $presenceDetail->presence->subject->subject_name }}</p>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-purple-700">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-purple-500" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3a1 1 0 012 0v4M8 7H6a1 1 0 00-1 1v8a1 1 0 001 1h12a1 1 0 001-1V8a1 1 0 00-1-1h-2M8 7h8M9 3a1 1 0 012 0v4M9 3h6" />
                                            </svg>
                                            {{ \Carbon\Carbon::parse($presenceDetail->presence->date)->format('d F Y') }}
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-purple-500" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $presenceDetail->presence->start_time }} -
                                            {{ $presenceDetail->presence->end_time }}
                                        </div>
                                    </div>

                                    @if ($presenceDetail->presence->note)
                                        <div class="mt-3 p-3 bg-purple-100 rounded-lg">
                                            <p class="text-sm text-purple-800"><strong>Catatan:</strong>
                                                {{ $presenceDetail->presence->note }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div
                        class="flex flex-col sm:flex-row justify-between items-center pt-6 border-t border-gray-100 space-y-4 sm:space-y-0">
                        <div class="text-gray-500 text-sm font-mono bg-gray-50 px-3 py-2 rounded-lg">
                            Token: {{ $presenceDetail->presence->qr_code_token }}
                        </div>

                        <div class="flex space-x-3">
                            <a href="{{ route('student.attendances.index') }}"
                                class="inline-flex items-center px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-xl transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z" />
                                </svg>
                                Lihat Riwayat
                            </a>
                            <a href="{{ route('student.attendances.scan') }}"
                                class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-semibold rounded-xl transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h4m-4 8h4M4 4h4m0 0V2m0 2h4m0 0V2m0 2v2M4 4v4m0 0h4m0 0V6" />
                                </svg>
                                Scan QR Lagi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-student-layout>
