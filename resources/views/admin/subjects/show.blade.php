@props(['subject'])
<x-app-layout>
    <!-- Header Section with Gradient Background -->
    <div class="bg-gradient-to-br from-blue-50 via-white to-cyan-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <!-- Page Badge -->
                <div
                    class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-gradient-to-r from-blue-100 to-cyan-100 text-blue-800 border border-blue-200 mb-4">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                    Detail Mata Pelajaran
                </div>

                <!-- Main Title -->
                <h1 class="text-4xl font-bold text-gray-900 mb-3">
                    <span class="bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent">
                        {{ $subject->subject_name }}
                    </span>
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Kode: <span class="font-semibold text-blue-600">{{ $subject->code_subject }}</span>
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Navigation -->
        <div class="flex items-center justify-between mb-8">
            <a href="{{ route('admin.subjects.index') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm hover:shadow-md">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar Mata Pelajaran
            </a>

            <a href="{{ route('admin.subjects.edit', $subject) }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-700 hover:to-orange-700 rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                    </path>
                </svg>
                Edit Mata Pelajaran
            </a>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
            <!-- Main Information -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Information Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 p-6 border-b border-gray-200">
                        <div class="flex items-center gap-3">
                            <div class="rounded-full bg-blue-100 p-3 text-blue-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-900">Informasi Mata Pelajaran</h2>
                                <p class="text-sm text-gray-600">Detail lengkap mata pelajaran</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="grid gap-6 md:grid-cols-2">
                            <div class="space-y-1">
                                <label class="text-sm font-medium text-gray-500">Kode Mata Pelajaran</label>
                                <div class="flex items-center gap-2">
                                    <div
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                        </svg>
                                        {{ $subject->code_subject }}
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-1">
                                <label class="text-sm font-medium text-gray-500">Nama Mata Pelajaran</label>
                                <p class="text-lg font-semibold text-gray-900">{{ $subject->subject_name }}</p>
                            </div>

                            <div class="space-y-1 md:col-span-2">
                                <label class="text-sm font-medium text-gray-500">Deskripsi</label>
                                @if ($subject->description)
                                    <p class="text-gray-700 text-sm leading-relaxed bg-gray-50 p-4 rounded-lg">
                                        {{ $subject->description }}
                                    </p>
                                @else
                                    <p class="text-gray-400 italic text-sm">Tidak ada deskripsi tersedia</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Schedule Information -->
                @if ($subject->classSchedules && $subject->classSchedules->count() > 0)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-purple-50 to-pink-50 p-6 border-b border-gray-200">
                            <div class="flex items-center gap-3">
                                <div class="rounded-full bg-purple-100 p-3 text-purple-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-gray-900">Jadwal Kelas</h2>
                                    <p class="text-sm text-gray-600">Daftar jadwal mata pelajaran ini</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="space-y-4">
                                @foreach ($subject->classSchedules as $schedule)
                                    <div
                                        class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                                        <div class="flex items-center space-x-4">
                                            <div
                                                class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-6 h-6 text-purple-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h4a1 1 0 011 1v5m-6 0V9a1 1 0 011-1h4a1 1 0 011 1v13.02">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="text-sm font-semibold text-gray-900">
                                                    {{ $schedule->classes->class_name ?? 'N/A' }}</h4>
                                                <p class="text-xs text-gray-500">
                                                    @php
                                                        $days = [
                                                            'Monday' => 'Senin',
                                                            'Tuesday' => 'Selasa',
                                                            'Wednesday' => 'Rabu',
                                                            'Thursday' => 'Kamis',
                                                            'Friday' => 'Jumat',
                                                            'Saturday' => 'Sabtu',
                                                        ];
                                                    @endphp
                                                    {{ $days[$schedule->day] ?? ($schedule->day ?? 'N/A') }},
                                                    {{ \Carbon\Carbon::parse($schedule->start_time)->translatedFormat('H:i') ?? 'N/A' }} -
                                                    {{ \Carbon\Carbon::parse($schedule->end_time)->translatedFormat('H:i') ?? 'N/A' }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm font-medium text-gray-900">
                                                {{ $schedule->teacher->user->name ?? 'N/A' }}</p>
                                            <p class="text-xs text-gray-500">Pengajar</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar Information -->
            <div class="space-y-6">
                <!-- Timestamp Information -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-4 border-b border-gray-200">
                        <div class="flex items-center gap-2">
                            <div class="rounded-full bg-green-100 p-2 text-green-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">Informasi Sistem</h3>
                        </div>
                    </div>

                    <div class="p-4 space-y-4">
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase tracking-wide">Dibuat
                                Pada</label>
                            <p class="text-sm text-gray-900 mt-1">{{ $subject->created_at->timezone('Asia/Jakarta')->format('d F Y') }}</p>
                            <p class="text-xs text-gray-500">{{ $subject->created_at->timezone('Asia/Jakarta')->format('H:i') }} WIB</p>
                        </div>
                        <hr class="border-gray-200">
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase tracking-wide">Terakhir
                                Diperbarui</label>
                            <p class="text-sm text-gray-900 mt-1">{{ $subject->updated_at->timezone('Asia/Jakarta')->format('d F Y') }}</p>
                            <p class="text-xs text-gray-500">{{ $subject->updated_at->timezone('Asia/Jakarta')->format('H:i') }} WIB</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Statistics -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-indigo-50 to-blue-50 p-4 border-b border-gray-200">
                        <div class="flex items-center gap-2">
                            <div class="rounded-full bg-indigo-100 p-2 text-indigo-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">Statistik</h3>
                        </div>
                    </div>

                    <div class="p-4 space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Total Jadwal</span>
                            <span
                                class="text-lg font-bold text-indigo-600">{{ $subject->classSchedules ? $subject->classSchedules->count() : 0 }}</span>
                        </div>
                        <hr class="border-gray-200">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Status</span>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Aktif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
