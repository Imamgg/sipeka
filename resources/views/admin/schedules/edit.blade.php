@props(['schedule', 'classes', 'teachers', 'subjects', 'days', 'semesters'])
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
                    class="inline-flex items-center rounded-full bg-amber-500/20 px-3 py-1 text-sm font-medium text-amber-100 ring-1 ring-amber-500/30">
                    <svg class="mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Jadwal
                </span>
                <div>
                    <h1 class="text-3xl font-bold tracking-tight">Edit Jadwal Pelajaran</h1>
                    <p class="text-emerald-100/90">Perbarui informasi jadwal pelajaran</p>
                </div>
            </div>
        </div> <!-- Form Section -->
        <div
            class="rounded-2xl border border-gray-200/50 bg-white/80 p-8 shadow-xl backdrop-blur-sm dark:border-gray-700/50 dark:bg-gray-800/80">
            <!-- Back Button -->
            <div class="mb-8 flex items-center gap-4">
                <a href="{{ route('admin.schedules.index') }}"
                    class="group inline-flex items-center gap-2 rounded-xl bg-gray-100 px-4 py-2.5 text-sm font-medium text-gray-700 transition-all duration-200 hover:bg-gray-200 hover:scale-105 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                    <svg class="h-4 w-4 transition-transform group-hover:-translate-x-1" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>

            <form action="{{ route('admin.schedules.update', $schedule) }}" method="POST" class="space-y-8"
                id="schedule-form">
                @csrf
                @method('PUT')

                <!-- Informasi Jadwal -->
                <div
                    class="rounded-2xl border border-amber-200/50 bg-gradient-to-br from-amber-50/50 to-orange-50/50 p-6 shadow-lg dark:border-amber-700/50 dark:from-amber-900/20 dark:to-orange-900/20">
                    <div class="mb-6 flex items-center gap-3">
                        <div class="rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 p-3 text-white shadow-lg">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Informasi Jadwal Pelajaran</h2>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Perbarui detail jadwal pelajaran</p>
                        </div>
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="space-y-2">
                            <label for="class_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                Kelas <span class="text-red-500">*</span>
                            </label>
                            <select name="class_id" id="class_id"
                                class="w-full rounded-xl border-gray-300 bg-white shadow-sm transition-all duration-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-amber-400">
                                <option value="">Pilih Kelas</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}"
                                        {{ (old('class_id') ?? $schedule->class_id) == $class->id ? 'selected' : '' }}>
                                        {{ $class->class_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('class_id')
                                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="subject_id"
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                Mata Pelajaran <span class="text-red-500">*</span>
                            </label>
                            <select name="subject_id" id="subject_id"
                                class="w-full rounded-xl border-gray-300 bg-white shadow-sm transition-all duration-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-amber-400">
                                <option value="">Pilih Mata Pelajaran</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}"
                                        {{ (old('subject_id') ?? $schedule->subject_id) == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->subject_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('subject_id')
                                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="teacher_id"
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                Guru <span class="text-red-500">*</span>
                            </label>
                            <select name="teacher_id" id="teacher_id"
                                class="w-full rounded-xl border-gray-300 bg-white shadow-sm transition-all duration-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-amber-400">
                                <option value="">Pilih Guru</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}"
                                        {{ (old('teacher_id') ?? $schedule->teacher_id) == $teacher->id ? 'selected' : '' }}>
                                        {{ $teacher->user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('teacher_id')
                                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="day" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                Hari <span class="text-red-500">*</span>
                            </label>
                            <select name="day" id="day"
                                class="w-full rounded-xl border-gray-300 bg-white shadow-sm transition-all duration-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-amber-400">
                                <option value="">Pilih Hari</option>
                                @foreach ($days as $dayValue => $dayName)
                                    <option value="{{ $dayValue }}"
                                        {{ (old('day') ?? $schedule->day) == $dayValue ? 'selected' : '' }}>
                                        {{ $dayName }}
                                    </option>
                                @endforeach
                            </select>
                            @error('day')
                                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="start_time"
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                Waktu Mulai <span class="text-red-500">*</span>
                            </label> <input type="time" name="start_time" id="start_time"
                                value="{{ old('start_time') ?? \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}"
                                class="w-full rounded-xl border-gray-300 bg-white shadow-sm transition-all duration-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-amber-400">
                            @error('start_time')
                                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="end_time"
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                Waktu Selesai <span class="text-red-500">*</span>
                            </label> <input type="time" name="end_time" id="end_time"
                                value="{{ old('end_time') ?? \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}"
                                class="w-full rounded-xl border-gray-300 bg-white shadow-sm transition-all duration-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-amber-400">
                            @error('end_time')
                                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="space-y-2 md:col-span-2">
                            <label for="semester"
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                Semester <span class="text-red-500">*</span>
                            </label>
                            <select name="semester" id="semester"
                                class="w-full rounded-xl border-gray-300 bg-white shadow-sm transition-all duration-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-amber-400">
                                <option value="">Pilih Semester</option>
                                @foreach ($semesters as $semesterValue => $semesterName)
                                    <option value="{{ $semesterValue }}"
                                        {{ (old('semester') ?? $schedule->semester) == $semesterValue ? 'selected' : '' }}>
                                        {{ $semesterName }}
                                    </option>
                                @endforeach
                            </select>
                            @error('semester')
                                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-end gap-4">
                    <a href="{{ route('admin.schedules.index') }}"
                        class="rounded-xl border border-gray-300 bg-white px-6 py-3 text-sm font-semibold text-gray-700 shadow-sm transition-all duration-200 hover:bg-gray-50 hover:scale-105 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                        Batal
                    </a>
                    <button type="submit" id="submit-btn"
                        class="group inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-amber-600 to-orange-600 px-8 py-3 text-sm font-semibold text-white shadow-lg transition-all duration-200 hover:from-amber-700 hover:to-orange-700 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-amber-500/50 disabled:opacity-50 disabled:cursor-not-allowed">
                        <svg class="mr-2 h-4 w-4 transition-transform group-hover:scale-110" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="submit-text">Update Jadwal</span>
                        <svg class="ml-2 h-4 w-4 animate-spin hidden loading-spinner" fill="none"
                            viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('schedule-form');
                const submitBtn = document.getElementById('submit-btn');
                const submitText = submitBtn.querySelector('.submit-text');
                const loadingSpinner = submitBtn.querySelector('.loading-spinner');

                form.addEventListener('submit', function() {
                    // Show loading state
                    submitBtn.disabled = true;
                    submitText.textContent = 'Mengupdate...';
                    loadingSpinner.classList.remove('hidden');
                });
            });
        </script>
    @endpush
</x-app-layout>
