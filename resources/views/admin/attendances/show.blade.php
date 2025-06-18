<x-app-layout>
    <!-- Header Section -->
    <div
        class="bg-gradient-to-br from-emerald-50 via-white to-teal-50 relative overflow-hidden border-b border-gray-100 rounded-xl mb-6">
        <div class="absolute inset-0 bg-grid-pattern opacity-5"></div>
        <div class="relative px-6 py-8 sm:px-10">
            <div class="max-w-7xl mx-auto">
                <div class="flex items-center justify-between">
                    <div>
                        <div
                            class="inline-flex items-center px-4 py-2 rounded-full bg-emerald-100 text-emerald-700 text-sm font-medium mb-4">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Detail Kehadiran Siswa
                        </div>
                        <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-3">
                            Detail <span
                                class="bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">Kehadiran</span>
                        </h1>
                        <p class="text-lg text-gray-600">Informasi lengkap kehadiran siswa dan proses verifikasi</p>
                    </div>
                    <div class="hidden lg:block">
                        <div
                            class="w-20 h-20 bg-gradient-to-br from-emerald-100 to-teal-100 rounded-full flex items-center justify-center">
                            <svg class="w-10 h-10 text-emerald-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="px-6 py-8 space-y-8 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('admin.attendances.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Daftar Kehadiran
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Student Profile Card -->
                <div class="lg:col-span-1">
                    <div
                        class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
                        <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-indigo-50">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Profil Siswa</h3>
                                    <p class="text-sm text-gray-500">Informasi identitas siswa</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="text-center mb-6">
                                <div
                                    class="w-20 h-20 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <span class="text-2xl font-bold text-blue-700">
                                        {{ strtoupper(substr($attendance->student->user?->name ?? 'N', 0, 2)) }}
                                    </span>
                                </div>
                                <h4 class="text-xl font-bold text-gray-900 mb-2">
                                    {{ $attendance->student->user?->name ?? 'N/A' }}</h4>
                                <div class="space-y-2">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                        NIS: {{ $attendance->student->nis ?? 'N/A' }}
                                    </span>
                                    <div>
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                            {{ $attendance->student->classes?->name ?? 'N/A' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Attendance Information -->
                <div class="lg:col-span-2 space-y-6">
                    <div
                        class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
                        <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-emerald-50 to-teal-50">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-10 h-10 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Informasi Kehadiran</h3>
                                    <p class="text-sm text-gray-500">Detail lengkap kehadiran siswa</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-4">
                                    <div class="flex items-start space-x-3">
                                        <div
                                            class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                            <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-500">Mata Pelajaran</div>
                                            <div class="text-sm font-semibold text-gray-900">
                                                {{ $attendance->presence->classSchedule?->subject?->name ?? ($attendance->presence->subject?->name ?? 'N/A') }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-start space-x-3">
                                        <div
                                            class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-500">Guru Pengajar</div>
                                            <div class="text-sm font-semibold text-gray-900">
                                                {{ $attendance->presence->classSchedule?->teacher?->user?->name ?? ($attendance->presence->teacher?->user?->name ?? 'N/A') }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-start space-x-3">
                                        <div
                                            class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                            <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-500">Tanggal</div>
                                            <div class="text-sm font-semibold text-gray-900">
                                                {{ $attendance->presence->date?->format('d M Y') ?? 'N/A' }}</div>
                                        </div>
                                    </div>

                                    <div class="flex items-start space-x-3">
                                        <div
                                            class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-500">Waktu Pembelajaran</div>
                                            <div class="text-sm font-semibold text-gray-900">
                                                {{ $attendance->presence->start_time }} -
                                                {{ $attendance->presence->end_time }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-4">
                                    <div class="flex items-start space-x-3">
                                        <div
                                            class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                            <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                            </svg>
                                        </div>
                                        <div class="w-full">
                                            <div class="text-sm font-medium text-gray-500 mb-1">Topik Pembelajaran
                                            </div>
                                            <div
                                                class="text-sm font-semibold text-gray-900 bg-gray-50 p-3 rounded-lg border">
                                                {{ $attendance->presence->topic ?? 'Tidak ada topik' }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-start space-x-3">
                                        <div
                                            class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                            <svg class="w-4 h-4 text-emerald-600" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-500 mb-2">Status Kehadiran</div>
                                            @if ($attendance->status == 'present')
                                                <span
                                                    class="inline-flex items-center px-3 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 border border-green-200">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    Hadir
                                                </span>
                                            @elseif ($attendance->status == 'absent')
                                                <span
                                                    class="inline-flex items-center px-3 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-red-100 to-pink-100 text-red-800 border border-red-200">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                    Tidak Hadir
                                                </span>
                                            @elseif ($attendance->status == 'sick')
                                                <span
                                                    class="inline-flex items-center px-3 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-yellow-100 to-amber-100 text-yellow-800 border border-yellow-200">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                    </svg>
                                                    Sakit
                                                </span>
                                            @elseif ($attendance->status == 'permission')
                                                <span
                                                    class="inline-flex items-center px-3 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-800 border border-blue-200">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                    </svg>
                                                    Izin
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-3 py-2 rounded-full text-sm font-semibold bg-gray-100 text-gray-800 border border-gray-200">
                                                    {{ $attendance->status }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Verification Status Card -->
                    <div
                        class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
                        <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-amber-50 to-yellow-50">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-10 h-10 bg-gradient-to-r from-amber-500 to-yellow-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Status Verifikasi</h3>
                                    <p class="text-sm text-gray-500">Informasi verifikasi kehadiran</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="flex items-start space-x-3">
                                    <div
                                        class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-sm font-medium text-gray-500 mb-2">Status Verifikasi</div>
                                        @if ($attendance->verification_status == 'pending')
                                            <div class="flex items-center space-x-3">
                                                <span
                                                    class="inline-flex items-center px-3 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-yellow-100 to-amber-100 text-yellow-800 border border-yellow-200">
                                                    <svg class="w-4 h-4 mr-2 animate-spin" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 2v4m0 12v4M4.22 4.22l2.83 2.83m8.49 8.49l2.83 2.83M2 12h4m12 0h4M4.22 19.78l2.83-2.83m8.49-8.49l2.83-2.83" />
                                                    </svg>
                                                    Menunggu Verifikasi
                                                </span>
                                                <div class="text-sm text-gray-500">Belum diverifikasi oleh admin</div>
                                            </div>
                                        @elseif ($attendance->verification_status == 'verified')
                                            <div class="space-y-3">
                                                <span
                                                    class="inline-flex items-center px-3 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 border border-green-200">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                                    </svg>
                                                    Terverifikasi
                                                </span>
                                                <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                                                    <div class="text-sm text-green-800">
                                                        <strong>Diverifikasi oleh:</strong>
                                                        {{ $attendance->verifier?->name ?? 'N/A' }}<br>
                                                        <strong>Tanggal:</strong>
                                                        {{ $attendance->verified_at?->format('d M Y H:i') ?? 'N/A' }}
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="space-y-3">
                                                <span
                                                    class="inline-flex items-center px-3 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-red-100 to-pink-100 text-red-800 border border-red-200">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728" />
                                                    </svg>
                                                    Ditolak
                                                </span>
                                                <div class="bg-red-50 border border-red-200 rounded-lg p-3">
                                                    <div class="text-sm text-red-800">
                                                        <strong>Ditolak oleh:</strong>
                                                        {{ $attendance->verifier?->name ?? 'N/A' }}<br>
                                                        <strong>Tanggal:</strong>
                                                        {{ $attendance->verified_at?->format('d M Y H:i') ?? 'N/A' }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                @if ($attendance->verification_note)
                                    <div class="flex items-start space-x-3">
                                        <div
                                            class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <div class="text-sm font-medium text-gray-500 mb-2">Catatan Verifikasi
                                            </div>
                                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-3">
                                                <div class="text-sm text-gray-900">
                                                    {{ $attendance->verification_note }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Verification Form -->
            @if ($attendance->verification_status == 'pending')
                <div class="mt-8">
                    <div
                        class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
                        <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-indigo-50 to-purple-50">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Formulir Verifikasi</h3>
                                    <p class="text-sm text-gray-500">Lakukan verifikasi terhadap kehadiran siswa</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <form action="{{ route('admin.attendances.verify', $attendance) }}" method="POST"
                                class="space-y-6">
                                @csrf

                                <div class="space-y-3">
                                    <label for="verification_status"
                                        class="block text-sm font-semibold text-gray-700">
                                        Status Verifikasi <span class="text-red-500">*</span>
                                    </label>
                                    <select id="verification_status" name="verification_status"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                                        <option value="">Pilih Status Verifikasi</option>
                                        <option value="verified" class="text-green-600">✓ Terverifikasi</option>
                                        <option value="rejected" class="text-red-600">✗ Ditolak</option>
                                    </select>
                                    @error('verification_status')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="space-y-3">
                                    <label for="verification_note" class="block text-sm font-semibold text-gray-700">
                                        Catatan Verifikasi <span class="text-gray-400">(Opsional)</span>
                                    </label>
                                    <textarea id="verification_note" name="verification_note" rows="4"
                                        placeholder="Masukkan catatan atau alasan verifikasi..."
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200 resize-none"></textarea>
                                    @error('verification_note')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                                    <div class="flex items-center space-x-2 text-sm text-gray-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>Pastikan keputusan verifikasi sudah sesuai</span>
                                    </div>
                                    <button type="submit"
                                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 border border-transparent rounded-xl font-semibold text-sm text-white uppercase tracking-wide hover:from-indigo-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        Simpan Verifikasi
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
