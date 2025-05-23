<x-app-layout>
    <div class="p-6 space-y-6 mt-16 overflow-y-auto">
        <div class="glass-card border-glow rounded-xl p-6 shadow-md">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white deco-line"
                style="--line-color: rgba(99, 102, 241, 0.7)">Detail Guru</h1>
            <p class="text-muted-foreground mt-1 max-w-2xl text-sm text-gray-600 dark:text-gray-400">
                Informasi lengkap tentang data guru yang tersimpan dalam sistem.
            </p>
        </div>

        <div class="rounded-xl border p-6 shadow-md">
            <div class="mb-6 flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-center">
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.teachers.index') }}"
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
                            <dt class="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">NIP</dt>
                            <dd class="flex-1 text-gray-900 dark:text-white">{{ $teacher->nip }}</dd>
                        </div>
                        <div
                            class="flex items-start gap-3 rounded-md p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800/60">
                            <dt class="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">Nama</dt>
                            <dd class="flex-1 text-gray-900 dark:text-white">{{ $teacher->user->name }}</dd>
                        </div>
                        <div
                            class="flex items-start gap-3 rounded-md p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800/60">
                            <dt class="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">Email
                            </dt>
                            <dd class="flex-1 text-gray-900 dark:text-white">{{ $teacher->user->email }}</dd>
                        </div>
                        <div
                            class="flex items-start gap-3 rounded-md p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800/60">
                            <dt class="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">Telepon
                            </dt>
                            <dd class="flex-1 text-gray-900 dark:text-white">{{ $teacher->phone_number ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>

                <!-- Informasi Pribadi -->
                <div
                    class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm transition-all hover:shadow dark:border-gray-700 dark:bg-gray-800">
                    <div class="mb-4 flex items-center gap-3">
                        <div
                            class="rounded-full bg-indigo-100 p-2 text-indigo-600 dark:bg-indigo-900/30 dark:text-indigo-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Informasi Pribadi</h2>
                    </div>

                    <dl class="space-y-4">
                        <div
                            class="flex items-start gap-3 rounded-md p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800/60">
                            <dt class="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">TTL</dt>
                            <dd class="flex-1 text-gray-900 dark:text-white">
                                {{ $teacher->place_of_birth }}, {{ $teacher->date_of_birth->isoFormat('D MMMM Y') }}
                            </dd>
                        </div>
                        <div
                            class="flex items-start gap-3 rounded-md p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800/60">
                            <dt class="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">Gender
                            </dt>
                            <dd>
                                <span
                                    class="inline-flex rounded-full px-2.5 py-0.5 text-sm font-medium {{ $teacher->gender === 'M' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' : 'bg-pink-100 text-pink-800 dark:bg-pink-900/30 dark:text-pink-400' }}">
                                    {{ $teacher->gender === 'M' ? 'Laki-laki' : 'Perempuan' }}
                                </span>
                            </dd>
                        </div>
                        <div
                            class="flex items-start gap-3 rounded-md p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800/60">
                            <dt class="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">Alamat
                            </dt>
                            <dd class="flex-1 text-gray-900 dark:text-white">{{ $teacher->address }}</dd>
                        </div>
                        <div
                            class="flex items-start gap-3 rounded-md p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800/60">
                            <dt class="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">
                                Terdaftar</dt>
                            <dd class="flex-1 text-gray-900 dark:text-white">
                                {{ $teacher->created_at->isoFormat('D MMMM Y') }}
                            </dd>
                        </div>
                        <div
                            class="flex items-start gap-3 rounded-md p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800/60">
                            <dt class="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">
                                Diperbarui</dt>
                            <dd class="flex-1 text-gray-900 dark:text-white">
                                {{ $teacher->updated_at->isoFormat('D MMMM Y') }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.querySelector('.delete-form').addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data guru ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
