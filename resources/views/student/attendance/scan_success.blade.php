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

        <div class="max-w-2xl mx-auto">
            <!-- Success Card -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-green-50 p-6 flex items-center border-b border-green-100">
                    <div class="bg-green-100 rounded-full p-3 mr-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-green-800">Absensi Berhasil Tercatat!</h2>
                        <p class="text-green-600">Terima kasih telah melakukan absensi tepat waktu.</p>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 mb-2">Informasi Siswa</h3>
                            <p class="text-lg font-semibold text-gray-900">{{ $student->user->name }}</p>
                            <p class="text-gray-600">NISN: {{ $student->nisn }}</p>
                            <p class="text-gray-600">Kelas: {{ $student->classes->class_name }}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 mb-2">Status Kehadiran</h3>
                            <div class="flex items-center space-x-2">
                                @if ($presenceDetail->status == 'present')
                                    <span
                                        class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">Hadir</span>
                                @elseif($presenceDetail->status == 'late')
                                    <span
                                        class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">Terlambat</span>
                                @else
                                    <span
                                        class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">{{ ucfirst($presenceDetail->status) }}</span>
                                @endif

                                <span class="text-gray-500">
                                    {{ \Carbon\Carbon::parse($presenceDetail->verified_at)->format('H:i:s') }}
                                </span>
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <h3 class="text-sm font-semibold text-gray-500 mb-2">Detail Sesi</h3>
                            <p class="text-lg font-semibold text-gray-900">{{ $presenceDetail->presence->topic }}</p>
                            <p class="text-gray-600">{{ $presenceDetail->presence->subject->subject_name }}</p>
                            <p class="text-gray-600">
                                {{ \Carbon\Carbon::parse($presenceDetail->presence->date)->format('d F Y') }}
                                ({{ $presenceDetail->presence->start_time }} -
                                {{ $presenceDetail->presence->end_time }})
                            </p>
                            @if ($presenceDetail->presence->note)
                                <p class="text-gray-600 mt-2">{{ $presenceDetail->presence->note }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-100 flex justify-between items-center">
                        <div class="text-gray-500 text-sm">
                            Token: <span class="font-mono">{{ $presenceDetail->presence->qr_code_token }}</span>
                        </div>

                        <div>
                            <a href="{{ route('student.attendances.scan') }}"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                                Scan QR Lagi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-student-layout>
