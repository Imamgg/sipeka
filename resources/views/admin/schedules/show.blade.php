@props(['schedule'])
<x-app-layout>
    <div class="p-6 space-y-6 overflow-y-auto">
        <div class="glass-card border-glow rounded-xl p-6 shadow-md">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white deco-line"
                style="--line-color: rgba(99, 102, 241, 0.7)">Detail Jadwal Pelajaran</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Lihat informasi lengkap jadwal pelajaran</p>
        </div>

        <div class="rounded-xl border p-6 shadow-md">
            <div class="mb-6 flex items-center justify-between">
                <a href="{{ route('admin.schedules.index') }}"
                    class="rounded-lg transition-all hover:bg-blue-50 dark:hover:bg-blue-900/20 inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-200 dark:hover:text-blue-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>

            <!-- Detail Jadwal Pelajaran -->
            <div
                class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm transition-all hover:shadow dark:border-gray-700 dark:bg-gray-800 mb-6">
                <div class="mb-4 flex items-center gap-3">
                    <div class="rounded-full bg-blue-100 p-2 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Informasi Jadwal Pelajaran</h2>
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Kelas</h3>
                        <p class="mt-1 text-base text-gray-900 dark:text-white">
                            {{ $schedule->class->class_name ?? 'N/A' }}
                        </p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Mata Pelajaran</h3>
                        <p class="mt-1 text-base text-gray-900 dark:text-white">
                            {{ $schedule->subject->subject_name ?? 'N/A' }}
                        </p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Guru</h3>
                        <p class="mt-1 text-base text-gray-900 dark:text-white">
                            {{ $schedule->teacher->user->name ?? 'N/A' }}
                        </p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Hari</h3>
                        <p class="mt-1 text-base text-gray-900 dark:text-white">
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
                            {{ $days[$schedule->day] ?? $schedule->day }}
                        </p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Waktu</h3>
                        <p class="mt-1 text-base text-gray-900 dark:text-white">
                            {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} -
                            {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                        </p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Semester</h3>
                        <p class="mt-1 text-base text-gray-900 dark:text-white">
                            @php
                                $semesters = [
                                    'Odd' => 'Ganjil',
                                    'Even' => 'Genap',
                                ];
                            @endphp
                            {{ $semesters[$schedule->semester] ?? $schedule->semester }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Informasi Tambahan -->
            <div
                class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm transition-all hover:shadow dark:border-gray-700 dark:bg-gray-800">
                <div class="mb-4 flex items-center gap-3">
                    <div class="rounded-full bg-green-100 p-2 text-green-600 dark:bg-green-900/30 dark:text-green-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Informasi Tambahan</h2>
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Tanggal Dibuat</h3>
                        <p class="mt-1 text-base text-gray-900 dark:text-white">
                            {{ $schedule->created_at->format('d F Y, H:i') }}
                        </p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Terakhir Diperbarui</h3>
                        <p class="mt-1 text-base text-gray-900 dark:text-white">
                            {{ $schedule->updated_at->format('d F Y, H:i') }}
                        </p>
                    </div>
                </div>
            </div>

            @if ($schedule->presences && $schedule->presences->count() > 0)
                <!-- Data Presensi -->
                <div
                    class="mt-6 rounded-lg border border-gray-200 bg-white p-5 shadow-sm transition-all hover:shadow dark:border-gray-700 dark:bg-gray-800">
                    <div class="mb-4 flex items-center gap-3">
                        <div
                            class="rounded-full bg-purple-100 p-2 text-purple-600 dark:bg-purple-900/30 dark:text-purple-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Data Presensi</h2>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Tanggal</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Jumlah Hadir</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Jumlah Tidak Hadir</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
                                @foreach ($schedule->presences as $presence)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900 dark:text-white">
                                            {{ $presence->date->format('d F Y') }}
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900 dark:text-white">
                                            {{ $presence->presenceDetails->where('status', 'hadir')->count() }}
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900 dark:text-white">
                                            {{ $presence->presenceDetails->whereIn('status', ['sakit', 'izin', 'alpa'])->count() }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const deleteForm = document.querySelector('.delete-form');
                const deleteBtn = document.querySelector('.delete-btn');

                if (deleteBtn) {
                    deleteBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        Swal.fire({
                            title: 'Apakah Anda yakin?',
                            text: "Data jadwal pelajaran akan dihapus secara permanen!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                deleteForm.submit();
                            }
                        });
                    });
                }
            });
        </script>
    @endpush
</x-app-layout>
