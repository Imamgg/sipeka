<x-student-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-amber-500 to-amber-600 shadow-lg">
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
                                Edit Profil Siswa
                            </h2>
                            <p class="text-amber-100 text-sm">
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
                <div class="bg-gradient-to-r from-amber-500 to-amber-600 px-6 py-8">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-20 w-20 rounded-full bg-white bg-opacity-20 flex items-center justify-center">
                                <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-6">
                            <h3 class="text-2xl font-bold text-white">{{ $student->user->name }}</h3>
                            <p class="text-amber-100">{{ $student->user->email }}</p>
                            <div class="mt-2 flex items-center text-amber-100">
                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                    </path>
                                </svg>
                                <span class="text-sm">NIS: {{ $student->nis ?? 'Belum diatur' }}</span>
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
                                    <svg class="h-6 w-6 text-amber-500" fill="none" stroke="currentColor"
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
                            <form method="POST" action="{{ route('student.profile.update') }}" class="space-y-8">
                                @csrf
                                @method('PUT')

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Basic Information -->
                                    <div class="space-y-6">
                                        <div>
                                            <label for="name"
                                                class="block text-sm font-semibold text-gray-700 mb-2">
                                                <span class="flex items-center">
                                                    <svg class="h-4 w-4 mr-2 text-amber-500" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                        </path>
                                                    </svg>
                                                    Nama Lengkap <span class="text-red-500">*</span>
                                                </span>
                                            </label>
                                            <div class="relative">
                                                <input type="text" name="name" id="name"
                                                    value="{{ old('name', $student->user->name) }}"
                                                    class="block w-full rounded-lg shadow-sm focus:ring-amber-500 focus:border-amber-500 pl-10 @error('name') border-red-500 @enderror">
                                                <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                                    <svg class="h-5 w-5 text-gray-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            </div>
                                            @error('name')
                                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                                    <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="email"
                                                class="block text-sm font-semibold text-gray-700 mb-2">
                                                <span class="flex items-center">
                                                    <svg class="h-4 w-4 mr-2 text-amber-500" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                                        </path>
                                                    </svg>
                                                    Email <span class="text-red-500">*</span>
                                                </span>
                                            </label>
                                            <div class="relative">
                                                <input type="email" name="email" id="email"
                                                    value="{{ old('email', $student->user->email) }}"
                                                    class="block w-full rounded-lg shadow-sm focus:ring-amber-500 focus:border-amber-500 pl-10 @error('email') border-red-500 @enderror">
                                                <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                                    <svg class="h-5 w-5 text-gray-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            </div>
                                            @error('email')
                                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                                    <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div>
                                        <label for="phone_number"
                                            class="block text-sm font-medium text-gray-700 mb-2">
                                            Nomor Telepon
                                        </label>
                                        <input type="text" name="phone_number" id="phone_number"
                                            value="{{ old('phone_number', $student->user->phone_number) }}"
                                            class="mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('phone_number') border-red-500 @enderror">
                                        @error('phone_number')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Read-only Student Information -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            NIS
                                        </label>
                                        <input type="text" value="{{ $student->nis }}" readonly
                                            class="mt-1 block w-full rounded-md shadow-sm bg-gray-50 text-gray-500">
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Kelas
                                        </label>
                                        <input type="text"
                                            value="{{ $student->classes->class_name ?? 'Belum ditetapkan' }}" readonly
                                            class="mt-1 block w-full rounded-md shadow-sm bg-gray-50 text-gray-500">
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="space-y-6">
                                    <div>
                                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                                            Alamat
                                        </label>
                                        <textarea name="address" id="address" rows="3"
                                            class="mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('address') border-red-500 @enderror">{{ old('address', $student->address) }}</textarea>
                                        @error('address')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Password Section -->
                                    <div class="pt-4 border-t border-gray-200">
                                        <h4 class="text-md font-medium text-gray-900 mb-4">Ubah Kata Sandi</h4>
                                        <p class="text-sm text-gray-600 mb-4">Kosongkan jika tidak ingin mengubah kata
                                            sandi.</p>

                                        <div class="space-y-4">
                                            <div>
                                                <label for="current_password"
                                                    class="block text-sm font-medium text-gray-700 mb-2">
                                                    Kata Sandi Saat Ini
                                                </label>
                                                <input type="password" name="current_password" id="current_password"
                                                    class="mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('current_password') border-red-500 @enderror">
                                                @error('current_password')
                                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="new_password"
                                                    class="block text-sm font-medium text-gray-700 mb-2">
                                                    Kata Sandi Baru
                                                </label>
                                                <input type="password" name="new_password" id="new_password"
                                                    class="mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('new_password') border-red-500 @enderror">
                                                @error('new_password')
                                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="new_password_confirmation"
                                                    class="block text-sm font-medium text-gray-700 mb-2">
                                                    Konfirmasi Kata Sandi Baru
                                                </label>
                                                <input type="password" name="new_password_confirmation"
                                                    id="new_password_confirmation"
                                                    class="mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Student Details (Read-only) -->
                                    <div class="pt-4 border-t border-gray-200">
                                        <h4 class="text-md font-medium text-gray-900 mb-4">Informasi Tambahan</h4>

                                        <div class="space-y-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                                    NISN
                                                </label>
                                                <input type="text"
                                                    value="{{ $student->nisn ?? 'Belum tersedia' }}" readonly
                                                    class="mt-1 block w-full rounded-md shadow-sm bg-gray-50 text-gray-500">
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                                    Tempat, Tanggal Lahir
                                                </label>
                                                <input type="text"
                                                    value="{{ $student->place_of_birth ? $student->place_of_birth . ', ' . ($student->date_of_birth ? $student->date_of_birth->format('d M Y') : '') : 'Belum tersedia' }}"
                                                    readonly
                                                    class="mt-1 block w-full rounded-md shadow-sm bg-gray-50 text-gray-500">
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                                    Jenis Kelamin
                                                </label>
                                                <input type="text"
                                                    value="{{ $student->gender == 'M' ? 'Laki-laki' : ($student->gender == 'F' ? 'Perempuan' : 'Belum tersedia') }}"
                                                    readonly
                                                    class="mt-1 block w-full rounded-md shadow-sm bg-gray-50 text-gray-500">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="mt-8 flex items-center justify-between pt-6 border-t border-gray-200">
                                    <a href="{{ route('student.dashboard') }}"
                                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition-colors">
                                        Kembali
                                    </a>

                                    <button type="submit"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition-colors">
                                        Update Profil
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
</x-student-layout>
