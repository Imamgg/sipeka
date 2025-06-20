@props(['positions'])
<x-app-layout>
    <!-- Header Section with Gradient Background -->
    <div class="bg-gradient-to-br from-indigo-50 via-white to-blue-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <!-- Page Badge -->
                <div
                    class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 border border-green-200 mb-4">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Data Guru
                </div>

                <!-- Main Title -->
                <h1 class="text-4xl font-bold text-gray-900 mb-3">
                    <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                        Tambah Guru Baru
                    </span>
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Lengkapi formulir berikut untuk menambahkan data guru baru ke dalam sistem
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Back Button -->
            <div class="mb-8">
                <a href="{{ route('admin.teachers.index') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border  rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Daftar Guru
                </a>
            </div>

            <form action="{{ route('admin.teachers.store') }}" method="POST" class="space-y-8">
                @csrf

                <!-- Informasi Akun -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 p-6 border-b border-gray-200">
                        <div class="flex items-center gap-3">
                            <div class="rounded-full bg-purple-100 p-3 text-purple-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-900">Informasi Akun</h2>
                                <p class="text-sm text-gray-600">Data login dan kontak guru</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="grid gap-6 md:grid-cols-2">
                            <div class="space-y-2">
                                <label for="name" class="block text-sm font-medium text-gray-700">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label> <input type="text" name="name" id="name" value="{{ old('name') }}"
                                    placeholder="Masukkan nama lengkap guru"
                                    class="w-full rounded-xl border @error('name') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror bg-gray-50 px-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 transition-all duration-200">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="email" class="block text-sm font-medium text-gray-700">
                                    Email <span class="text-red-500">*</span>
                                </label> <input type="email" name="email" id="email" value="{{ old('email') }}"
                                    placeholder="contoh@email.com"
                                    class="w-full rounded-xl border @error('email') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror bg-gray-50 px-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 transition-all duration-200">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="password" class="block text-sm font-medium text-gray-700">
                                    Password <span class="text-red-500">*</span>
                                </label>
                                <input type="password" name="password" id="password" placeholder="Minimal 8 karakter"
                                    class="w-full rounded-xl border  bg-gray-50 px-4 py-3 text-sm  focus:bg-white focus:outline-none focus:ring-2 transition-all duration-200 @error('password') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror">
                                @error('password')
                                    <p class="mt-1 text-sm text-red-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
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
                                    placeholder="Ulangi password"
                                    class="w-full rounded-xl border  bg-gray-50 px-4 py-3 text-sm  focus:bg-white focus:outline-none focus:ring-2 transition-all duration-200">
                            </div>

                            <div class="space-y-2 md:col-span-2">
                                <label for="phone_number" class="block text-sm font-medium text-gray-700">
                                    Nomor Telepon
                                </label>
                                <input type="text" name="phone_number" id="phone_number"
                                    value="{{ old('phone_number') }}" placeholder="08xxxxxxxxxx"
                                    class="w-full rounded-xl border  bg-gray-50 px-4 py-3 text-sm  focus:bg-white focus:outline-none focus:ring-2 transition-all duration-200 @error('phone_number') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror">
                                @error('phone_number')
                                    <p class="mt-1 text-sm text-red-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Informasi Guru -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-4 sm:p-6 border-b border-gray-200">
                        <div class="flex items-center gap-3">
                            <div class="rounded-full bg-blue-100 p-2 sm:p-3 text-blue-600 flex-shrink-0">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z">
                                    </path>
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <h2 class="text-lg sm:text-xl font-bold text-gray-900">Informasi Guru</h2>
                                <p class="text-xs sm:text-sm text-gray-600">Data identitas dan akademik guru</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 sm:p-6">
                        <div class="grid gap-4 sm:gap-6 md:grid-cols-2">
                            <div class="space-y-2">
                                <label for="nip" class="block text-sm font-medium text-gray-700">
                                    NIP <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nip" id="nip" value="{{ old('nip') }}"
                                    placeholder="Nomor Induk Pegawai"
                                    class="w-full rounded-xl border bg-gray-50 px-3 py-2.5 sm:px-4 sm:py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 transition-all duration-200 @error('nip') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror">
                                @error('nip')
                                    <p class="mt-1 text-sm text-red-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="break-words">{{ $message }}</span>
                                    </p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="place_of_birth" class="block text-sm font-medium text-gray-700">
                                    Tempat Lahir <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="place_of_birth" id="place_of_birth"
                                    value="{{ old('place_of_birth') }}" placeholder="Kota tempat lahir"
                                    class="w-full rounded-xl border bg-gray-50 px-3 py-2.5 sm:px-4 sm:py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 transition-all duration-200 @error('place_of_birth') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror">
                                @error('place_of_birth')
                                    <p class="mt-1 text-sm text-red-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="break-words">{{ $message }}</span>
                                    </p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="date_of_birth" class="block text-sm font-medium text-gray-700">
                                    Tanggal Lahir <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="date_of_birth" id="date_of_birth"
                                    value="{{ old('date_of_birth') }}"
                                    class="w-full rounded-xl border bg-gray-50 px-3 py-2.5 sm:px-4 sm:py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 transition-all duration-200 @error('date_of_birth') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror">
                                @error('date_of_birth')
                                    <p class="mt-1 text-sm text-red-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="break-words">{{ $message }}</span>
                                    </p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    Jenis Kelamin <span class="text-red-500">*</span>
                                </label>
                                <div class="flex flex-col sm:flex-row gap-2 sm:gap-4 mt-2">
                                    <label
                                        class="flex items-center bg-gray-50 rounded-xl cursor-pointer hover:bg-gray-100 transition-colors">
                                        <input type="radio" name="gender" value="M"
                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 flex-shrink-0"
                                            {{ old('gender') == 'M' ? 'checked' : '' }}>
                                        <span class="ml-3 text-sm font-medium text-gray-700">Laki-laki</span>
                                    </label>
                                    <label
                                        class="flex items-center bg-gray-50 rounded-xl cursor-pointer hover:bg-gray-100 transition-colors">
                                        <input type="radio" name="gender" value="F"
                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 flex-shrink-0"
                                            {{ old('gender') == 'F' ? 'checked' : '' }}>
                                        <span class="ml-3 text-sm font-medium text-gray-700">Perempuan</span>
                                    </label>
                                </div>
                                @error('gender')
                                    <p class="mt-1 text-sm text-red-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="col-span-2 space-y-2">
                                <label for="address" class="block text-sm font-medium text-gray-700">
                                    Alamat <span class="text-red-500">*</span>
                                </label>
                                <textarea name="address" id="address" rows="4" placeholder="Alamat lengkap tempat tinggal"
                                    class="w-full rounded-xl border  bg-gray-50 px-4 py-3 text-sm  focus:bg-white focus:outline-none focus:ring-2 transition-all duration-200 resize-none @error('address') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror">{{ old('address') }}</textarea>
                                @error('address')
                                    <p class="mt-1 text-sm text-red-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-end space-x-4">
                    <a href="{{ route('admin.teachers.index') }}"
                        class="inline-flex items-center px-6 py-3 rounded-xl text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-8 py-3 rounded-xl text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-4 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <span class="loading-text">Simpan Data Guru</span>
                        <span class="loading-spinner hidden">
                            <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            Menyimpan...
                        </span>
                    </button>
                </div>
            </form>
        </div>

        @push('scripts')
            <script>
                // Form loading state
                document.querySelector('form').addEventListener('submit', function() {
                    const button = this.querySelector('button[type="submit"]');
                    const loadingText = button.querySelector('.loading-text');
                    const loadingSpinner = button.querySelector('.loading-spinner');

                    button.disabled = true;
                    loadingText.classList.add('hidden');
                    loadingSpinner.classList.remove('hidden');
                });
            </script>
        @endpush
</x-app-layout>
