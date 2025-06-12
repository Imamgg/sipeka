<x-teacher-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h2 class="text-2xl font-bold text-white">
                                Edit Profil Guru
                            </h2>
                            <p class="text-blue-100 text-sm">
                                Kelola informasi profil dan pengaturan akun Anda
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- Profile Summary Card -->
            <div class="bg-white overflow-hidden shadow-xl rounded-xl mb-8">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-8">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-20 w-20 rounded-full bg-white bg-opacity-20 flex items-center justify-center">
                                <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </div>
                        </div>
                        <div class="ml-6">
                            <h3 class="text-2xl font-bold text-white">{{ $user->name }}</h3>
                            <p class="text-blue-100">{{ $user->email }}</p>
                            <div class="mt-2 flex items-center text-blue-100">
                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                    </path>
                                </svg>
                                <span class="text-sm">NIP: {{ $teacher->nip ?? 'Belum diatur' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column - Profile Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-xl rounded-xl">
                        <div class="px-6 py-8">
                            <div class="flex items-center mb-6">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-blue-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-xl font-bold text-gray-900">Informasi Pribadi</h3>
                                    <p class="text-sm text-gray-600">Update informasi pribadi Anda di bawah ini</p>
                                </div>
                            </div>
                            @if (session('success'))
                                <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="text-green-800 font-medium">{{ session('success') }}</span>
                                    </div>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 text-red-500 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        <span class="text-red-800 font-medium">{{ session('error') }}</span>
                                    </div>
                                </div>
                            @endif
                            <form action="{{ route('teacher.profile.update') }}" method="POST" class="space-y-8">
                                @csrf
                                @method('PUT')

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Basic Information -->
                                    <div>
                                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                            Nama Lengkap <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input type="text" name="name" id="name"
                                                value="{{ old('name', $user->name) }}"
                                                class="block w-full rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 pl-10 @error('name') border-red-500 @enderror">
                                            <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                        @error('name')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                            Email <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input type="email" name="email" id="email"
                                                value="{{ old('email', $user->email) }}"
                                                class="block w-full rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 pl-10 @error('email') border-red-500 @enderror">
                                            <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                                <svg class="h-5 w-5 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                        @error('email')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="nip" class="block text-sm font-semibold text-gray-700 mb-2">
                                            NIP <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input type="text" name="nip" id="nip"
                                                value="{{ old('nip', $teacher->nip) }}"
                                                class="block w-full rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 pl-10 @error('nip') border-red-500 @enderror">
                                            <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                                <svg class="h-5 w-5 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                        @error('nip')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="phone_number"
                                            class="block text-sm font-semibold text-gray-700 mb-2">
                                            Nomor Telepon
                                        </label>
                                        <div class="relative">
                                            <input type="text" name="phone_number" id="phone_number"
                                                value="{{ old('phone_number', $teacher->phone_number) }}"
                                                class="block w-full rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 pl-10 @error('phone_number') border-red-500 @enderror">
                                            <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                                <svg class="h-5 w-5 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                        @error('phone_number')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="place_of_birth"
                                            class="block text-sm font-semibold text-gray-700 mb-2">
                                            Tempat Lahir
                                        </label>
                                        <div class="relative">
                                            <input type="text" name="place_of_birth" id="place_of_birth"
                                                value="{{ old('place_of_birth', $teacher->place_of_birth) }}"
                                                class="block w-full rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 pl-10 @error('place_of_birth') border-red-500 @enderror">
                                            <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                                <svg class="h-5 w-5 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                    </path>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        @error('place_of_birth')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="date_of_birth"
                                            class="block text-sm font-semibold text-gray-700 mb-2">
                                            Tanggal Lahir
                                        </label>
                                        <div class="relative">
                                            <input type="date" name="date_of_birth" id="date_of_birth"
                                                value="{{ old('date_of_birth', $teacher->date_of_birth ? $teacher->date_of_birth->format('Y-m-d') : '') }}"
                                                class="block w-full rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 pl-10 @error('date_of_birth') border-red-500 @enderror">
                                            <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                                <svg class="h-5 w-5 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                        @error('date_of_birth')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="space-y-6">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="gender"
                                                class="block text-sm font-semibold text-gray-700 mb-2">
                                                Jenis Kelamin
                                            </label>
                                            <select name="gender" id="gender"
                                                class="block w-full rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('gender') border-red-500 @enderror">
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="male"
                                                    {{ old('gender', $teacher->gender) == 'male' ? 'selected' : '' }}>
                                                    Laki-laki</option>
                                                <option value="female"
                                                    {{ old('gender', $teacher->gender) == 'female' ? 'selected' : '' }}>
                                                    Perempuan</option>
                                            </select>
                                            @error('gender')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div>
                                        <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">
                                            Alamat
                                        </label>
                                        <textarea name="address" id="address" rows="3"
                                            class="block w-full rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('address') border-red-500 @enderror">{{ old('address', $teacher->address) }}</textarea>
                                        @error('address')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Password Section -->
                                    <div class="pt-4 border-t border-gray-200">
                                        <h4 class="text-md font-medium text-gray-900 mb-4">Ubah Kata Sandi</h4>
                                        <p class="text-sm text-gray-600 mb-4">Kosongkan jika tidak ingin mengubah kata
                                            sandi.</p>

                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                            <div>
                                                <label for="current_password"
                                                    class="block text-sm font-medium text-gray-700 mb-2">
                                                    Kata Sandi Saat Ini
                                                </label>
                                                <input type="password" name="current_password" id="current_password"
                                                    class="block w-full rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('current_password') border-red-500 @enderror">
                                                @error('current_password')
                                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="password"
                                                    class="block text-sm font-medium text-gray-700 mb-2">
                                                    Kata Sandi Baru
                                                </label>
                                                <input type="password" name="password" id="password"
                                                    class="block w-full rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-500 @enderror">
                                                @error('password')
                                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="password_confirmation"
                                                    class="block text-sm font-medium text-gray-700 mb-2">
                                                    Konfirmasi Kata Sandi Baru
                                                </label>
                                                <input type="password" name="password_confirmation"
                                                    id="password_confirmation"
                                                    class="block w-full rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="mt-8 flex items-center justify-between pt-6 border-t border-gray-200">
                                    <a href="{{ route('teacher.dashboard') }}"
                                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition-colors">
                                        Kembali
                                    </a>

                                    <button type="submit"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition-colors">
                                        <svg class="inline-block h-5 w-5 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Update Profil
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-teacher-layout>
