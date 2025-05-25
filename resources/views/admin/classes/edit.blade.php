<x-app-layout>
    <!-- Header Section with Gradient Background -->
    <div class="bg-gradient-to-br from-amber-50 via-white to-orange-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <!-- Page Badge -->
                <div
                    class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-gradient-to-r from-amber-100 to-orange-100 text-amber-800 border border-amber-200 mb-4">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                    Edit Kelas
                </div>

                <!-- Main Title -->
                <h1 class="text-4xl font-bold text-gray-900 mb-3">
                    <span class="bg-gradient-to-r from-amber-600 to-orange-600 bg-clip-text text-transparent">
                        Edit Kelas {{ $class->class_name }}
                    </span>
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Perbarui informasi kelas yang sudah ada dalam sistem
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Back Button -->
        <div class="mb-8">
            <a href="{{ route('admin.classes.index') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm hover:shadow-md">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar Kelas
            </a>
        </div> <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
            <form action="{{ route('admin.classes.update', $class) }}" method="POST" id="editClassForm">
                @csrf
                @method('PUT')

                <!-- Form Header -->
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div
                                class="w-8 h-8 bg-gradient-to-r from-amber-500 to-orange-500 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-lg font-semibold text-gray-900">Informasi Kelas</h3>
                            <p class="text-sm text-gray-600">Perbarui detail informasi kelas</p>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6"> <!-- Nama Kelas -->
                        <div class="space-y-2">
                            <label for="class_name" class="block text-sm font-semibold text-gray-700">
                                Nama Kelas <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="class_name" id="class_name"
                                value="{{ old('class_name', $class->class_name) }}"
                                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all duration-200 @error('class_name') !border-red-500 ring-2 ring-red-200 @enderror"
                                placeholder="Masukkan nama kelas">
                            @error('class_name')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tingkat -->
                        <div class="space-y-2">
                            <label for="level" class="block text-sm font-semibold text-gray-700">
                                Tingkat <span class="text-red-500">*</span>
                            </label>
                            <select name="level" id="level"
                                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all duration-200 @error('level') !border-red-500 ring-2 ring-red-200 @enderror">
                                <option value="">Pilih Tingkat</option>
                                <option value="10" {{ old('level', $class->level) == 10 ? 'selected' : '' }}>10
                                </option>
                                <option value="11" {{ old('level', $class->level) == 11 ? 'selected' : '' }}>11
                                </option>
                                <option value="12" {{ old('level', $class->level) == 12 ? 'selected' : '' }}>12
                                </option>
                            </select>
                            @error('level')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jurusan -->
                        <div class="space-y-2">
                            <label for="major" class="block text-sm font-semibold text-gray-700">
                                Jurusan <span class="text-red-500">*</span>
                            </label>
                            <select name="major" id="major"
                                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all duration-200 @error('major') !border-red-500 ring-2 ring-red-200 @enderror">
                                <option value="">Pilih Jurusan</option>
                                <option value="IPA" {{ old('major', $class->major) == 'IPA' ? 'selected' : '' }}>IPA
                                    (Science)</option>
                                <option value="IPS" {{ old('major', $class->major) == 'IPS' ? 'selected' : '' }}>IPS
                                    (Social)</option>
                            </select>
                            @error('major')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tahun Akademik -->
                        <div class="space-y-2">
                            <label for="academic_year" class="block text-sm font-semibold text-gray-700">
                                Tahun Akademik <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="academic_year" id="academic_year"
                                value="{{ old('academic_year', $class->academic_year) }}"
                                placeholder="contoh: 2025/2026" pattern="[0-9]{4}/[0-9]{4}"
                                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all duration-200 @error('academic_year') !border-red-500 ring-2 ring-red-200 @enderror">
                            <p class="text-xs text-gray-500 mt-1">Format: YYYY/YYYY (contoh: 2025/2026)</p>
                            @error('academic_year')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Wali Kelas -->
                        <div class="space-y-2 md:col-span-2">
                            <label for="homeroom_teacher_id" class="block text-sm font-semibold text-gray-700">
                                Wali Kelas
                            </label>
                            <select name="homeroom_teacher_id" id="homeroom_teacher_id"
                                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all duration-200 @error('homeroom_teacher_id') !border-red-500 ring-2 ring-red-200 @enderror">
                                <option value="">Pilih Guru</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}"
                                        {{ old('homeroom_teacher_id', $class->homeroom_teacher_id) == $teacher->id ? 'selected' : '' }}>
                                        {{ $teacher->user->name }} (NIP: {{ $teacher->nip }})
                                    </option>
                                @endforeach
                            </select>
                            @error('homeroom_teacher_id')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex items-center justify-between">
                    <a href="{{ route('admin.classes.index') }}"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Batal
                    </a>
                    <button type="submit" id="submitBtn"
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-amber-500 to-orange-500 text-white text-sm font-semibold rounded-lg hover:from-amber-600 hover:to-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-all duration-200 shadow-lg hover:shadow-xl">
                        <svg class="w-4 h-4 mr-2 hidden" id="loadingIcon" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                        <svg class="w-4 h-4 mr-2" id="saveIcon" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <span id="submitText">Simpan Perubahan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                        const form = document.getElementById('editClassForm');
                        const submitBtn = document.getElementById('submitBtn');
                        const submitText = document.getElementById('submitText');
                        const loadingIcon = document.getElementById('loadingIcon');
                        const saveIcon = document.getElementById('saveIcon');

                        form.addEventListener('submit', function() {
                            // Show loading state
                            submitBtn.disabled = true;
                            submitText.textContent = 'Menyimpan...';
                            loadingIcon.classList.remove('hidden');
                            saveIcon.classList.add('hidden');
                            submitBtn.classList.add('opacity-75');
                        });

                        // Add input validation feedback
                        const inputs = form.querySelectorAll('input, select');
                        inputs.forEach(input => {
                            input.addEventListener('blur', function() {
                                if (this.hasAttribute('required') && !this.value) {
                                    this.classList.add('border-red-500', 'ring-2', 'ring-red-200');
                                    this.classList.remove(');
                                    }
                                    else {
                                        this.classList.remove('border-red-500', 'ring-2', 'ring-red-200');
                                        this.classList.add(');
                                        }
                                    });
                            });
                        });
        </script>
    @endpush
</x-app-layout>
