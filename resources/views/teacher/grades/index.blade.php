<x-teacher-layout>
    <div class="p-6">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Input Nilai</h1>
                    <p class="text-gray-600">Kelola nilai siswa untuk mata pelajaran yang Anda ampu</p>
                </div>
                <div class="mt-4 sm:mt-0 flex space-x-3">
                    <a href="{{ route('teacher.grades.create') }}"
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-blue-800 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Input Nilai Siswa
                    </a>
                </div>
            </div>
        </div>

        <!-- Filter Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <label for="class_filter" class="block text-sm font-semibold text-gray-700 mb-3">Filter Kelas</label>
                <select id="class_filter" name="class_id"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50">
                    <option value="">Semua Kelas</option>
                    @foreach ($classes as $class)
                        <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                            {{ $class->class_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <label for="subject_filter" class="block text-sm font-semibold text-gray-700 mb-3">Filter Mata
                    Pelajaran</label>
                <select id="subject_filter" name="subject_id"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50">
                    <option value="">Semua Mata Pelajaran</option>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}"
                            {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                            {{ $subject->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <label for="grade_type_filter" class="block text-sm font-semibold text-gray-700 mb-3">Filter Jenis
                    Nilai</label>
                <select id="grade_type_filter" name="grade_type"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50">
                    <option value="">Semua Jenis</option>
                    <option value="tugas" {{ request('grade_type') == 'tugas' ? 'selected' : '' }}>Tugas</option>
                    <option value="kuis" {{ request('grade_type') == 'kuis' ? 'selected' : '' }}>Kuis</option>
                    <option value="uts" {{ request('grade_type') == 'uts' ? 'selected' : '' }}>UTS</option>
                    <option value="uas" {{ request('grade_type') == 'uas' ? 'selected' : '' }}>UAS</option>
                </select>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <label for="semester_filter" class="block text-sm font-semibold text-gray-700 mb-3">Filter
                    Semester</label>
                <select id="semester_filter" name="semester"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50">
                    <option value="">Semua Semester</option>
                    <option value="Ganjil" {{ request('semester') == 'Ganjil' ? 'selected' : '' }}>Semester Ganjil
                    </option>
                    <option value="Genap" {{ request('semester') == 'Genap' ? 'selected' : '' }}>Semester Genap
                    </option>
                </select>
            </div>
        </div>

        <!-- Statistics Dashboard -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8" id="statistics-dashboard">
            <!-- Statistics cards will be loaded here -->
        </div>

        <!-- Grades List -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="p-6 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                        </path>
                    </svg>
                    Daftar Nilai
                </h3>
            </div>

            @if ($grades->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Siswa</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Kelas</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Mata Pelajaran</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Jenis</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Nilai</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Tanggal</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($grades as $grade)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold text-sm mr-3">
                                                {{ substr($grade->student->user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="text-sm font-semibold text-gray-900">
                                                    {{ $grade->student->user->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $grade->student->nisn }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $grade->student->classes->class_name ?? 'Belum Terdaftar' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-gray-900">{{ $grade->subject->name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $grade->grade_type === 'tugas'
                                                ? 'bg-green-100 text-green-800'
                                                : ($grade->grade_type === 'kuis'
                                                    ? 'bg-yellow-100 text-yellow-800'
                                                    : ($grade->grade_type === 'uts'
                                                        ? 'bg-orange-100 text-orange-800'
                                                        : ($grade->grade_type === 'uas'
                                                            ? 'bg-red-100 text-red-800'
                                                            : 'bg-gray-100 text-gray-800'))) }}">
                                            {{ ucfirst($grade->grade_type) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div>
                                            <span
                                                class="text-lg font-bold {{ $grade->score >= 90
                                                    ? 'text-green-600'
                                                    : ($grade->score >= 80
                                                        ? 'text-blue-600'
                                                        : ($grade->score >= 70
                                                            ? 'text-yellow-600'
                                                            : ($grade->score >= 60
                                                                ? 'text-orange-600'
                                                                : 'text-red-600'))) }}">
                                                {{ $grade->score }}
                                            </span>
                                            <span
                                                class="text-sm font-medium text-gray-500">({{ $grade->grade }})</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $grade->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-3">
                                            <a href="{{ route('teacher.grades.edit', $grade) }}"
                                                class="text-blue-600 hover:text-blue-800 font-semibold">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('teacher.grades.destroy', $grade) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="delete-btn text-red-600 hover:text-red-800 font-semibold">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    {{ $grades->links() }}
                </div>
            @else
                <div class="p-12 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                        </path>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Nilai</h3>
                    <p class="text-gray-600 mb-6">Mulai input nilai siswa untuk mata pelajaran yang Anda ampu.</p>
                    <a href="{{ route('teacher.grades.create') }}"
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-blue-800 transform hover:scale-105 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Input Nilai Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const deleteButtons = document.querySelectorAll('.delete-btn');
                deleteButtons.forEach(deleteBtn => {
                    deleteBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        const form = this.closest('form');
                        Swal.fire({
                            title: 'Hapus Nilai',
                            text: "Nilai yang dihapus tidak dapat dikembalikan!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#dc2626',
                            cancelButtonColor: '#6b7280',
                            confirmButtonText: 'Ya, Hapus!',
                            cancelButtonText: 'Batal',
                            reverseButtons: true,
                            customClass: {
                                popup: 'rounded-2xl border-0 shadow-2xl',
                                confirmButton: 'rounded-xl px-6 py-3 font-semibold',
                                cancelButton: 'rounded-xl px-6 py-3 font-semibold'
                            },
                            focusConfirm: false,
                            focusCancel: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire({
                                    title: 'Menghapus Nilai...',
                                    text: 'Sedang memproses penghapusan nilai',
                                    icon: 'info',
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    showConfirmButton: false,
                                    customClass: {
                                        popup: 'rounded-2xl border-0 shadow-2xl'
                                    },
                                    didOpen: () => {
                                        Swal.showLoading();
                                    }
                                });
                                form.submit();
                            }
                        });
                    });
                });

                const classFilter = document.getElementById('class_filter');
                const subjectFilter = document.getElementById('subject_filter');
                const gradeTypeFilter = document.getElementById('grade_type_filter');
                const semesterFilter = document.getElementById('semester_filter');

                function updateFilters() {
                    const params = new URLSearchParams();
                    if (classFilter.value) params.set('class_id', classFilter.value);
                    if (subjectFilter.value) params.set('subject_id', subjectFilter.value);
                    if (gradeTypeFilter.value) params.set('grade_type', gradeTypeFilter.value);
                    if (semesterFilter.value) params.set('semester', semesterFilter.value);

                    const queryString = params.toString();
                    const newUrl = queryString ? `${window.location.pathname}?${queryString}` : window
                        .location
                        .pathname;

                    window.location.href = newUrl;
                }

                function loadStatistics() {
                    const params = new URLSearchParams();

                    if (classFilter.value) params.append('class_id', classFilter.value);
                    if (subjectFilter.value) params.append('subject_id', subjectFilter.value);
                    if (gradeTypeFilter.value) params.append('grade_type', gradeTypeFilter.value);
                    if (semesterFilter.value) params.append('semester', semesterFilter.value);

                    const queryString = params.toString();
                    const url =
                        `{{ route('teacher.grades.statistics') }}${queryString ? '?' + queryString : ''}`;

                    fetch(url)
                        .then(response => response.json())
                        .then(data => {
                            updateStatisticsDashboard(data);
                        })
                        .catch(error => {
                            console.error('Error loading statistics:', error);
                        });
                }

                function updateStatisticsDashboard(stats) {
                    const dashboard = document.getElementById('statistics-dashboard');

                    const html = `
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-blue-100 text-sm font-medium">Total Nilai</p>
                                <p class="text-3xl font-bold">${stats.total_grades}</p>
                            </div>
                            <div class="bg-blue-400 bg-opacity-50 rounded-full p-3">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-green-100 text-sm font-medium">Rata-rata</p>
                                <p class="text-3xl font-bold">${stats.average_score ? Math.round(stats.average_score * 10) / 10 : 0}</p>
                            </div>
                            <div class="bg-green-400 bg-opacity-50 rounded-full p-3">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-xl shadow-lg p-6 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-yellow-100 text-sm font-medium">Nilai Tertinggi</p>
                                <p class="text-3xl font-bold">${stats.highest_score || 0}</p>
                            </div>
                            <div class="bg-yellow-400 bg-opacity-50 rounded-full p-3">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3.293 9.707a1 1 0 010-1.414l6-6a1 1 0 011.414 0l6 6a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L4.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-xl shadow-lg p-6 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-red-100 text-sm font-medium">Nilai Terendah</p>
                                <p class="text-3xl font-bold">${stats.lowest_score !== null ? stats.lowest_score : 0}</p>
                            </div>
                            <div class="bg-red-400 bg-opacity-50 rounded-full p-3">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 10.293a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l4.293-4.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                `;

                    dashboard.innerHTML = html;
                }

                // Event listeners for all filters
                classFilter.addEventListener('change', function() {
                    updateFilters();
                    loadStatistics();
                });
                subjectFilter.addEventListener('change', function() {
                    updateFilters();
                    loadStatistics();
                });
                gradeTypeFilter.addEventListener('change', function() {
                    updateFilters();
                    loadStatistics();
                });
                semesterFilter.addEventListener('change', function() {
                    updateFilters();
                    loadStatistics();
                });

                // Load initial statistics
                loadStatistics();
            });
        </script>
    @endpush

</x-teacher-layout>
