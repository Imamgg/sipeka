@props(['classes'])
<x-app-layout>
    <!-- Header Section dengan design konsisten dashboard -->
    <div class="bg-gradient-to-br from-blue-50 via-white to-indigo-50 relative overflow-hidden border-b border-gray-100">
        <div class="relative px-6 py-8 sm:px-10">
            <div class="max-w-7xl mx-auto">
                <div class="text-center">
                    <div
                        class="inline-flex items-center px-4 py-2 rounded-full bg-blue-100 text-blue-700 text-sm font-medium mb-4">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Tambah Data Siswa
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-3">
                        Registrasi <span
                            class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Siswa
                            Baru</span>
                    </h1>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">Lengkapi formulir berikut untuk mendaftarkan
                        siswa baru ke dalam sistem SIPEKA</p>
                </div>
            </div>
        </div>
    </div>

    <div class="px-6 py-8 space-y-8 bg-gray-50">
        <div class="max-w-4xl mx-auto">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('admin.students.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-white border rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Daftar Siswa
                </a>
            </div>

            <form action="{{ route('admin.students.store') }}" method="POST" class="space-y-8" id="createForm">
                @csrf

                <!-- Informasi Akun -->
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
                    <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-indigo-50">
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-10 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Informasi Akun</h3>
                                <p class="text-sm text-gray-500">Data login dan kontak siswa</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="grid gap-6 md:grid-cols-2">
                            <div class="space-y-2">
                                <label for="name" class="block text-sm font-medium text-gray-700">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}"
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm @error('name') border-red-500 ring-2 ring-red-200 @enderror"
                                    placeholder="Masukkan nama lengkap siswa">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="email" class="block text-sm font-medium text-gray-700">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}"
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm @error('email') border-red-500 ring-2 ring-red-200 @enderror"
                                    placeholder="contoh@email.com">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="password" class="block text-sm font-medium text-gray-700">
                                    Password <span class="text-red-500">*</span>
                                </label>
                                <input type="password" name="password" id="password"
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm @error('password') border-red-500 ring-2 ring-red-200 @enderror"
                                    placeholder="Minimal 8 karakter">
                                @error('password')
                                    <p class="mt-1 text-sm text-red-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                                    Konfirmasi Password <span class="text-red-500">*</span>
                                </label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm"
                                    placeholder="Ulangi password">
                            </div>

                            <div class="space-y-2 md:col-span-2">
                                <label for="phone_number" class="block text-sm font-medium text-gray-700">
                                    Nomor Telepon
                                </label>
                                <input type="text" name="phone_number" id="phone_number"
                                    value="{{ old('phone_number') }}"
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm @error('phone_number') border-red-500 ring-2 ring-red-200 @enderror"
                                    placeholder="08xxxxxxxxxx">
                                @error('phone_number')
                                    <p class="mt-1 text-sm text-red-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div> <!-- Informasi Siswa -->
                <div
                    class="bg-white rounded-2xl sm:rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 border-b border-gray-200">
                        <div class="flex items-center gap-3">
                            <div class="rounded-full bg-blue-100 p-3 text-blue-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-900">Informasi Siswa</h2>
                                <p class="text-sm text-gray-600">Data akademik dan identitas siswa</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 sm:p-6">
                        <div class="grid gap-4 sm:gap-6 grid-cols-1 md:grid-cols-2">
                            <div class="space-y-2">
                                <label for="nis" class="block text-sm font-semibold text-gray-700">
                                    NIS <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nis" id="nis" value="{{ old('nis') }}"
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm @error('nis') border-red-500 ring-2 ring-red-200 @enderror">
                                @error('nis')
                                    <p class="mt-1 text-sm text-red-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="nisn" class="block text-sm font-semibold text-gray-700">
                                    NISN
                                </label>
                                <input type="text" name="nisn" id="nisn" value="{{ old('nisn') }}"
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm @error('nisn') border-red-500 ring-2 ring-red-200 @enderror"
                                    placeholder="Masukkan NISN">
                                @error('nisn')
                                    <p class="mt-1 text-sm text-red-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="place_of_birth" class="block text-sm font-semibold text-gray-700">
                                    Tempat Lahir <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="place_of_birth" id="place_of_birth"
                                    value="{{ old('place_of_birth') }}"
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm @error('place_of_birth') border-red-500 ring-2 ring-red-200 @enderror">
                                @error('place_of_birth')
                                    <p class="mt-1 text-sm text-red-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="date_of_birth" class="block text-sm font-semibold text-gray-700">
                                    Tanggal Lahir <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="date_of_birth" id="date_of_birth"
                                    value="{{ old('date_of_birth') }}"
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm @error('date_of_birth') border-red-500 ring-2 ring-red-200 @enderror">
                                @error('date_of_birth')
                                    <p class="mt-1 text-sm text-red-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="space-y-3">
                                <label class="block text-sm font-semibold text-gray-700">
                                    Jenis Kelamin <span class="text-red-500">*</span>
                                </label>
                                <div class="flex gap-2 md:gap-6 flex-col md:flex-row">
                                    <label class="flex items-center group cursor-pointer">
                                        <input type="radio" name="gender" value="M"
                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 transition-all"
                                            {{ old('gender') == 'M' ? 'checked' : '' }}>
                                        <span
                                            class="ml-3 text-sm font-medium text-gray-700 group-hover:text-blue-600 transition-colors">Laki-laki</span>
                                    </label>
                                    <label class="flex items-center group cursor-pointer">
                                        <input type="radio" name="gender" value="F"
                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 transition-all"
                                            {{ old('gender') == 'F' ? 'checked' : '' }}>
                                        <span
                                            class="ml-3 text-sm font-medium text-gray-700 group-hover:text-blue-600 transition-colors">Perempuan</span>
                                    </label>
                                </div>
                                @error('gender')
                                    <p class="mt-1 text-sm text-red-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="class_id" class="block text-sm font-semibold text-gray-700">
                                    Kelas
                                </label>
                                <select name="class_id" id="class_id"
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm @error('class_id') border-red-500 ring-2 ring-red-200 @enderror">
                                    <option value="">Pilih Kelas</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}"
                                            {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                            {{ $class->class_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('class_id')
                                    <p class="mt-1 text-sm text-red-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="col-span-2 space-y-2">
                                <label for="address" class="block text-sm font-semibold text-gray-700">
                                    Alamat <span class="text-red-500">*</span>
                                </label>
                                <textarea name="address" id="address" rows="4"
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm resize-none @error('address') border-red-500 ring-2 ring-red-200 @enderror"
                                    placeholder="Masukkan alamat lengkap">{{ old('address') }}</textarea>
                                @error('address')
                                    <p class="mt-1 text-sm text-red-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Orang Tua -->
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
                    <div class="bg-gradient-to-r from-emerald-50 to-green-50 p-6 border-b border-gray-200">
                        <div class="flex items-center gap-3">
                            <div class="rounded-full bg-emerald-100 p-3 text-emerald-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-900">Data Orang Tua</h2>
                                <p class="text-sm text-gray-600">Informasi orang tua/wali siswa</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="grid gap-6 md:grid-cols-2">
                            <div class="space-y-2">
                                <label for="father_name" class="block text-sm font-semibold text-gray-700">
                                    Nama Ayah
                                </label>
                                <input type="text" name="father_name" id="father_name"
                                    value="{{ old('father_name') }}"
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm @error('father_name') border-red-500 ring-2 ring-red-200 @enderror"
                                    placeholder="Masukkan nama ayah">
                                @error('father_name')
                                    <p class="mt-1 text-sm text-red-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="mother_name" class="block text-sm font-semibold text-gray-700">
                                    Nama Ibu
                                </label>
                                <input type="text" name="mother_name" id="mother_name"
                                    value="{{ old('mother_name') }}"
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm @error('mother_name') border-red-500 ring-2 ring-red-200 @enderror"
                                    placeholder="Masukkan nama ibu">
                                @error('mother_name')
                                    <p class="mt-1 text-sm text-red-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Submit Button -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <div class="flex flex-col sm:flex-row gap-4 sm:justify-end">
                        <a href="{{ route('admin.students.index') }}"
                            class="inline-flex items-center justify-center px-6 py-3 border rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm hover:shadow-md">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali
                        </a>
                        <button type="submit" id="submitBtn"
                            class="inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-semibold rounded-lg hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed">
                            <svg id="loadingIcon" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white hidden"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Simpan Data</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            const form = document.getElementById('createForm');
            const submitBtn = document.getElementById('submitBtn');
            const loadingIcon = document.getElementById('loadingIcon');

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                submitBtn.disabled = true;
                loadingIcon.classList.remove('hidden');
                submitBtn.querySelector('span').textContent = 'Menyimpan...';
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
