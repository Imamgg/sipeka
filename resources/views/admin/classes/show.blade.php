<x-app-layout>
    <div class="p-6 space-y-6 mt-16 overflow-y-auto">
        <div class="glass-card border-glow rounded-xl p-6 shadow-md">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white deco-line"
                style="--line-color: rgba(99, 102, 241, 0.7)">Detail Kelas</h1>
            <p class="text-muted-foreground mt-1 max-w-2xl text-sm text-gray-600 dark:text-gray-400">Informasi
                lengkap tentang kelas yang tersimpan dalam sistem.</p>
        </div>

        <div class="rounded-xl border p-6 shadow-md">
            <div class="mb-6 flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-center">
                <div class="flex items-center gap-2">
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
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                <!-- Informasi Kelas -->
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

                    <dl class="space-y-4">
                        <div
                            class="flex items-start gap-3 rounded-md p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800/60">
                            <dt class="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">Nama
                                Kelas</dt>
                            <dd class="flex-1 text-gray-900 dark:text-white">{{ $class->class_name }}</dd>
                        </div>
                        <div
                            class="flex items-start gap-3 rounded-md p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800/60">
                            <dt class="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">Tingkat
                            </dt>
                            <dd class="flex-1 text-gray-900 dark:text-white">{{ $class->level }}</dd>
                        </div>
                        <div
                            class="flex items-start gap-3 rounded-md p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800/60">
                            <dt class="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">Jurusan
                            </dt>
                            <dd class="flex-1 text-gray-900 dark:text-white">{{ $class->major }}</dd>
                        </div>
                        <div
                            class="flex items-start gap-3 rounded-md p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800/60">
                            <dt class="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">Tahun
                                Akademik</dt>
                            <dd class="flex-1 text-gray-900 dark:text-white">{{ $class->academic_year }}</dd>
                        </div>
                        <div
                            class="flex items-start gap-3 rounded-md p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800/60">
                            <dt class="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">Wali
                                Kelas</dt>
                            <dd class="flex-1 text-gray-900 dark:text-white">
                                {{ $class->teacher->user->name ?? 'Belum Ditugaskan' }}
                                @if ($class->teacher)
                                    <span class="text-gray-500">(NIP: {{ $class->teacher->nip }})</span>
                                @endif
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Daftar Siswa -->
        <div class="rounded-xl border p-6 shadow-md">
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Daftar Siswa dalam Kelas</h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Siswa-siswa yang terdaftar dalam kelas ini</p>
            </div>

            <div class="overflow-hidden rounded-lg border">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Nama</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    NIS</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Jenis Kelamin</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Tanggal Lahir</th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
                            @forelse ($class->students as $student)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $student->user->name }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900 dark:text-white">
                                        {{ $student->nis }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm">
                                        <span
                                            class="inline-flex rounded-full px-2 text-xs font-semibold leading-5 {{ $student->gender === 'M' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                            {{ $student->gender === 'M' ? 'Laki-laki' : 'Perempuan' }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                        {{ $student->date_of_birth->format('d-m-Y') }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-center text-sm font-medium"> <a
                                            href="{{ route('admin.students.show', $student) }}"
                                            class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300"
                                            title="Detail">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5"
                                        class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                        Tidak ada siswa dalam kelas ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const deleteBtn = document.querySelector('.delete-btn');
                if (deleteBtn) {
                    deleteBtn.addEventListener('click', function() {
                        const form = this.closest('form');

                        Swal.fire({
                            title: 'Apakah anda yakin?',
                            text: "Data kelas yang dihapus tidak dapat dikembalikan!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#ef4444',
                            cancelButtonColor: '#6b7280',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                }
            });
        </script>
    @endpush
</x-app-layout>
