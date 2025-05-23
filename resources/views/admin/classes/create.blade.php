<x-app-layout>
    <div class="p-6 space-y-6 mt-16 overflow-y-auto">
        <div class="glass-card border-glow rounded-xl p-6 shadow-md">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white deco-line"
                style="--line-color: rgba(99, 102, 241, 0.7)">Tambah Kelas Baru</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Lengkapi formulir berikut untuk menambahkan data
                kelas baru</p>
        </div>
        <div class="rounded-xl border p-6 shadow-md">
            <div class="mb-6 flex items-center gap-2">
                <a href="{{ route('admin.classes.index') }}"
                    class="rounded-lg transition-all hover:bg-blue-50 dark:hover:bg-blue-900/20 inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-200 dark:hover:text-blue-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>

            <form action="{{ route('admin.classes.store') }}" method="POST" class="space-y-6">
                @csrf
                <div
                    class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm transition-all hover:shadow dark:border-gray-700 dark:bg-gray-800">
                    <div class="mb-4 flex items-center gap-3">
                        <div class="rounded-full bg-blue-100 p-2 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Informasi Kelas</h2>
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="space-y-2">
                            <label for="class_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Nama Kelas <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="class_name" id="class_name" value="{{ old('class_name') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            @error('class_name')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="level" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Tingkat <span class="text-red-500">*</span>
                            </label>
                            <select name="level" id="level"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <option value="">Pilih Tingkat</option>
                                <option value="10" {{ old('level') == 10 ? 'selected' : '' }}>10</option>
                                <option value="11" {{ old('level') == 11 ? 'selected' : '' }}>11</option>
                                <option value="12" {{ old('level') == 12 ? 'selected' : '' }}>12</option>
                            </select>
                            @error('level')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="major" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Jurusan <span class="text-red-500">*</span>
                            </label>
                            <select name="major" id="major"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <option value="">Pilih Jurusan</option>
                                <option value="IPA" {{ old('major') == 'IPA' ? 'selected' : '' }}>IPA (Science)
                                </option>
                                <option value="IPS" {{ old('major') == 'IPS' ? 'selected' : '' }}>IPS (Social)
                                </option>
                            </select>
                            @error('major')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="academic_year"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Tahun Akademik <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="academic_year" id="academic_year"
                                value="{{ old('academic_year', date('Y') . '/' . ((int) date('Y') + 1)) }}"
                                placeholder="contoh: 2025/2026" pattern="[0-9]{4}/[0-9]{4}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            <p class="text-gray-500 text-xs mt-1">Format: YYYY/YYYY (contoh: 2025/2026)</p>
                            @error('academic_year')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="space-y-2 md:col-span-2">
                            <label for="homeroom_teacher_id"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Wali Kelas
                            </label>
                            <select name="homeroom_teacher_id" id="homeroom_teacher_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <option value="">Pilih Guru</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}"
                                        {{ old('homeroom_teacher_id') == $teacher->id ? 'selected' : '' }}>
                                        {{ $teacher->user->name }} (NIP: {{ $teacher->nip }})
                                    </option>
                                @endforeach
                            </select>
                            @error('homeroom_teacher_id')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-end gap-4">
                    <a href="{{ route('admin.classes.index') }}"
                        class="rounded-lg px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:text-gray-400 dark:hover:bg-gray-800 dark:focus:ring-gray-700">
                        Batal
                    </a>
                    <button type="submit"
                        class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Simpan Kelas
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
