<x-teacher-layout>
    <div class="p-6">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Buat Sesi QR Baru</h1>
                    <p class="text-gray-600">Buat sesi absensi dengan QR code untuk siswa</p>
                </div>
                <a href="{{ route('teacher.attendance.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        <!-- Create QR Session Form -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 mb-8">
            <form method="POST" action="{{ route('teacher.attendance.store-qr') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Judul Sesi <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}"
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500"
                            placeholder="Contoh: Absensi Fisika Bab Cahaya">
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi
                            (Opsional)</label>
                        <input type="text" id="description" name="description" value="{{ old('description') }}"
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500"
                            placeholder="Informasi tambahan tentang sesi">
                    </div>

                    <div>
                        <label for="class_id" class="block text-sm font-semibold text-gray-700 mb-2">Kelas <span
                                class="text-red-500">*</span></label>
                        <select id="class_id" name="class_id"
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                            <option value="">Pilih Kelas</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}"
                                    {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                    {{ $class->class_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('class_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="subject_id" class="block text-sm font-semibold text-gray-700 mb-2">Mata Pelajaran
                            <span class="text-red-500">*</span></label>
                        <select id="subject_id" name="subject_id"
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                            <option value="">Pilih Mata Pelajaran</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}"
                                    {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->subject_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('subject_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="date" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal <span
                                class="text-red-500">*</span></label>
                        <input type="date" id="date" name="date"
                            value="{{ old('date', now()->timezone('Asia/Jakarta')->format('Y-m-d')) }}"
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                        @error('date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="start_time" class="block text-sm font-semibold text-gray-700 mb-2">Waktu Mulai
                                <span class="text-red-500">*</span></label>
                            <input type="time" id="start_time" name="start_time"
                                value="{{ old('start_time', now()->timezone('Asia/Jakarta')->format('H:i')) }}"
                                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                            @error('start_time')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="end_time" class="block text-sm font-semibold text-gray-700 mb-2">Waktu Berakhir
                                <span class="text-red-500">*</span></label>
                            <input type="time" id="end_time" name="end_time"
                                value="{{ old('end_time', now()->addMinutes(45)->timezone('Asia/Jakarta')->format('H:i')) }}"
                                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                            @error('end_time')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-200">
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                        Buat Sesi QR
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-teacher-layout>
