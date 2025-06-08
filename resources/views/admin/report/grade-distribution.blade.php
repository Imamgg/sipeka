<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-6">
        <div
            class="flex flex-col md:flex-row justify-between items-start md:items-center pb-6 mb-6 border-b-2 border-gray-200">
            <div class="mb-4 md:mb-0">
                <h2 class="text-2xl font-semibold text-gray-800">Distribusi Nilai</h2>
                <p class="text-sm text-gray-600 mt-1">Analisis distribusi dan trend nilai di seluruh sekolah</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.reports.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 rounded-md text-white text-sm font-medium transition">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <button
                    class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 rounded-md text-white text-sm font-medium transition"
                    onclick="exportData('excel')">
                    <i class="fas fa-file-excel mr-2"></i>Export Excel
                </button>
                <button
                    class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 rounded-md text-white text-sm font-medium transition"
                    onclick="exportData('pdf')">
                    <i class="fas fa-file-pdf mr-2"></i>Export PDF
                </button>
            </div>
        </div> <!-- Filter Section -->
        <div class="mb-8">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Periode</label>
                        <select name="period"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                            <option value="current_semester"
                                {{ request('period') == 'current_semester' ? 'selected' : '' }}>Semester Ini</option>
                            <option value="last_semester" {{ request('period') == 'last_semester' ? 'selected' : '' }}>
                                Semester Lalu</option>
                            <option value="current_year" {{ request('period') == 'current_year' ? 'selected' : '' }}>
                                Tahun Ini</option>
                            <option value="last_year" {{ request('period') == 'last_year' ? 'selected' : '' }}>Tahun
                                Lalu</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kelas</label>
                        <select name="class_id"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                            <option value="">Semua Kelas</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}"
                                    {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                    {{ $class->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mata Pelajaran</label>
                        <select name="subject_id"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                            <option value="">Semua Mata Pelajaran</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}"
                                    {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full md:w-auto inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-md text-white text-sm font-medium transition">
                            <i class="fas fa-filter mr-2"></i>Filter
                        </button>
                    </div>
                </form>
            </div>
        </div> <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div
                class="bg-gradient-to-br from-blue-600 to-blue-800 rounded-lg shadow-md p-5 transition-transform hover:-translate-y-1">
                <div class="flex justify-between items-center">
                    <div>
                        <h6 class="text-white text-opacity-90 text-sm font-medium mb-1">Rata-rata Nilai</h6>
                        <h3 class="text-white text-3xl font-bold mb-1">
                            {{ number_format($gradeStats['average_grade'], 1) }}</h3>
                        <small class="text-white text-opacity-70 text-xs">Keseluruhan</small>
                    </div>
                    <div class="text-white text-opacity-70 text-3xl">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
            </div>
            <div
                class="bg-gradient-to-br from-green-600 to-green-800 rounded-lg shadow-md p-5 transition-transform hover:-translate-y-1">
                <div class="flex justify-between items-center">
                    <div>
                        <h6 class="text-white text-opacity-90 text-sm font-medium mb-1">Nilai Tertinggi</h6>
                        <h3 class="text-white text-3xl font-bold mb-1">{{ $gradeStats['highest_grade'] }}</h3>
                        <small class="text-white text-opacity-70 text-xs">Maksimal</small>
                    </div>
                    <div class="text-white text-opacity-70 text-3xl">
                        <i class="fas fa-trophy"></i>
                    </div>
                </div>
            </div>
            <div
                class="bg-gradient-to-br from-yellow-500 to-orange-500 rounded-lg shadow-md p-5 transition-transform hover:-translate-y-1">
                <div class="flex justify-between items-center">
                    <div>
                        <h6 class="text-white text-opacity-90 text-sm font-medium mb-1">Nilai Terendah</h6>
                        <h3 class="text-white text-3xl font-bold mb-1">{{ $gradeStats['lowest_grade'] }}</h3>
                        <small class="text-white text-opacity-70 text-xs">Minimal</small>
                    </div>
                    <div class="text-white text-opacity-70 text-3xl">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                </div>
            </div>
            <div
                class="bg-gradient-to-br from-cyan-600 to-blue-600 rounded-lg shadow-md p-5 transition-transform hover:-translate-y-1">
                <div class="flex justify-between items-center">
                    <div>
                        <h6 class="text-white text-opacity-90 text-sm font-medium mb-1">Total Nilai</h6>
                        <h3 class="text-white text-3xl font-bold mb-1">{{ number_format($gradeStats['total_grades']) }}
                        </h3>
                        <small class="text-white text-opacity-70 text-xs">Data nilai</small>
                    </div>
                    <div class="text-white text-opacity-70 text-3xl">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                </div>
            </div>
        </div> <!-- Grade Distribution Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Grade Range Distribution -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h5 class="text-gray-800 font-semibold text-lg">Distribusi Rentang Nilai</h5>
                </div>
                <div class="p-6">
                    <canvas id="gradeRangeChart" height="300"></canvas>
                </div>
            </div>

            <!-- Grade Trend Over Time -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h5 class="text-gray-800 font-semibold text-lg">Trend Nilai Bulanan</h5>
                </div>
                <div class="p-6">
                    <canvas id="gradeTrendChart" height="300"></canvas>
                </div>
            </div>
        </div>
        <!-- Grade Performance by Subject -->
        <div class="mb-8">
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h5 class="text-gray-800 font-semibold text-lg">Performa Nilai per Mata Pelajaran</h5>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Mata Pelajaran</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jumlah Siswa</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Rata-rata</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nilai Tertinggi</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nilai Terendah</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    A (90-100)</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    B (80-89)</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    C (70-79)</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    D (60-69)</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ 'E (<60)' }}</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($subjectGrades as $subject)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-medium">
                                                {{ substr($subject['name'], 0, 2) }}
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $subject['name'] }}
                                                </div>
                                                <div class="text-sm text-gray-500">{{ $subject['teacher_name'] }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            {{ $subject['student_count'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap font-semibold text-gray-900">
                                        {{ number_format($subject['average'], 1) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ $subject['highest'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            {{ $subject['lowest'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ $subject['grade_a'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ $subject['grade_b'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            {{ $subject['grade_c'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">
                                            {{ $subject['grade_d'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            {{ $subject['grade_e'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($subject['average'] >= 85)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Sangat Baik
                                            </span>
                                        @elseif($subject['average'] >= 75)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                Baik
                                            </span>
                                        @elseif($subject['average'] >= 65)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Cukup
                                            </span>
                                        @else
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Perlu Perhatian
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- Grade Performance by Class -->
        <div class="mb-8">
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h5 class="text-gray-800 font-semibold text-lg">Performa Nilai per Kelas</h5>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kelas</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Wali Kelas</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jumlah Siswa</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Rata-rata Kelas</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Siswa Terbaik</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nilai Tertinggi</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Distribusi Grade</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Ranking</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($classGrades as $index => $class)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-600 flex items-center justify-center text-white font-medium">
                                                {{ substr($class['name'], 0, 2) }}
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $class['name'] }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $class['teacher_name'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            {{ $class['student_count'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap font-semibold text-gray-900">
                                        {{ number_format($class['average'], 1) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $class['top_student'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ $class['highest_grade'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex space-x-2">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                A: {{ $class['grade_a'] }}
                                            </span>
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                B: {{ $class['grade_b'] }}
                                            </span>
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                C: {{ $class['grade_c'] }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($index == 0)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                <i class="fas fa-crown mr-1"></i> #1
                                            </span>
                                        @elseif($index == 1)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-200 text-gray-800">
                                                #2
                                            </span>
                                        @elseif($index == 2)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">
                                                #3
                                            </span>
                                        @else
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                #{{ $index + 1 }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const gradeRangeCtx = document.getElementById('gradeRangeChart').getContext('2d');
            new Chart(gradeRangeCtx, {
                type: 'bar',
                data: {
                    labels: ['A (90-100)', 'B (80-89)', 'C (70-79)', 'D (60-69)', 'E (<60)'],
                    datasets: [{
                        label: 'Jumlah Siswa',
                        data: {!! json_encode($gradeDistribution) !!},
                        backgroundColor: [
                            '#28a745',
                            '#17a2b8',
                            '#ffc107',
                            '#fd7e14',
                            '#dc3545'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

            const gradeTrendCtx = document.getElementById('gradeTrendChart').getContext('2d');
            new Chart(gradeTrendCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($gradeTrend['months']) !!},
                    datasets: [{
                        label: 'Rata-rata Nilai',
                        data: {!! json_encode($gradeTrend['averages']) !!},
                        borderColor: 'rgb(54, 162, 235)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        tension: 0.1,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

            function exportData(format) {
                const url =
                    `{{ route('admin.reports.grade-distribution') }}?export=${format}&{{ http_build_query(request()->query()) }}`;
                window.open(url, '_blank');
            }

            function counselStudent(studentId) {
                // Implement counseling functionality
                alert('Fitur konseling siswa akan segera tersedia');
            }

            function contactParent(studentId) {
                // Implement contact parent functionality
                alert('Fitur hubungi orang tua akan segera tersedia');
            }
        </script>
    @endpush
</x-app-layout>
