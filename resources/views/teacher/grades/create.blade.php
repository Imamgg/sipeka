<x-teacher-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="p-6">
        <div class="mb-8">
            <div class="flex items-center space-x-4">
                <a href="{{ route('teacher.grades.index') }}"
                    class="p-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors duration-200">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
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
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="class_id" class="block text-sm font-semibold text-gray-700 mb-3">Kelas <span
                                    class="text-red-500">*</span></label>
                            <select id="class_id" name="class_id"
                                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('class_id') border-red-500 @enderror">
                                <option value="">Pilih Kelas</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}"
                                        {{ old('class_id', $selectedClassId) == $class->id ? 'selected' : '' }}>
                                        {{ $class->class_name }}
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
                            <select id="subject_id" name="subject_id"
                                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('subject_id') border-red-500 @enderror">
                                <option value="">Pilih Mata Pelajaran</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}"
                                        {{ old('subject_id', $selectedSubjectId) == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->subject_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('subject_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Loading Indicator -->
                    <div class="text-center hidden" id="loading_indicator">
                        <div class="flex items-center justify-center">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-500"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            <span class="text-blue-500">Memuat daftar siswa...</span>
                        </div>
                    </div>

                    <!-- Grade Type and Assessment Name -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="grade_type" class="block text-sm font-semibold text-gray-700 mb-3">Jenis
                                Penilaian
                                <span class="text-red-500">*</span></label>
                            <select id="grade_type" name="grade_type"
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

                    <!-- Date -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="assessment_date" class="block text-sm font-semibold text-gray-700 mb-3">Tanggal
                                Penilaian</label>
                            <input type="date" id="assessment_date" name="assessment_date"
                                value="{{ old('assessment_date', date('Y-m-d')) }}"
                                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('assessment_date') border-red-500 @enderror">
                            @error('assessment_date')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="semester"
                                class="block text-sm font-semibold text-gray-700 mb-3">Semester</label>
                            <select id="semester" name="semester"
                                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('semester') border-red-500 @enderror">
                                <option value="Ganjil"
                                    {{ old('semester', date('n') >= 7 ? 'Ganjil' : 'Genap') == 'Ganjil' ? 'selected' : '' }}>
                                    Semester Ganjil</option>
                                <option value="Genap"
                                    {{ old('semester', date('n') >= 7 ? 'Ganjil' : 'Genap') == 'Genap' ? 'selected' : '' }}>
                                    Semester Genap</option>
                            </select>
                            @error('semester')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Students List -->
                    <div id="students_container" class="hidden">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700">Daftar Siswa dan Nilai</label>
                                <div id="grade_statistics" class="mt-1 text-sm text-gray-600">
                                    <span id="filled_count">0</span> dari <span id="total_count">0</span> siswa akan
                                    mendapat nilai
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center space-x-2">
                                    <input type="number" id="bulk_grade" min="0" max="100"
                                        step="0.01" placeholder="Nilai"
                                        class="w-20 px-2 py-1 border rounded focus:ring-2 focus:ring-blue-500 text-sm">
                                    <button type="button" onclick="applyBulkGrade()"
                                        class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition-colors">
                                        Terapkan ke Semua
                                    </button>
                                </div>
                                <button type="button" onclick="clearAllGrades()"
                                    class="px-3 py-1 bg-gray-500 text-white text-sm rounded hover:bg-gray-600 transition-colors">
                                    Hapus Semua
                                </button>
                            </div>
                        </div>
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
        // Toast notification functions
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        function showToastSuccess(message) {
            Toast.fire({
                icon: 'success',
                title: message
            });
        }

        function showToastError(message) {
            Toast.fire({
                icon: 'error',
                title: message
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const classSelect = document.getElementById('class_id');
            const subjectSelect = document.getElementById('subject_id');
            const studentsContainer = document.getElementById('students_container');
            const studentsList = document.getElementById('students_list');
            const loadingIndicator = document.getElementById('loading_indicator');

            // Function to load students via AJAX
            function loadStudents() {
                const classId = classSelect.value;
                const subjectId = subjectSelect.value;

                if (!classId || !subjectId) {
                    // Hide students container if either selection is empty
                    studentsContainer.classList.add('hidden');
                    loadingIndicator.classList.add('hidden');
                    return;
                }

                // Show loading indicator
                loadingIndicator.classList.remove('hidden');
                studentsContainer.classList.add('hidden');

                // Create FormData for the AJAX request
                const formData = new FormData();
                formData.append('class_id', classId);
                formData.append('subject_id', subjectId);
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute(
                    'content'));

                fetch('{{ route('teacher.grades.load-students') }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Student data loaded:', data);
                        if (data.success) {
                            // Clear existing students
                            studentsList.innerHTML = '';

                            if (data.students.length === 0) {
                                console.log('No students found for this class and subject');
                                studentsList.innerHTML =
                                    '<div class="text-center text-gray-500 py-8">Tidak ada siswa ditemukan untuk kelas dan mata pelajaran yang dipilih.</div>';
                            } else {
                                // Add students to the list
                                data.students.forEach((student, index) => {
                                    console.log('Rendering student:', student);
                                    const studentHtml = `
                                    <div class="student-row flex items-center justify-between p-4 bg-white rounded-lg mb-3 border border-gray-200 transition-all duration-200">
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
                                            <input type="number" name="students[${index}][grade]" min="0" max="100" step="0.01" placeholder="0-100"
                                                class="grade-input w-24 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-center"
                                                onchange="updateGradeLetter(this)"
                                                onblur="formatGradeValue(this)"
                                                oninput="updateStudentRowStyle(this)">
                                            <span class="grade-letter text-lg font-bold text-gray-600 w-8"></span>
                                            <div class="grade-status-indicator w-3 h-3 rounded-full bg-gray-300 opacity-0 transition-opacity duration-200"></div>
                                        </div>
                                    </div>
                                `;
                                    studentsList.insertAdjacentHTML('beforeend', studentHtml);
                                });
                            }

                            // Tambahkan notifikasi berhasil
                            showToastSuccess('Daftar siswa berhasil dimuat');

                            // Show students container
                            studentsContainer.classList.remove('hidden');

                            // Update grade statistics
                            updateGradeStatistics();
                        } else {
                            showToastError(data.message || 'Terjadi kesalahan saat memuat data siswa');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showToastError('Terjadi kesalahan saat memuat data siswa');
                    })
                    .finally(() => {
                        // Hide loading indicator
                        loadingIndicator.classList.add('hidden');
                    });
            }

            // Auto-load when both selections change
            let autoReloadTimeout;

            function handleSelectionChange() {
                clearTimeout(autoReloadTimeout);
                autoReloadTimeout = setTimeout(() => {
                    loadStudents();
                }, 300); // Wait 300ms after user stops changing selections
            }

            classSelect.addEventListener('change', handleSelectionChange);
            subjectSelect.addEventListener('change', handleSelectionChange);

            // Load students on page load if both values are already selected
            if (classSelect.value && subjectSelect.value) {
                loadStudents();
            }
        });

        // Convert numerical score to letter grade
        function convertScoreToGrade(score) {
            if (score >= 90) return 'A';
            if (score >= 80) return 'B';
            if (score >= 70) return 'C';
            if (score >= 60) return 'D';
            return 'E';
        }

        // Format grade value on blur
        function formatGradeValue(input) {
            let value = input.value.trim();
            if (value && !isNaN(value)) {
                const numValue = parseFloat(value);
                if (numValue >= 0 && numValue <= 100) {
                    input.value = numValue.toFixed(2);
                } else if (numValue > 100) {
                    input.value = '100.00';
                } else if (numValue < 0) {
                    input.value = '0.00';
                }
            }
            updateGradeLetter(input);
        }

        // Update grade letter when score changes
        function updateGradeLetter(input) {
            const score = parseFloat(input.value);
            const letterSpan = input.parentElement.querySelector('.grade-letter');

            console.log('Updating grade letter for score:', score, 'input name:', input.name);

            if (!isNaN(score) && score >= 0 && score <= 100) {
                const letter = convertScoreToGrade(score);
                letterSpan.textContent = letter;
                letterSpan.className = 'grade-letter text-lg font-bold w-8 ' + getGradeColor(score);
                console.log('Grade updated to:', letter);
            } else {
                letterSpan.textContent = '';
                console.log('Invalid score, clearing grade letter');
            }

            // Update student row styling
            updateStudentRowStyle(input);
        }

        // Update student row styling based on grade input
        function updateStudentRowStyle(input) {
            const studentRow = input.closest('.student-row');
            const indicator = studentRow.querySelector('.grade-status-indicator');
            const hasValue = input.value.trim() !== '';

            if (hasValue) {
                studentRow.classList.add('border-green-200', 'bg-green-50');
                studentRow.classList.remove('border-gray-200');
                indicator.classList.remove('bg-gray-300', 'opacity-0');
                indicator.classList.add('bg-green-500', 'opacity-100');
            } else {
                studentRow.classList.remove('border-green-200', 'bg-green-50');
                studentRow.classList.add('border-gray-200');
                indicator.classList.remove('bg-green-500', 'opacity-100');
                indicator.classList.add('bg-gray-300', 'opacity-0');
            }

            // Update grade statistics
            updateGradeStatistics();
        }

        // Update grade statistics display
        function updateGradeStatistics() {
            const gradeInputs = document.querySelectorAll('.grade-input');
            const filledInputs = Array.from(gradeInputs).filter(input => input.value.trim() !== '');

            const totalCount = document.getElementById('total_count');
            const filledCount = document.getElementById('filled_count');

            if (totalCount && filledCount) {
                totalCount.textContent = gradeInputs.length;
                filledCount.textContent = filledInputs.length;

                const statisticsElement = document.getElementById('grade_statistics');
                if (filledInputs.length === 0) {
                    statisticsElement.className = 'mt-1 text-sm text-gray-600';
                } else if (filledInputs.length === gradeInputs.length) {
                    statisticsElement.className = 'mt-1 text-sm text-green-600 font-medium';
                } else {
                    statisticsElement.className = 'mt-1 text-sm text-blue-600 font-medium';
                }
            }
        }

        // Get color based on grade
        function getGradeColor(score) {
            if (score >= 90) return 'text-green-600';
            if (score >= 80) return 'text-blue-600';
            if (score >= 70) return 'text-yellow-600';
            if (score >= 60) return 'text-orange-600';
            return 'text-red-600';
        }

        function applyBulkGrade() {
            const bulkGrade = document.getElementById('bulk_grade').value;
            console.log('Applying bulk grade:', bulkGrade);

            if (!bulkGrade || bulkGrade < 0 || bulkGrade > 100) {
                showToastError('Mohon masukkan nilai yang valid (0-100)');
                return;
            }

            // Konversi ke float untuk memastikan format yang benar
            const gradeValue = parseFloat(bulkGrade).toFixed(2);
            const gradeInputs = document.querySelectorAll('.grade-input');
            console.log('Applying bulk grade to', gradeInputs.length, 'inputs');

            gradeInputs.forEach((input, index) => {
                console.log('Setting grade for input', index, input.name);
                input.value = gradeValue;
                updateGradeLetter(input);
            });

            showToastSuccess('Nilai berhasil diterapkan ke semua siswa');
        }

        // Clear all grades
        function clearAllGrades() {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus semua nilai?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-xl',
                    confirmButton: 'rounded-lg px-4 py-2',
                    cancelButton: 'rounded-lg px-4 py-2'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const gradeInputs = document.querySelectorAll('.grade-input');
                    gradeInputs.forEach(input => {
                        input.value = '';
                        updateGradeLetter(input);
                    });
                    showToastSuccess('Semua nilai berhasil dihapus');
                }
            });
        }

        // Form validation before submit
        document.querySelector('form').addEventListener('submit', function(e) {
            const gradeInputs = document.querySelectorAll('.grade-input');

            console.log('Form submission - grade inputs found:', gradeInputs.length);

            if (gradeInputs.length === 0) {
                e.preventDefault();
                showToastError('Mohon pilih kelas dan mata pelajaran terlebih dahulu untuk memuat daftar siswa');
                return;
            }

            let hasInvalidGrades = false;
            let filledGrades = 0;

            // Pastikan semua nilai dalam format yang benar sebelum submit
            gradeInputs.forEach((input, index) => {
                let value = input.value.trim();
                if (value) {
                    // Format nilai sebagai angka dengan 2 desimal
                    const score = parseFloat(value);
                    if (!isNaN(score) && score >= 0 && score <= 100) {
                        // Update nilai ke format dengan 2 desimal untuk konsistensi
                        input.value = score.toFixed(2);
                        filledGrades++;
                    } else {
                        hasInvalidGrades = true;
                    }
                }
            });

            // Debug: Log all form data for debugging
            const formElement = document.querySelector('form');
            const formDataObj = new FormData(formElement);
            console.log('Form data being submitted:');
            for (let pair of formDataObj.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }

            // Validasi: minimal harus ada 1 nilai yang diisi
            if (filledGrades === 0) {
                e.preventDefault();
                showToastError('Mohon isi minimal 1 nilai siswa');
                return;
            }

            if (hasInvalidGrades) {
                e.preventDefault();
                showToastError('Mohon pastikan semua nilai berada dalam rentang 0-100');
                return;
            }

            // Tampilkan konfirmasi berapa nilai yang akan disimpan
            if (filledGrades < gradeInputs.length) {
                const emptyGrades = gradeInputs.length - filledGrades;
                const confirmation = confirm(
                    `Anda akan menyimpan ${filledGrades} nilai dari ${gradeInputs.length} siswa. ${emptyGrades} siswa tidak akan mendapat nilai. Lanjutkan?`
                    );
                if (!confirmation) {
                    e.preventDefault();
                    return;
                }
            }

            // Tambahkan notifikasi untuk menunjukkan form sedang disubmit
            showToastSuccess(`Menyimpan ${filledGrades} nilai...`);
        });
    </script>
</x-teacher-layout>
