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
                    <h1 class="text-3xl font-bold text-gray-900">Input Nilai Baru</h1>
                    <p class="text-gray-600">Tambahkan nilai baru untuk siswa</p>
                </div>
            </div>
        </div>

        <form action="{{ route('teacher.grades.store') }}" method="POST" class="max-w-4xl">
            @csrf

            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 bg-gradient-to-r from-blue-50 to-blue-100 border-b border-blue-200">
                    <h3 class="text-lg font-semibold text-blue-900 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Form Input Nilai
                    </h3>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Class and Subject Selection -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="class_id" class="block text-sm font-semibold text-gray-700 mb-3">Kelas <span
                                    class="text-red-500">*</span></label>
                            <select id="class_id" name="class_id" required
                                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('class_id') border-red-500 @enderror">
                                <option value="">Pilih Kelas</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}"
                                        {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                        {{ $class->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('class_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="subject_id" class="block text-sm font-semibold text-gray-700 mb-3">Mata
                                Pelajaran
                                <span class="text-red-500">*</span></label>
                            <select id="subject_id" name="subject_id" required
                                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('subject_id') border-red-500 @enderror">
                                <option value="">Pilih Mata Pelajaran</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}"
                                        {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('subject_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Grade Type and Assessment Name -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="grade_type" class="block text-sm font-semibold text-gray-700 mb-3">Jenis
                                Penilaian
                                <span class="text-red-500">*</span></label>
                            <select id="grade_type" name="grade_type" required
                                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('grade_type') border-red-500 @enderror">
                                <option value="">Pilih Jenis Penilaian</option>
                                <option value="tugas" {{ old('grade_type') == 'tugas' ? 'selected' : '' }}>Tugas
                                </option>
                                <option value="kuis" {{ old('grade_type') == 'kuis' ? 'selected' : '' }}>Kuis
                                </option>
                                <option value="uts" {{ old('grade_type') == 'uts' ? 'selected' : '' }}>UTS</option>
                                <option value="uas" {{ old('grade_type') == 'uas' ? 'selected' : '' }}>UAS</option>
                            </select>
                            @error('grade_type')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="assessment_name" class="block text-sm font-semibold text-gray-700 mb-3">Nama
                                Penilaian</label>
                            <input type="text" id="assessment_name" name="assessment_name"
                                value="{{ old('assessment_name') }}"
                                placeholder="Contoh: Kuis Bab 1, Tugas Mandiri, dll"
                                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('assessment_name') border-red-500 @enderror">
                            @error('assessment_name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Students List -->
                    <div id="students_container" class="hidden">
                        <label class="block text-sm font-semibold text-gray-700 mb-4">Daftar Siswa dan Nilai</label>
                        <div class="bg-gray-50 rounded-lg p-4 max-h-96 overflow-y-auto">
                            <div id="students_list">
                                <!-- Students will be loaded here via AJAX -->
                            </div>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div>
                        <label for="notes" class="block text-sm font-semibold text-gray-700 mb-3">Catatan</label>
                        <textarea id="notes" name="notes" rows="3" placeholder="Catatan tambahan untuk penilaian ini..."
                            class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('notes') border-red-500 @enderror">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
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
                        Simpan Nilai
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const classSelect = document.getElementById('class_id');
            const subjectSelect = document.getElementById('subject_id');
            const studentsContainer = document.getElementById('students_container');
            const studentsList = document.getElementById('students_list');

            function loadStudents() {
                const classId = classSelect.value;
                const subjectId = subjectSelect.value;

                if (classId && subjectId) {
                    // Show loading state
                    studentsList.innerHTML =
                        '<div class="text-center py-4 text-gray-500">Memuat daftar siswa...</div>';
                    studentsContainer.classList.remove('hidden');

                    // Fetch students via AJAX
                    fetch(`{{ route('teacher.students.by-class') }}?class_id=${classId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                let html = '';
                                data.students.forEach((student, index) => {
                                    html += `
                                <div class="flex items-center justify-between p-4 bg-white rounded-lg mb-3 border border-gray-200">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold text-sm mr-4">
                                            ${student.name.charAt(0)}
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900">${student.name}</div>
                                            <div class="text-sm text-gray-500">NISN: ${student.nisn}</div>
                                        </div>
                                        <input type="hidden" name="students[${index}][student_id]" value="${student.id}">
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <input type="number" 
                                               name="students[${index}][grade]" 
                                               min="0" 
                                               max="100" 
                                               step="0.1"
                                               placeholder="0-100"
                                               class="w-24 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-center"
                                               required>
                                    </div>
                                </div>
                            `;
                                });
                                studentsList.innerHTML = html;
                            } else {
                                studentsList.innerHTML =
                                    '<div class="text-center py-4 text-red-500">Tidak ada siswa dalam kelas ini</div>';
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            studentsList.innerHTML =
                                '<div class="text-center py-4 text-red-500">Terjadi kesalahan saat memuat data</div>';
                        });
                } else {
                    studentsContainer.classList.add('hidden');
                }
            }

            classSelect.addEventListener('change', loadStudents);
            subjectSelect.addEventListener('change', loadStudents);

            if (classSelect.value && subjectSelect.value) {
                loadStudents();
            }
        });
    </script>
</x-teacher-layout>
