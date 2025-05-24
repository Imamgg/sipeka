@props(['schedule', 'classes', 'teachers', 'subjects', 'days', 'semesters'])
<x-app-layout>
    <div class="p-6 space-y-6 mt-16 overflow-y-auto">
        <div class="glass-card border-glow rounded-xl p-6 shadow-md">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white deco-line"
                style="--line-color: rgba(99, 102, 241, 0.7)">Edit Jadwal Pelajaran</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Perbarui informasi jadwal pelajaran</p>
        </div>

        <div class="rounded-xl border p-6 shadow-md">
            <div class="mb-6 flex items-center gap-2">
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

            <form action="{{ route('admin.schedules.update', $schedule) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Informasi Jadwal -->
                <div
                    class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm transition-all hover:shadow dark:border-gray-700 dark:bg-gray-800">
                    <div class="mb-4 flex items-center gap-3">
                        <div
                            class="rounded-full bg-amber-100 p-2 text-amber-600 dark:bg-amber-900/30 dark:text-amber-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Informasi Jadwal Pelajaran</h2>
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="space-y-2">
                            <label for="class_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Kelas <span class="text-red-500">*</span>
                            </label>
                            <select name="class_id" id="class_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <option value="">Pilih Kelas</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}"
                                        {{ old('class_id', $schedule->class_id) == $class->id ? 'selected' : '' }}>
                                        {{ $class->class_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('class_id')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="subject_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Mata Pelajaran <span class="text-red-500">*</span>
                            </label>
                            <select name="subject_id" id="subject_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <option value="">Pilih Mata Pelajaran</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}"
                                        {{ old('subject_id', $schedule->subject_id) == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->subject_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('subject_id')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="teacher_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Guru <span class="text-red-500">*</span>
                            </label>
                            <select name="teacher_id" id="teacher_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <option value="">Pilih Guru</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}"
                                        {{ old('teacher_id', $schedule->teacher_id) == $teacher->id ? 'selected' : '' }}>
                                        {{ $teacher->user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('teacher_id')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="day" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Hari <span class="text-red-500">*</span>
                            </label> <select name="day" id="day"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <option value="">Pilih Hari</option>
                                @foreach ($days as $dayValue => $dayName)
                                    <option value="{{ $dayValue }}"
                                        {{ old('day', $schedule->day) == $dayValue ? 'selected' : '' }}>
                                        {{ $dayName }}
                                    </option>
                                @endforeach
                            </select>
                            @error('day')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label for="start_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Waktu Mulai <span class="text-red-500">*</span>
                            </label>
                            <input type="time" name="start_time" id="start_time"
                                value="{{ old('start_time', substr($schedule->start_time, 0, 5)) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            @error('start_time')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="end_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Waktu Selesai <span class="text-red-500">*</span>
                            </label>
                            <input type="time" name="end_time" id="end_time"
                                value="{{ old('end_time', substr($schedule->end_time, 0, 5)) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            @error('end_time')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="semester" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Semester <span class="text-red-500">*</span>
                            </label> <select name="semester" id="semester"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <option value="">Pilih Semester</option>
                                @foreach ($semesters as $semesterValue => $semesterName)
                                    <option value="{{ $semesterValue }}"
                                        {{ old('semester', $schedule->semester) == $semesterValue ? 'selected' : '' }}>
                                        {{ $semesterName }}
                                    </option>
                                @endforeach
                            </select>
                            @error('semester')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <x-admin-button :title="'Simpan Perubahan'" />
            </form>
        </div>
    </div>
</x-app-layout>
