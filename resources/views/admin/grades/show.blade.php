<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <div class="mb-4">
            <a href="{{ route('admin.grades.index') }}" class="text-blue-600 hover:text-blue-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
                Kembali ke Daftar Nilai
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Grade Information -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Nilai</h3>

                <div class="grid grid-cols-2 gap-4">
                    <div class="text-sm font-medium text-gray-500">Siswa:</div>
                    <div class="text-sm text-gray-900">{{ $grade->student->user->name }}</div>

                    <div class="text-sm font-medium text-gray-500">Kelas:</div>
                    <div class="text-sm text-gray-900">{{ $grade->student->classes->class_name }}</div>

                    <div class="text-sm font-medium text-gray-500">Mata Pelajaran:</div>
                    <div class="text-sm text-gray-900">{{ $grade->subject->name }}</div>

                    <div class="text-sm font-medium text-gray-500">Guru:</div>
                    <div class="text-sm text-gray-900">{{ $grade->teacher->user->name }}</div>

                    <div class="text-sm font-medium text-gray-500">Jenis Penilaian:</div>
                    <div class="text-sm text-gray-900">{{ $grade->type_assessment }}</div>

                    <div class="text-sm font-medium text-gray-500">Nilai:</div>
                    <div
                        class="text-sm font-bold {{ $grade->grade >= 75 ? 'text-green-600' : ($grade->grade >= 60 ? 'text-yellow-600' : 'text-red-600') }}">
                        {{ $grade->grade }}
                    </div>

                    <div class="text-sm font-medium text-gray-500">Semester:</div>
                    <div class="text-sm text-gray-900">{{ $grade->semester }}</div>

                    <div class="text-sm font-medium text-gray-500">Tanggal Input:</div>
                    <div class="text-sm text-gray-900">{{ $grade->created_at->format('d M Y H:i') }}</div>

                    @if ($grade->description)
                        <div class="text-sm font-medium text-gray-500">Deskripsi:</div>
                        <div class="text-sm text-gray-900">{{ $grade->description }}</div>
                    @endif

                    <div class="text-sm font-medium text-gray-500">Status Verifikasi:</div>
                    <div class="text-sm">
                        @if ($grade->verification_status == 'pending')
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Menunggu Verifikasi
                            </span>
                        @elseif ($grade->verification_status == 'verified')
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Terverifikasi oleh {{ $grade->verifier->name }} pada
                                {{ $grade->verified_at->format('d M Y H:i') }}
                            </span>
                        @else
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Ditolak oleh {{ $grade->verifier->name }} pada
                                {{ $grade->verified_at->format('d M Y H:i') }}
                            </span>
                        @endif
                    </div>

                    @if ($grade->verification_note)
                        <div class="text-sm font-medium text-gray-500">Catatan Verifikasi:</div>
                        <div class="text-sm text-gray-900">{{ $grade->verification_note }}</div>
                    @endif
                </div>
            </div>

            <!-- Verification Form -->
            @if ($grade->verification_status == 'pending')
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Verifikasi Nilai</h3>

                    <form action="{{ route('admin.grades.verify', $grade) }}" method="POST">
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
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
