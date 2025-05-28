<x-teacher-layout>
    <div class="p-6">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center space-x-4">
                <a href="{{ route('teacher.grades.index') }}"
                    class="p-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors duration-200">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Edit Nilai</h1>
                    <p class="text-gray-600">Ubah nilai untuk {{ $grade->student->name }}</p>
                </div>
            </div>
        </div>

        <form action="{{ route('teacher.grades.update', $grade) }}" method="POST" class="max-w-2xl">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 bg-gradient-to-r from-blue-50 to-blue-100 border-b border-blue-200">
                    <h3 class="text-lg font-semibold text-blue-900 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        Form Edit Nilai
                    </h3>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Student Info (Read-only) -->
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <h4 class="text-sm font-semibold text-gray-700 mb-3">Informasi Siswa</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-500 mb-1">Nama Siswa</label>
                                <div class="text-sm font-semibold text-gray-900">{{ $grade->student->name }}</div>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-500 mb-1">NISN</label>
                                <div class="text-sm text-gray-700">{{ $grade->student->nisn }}</div>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-500 mb-1">Kelas</label>
                                <div class="text-sm text-gray-700">{{ $grade->student->classes->name }}</div>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-500 mb-1">Mata Pelajaran</label>
                                <div class="text-sm text-gray-700">{{ $grade->subject->name }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Grade Type -->
                    <div>
                        <label for="grade_type" class="block text-sm font-semibold text-gray-700 mb-3">Jenis Penilaian
                            <span class="text-red-500">*</span></label>
                        <select id="grade_type" name="grade_type" required
                            class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('grade_type') border-red-500 @enderror">
                            <option value="">Pilih Jenis Penilaian</option>
                            <option value="tugas"
                                {{ old('grade_type', $grade->grade_type) == 'tugas' ? 'selected' : '' }}>
                                Tugas</option>
                            <option value="kuis"
                                {{ old('grade_type', $grade->grade_type) == 'kuis' ? 'selected' : '' }}>
                                Kuis</option>
                            <option value="uts"
                                {{ old('grade_type', $grade->grade_type) == 'uts' ? 'selected' : '' }}>
                                UTS</option>
                            <option value="uas"
                                {{ old('grade_type', $grade->grade_type) == 'uas' ? 'selected' : '' }}>
                                UAS</option>
                        </select>
                        @error('grade_type')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Assessment Name -->
                    <div>
                        <label for="assessment_name" class="block text-sm font-semibold text-gray-700 mb-3">Nama
                            Penilaian</label>
                        <input type="text" id="assessment_name" name="assessment_name"
                            value="{{ old('assessment_name', $grade->assessment_name) }}"
                            placeholder="Contoh: Kuis Bab 1, Tugas Mandiri, dll"
                            class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('assessment_name') border-red-500 @enderror">
                        @error('assessment_name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Grade -->
                    <div>
                        <label for="grade" class="block text-sm font-semibold text-gray-700 mb-3">Nilai <span
                                class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="number" id="grade" name="grade" min="0" max="100"
                                step="0.1" value="{{ old('grade', $grade->grade) }}" required
                                class="w-full px-4 py-3 pr-12 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('grade') border-red-500 @enderror text-xl font-bold text-center">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                <span class="text-sm font-medium text-gray-500">/100</span>
                            </div>
                        </div>
                        @error('grade')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <div class="mt-2 flex space-x-2">
                            <span
                                class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-800">
                                A: 90-100
                            </span>
                            <span
                                class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                B: 80-89
                            </span>
                            <span
                                class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                C: 70-79
                            </span>
                            <span
                                class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-red-100 text-red-800">
                                D: <70 </span>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div>
                        <label for="notes" class="block text-sm font-semibold text-gray-700 mb-3">Catatan</label>
                        <textarea id="notes" name="notes" rows="3" placeholder="Catatan tambahan untuk penilaian ini..."
                            class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('notes') border-red-500 @enderror">{{ old('notes', $grade->notes) }}</textarea>
                        @error('notes')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Last Updated Info -->
                    <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="text-sm">
                                <span class="font-medium text-blue-900">Terakhir diperbarui:</span>
                                <span class="text-blue-700">{{ $grade->updated_at->format('d M Y, H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
                    <a href="{{ route('teacher.grades.index') }}"
                        class="px-6 py-3 border text-gray-700 font-semibold rounded-lg hover:bg-gray-100 transition-colors duration-200">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-blue-800 transform hover:scale-105 transition-all duration-200 shadow-lg">
                        Perbarui Nilai
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const gradeInput = document.getElementById('grade');

            gradeInput.addEventListener('input', function() {
                const value = parseFloat(this.value);
                let bgColor = 'bg-gray-50';

                if (value >= 90) {
                    bgColor = 'bg-green-50';
                } else if (value >= 80) {
                    bgColor = 'bg-blue-50';
                } else if (value >= 70) {
                    bgColor = 'bg-yellow-50';
                } else if (value > 0) {
                    bgColor = 'bg-red-50';
                }

                this.className = this.className.replace(/bg-\w+-50/g, '') + ' ' + bgColor;
            });

            // Trigger on load
            gradeInput.dispatchEvent(new Event('input'));
        });
    </script>
</x-teacher-layout>
