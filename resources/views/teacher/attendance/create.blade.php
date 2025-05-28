<x-teacher-layout>
    <div class="p-6">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center space-x-4">
                <a href="{{ route('teacher.attendance.index') }}"
                    class="p-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors duration-200">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Buat Absensi Baru</h1>
                    <p class="text-gray-600">Buat dan input absensi siswa untuk sesi pembelajaran</p>
                </div>
            </div>
        </div>

        <form action="{{ route('teacher.attendance.store') }}" method="POST" class="max-w-5xl">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column: Form Settings -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden sticky top-6">
                        <div class="p-6 bg-gradient-to-r from-indigo-50 to-indigo-100 border-b border-indigo-200">
                            <h3 class="text-lg font-semibold text-indigo-900 flex items-center">
                                <svg class="w-6 h-6 mr-3 text-indigo-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Pengaturan Absensi
                            </h3>
                        </div>

                        <div class="p-6 space-y-6">
                            <!-- Date -->
                            <div>
                                <label for="date" class="block text-sm font-semibold text-gray-700 mb-3">Tanggal
                                    <span class="text-red-500">*</span></label>
                                <input type="date" id="date" name="date"
                                    value="{{ old('date', date('Y-m-d')) }}" required
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('date') border-red-500 @enderror">
                                @error('date')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Time -->
                            <div>
                                <label for="time"
                                    class="block text-sm font-semibold text-gray-700 mb-3">Waktu</label>
                                <input type="time" id="time" name="time"
                                    value="{{ old('time', date('H:i')) }}"
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('time') border-red-500 @enderror">
                                @error('time')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Class -->
                            <div>
                                <label for="class_id" class="block text-sm font-semibold text-gray-700 mb-3">Kelas <span
                                        class="text-red-500">*</span></label>
                                <select id="class_id" name="class_id" required
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('class_id') border-red-500 @enderror">
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

                            <!-- Subject -->
                            <div>
                                <label for="subject_id" class="block text-sm font-semibold text-gray-700 mb-3">Mata
                                    Pelajaran <span class="text-red-500">*</span></label>
                                <select id="subject_id" name="subject_id" required
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('subject_id') border-red-500 @enderror">
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

                            <!-- Notes -->
                            <div>
                                <label for="notes"
                                    class="block text-sm font-semibold text-gray-700 mb-3">Catatan</label>
                                <textarea id="notes" name="notes" rows="3" placeholder="Catatan tambahan untuk absensi ini..."
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('notes') border-red-500 @enderror">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Quick Actions -->
                            <div class="border-t border-gray-200 pt-6">
                                <h4 class="text-sm font-semibold text-gray-700 mb-3">Aksi Cepat</h4>
                                <div class="space-y-2">
                                    <button type="button" id="mark_all_present"
                                        class="w-full px-4 py-2 bg-green-100 text-green-800 rounded-lg hover:bg-green-200 transition-colors duration-200 text-sm font-medium">
                                        Tandai Semua Hadir
                                    </button>
                                    <button type="button" id="reset_all"
                                        class="w-full px-4 py-2 bg-gray-100 text-gray-800 rounded-lg hover:bg-gray-200 transition-colors duration-200 text-sm font-medium">
                                        Reset Semua
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Students List -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                        <div class="p-6 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <svg class="w-6 h-6 mr-3 text-indigo-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                                Daftar Siswa
                                <span id="student_count"
                                    class="ml-auto bg-indigo-100 text-indigo-800 text-sm font-medium px-3 py-1 rounded-full">0
                                    siswa</span>
                            </h3>
                        </div>

                        <div id="students_container" class="hidden">
                            <div id="students_list" class="p-6 space-y-4 max-h-96 overflow-y-auto">
                                <!-- Students will be loaded here via AJAX -->
                            </div>

                            <!-- Summary -->
                            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                                <div class="grid grid-cols-4 gap-4 text-center">
                                    <div class="bg-green-100 rounded-lg p-3">
                                        <div class="text-2xl font-bold text-green-800" id="present_count">0</div>
                                        <div class="text-sm text-green-600">Hadir</div>
                                    </div>
                                    <div class="bg-yellow-100 rounded-lg p-3">
                                        <div class="text-2xl font-bold text-yellow-800" id="permission_count">0</div>
                                        <div class="text-sm text-yellow-600">Izin</div>
                                    </div>
                                    <div class="bg-blue-100 rounded-lg p-3">
                                        <div class="text-2xl font-bold text-blue-800" id="sick_count">0</div>
                                        <div class="text-sm text-blue-600">Sakit</div>
                                    </div>
                                    <div class="bg-red-100 rounded-lg p-3">
                                        <div class="text-2xl font-bold text-red-800" id="absent_count">0</div>
                                        <div class="text-sm text-red-600">Alpha</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="no_students" class="p-12 text-center">
                            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Pilih Kelas Terlebih Dahulu</h3>
                            <p class="text-gray-600">Pilih kelas untuk menampilkan daftar siswa yang akan diabsen.</p>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-6 flex items-center justify-between">
                        <a href="{{ route('teacher.attendance.index') }}"
                            class="px-6 py-3 border text-gray-700 font-semibold rounded-lg hover:bg-gray-100 transition-colors duration-200">
                            Batal
                        </a>
                        <button type="submit" id="submit_btn" disabled
                            class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-semibold rounded-lg hover:from-indigo-700 hover:to-indigo-800 transform hover:scale-105 transition-all duration-200 shadow-lg disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                            Simpan Absensi
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
                    const classSelect = document.getElementById('class_id');
                    const studentsContainer = document.getElementById('students_container');
                    const studentsList = document.getElementById('students_list');
                    const noStudents = document.getElementById('no_students');
                    const studentCount = document.getElementById('student_count');
                    const submitBtn = document.getElementById('submit_btn');
                    const markAllPresentBtn = document.getElementById('mark_all_present');
                    const resetAllBtn = document.getElementById('reset_all');

                    // Counters
                    const presentCount = document.getElementById('present_count');
                    const permissionCount = document.getElementById('permission_count');
                    const sickCount = document.getElementById('sick_count');
                    const absentCount = document.getElementById('absent_count');

                    function loadStudents() {
                        const classId = classSelect.value;

                        if (classId) {
                            // Show loading state
                            studentsContainer.classList.remove('hidden');
                            noStudents.classList.add('hidden');
                            studentsList.innerHTML =
                                '<div class="text-center py-8 text-gray-500">Memuat daftar siswa...</div>';

                            // Fetch students
                            fetch(`{{ route('teacher.students.by-class') }}?class_id=${classId}`)
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        studentCount.textContent = data.students.length + ' siswa';
                                        let html = '';

                                        data.students.forEach((student, index) => {
                                            html += `
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold text-sm mr-4">
                                            ${student.name.charAt(0)}
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900">${student.name}</div>
                                            <div class="text-sm text-gray-500">NISN: ${student.nisn}</div>
                                        </div>
                                        <input type="hidden" name="students[${index}][student_id]" value="${student.id}">
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <label class="flex items-center">
                                            <input type="radio" name="students[${index}][status]" value="present" class="sr-only attendance-radio" data-type="present">
                                            <div class="w-10 h-10 bg-white border-2 rounded-lg flex items-center justify-center cursor-pointer hover:border-green-500 transition-colors duration-200 radio-button" data-type="present">
                                                <svg class="w-5 h-5 text-green-600 hidden check-icon" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                                </svg>
                                            </div>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="radio" name="students[${index}][status]" value="permission" class="sr-only attendance-radio" data-type="permission">
                                            <div class="w-10 h-10 bg-white border-2 rounded-lg flex items-center justify-center cursor-pointer hover:border-yellow-500 transition-colors duration-200 radio-button" data-type="permission">
                                                <span class="text-yellow-600 font-bold text-sm hidden check-icon">I</span>
                                            </div>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="radio" name="students[${index}][status]" value="sick" class="sr-only attendance-radio" data-type="sick">
                                            <div class="w-10 h-10 bg-white border-2 rounded-lg flex items-center justify-center cursor-pointer hover:border-blue-500 transition-colors duration-200 radio-button" data-type="sick">
                                                <span class="text-blue-600 font-bold text-sm hidden check-icon">S</span>
                                            </div>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="radio" name="students[${index}][status]" value="absent" class="sr-only attendance-radio" data-type="absent">
                                            <div class="w-10 h-10 bg-white border-2 rounded-lg flex items-center justify-center cursor-pointer hover:border-red-500 transition-colors duration-200 radio-button" data-type="absent">
                                                <span class="text-red-600 font-bold text-sm hidden check-icon">A</span>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            `;
                                        });

                                        studentsList.innerHTML = html;
                                        submitBtn.disabled = false;

                                        // Add event listeners for radio buttons
                                        addRadioListeners();
                                        updateCounts();
                                    } else {
                                        studentsList.innerHTML =
                                            '<div class="text-center py-8 text-red-500">Gagal memuat daftar siswa</div>';
                                        submitBtn.disabled = true;
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    studentsList.innerHTML =
                                        '<div class="text-center py-8 text-red-500">Terjadi kesalahan saat memuat data</div>';
                                    submitBtn.disabled = true;
                                });
                        } else {
                            studentsContainer.classList.add('hidden');
                            noStudents.classList.remove('hidden');
                            submitBtn.disabled = true;
                            studentCount.textContent = '0 siswa';
                        }
                    }

                    function addRadioListeners() {
                        const radioButtons = document.querySelectorAll('.radio-button');
                        const radios = document.querySelectorAll('.attendance-radio');

                        radioButtons.forEach(button => {
                                button.addEventListener('click', function() {
                                    const type = this.dataset.type;
                                    const container = this.closest('.flex');
                                    const radio = container.querySelector(`input[data-type="${type}"]`);

                                    // Clear all selections in this row
                                    container.querySelectorAll('.radio-button').forEach(btn => {
                                            btn.classList.remove('border-green-500', 'border-yellow-500',
                                                'border-blue-500', 'border-red-500', 'bg-green-100',
                                                'bg-yellow-100', 'bg-blue-100', 'bg-red-100');
                                            btn.classList.add(');
                                                btn.querySelector('.check-icon').classList.add(
                                                'hidden');
                                            });

                                        // Clear all radio selections in this row
                                        container.querySelectorAll('.attendance-radio').forEach(r => r
                                            .checked =
                                            false);

                                        // Select this option
                                        radio.checked = true; this.classList.remove(');
                                            this.querySelector('.check-icon').classList.remove('hidden');

                                            if (type === 'present') {
                                                this.classList.add('border-green-500', 'bg-green-100');
                                            } else if (type === 'permission') {
                                                this.classList.add('border-yellow-500', 'bg-yellow-100');
                                            } else if (type === 'sick') {
                                                this.classList.add('border-blue-500', 'bg-blue-100');
                                            } else if (type === 'absent') {
                                                this.classList.add('border-red-500', 'bg-red-100');
                                            }

                                            updateCounts();
                                        });
                                });
                            }

                            function updateCounts() {
                                const presentChecked = document.querySelectorAll('input[value="present"]:checked')
                                    .length;
                                const permissionChecked = document.querySelectorAll('input[value="permission"]:checked')
                                    .length;
                                const sickChecked = document.querySelectorAll('input[value="sick"]:checked').length;
                                const absentChecked = document.querySelectorAll('input[value="absent"]:checked').length;

                                presentCount.textContent = presentChecked;
                                permissionCount.textContent = permissionChecked;
                                sickCount.textContent = sickChecked;
                                absentCount.textContent = absentChecked;
                            }

                            // Mark all present
                            markAllPresentBtn.addEventListener('click', function() {
                                document.querySelectorAll('.radio-button[data-type="present"]').forEach(btn => {
                                    btn.click();
                                });
                            });

                            // Reset all
                            resetAllBtn.addEventListener('click', function() {
                                    document.querySelectorAll('.radio-button').forEach(btn => {
                                            btn.classList.remove('border-green-500', 'border-yellow-500',
                                                'border-blue-500',
                                                'border-red-500', 'bg-green-100', 'bg-yellow-100',
                                                'bg-blue-100',
                                                'bg-red-100');
                                            btn.classList.add(');
                                                btn.querySelector('.check-icon').classList.add('hidden');
                                            }); document.querySelectorAll('.attendance-radio').forEach(radio =>
                                            radio.checked = false); updateCounts();
                                    });

                                classSelect.addEventListener('change', loadStudents);

                                // Load students if class is already selected
                                if (classSelect.value) {
                                    loadStudents();
                                }
                            });
    </script>
</x-teacher-layout>
