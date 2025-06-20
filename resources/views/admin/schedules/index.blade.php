@props(['schedules', 'classes', 'teachers', 'subjects'])
<x-app-layout>
    <div class="px-6 py-8 space-y-6 overflow-y-auto">
        <!-- Header Section with Gradient -->
        <div
            class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-emerald-600 via-teal-600 to-cyan-700 p-8 text-white shadow-2xl">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="absolute -right-16 -top-16 h-32 w-32 rounded-full bg-white/10"></div>
            <div class="absolute -bottom-8 -left-8 h-24 w-24 rounded-full bg-white/5"></div>

            <div class="relative flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
                <div class="space-y-2">
                    <div class="flex items-center gap-3">
                        <span
                            class="inline-flex items-center rounded-full bg-emerald-500/20 px-3 py-1 text-sm font-medium text-emerald-100 ring-1 ring-emerald-500/30">
                            <svg class="mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Manajemen Jadwal
                        </span>
                    </div>
                    <h1 class="text-3xl font-bold tracking-tight">Data Jadwal Pelajaran</h1>
                    <p class="text-emerald-100/90">Kelola dan atur jadwal pelajaran sekolah dengan mudah</p>
                </div>
                <a href="{{ route('admin.schedules.create') }}"
                    class="group inline-flex items-center justify-center rounded-xl bg-white/10 px-6 py-3 text-sm font-semibold text-white backdrop-blur-sm transition-all duration-200 hover:bg-white/20 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-white/50">
                    <svg class="mr-2 h-5 w-5 transition-transform group-hover:scale-110" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Jadwal Pelajaran
                </a>
            </div>
        </div> <!-- Search and Filter Section -->
        <div
            class="rounded-2xl border border-gray-200/50 bg-white/80 p-6 shadow-xl backdrop-blur-sm dark:border-gray-700/50 dark:bg-gray-800/80">
            <div class="mb-6 flex items-center gap-3">
                <div
                    class="rounded-xl bg-emerald-100 p-2 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z" />
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Filter Jadwal</h2>
            </div>
            <form action="{{ route('admin.schedules.index') }}" method="GET" class="space-y-6">
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
                    <div class="space-y-2">
                        <label for="class_id"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kelas</label>
                        <select name="class_id" id="class_id"
                            class="w-full rounded-xl border-gray-300 bg-white shadow-sm transition-all duration-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-emerald-400">
                            <option value="">Semua Kelas</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}"
                                    {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                    {{ $class->class_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label for="teacher_id"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Guru</label>
                        <select name="teacher_id" id="teacher_id"
                            class="w-full rounded-xl border-gray-300 bg-white shadow-sm transition-all duration-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-emerald-400">
                            <option value="">Semua Guru</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}"
                                    {{ request('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label for="subject_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mata
                            Pelajaran</label>
                        <select name="subject_id" id="subject_id"
                            class="w-full rounded-xl border-gray-300 bg-white shadow-sm transition-all duration-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-emerald-400">
                            <option value="">Semua Mata Pelajaran</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}"
                                    {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->subject_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label for="day"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Hari</label>
                        <select name="day" id="day"
                            class="w-full rounded-xl border-gray-300 bg-white shadow-sm transition-all duration-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-emerald-400">
                            <option value="">Semua Hari</option>
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
                            @foreach ($days as $dayValue => $dayName)
                                <option value="{{ $dayValue }}"
                                    {{ request('day') == $dayValue ? 'selected' : '' }}>
                                    {{ $dayName }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label for="semester"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Semester</label>
                        <select name="semester" id="semester"
                            class="w-full rounded-xl border-gray-300 bg-white shadow-sm transition-all duration-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-emerald-400">
                            <option value="">Semua Semester</option>
                            @php
                                $semesters = [
                                    'Odd' => 'Ganjil',
                                    'Even' => 'Genap',
                                ];
                            @endphp
                            @foreach ($semesters as $semesterValue => $semesterName)
                                <option value="{{ $semesterValue }}"
                                    {{ request('semester') == $semesterValue ? 'selected' : '' }}>
                                    {{ $semesterName }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-end">
                        <button type="submit"
                            class="group inline-flex w-full items-center justify-center rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 px-6 py-3 text-sm font-semibold text-white shadow-lg transition-all duration-200 hover:from-emerald-700 hover:to-teal-700 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-emerald-500/50">
                            <svg class="mr-2 h-4 w-4 transition-transform group-hover:scale-110" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Filter
                        </button>
                    </div>
                </div>
            </form>
        </div> <!-- Schedule Cards Grid -->
        @if ($schedules->count() > 0)
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($schedules as $schedule)
                    <div
                        class="group relative overflow-hidden rounded-2xl border border-gray-200/50 bg-white/80 p-6 shadow-lg backdrop-blur-sm transition-all duration-300 hover:border-emerald-300/50 hover:shadow-2xl hover:scale-[1.02] dark:border-gray-700/50 dark:bg-gray-800/80">
                        <!-- Card Header -->
                        <div class="mb-4 flex items-start justify-between">
                            <div class="flex items-center gap-3">
                                <div
                                    class="rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 p-2.5 text-white shadow-lg">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900 dark:text-white">
                                        {{ $schedule->classes->class_name ?? 'N/A' }}</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $schedule->subject->subject_name ?? 'N/A' }}</p>
                                </div>
                            </div>

                            @php
                                $semesters = ['Odd' => 'Ganjil', 'Even' => 'Genap'];
                            @endphp
                            <span
                                class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-medium text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400">
                                {{ $semesters[$schedule->semester] ?? $schedule->semester }}
                            </span>
                        </div>

                        <!-- Card Content -->
                        <div class="space-y-3">
                            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                                <svg class="h-4 w-4 text-emerald-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span>{{ $schedule->teacher->user->name ?? 'N/A' }}</span>
                            </div>

                            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                                <svg class="h-4 w-4 text-emerald-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
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
                                <span>{{ $days[$schedule->day] ?? $schedule->day }}</span>
                            </div>

                            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                                <svg class="h-4 w-4 text-emerald-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} -
                                    {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</span>
                            </div>
                        </div>

                        <!-- Card Actions -->
                        <div class="mt-6 flex items-center justify-end gap-2">
                            <a href="{{ route('admin.schedules.show', $schedule) }}"
                                class="inline-flex items-center justify-center rounded-xl bg-blue-50 p-2 text-blue-600 transition-all duration-200 hover:bg-blue-100 hover:scale-110 dark:bg-blue-900/30 dark:text-blue-400 dark:hover:bg-blue-900/50"
                                title="Detail">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>
                            <a href="{{ route('admin.schedules.edit', $schedule) }}"
                                class="inline-flex items-center justify-center rounded-xl bg-amber-50 p-2 text-amber-600 transition-all duration-200 hover:bg-amber-100 hover:scale-110 dark:bg-amber-900/30 dark:text-amber-400 dark:hover:bg-amber-900/50"
                                title="Edit">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST"
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    class="inline-flex items-center justify-center rounded-xl bg-red-50 p-2 text-red-600 transition-all duration-200 hover:bg-red-100 hover:scale-110 dark:bg-red-900/30 dark:text-red-400 dark:hover:bg-red-900/50 delete-btn"
                                    title="Hapus">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div
                    class="rounded-2xl border-2 border-dashed border-gray-200 bg-gray-50/50 p-12 dark:border-gray-700 dark:bg-gray-800/50">
                    <div
                        class="mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-emerald-100 dark:bg-emerald-900/30">
                        <svg class="h-10 w-10 text-emerald-600 dark:text-emerald-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">Belum ada jadwal pelajaran
                    </h3>
                    <p class="mb-6 text-gray-500 dark:text-gray-400">Mulai dengan menambahkan jadwal pelajaran pertama
                        Anda.</p>
                    <a href="{{ route('admin.schedules.create') }}"
                        class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 px-6 py-3 text-sm font-semibold text-white shadow-lg transition-all duration-200 hover:from-emerald-700 hover:to-teal-700 hover:scale-105">
                        <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Jadwal Pelajaran
                    </a>
                </div>
            </div>
        @endif
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const deleteButtons = document.querySelectorAll('.delete-btn');
                deleteButtons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        const form = this.closest('form');
                        e.preventDefault();
                        Swal.fire({
                            title: 'Hapus Jadwal Pelajaran?',
                            text: "Data jadwal pelajaran akan dihapus secara permanen!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#ef4444',
                            cancelButtonColor: '#6b7280',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal',
                            reverseButtons: true,
                            customClass: {
                                popup: 'rounded-2xl border-0 shadow-2xl',
                                confirmButton: 'rounded-xl px-6 py-3 font-semibold',
                                cancelButton: 'rounded-xl px-6 py-3 font-semibold'
                            },
                            focusConfirm: false,
                            focusCancel: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire({
                                    title: 'Menghapus...',
                                    text: 'Sedang memproses penghapusan jadwal pelajaran...',
                                    allowOutsideClick: false,
                                    showConfirmButton: false,
                                    customClass: {
                                        popup: 'rounded-2xl border-0 shadow-2xl'
                                    },
                                    didOpen: () => {
                                        Swal.showLoading();
                                    }
                                });
                                form.submit();
                            }
                        });
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
