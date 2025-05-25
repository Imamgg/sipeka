<x-app-layout>
    <div class="p-6 space-y-6 overflow-y-auto">
        <div class="glass-card border-glow rounded-xl p-6 shadow-md">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white deco-line"
                style="--line-color: rgba(99, 102, 241, 0.7)">Tambah Mata Pelajaran Baru</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Lengkapi formulir berikut untuk menambahkan mata
                pelajaran baru</p>
        </div>

        <div class="rounded-xl border p-6 shadow-md">
            <div class="mb-6 flex items-center gap-2">
                <a href="{{ route('admin.subjects.index') }}"
                    class="rounded-lg transition-all hover:bg-blue-50 dark:hover:bg-blue-900/20 inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-200 dark:hover:text-blue-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>

            <form action="{{ route('admin.subjects.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Informasi Mata Pelajaran -->
                <div
                    class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm transition-all hover:shadow dark:border-gray-700 dark:bg-gray-800">
                    <div class="mb-4 flex items-center gap-3">
                        <div
                            class="rounded-full bg-indigo-100 p-2 text-indigo-600 dark:bg-indigo-900/30 dark:text-indigo-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Informasi Mata Pelajaran</h2>
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="space-y-2">
                            <label for="code_subject"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Kode Mata Pelajaran <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="code_subject" id="code_subject"
                                value="{{ old('code_subject') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                placeholder="Contoh: MTK001">
                            @error('code_subject')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="subject_name"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Nama Mata Pelajaran <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="subject_name" id="subject_name"
                                value="{{ old('subject_name') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                placeholder="Contoh: Matematika">
                            @error('subject_name')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-2 space-y-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Deskripsi
                            </label>
                            <textarea name="description" id="description" rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                placeholder="Deskripsi singkat tentang mata pelajaran">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <x-admin-button :title="'Simpan Data'" />
            </form>
        </div>
    </div>
</x-app-layout>
