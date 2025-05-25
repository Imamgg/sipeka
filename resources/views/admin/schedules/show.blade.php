@props(['schedule'])
<x-app-layout>
    <div class="p-6 space-y-6 overflow-y-auto">
        <!-- Header Section with Gradient -->
        <div
            class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-emerald-600 via-teal-600 to-cyan-700 p-8 text-white shadow-2xl">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="absolute -right-16 -top-16 h-32 w-32 rounded-full bg-white/10"></div>
            <div class="absolute -bottom-8 -left-8 h-24 w-24 rounded-full bg-white/5"></div>

            <div class="relative flex items-center gap-4">
                <span
                    class="inline-flex items-center rounded-full bg-blue-500/20 px-3 py-1 text-sm font-medium text-blue-100 ring-1 ring-blue-500/30">
                    <svg class="mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    Detail Jadwal
                </span>
                <div>
                    <h1 class="text-3xl font-bold tracking-tight">Detail Jadwal Pelajaran</h1>
                    <p class="text-emerald-100/90">Lihat informasi lengkap jadwal pelajaran</p>
                </div>
            </div>
        </div> <!-- Back Navigation -->
        <div class="mb-6">
            <a href="{{ route('admin.schedules.index') }}"
                class="group inline-flex items-center gap-2 rounded-xl bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-md transition-all duration-200 hover:bg-emerald-50 hover:text-emerald-700 hover:shadow-lg hover:-translate-y-0.5 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-emerald-900/20 dark:hover:text-emerald-400">
                <svg class="h-4 w-4 transition-transform group-hover:-translate-x-1" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Kembali ke Daftar Jadwal</span>
            </a>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Schedule Information Card -->
                <div
                    class="group rounded-2xl bg-gradient-to-br from-white to-gray-50/50 p-8 shadow-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border border-gray-100 dark:from-gray-800 dark:to-gray-800/50 dark:border-gray-700">
                    <div class="mb-6 flex items-center gap-4">
                        <div
                            class="rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 p-3 text-white shadow-lg">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Informasi Jadwal</h2>
                            <p class="text-gray-600 dark:text-gray-400">Detail lengkap jadwal pelajaran</p>
                        </div>
                    </div>

                    <div class="grid gap-6 sm:grid-cols-2">
                        <div class="space-y-3">
                            <div
                                class="flex items-center gap-3 p-4 rounded-xl bg-blue-50 border border-blue-100 transition-colors hover:bg-blue-100 dark:bg-blue-900/20 dark:border-blue-800">
                                <div class="rounded-lg bg-blue-500 p-2 text-white">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-blue-800 dark:text-blue-300">Kelas</h3>
                                    <p class="text-lg font-semibold text-blue-900 dark:text-blue-100">
                                        {{ $schedule->class->class_name ?? 'N/A' }}</p>
                                </div>
                            </div>

                            <div
                                class="flex items-center gap-3 p-4 rounded-xl bg-purple-50 border border-purple-100 transition-colors hover:bg-purple-100 dark:bg-purple-900/20 dark:border-purple-800">
                                <div class="rounded-lg bg-purple-500 p-2 text-white">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-purple-800 dark:text-purple-300">Mata Pelajaran
                                    </h3>
                                    <p class="text-lg font-semibold text-purple-900 dark:text-purple-100">
                                        {{ $schedule->subject->subject_name ?? 'N/A' }}</p>
                                </div>
                            </div>

                            <div
                                class="flex items-center gap-3 p-4 rounded-xl bg-green-50 border border-green-100 transition-colors hover:bg-green-100 dark:bg-green-900/20 dark:border-green-800">
                                <div class="rounded-lg bg-green-500 p-2 text-white">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-green-800 dark:text-green-300">Guru</h3>
                                    <p class="text-lg font-semibold text-green-900 dark:text-green-100">
                                        {{ $schedule->teacher->user->name ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <div
                                class="flex items-center gap-3 p-4 rounded-xl bg-amber-50 border border-amber-100 transition-colors hover:bg-amber-100 dark:bg-amber-900/20 dark:border-amber-800">
                                <div class="rounded-lg bg-amber-500 p-2 text-white">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-amber-800 dark:text-amber-300">Hari</h3>
                                    <p class="text-lg font-semibold text-amber-900 dark:text-amber-100">
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
                            </div>

                            <div
                                class="flex items-center gap-3 p-4 rounded-xl bg-rose-50 border border-rose-100 transition-colors hover:bg-rose-100 dark:bg-rose-900/20 dark:border-rose-800">
                                <div class="rounded-lg bg-rose-500 p-2 text-white">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-rose-800 dark:text-rose-300">Waktu</h3>
                                    <p class="text-lg font-semibold text-rose-900 dark:text-rose-100">
                                        {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                    </p>
                                </div>
                            </div>

                            <div
                                class="flex items-center gap-3 p-4 rounded-xl bg-indigo-50 border border-indigo-100 transition-colors hover:bg-indigo-100 dark:bg-indigo-900/20 dark:border-indigo-800">
                                <div class="rounded-lg bg-indigo-500 p-2 text-white">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-indigo-800 dark:text-indigo-300">Semester</h3>
                                    <p class="text-lg font-semibold text-indigo-900 dark:text-indigo-100">
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
                    </div>
                </div>

                @if ($schedule->presences && $schedule->presences->count() > 0)
                    <!-- Attendance Data Card -->
                    <div
                        class="group rounded-2xl bg-gradient-to-br from-white to-gray-50/50 p-8 shadow-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border border-gray-100 dark:from-gray-800 dark:to-gray-800/50 dark:border-gray-700">
                        <div class="mb-6 flex items-center gap-4">
                            <div
                                class="rounded-2xl bg-gradient-to-br from-purple-500 to-violet-600 p-3 text-white shadow-lg">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Data Presensi</h2>
                                <p class="text-gray-600 dark:text-gray-400">Riwayat kehadiran siswa</p>
                            </div>
                        </div>

                        <div class="overflow-hidden rounded-xl border border-gray-200 dark:border-gray-700">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead
                                        class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800">
                                        <tr>
                                            <th
                                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-gray-300">
                                                Tanggal
                                            </th>
                                            <th
                                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-gray-300">
                                                Hadir
                                            </th>
                                            <th
                                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-gray-300">
                                                Tidak Hadir
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody
                                        class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
                                        @foreach ($schedule->presences as $presence)
                                            <tr class="transition-colors hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                                <td
                                                    class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ $presence->date->format('d F Y') }}
                                                </td>
                                                <td class="whitespace-nowrap px-6 py-4">
                                                    <span
                                                        class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-sm font-medium text-green-800 dark:bg-green-900/30 dark:text-green-300">
                                                        {{ $presence->presenceDetails->where('status', 'hadir')->count() }}
                                                        siswa
                                                    </span>
                                                </td>
                                                <td class="whitespace-nowrap px-6 py-4">
                                                    <span
                                                        class="inline-flex items-center rounded-full bg-red-100 px-3 py-1 text-sm font-medium text-red-800 dark:bg-red-900/30 dark:text-red-300">
                                                        {{ $presence->presenceDetails->whereIn('status', ['sakit', 'izin', 'alpa'])->count() }}
                                                        siswa
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Quick Actions Card -->
                <div
                    class="rounded-2xl bg-gradient-to-br from-white to-gray-50/50 p-6 shadow-lg border border-gray-100 dark:from-gray-800 dark:to-gray-800/50 dark:border-gray-700">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Aksi Cepat</h3>
                    <div class="space-y-3">
                        <a href="{{ route('admin.schedules.edit', $schedule) }}"
                            class="group flex w-full items-center gap-3 rounded-xl bg-gradient-to-r from-amber-500 to-orange-500 px-4 py-3 text-sm font-medium text-white shadow-md transition-all duration-200 hover:from-amber-600 hover:to-orange-600 hover:shadow-lg hover:-translate-y-0.5">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            <span>Edit Jadwal</span>
                        </a>

                        <form action="{{ route('admin.schedules.destroy', $schedule) }}" method="POST"
                            class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="delete-btn group flex w-full items-center gap-3 rounded-xl bg-gradient-to-r from-red-500 to-rose-500 px-4 py-3 text-sm font-medium text-white shadow-md transition-all duration-200 hover:from-red-600 hover:to-rose-600 hover:shadow-lg hover:-translate-y-0.5">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                <span>Hapus Jadwal</span>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Additional Information Card -->
                <div
                    class="rounded-2xl bg-gradient-to-br from-white to-gray-50/50 p-6 shadow-lg border border-gray-100 dark:from-gray-800 dark:to-gray-800/50 dark:border-gray-700">
                    <div class="mb-4 flex items-center gap-3">
                        <div class="rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 p-2 text-white">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Informasi Sistem</h3>
                    </div>

                    <div class="space-y-4">
                        <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700/50">
                            <h4 class="text-sm font-medium text-gray-600 dark:text-gray-400">Dibuat</h4>
                            <p class="mt-1 text-sm font-semibold text-gray-900 dark:text-white">
                                {{ $schedule->created_at->format('d F Y, H:i') }}
                            </p>
                        </div>

                        <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700/50">
                            <h4 class="text-sm font-medium text-gray-600 dark:text-gray-400">Terakhir Diperbarui</h4>
                            <p class="mt-1 text-sm font-semibold text-gray-900 dark:text-white">
                                {{ $schedule->updated_at->format('d F Y, H:i') }}
                            </p>
                        </div>

                        @if ($schedule->presences && $schedule->presences->count() > 0)
                            <div class="rounded-lg bg-emerald-50 p-4 dark:bg-emerald-900/20">
                                <h4 class="text-sm font-medium text-emerald-600 dark:text-emerald-400">Total Pertemuan
                                </h4>
                                <p class="mt-1 text-2xl font-bold text-emerald-900 dark:text-emerald-100">
                                    {{ $schedule->presences->count() }}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
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
