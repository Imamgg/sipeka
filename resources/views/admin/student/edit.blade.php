@props(['student', 'classes'])
<x-app-layout>
    <div class="p-6 space-y-6 mt-16 overflow-y-auto">
        <div class="glass-card border-glow rounded-xl p-6 shadow-md">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white deco-line"
                style="--line-color: rgba(99, 102, 241, 0.7)">Edit Data Siswa</h1>
            <p class="text-muted-foreground mt-1 max-w-2xl text-sm text-gray-600 dark:text-gray-400">Perbarui data siswa
                dengan mengubah formulir di bawah ini.</p>
        </div>

        <div class="rounded-xl border p-6 shadow-md">
            <div class="mb-6 flex items-center gap-2">
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

            <form action="{{ route('admin.students.update', $student->id) }}" method="POST" class="space-y-6"
                id="editForm">
                @csrf
                @method('PUT')

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

                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="space-y-2">
                            <label for="name"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Lengkap <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name"
                                value="{{ old('name', $student->user->name) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            @error('name')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="email"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email <span
                                    class="text-red-500">*</span></label>
                            <input type="email" name="email" id="email"
                                value="{{ old('email', $student->user->email) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            @error('email')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="password"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password (kosongkan
                                jika
                                tidak ingin mengubah)</label>
                            <input type="password" name="password" id="password"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            @error('password')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="password_confirmation"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Konfirmasi
                                Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        </div>

                        <div class="space-y-2">
                            <label for="phone_number"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor Telepon</label>
                            <input type="text" name="phone_number" id="phone_number"
                                value="{{ old('phone_number', $student->user->phone_number) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            @error('phone_number')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
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

                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="space-y-2">
                            <label for="nis" class="block text-sm font-medium text-gray-700 dark:text-gray-300">NIS
                                <span class="text-red-500">*</span></label>
                            <input type="text" name="nis" id="nis" value="{{ old('nis', $student->nis) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            @error('nis')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="nisn" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                NISN
                            </label>
                            <input type="text" name="nisn" id="nisn"
                                value="{{ old('nisn', $student->nisn) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            @error('nisn')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="place_of_birth"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tempat Lahir <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="place_of_birth" id="place_of_birth"
                                value="{{ old('place_of_birth', $student->place_of_birth) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            @error('place_of_birth')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="date_of_birth"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Lahir <span
                                    class="text-red-500">*</span></label>
                            <input type="date" name="date_of_birth" id="date_of_birth"
                                value="{{ old('date_of_birth', $student->date_of_birth ? date('Y-m-d', strtotime($student->date_of_birth)) : '') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            @error('date_of_birth')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Kelamin
                                <span class="text-red-500">*</span></label>
                            <div class="mt-2 flex gap-4">
                                <label class="flex items-center">
                                    <input type="radio" name="gender" value="M"
                                        class="h-4 w-4 border-gray-300 text-blue-600 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700"
                                        {{ old('gender', $student->gender) == 'M' ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Laki-laki</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="gender" value="F"
                                        class="h-4 w-4 border-gray-300 text-blue-600 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700"
                                        {{ old('gender', $student->gender) == 'F' ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Perempuan</span>
                                </label>
                            </div>
                            @error('gender')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="class_id"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kelas</label>
                            <select name="class_id" id="class_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <option value="">Pilih Kelas</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}"
                                        {{ old('class_id', $student->class_id) == $class->id ? 'selected' : '' }}>
                                        {{ $class->class_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('class_id')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-2 space-y-2">
                            <label for="address"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat <span
                                    class="text-red-500">*</span></label>
                            <textarea name="address" id="address" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">{{ old('address', $student->address) }}</textarea>
                            @error('address')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="father_name"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Nama Ayah
                            </label>
                            <input type="text" name="father_name" id="father_name"
                                value="{{ old('father_name', $student->father_name) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            @error('father_name')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="mother_name"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Nama Ibu
                            </label>
                            <input type="text" name="mother_name" id="mother_name"
                                value="{{ old('mother_name', $student->mother_name) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            @error('mother_name')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <x-admin-button :title="'Simpan Perubahan'" />
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            const form = document.getElementById('editForm');
            const submitBtn = document.getElementById('submitBtn');
            const loadingIcon = document.getElementById('loadingIcon');

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Show loading state
                submitBtn.disabled = true;
                loadingIcon.classList.remove('hidden');
                submitBtn.querySelector('span').textContent = 'Menyimpan...';

                // Submit the form
                form.submit();
            });

            @if ($errors->any())
                Swal.fire({
                    title: 'Validasi Error',
                    html: '{!! implode('<br>', $errors->all()) !!}',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            @endif
        </script>
    @endpush
</x-app-layout>
