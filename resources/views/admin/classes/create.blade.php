<x-app-layout>
    <!-- Header Section with Gradient Background -->
    <div class="bg-gradient-to-br from-indigo-50 via-white to-blue-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <!-- Page Badge -->
                <div
                    class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 border border-green-200 mb-4">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Kelas
                </div>

                <!-- Main Title -->
                <h1 class="text-4xl font-bold text-gray-900 mb-3">
                    <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                        Tambah Kelas Baru
                    </span>
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Lengkapi formulir berikut untuk menambahkan data kelas baru ke dalam sistem
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Back Button -->
        <div class="mb-8">
            <a href="{{ route('admin.classes.index') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm hover:shadow-md">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar Kelas
            </a>
        </div> <!-- Main Form Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <!-- Card Header -->
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
                        <h2 class="text-xl font-bold text-gray-900">Informasi Kelas</h2>
                        <p class="text-sm text-gray-600">Data lengkap untuk kelas baru</p>
                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <form action="{{ route('admin.classes.store') }}" method="POST" class="p-6" id="createClassForm">
                @csrf
                <div class="grid gap-6 md:grid-cols-2">
                    <!-- Nama Kelas -->
                    <div class="space-y-2">
                        <label for="class_name" class="block text-sm font-medium text-gray-700">
                            Nama Kelas <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="class_name" id="class_name" value="{{ old('class_name') }}"
                            placeholder="Contoh: XII IPA 1"
                            class="w-full rounded-xl border @error('class_name') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror bg-gray-50 px-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 transition-all duration-200">
                        @error('class_name')
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

                    <!-- Tingkat -->
                    <div class="space-y-2">
                        <label for="level" class="block text-sm font-medium text-gray-700">
                            Tingkat <span class="text-red-500">*</span>
                        </label>
                        <select name="level" id="level"
                            class="w-full rounded-xl border @error('level') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror bg-gray-50 px-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 transition-all duration-200">
                            <option value="">Pilih Tingkat</option>
                            <option value="10" {{ old('level') == 10 ? 'selected' : '' }}>Kelas 10</option>
                            <option value="11" {{ old('level') == 11 ? 'selected' : '' }}>Kelas 11</option>
                            <option value="12" {{ old('level') == 12 ? 'selected' : '' }}>Kelas 12</option>
                        </select>
                        @error('level')
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

                    <!-- Jurusan -->
                    <div class="space-y-2">
                        <label for="major" class="block text-sm font-medium text-gray-700">
                            Jurusan <span class="text-red-500">*</span>
                        </label>
                        <select name="major" id="major"
                            class="w-full rounded-xl border @error('major') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror bg-gray-50 px-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 transition-all duration-200">
                            <option value="">Pilih Jurusan</option>
                            <option value="IPA" {{ old('major') == 'IPA' ? 'selected' : '' }}>IPA (Ilmu Pengetahuan
                                Alam)</option>
                            <option value="IPS" {{ old('major') == 'IPS' ? 'selected' : '' }}>IPS (Ilmu Pengetahuan
                                Sosial)</option>
                        </select>
                        @error('major')
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

                    <!-- Tahun Akademik -->
                    <div class="space-y-2">
                        <label for="academic_year" class="block text-sm font-medium text-gray-700">
                            Tahun Akademik <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="academic_year" id="academic_year"
                            value="{{ old('academic_year', date('Y') . '/' . ((int) date('Y') + 1)) }}"
                            placeholder="Contoh: 2025/2026" pattern="[0-9]{4}/[0-9]{4}"
                            class="w-full rounded-xl border @error('academic_year') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror bg-gray-50 px-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 transition-all duration-200">
                        <p class="text-xs text-gray-500 mt-1">Format: YYYY/YYYY (contoh: 2025/2026)</p>
                        @error('academic_year')
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

                    <!-- Wali Kelas -->
                    <div class="space-y-2 md:col-span-2">
                        <label for="homeroom_teacher_id" class="block text-sm font-medium text-gray-700">
                            Wali Kelas
                        </label>
                        <select name="homeroom_teacher_id" id="homeroom_teacher_id"
                            class="w-full rounded-xl border @error('homeroom_teacher_id') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror bg-gray-50 px-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 transition-all duration-200">
                            <option value="">Pilih Guru (Opsional)</option>
                            @foreach ($teachers as $teacher)
                                @php
                                    $isAssigned = isset($assignedTeachers[$teacher->id]);
                                    $assignedClass = $isAssigned ? $assignedTeachers[$teacher->id] : null;
                                @endphp
                                <option value="{{ $teacher->id }}"
                                    {{ old('homeroom_teacher_id') == $teacher->id ? 'selected' : '' }}
                                    {{ $isAssigned ? 'disabled' : '' }}>
                                    {{ $teacher->user->name }} (NIP: {{ $teacher->nip }})
                                    {{ $isAssigned ? ' - Wali Kelas ' . $assignedClass->class_name : '' }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-xs text-gray-500">Wali kelas dapat diatur nanti jika belum ditentukan.</p>
                        @error('homeroom_teacher_id')
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

                <!-- Action Buttons -->
                <div class="mt-8 flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.classes.index') }}"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm hover:shadow-md">
                        Batal
                    </a>
                    <button type="submit" id="submitBtn"
                        class="inline-flex items-center px-6 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed">
                        <svg class="w-5 h-5 mr-2 hidden" id="loadingIcon" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                        <svg class="w-5 h-5 mr-2" id="defaultIcon" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <span id="btnText">Simpan Data Kelas</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('createClassForm');
                const submitBtn = document.getElementById('submitBtn');
                const loadingIcon = document.getElementById('loadingIcon');
                const defaultIcon = document.getElementById('defaultIcon');
                const btnText = document.getElementById('btnText');

                form.addEventListener('submit', function() {
                    submitBtn.disabled = true;
                    loadingIcon.classList.remove('hidden');
                    defaultIcon.classList.add('hidden');
                    btnText.textContent = 'Menyimpan...';
                });
            });
        </script>
    @endpush
</x-app-layout>
