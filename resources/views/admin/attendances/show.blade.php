<x-app-layout>
    <div class="text-sm font-medium text-gray-500">Nama:</div>
    <div class="text-sm text-gray-900">{{ $attendance->student->user?->name ?? 'N/A' }}</div>

    <div class="text-sm font-medium text-gray-500">Kelas:</div>
    <div class="text-sm text-gray-900">{{ $attendance->student->classes?->name ?? 'N/A' }}</div>class="bg-white
    <div class="mb-4">
        <a href="{{ route('admin.attendances.index') }}" class="text-blue-600 hover:text-blue-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z"
                    clip-rule="evenodd" />
            </svg>
            Kembali ke Daftar Kehadiran
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Attendance Information -->
        <div class="bg-gray-50 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Kehadiran</h3>

            <div class="grid grid-cols-2 gap-4">
                <div class="text-sm font-medium text-gray-500">Siswa:</div>
                <div class="text-sm text-gray-900">{{ $attendance->student->user?->name ?? 'N/A' }}</div>

                <div class="text-sm font-medium text-gray-500">Kelas:</div>
                <div class="text-sm text-gray-900">{{ $attendance->student->classes?->name ?? 'N/A' }}</div>

                <div class="text-sm font-medium text-gray-500">Mata Pelajaran:</div>
                <div class="text-sm text-gray-900">
                    {{ $attendance->presence->classSchedule?->subject?->name ?? ($attendance->presence->subject?->name ?? 'N/A') }}
                </div>

                <div class="text-sm font-medium text-gray-500">Guru:</div>
                <div class="text-sm text-gray-900">
                    {{ $attendance->presence->classSchedule?->teacher?->user?->name ?? ($attendance->presence->teacher?->user?->name ?? 'N/A') }}
                </div>

                <div class="text-sm font-medium text-gray-500">Tanggal:</div>
                <div class="text-sm text-gray-900">{{ $attendance->presence->date?->format('d M Y') ?? 'N/A' }}</div>

                <div class="text-sm font-medium text-gray-500">Waktu Mulai:</div>
                <div class="text-sm text-gray-900">{{ $attendance->presence->start_time }}</div>

                <div class="text-sm font-medium text-gray-500">Waktu Selesai:</div>
                <div class="text-sm text-gray-900">{{ $attendance->presence->end_time }}</div>

                <div class="text-sm font-medium text-gray-500">Topik:</div>
                <div class="text-sm text-gray-900">{{ $attendance->presence->topic }}</div>

                <div class="text-sm font-medium text-gray-500">Status Kehadiran:</div>
                <div class="text-sm">
                    @if ($attendance->status == 'present')
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Hadir
                        </span>
                    @elseif ($attendance->status == 'absent')
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                            Tidak Hadir
                        </span>
                    @elseif ($attendance->status == 'sick')
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            Sakit
                        </span>
                    @elseif ($attendance->status == 'permission')
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                            Izin
                        </span>
                    @else
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                            {{ $attendance->status }}
                        </span>
                    @endif
                </div>

                <div class="text-sm font-medium text-gray-500">Status Verifikasi:</div>
                <div class="text-sm">
                    @if ($attendance->verification_status == 'pending')
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            Menunggu Verifikasi
                        </span>
                    @elseif ($attendance->verification_status == 'verified')
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Terverifikasi oleh {{ $attendance->verifier?->name ?? 'N/A' }} pada
                            {{ $attendance->verified_at?->format('d M Y H:i') ?? 'N/A' }}
                        </span>
                    @else
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                            Ditolak oleh {{ $attendance->verifier?->name ?? 'N/A' }} pada
                            {{ $attendance->verified_at?->format('d M Y H:i') ?? 'N/A' }}
                        </span>
                    @endif
                </div>

                @if ($attendance->verification_note)
                    <div class="text-sm font-medium text-gray-500">Catatan Verifikasi:</div>
                    <div class="text-sm text-gray-900">{{ $attendance->verification_note }}</div>
                @endif
            </div>
        </div>

        <!-- Verification Form -->
        @if ($attendance->verification_status == 'pending')
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Verifikasi Kehadiran</h3>

                <form action="{{ route('admin.attendances.verify', $attendance) }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="verification_status" :value="__('Status Verifikasi')" />
                        <select id="verification_status" name="verification_status"
                            class="mt-1 block w-full rounded-md border-gray-300" required>
                            <option value="">Pilih Status Verifikasi</option>
                            <option value="verified">Verifikasi</option>
                            <option value="rejected">Tolak</option>
                        </select>
                        <x-input-error :messages="$errors->get('verification_status')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="verification_note" :value="__('Catatan Verifikasi (Opsional)')" />
                        <textarea id="verification_note" name="verification_note" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300"></textarea>
                        <x-input-error :messages="$errors->get('verification_note')" class="mt-2" />
                    </div>

                    <div class="flex justify-end">
                        <x-primary-button type="submit">
                            {{ __('Simpan') }} </x-primary-button>
                    </div>
                </form>
            </div>
        @endif
    </div>
    </div>
</x-app-layout>
