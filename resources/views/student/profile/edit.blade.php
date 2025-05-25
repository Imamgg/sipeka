<x-student-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Profil Siswa
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Informasi Pribadi</h3>
                        <p class="text-sm text-gray-600">Update informasi pribadi Anda di bawah ini.</p>
                    </div>

                    @if (session('success'))
                        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('student.profile.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Left Column -->
                            <div class="space-y-6">
                                <!-- Basic Information -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                        Nama Lengkap <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="name" id="name"
                                        value="{{ old('name', $student->user->name) }}"
                                        class="mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror">
                                    @error('name')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                        Email <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email" name="email" id="email"
                                        value="{{ old('email', $student->user->email) }}"
                                        class="mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror">
                                    @error('email')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-2">
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
                                    <input type="text" value="{{ $student->class->name ?? 'Belum ditetapkan' }}"
                                        readonly
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
                                            <input type="text" value="{{ $student->nisn ?? 'Belum tersedia' }}"
                                                readonly
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
                                                value="{{ $student->gender ? ucfirst($student->gender) : 'Belum tersedia' }}"
                                                readonly
                                                class="mt-1 block w-full rounded-md shadow-sm bg-gray-50 text-gray-500">
                                        </div>
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
