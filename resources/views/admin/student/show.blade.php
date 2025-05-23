<x-app-layout>
    <div class="p-6 space-y-6 mt-16 overflow-y-auto">
        <div class="glass-card border-glow rounded-xl p-6 shadow-md">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white deco-line"
                style="--line-color: rgba(99, 102, 241, 0.7)">Detail Siswa</h1>
            <p class="text-muted-foreground mt-1 max-w-2xl text-sm text-gray-600 dark:text-gray-400">Informasi
                lengkap tentang data siswa yang tersimpan dalam sistem.</p>
        </div>

        <div class="rounded-xl border p-6 shadow-md">
            <div class="mb-6 flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-center">
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.students.index') }}"
                        class="rounded-lg transition-all hover:bg-blue-50 dark:hover:bg-blue-900/20 inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-200 dark:hover:text-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                <!-- Informasi Akun -->
                <div
                    class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm transition-all hover:shadow dark:border-gray-700 dark:bg-gray-800">
                    <div class="mb-4 flex items-center gap-3">
                        <div class="rounded-full bg-blue-100 p-2 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Informasi Akun</h2>
                    </div>

                    <dl class="space-y-4">
                        <div
                            class="flex items-start gap-3 rounded-md p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800/60">
                            <dt class="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">NIS</dt>
                            <dd class="flex-1 text-gray-900 dark:text-white">{{ $student->nis }}</dd>
                        </div>
                        <div
                            class="flex items-start gap-3 rounded-md p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800/60">
                            <dt class="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">NISN</dt>
                            <dd class="flex-1 text-gray-900 dark:text-white">{{ $student->nisn ?? '-' }}</dd>
                        </div>
                        <div
                            class="flex items-start gap-3 rounded-md p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800/60">
                            <dt class="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">Email
                            </dt>
                            <dd class="flex-1 text-gray-900 dark:text-white">{{ $student->user->email }}</dd>
                        </div>
                        <div
                            class="flex items-start gap-3 rounded-md p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800/60">
                            <dt class="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">Telepon
                            </dt>
                            <dd class="flex-1 text-gray-900 dark:text-white">{{ $student->user->phone_number ?? '-' }}
                            </dd>
                        </div>
                        <div
                            class="flex items-start gap-3 rounded-md p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800/60">
                            <dt class="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">Kelas
                            </dt>
                            <dd class="flex-1 text-gray-900 dark:text-white">{{ $student->class->class_name ?? '-' }}
                            </dd>
                        </div>
                    </dl>
                </div>

                <!-- Informasi Siswa -->
                <div
                    class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm transition-all hover:shadow dark:border-gray-700 dark:bg-gray-800">
                    <div class="mb-4 flex items-center gap-3">
                        <div
                            class="rounded-full bg-indigo-100 p-2 text-indigo-600 dark:bg-indigo-900/30 dark:text-indigo-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path
                                    d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            </svg>
                        </div>
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Informasi Siswa</h2>
                    </div>

                    <dl class="space-y-4">
                        <div
                            class="flex items-start gap-3 rounded-md p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800/60">
                            <dt class="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">TTL</dt>
                            <dd class="flex-1 text-gray-900 dark:text-white">
                                {{ $student->place_of_birth }}, {{ $student->date_of_birth->isoFormat('D MMMM Y') }}
                            </dd>
                        </div>
                        <div
                            class="flex items-start gap-3 rounded-md p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800/60">
                            <dt class="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">Jenis
                                Kelamin
                            </dt>
                            <dd class="flex-1">
                                <span
                                    class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium backdrop-blur-sm {{ $student->gender === 'M' ? 'bg-blue-100/80 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300' : 'bg-pink-100/80 text-pink-800 dark:bg-pink-900/40 dark:text-pink-300' }}">
                                    {{ $student->gender === 'M' ? 'Laki-laki' : 'Perempuan' }}
                                </span>
                            </dd>
                        </div>
                        <div
                            class="flex items-start gap-3 rounded-md p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800/60">
                            <dt t class="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">Alamat
                            </dt>
                            <dd class="flex-1 text-gray-900 dark:text-white">
                                {{ $student->address }}
                            </dd>
                        </div>
                        <div
                            class="flex items-start gap-3 rounded-md p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800/60">
                            <dt class="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">Nama Ayah
                            </dt>
                            <dd class="flex-1 text-gray-900 dark:text-white">{{ $student->father_name ?? '-' }}</dd>
                        </div>
                        <div
                            class="flex items-start gap-3 rounded-md p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800/60">
                            <dt class="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">Nama Ibu
                            </dt>
                            <dd class="flex-1 text-gray-900 dark:text-white">{{ $student->mother_name ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>

                <!-- Informasi Waktu -->
                <div
                    class="lg:col-span-2 rounded-lg border border-gray-200 bg-white p-5 shadow-sm transition-all hover:shadow dark:border-gray-700 dark:bg-gray-800">
                    <div class="mb-4 flex items-center gap-3">
                        <div
                            class="rounded-full bg-orange-100 p-2 text-orange-600 dark:bg-orange-900/30 dark:text-orange-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Informasi Waktu</h2>
                    </div>

                    <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div
                            class="flex items-start gap-3 rounded-md p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800/60">
                            <dt class="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">Dibuat
                            </dt>
                            <dd class="flex-1 text-gray-900 dark:text-white">
                                {{ $student->created_at->isoFormat('D MMMM Y') }}
                            </dd>
                        </div>
                        <div
                            class="flex items-start gap-3 rounded-md p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800/60">
                            <dt class="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">
                                Diperbarui</dt>
                            <dd class="flex-1 text-gray-900 dark:text-white">
                                {{ $student->updated_at->isoFormat('D MMMM Y') }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
