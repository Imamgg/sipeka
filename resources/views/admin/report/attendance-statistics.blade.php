<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 p-4 sm:p-6 lg:p-8">
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 mb-8">
            <div class="px-6 py-8 sm:px-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
                    <div class="space-y-2">
                        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">
                            📊 Statistik Kehadiran
                        </h1>
                        <p class="text-gray-600 text-lg">Analisis kehadiran siswa di seluruh sekolah</p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('admin.reports.index') }}"
                            class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali
                        </a>
                        <button onclick="exportData('excel')"
                            class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 transition-all duration-200 shadow-sm hover:shadow-md">
                            <i class="fas fa-file-excel mr-2"></i>
                            Export Excel
                        </button>
                        <button onclick="exportData('pdf')"
                            class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-all duration-200 shadow-sm hover:shadow-md">
                            <i class="fas fa-file-pdf mr-2"></i>
                            Export PDF
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div
                class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="text-white">
                            <p class="text-green-100 text-sm font-medium">Total Kehadiran</p>
                            <h3 class="text-3xl font-bold mt-2">
                                {{ number_format($attendanceStats['total_attendance']) }}</h3>
                            <p class="text-green-100 text-xs mt-1">Hari ini</p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-full p-3">
                            <i class="fas fa-check-circle text-white text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="bg-gradient-to-r from-blue-500 to-cyan-600 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="text-white">
                            <p class="text-blue-100 text-sm font-medium">Persentase Hadir</p>
                            <h3 class="text-3xl font-bold mt-2">
                                {{ number_format($attendanceStats['attendance_rate'], 1) }}%</h3>
                            <p class="text-blue-100 text-xs mt-1">Rata-rata keseluruhan</p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-full p-3">
                            <i class="fas fa-percentage text-white text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="bg-gradient-to-r from-amber-500 to-orange-600 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="text-white">
                            <p class="text-amber-100 text-sm font-medium">Siswa Terlambat</p>
                            <h3 class="text-3xl font-bold mt-2">{{ $attendanceStats['late_students'] }}</h3>
                            <p class="text-amber-100 text-xs mt-1">Hari ini</p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-full p-3">
                            <i class="fas fa-clock text-white text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="bg-gradient-to-r from-red-500 to-pink-600 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="text-white">
                            <p class="text-red-100 text-sm font-medium">Tidak Hadir</p>
                            <h3 class="text-3xl font-bold mt-2">{{ $attendanceStats['absent_students'] }}</h3>
                            <p class="text-red-100 text-xs mt-1">Hari ini</p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-full p-3">
                            <i class="fas fa-times-circle text-white text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <div class="lg:col-span-2 bg-white rounded-xl shadow-lg border border-gray-100">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Trend Kehadiran (7 Hari Terakhir)</h3>
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                            <span class="text-sm text-gray-600">Persentase Kehadiran</span>
                        </div>
                    </div>
                    <div class="relative h-80">
                        <canvas id="attendanceTrendChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg border border-gray-100">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Distribusi Status</h3>
                    <div class="relative h-80">
                        <canvas id="attendanceStatusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg border border-gray-100 mb-8">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 rounded-t-xl">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Performa Kehadiran per Kelas</h3>
                        <p class="text-sm text-gray-600 mt-1">Statistik kehadiran berdasarkan kelas</p>
                    </div>
                    <div class="relative">
                        <select id="classFilter"
                            class="appearance-none bg-white border border-gray-300 rounded-lg px-4 py-2 pr-8 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="today">Hari Ini</option>
                            <option value="week">Minggu Ini</option>
                            <option value="month">Bulan Ini</option>
                            <option value="semester">Semester Ini</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                {{-- No need for ?? [] here if data is always passed from controller --}}
                @if (count($classAttendance) > 0)
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kelas</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total Siswa</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Hadir</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tidak Hadir</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Terlambat</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Izin</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Sakit</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Persentase</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($classAttendance as $attendance)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div
                                                    class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-medium text-sm">
                                                    {{ strtoupper(substr($attendance['class_name'], 0, 2)) }}
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $attendance['class_name'] }}</div>
                                                <div class="text-sm text-gray-500">{{ $attendance['teacher_name'] }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ $attendance['total_students'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            {{ $attendance['present'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            {{ $attendance['absent'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            {{ $attendance['late'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $attendance['permission'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ $attendance['sick'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-16 bg-gray-200 rounded-full h-2 mr-3">
                                                <div class="bg-green-500 h-2 rounded-full"
                                                    style="width: {{ $attendance['attendance_rate'] }}%"></div>
                                            </div>
                                            <span
                                                class="text-sm font-medium text-gray-900">{{ number_format($attendance['attendance_rate'], 1) }}%</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($attendance['attendance_rate'] >= 90)
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Sangat Baik
                                            </span>
                                        @elseif($attendance['attendance_rate'] >= 80)
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                Baik
                                            </span>
                                        @elseif($attendance['attendance_rate'] >= 70)
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Cukup
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                Perlu Perhatian
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center py-8">
                        <p class="text-gray-500">Tidak ada data kehadiran kelas yang tersedia untuk periode ini.</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 rounded-t-xl">
                <h3 class="text-lg font-semibold text-gray-900">Siswa dengan Kehadiran Rendah</h3>
                <p class="text-sm text-gray-600 mt-1">Siswa dengan tingkat kehadiran di bawah 75%</p>
            </div>
            <div class="overflow-x-auto">
                {{-- No need for ?? [] here if data is always passed from controller --}}
                @if (count($poorAttendanceStudents) > 0)
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Siswa</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kelas</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total Hari</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Hadir</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tidak Hadir</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Persentase</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($poorAttendanceStudents as $student)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div
                                                    class="h-10 w-10 rounded-full bg-red-500 flex items-center justify-center text-white font-medium text-sm">
                                                    {{ strtoupper(substr($student['name'], 0, 2)) }}
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $student['name'] }}</div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $student['student_id'] }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $student['class_name'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ $student['total_days'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            {{ $student['present_days'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            {{ $student['absent_days'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-16 bg-gray-200 rounded-full h-2 mr-3">
                                                <div class="bg-red-500 h-2 rounded-full"
                                                    style="width: {{ $student['attendance_rate'] }}%"></div>
                                            </div>
                                            <span
                                                class="text-sm font-medium text-red-600">{{ number_format($student['attendance_rate'], 1) }}%</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button onclick="contactParent('{{ $student['id'] }}')"
                                            class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                            <i class="fas fa-phone mr-1"></i>
                                            Hubungi Ortu
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center py-12">
                        <div class="w-24 h-24 mx-auto mb-4 text-green-500">
                            <i class="fas fa-check-circle text-6xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak Ada Siswa dengan Kehadiran
                            Rendah</h3>
                        <p class="text-gray-500">Semua siswa memiliki tingkat kehadiran yang baik!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const attendanceTrendData = @json($attendanceTrend);
            const attendanceStatsData = @json($attendanceStats);
            const attendanceStatusValues = [
                attendanceStatsData.present || 0,
                attendanceStatsData.absent || 0,
                attendanceStatsData.late || 0,
                attendanceStatsData.permission || 0,
                attendanceStatsData.sick || 0
            ];

            const attendanceTrendCtx = document.getElementById('attendanceTrendChart').getContext('2d');
            new Chart(attendanceTrendCtx, {
                type: 'line',
                data: {
                    labels: attendanceTrendData.dates,
                    datasets: [{
                        label: 'Persentase Kehadiran',
                        data: attendanceTrendData.rates,
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: 'rgb(59, 130, 246)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(17, 24, 39, 0.9)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            borderColor: 'rgba(59, 130, 246, 0.5)',
                            borderWidth: 1,
                            cornerRadius: 8,
                            displayColors: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            grid: {
                                color: 'rgba(107, 114, 128, 0.1)'
                            },
                            ticks: {
                                color: '#6B7280',
                                callback: function(value) {
                                    return value + '%';
                                }
                            }
                        },
                        x: {
                            grid: {
                                color: 'rgba(107, 114, 128, 0.1)'
                            },
                            ticks: {
                                color: '#6B7280'
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    }
                }
            });

            // Attendance Status Chart
            const attendanceStatusCtx = document.getElementById('attendanceStatusChart').getContext('2d');
            new Chart(attendanceStatusCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Hadir', 'Tidak Hadir', 'Terlambat', 'Izin', 'Sakit'],
                    datasets: [{
                        data: attendanceStatusValues, // Use the extracted values array
                        backgroundColor: [
                            '#10B981', // green-500 (Hadir)
                            '#EF4444', // red-500 (Tidak Hadir)
                            '#F59E0B', // amber-500 (Terlambat)
                            '#3B82F6', // blue-500 (Izin)
                            '#6B7280' // gray-500 (Sakit)
                        ],
                        borderWidth: 0,
                        hoverBorderWidth: 2,
                        hoverBorderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '60%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                color: '#374151',
                                font: {
                                    size: 12
                                },
                                padding: 20
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(17, 24, 39, 0.9)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            borderColor: 'rgba(59, 130, 246, 0.5)',
                            borderWidth: 1,
                            cornerRadius: 8
                        }
                    }
                }
            });

            function exportData(format) {
                const filter = document.getElementById('classFilter').value;
                const url = `{{ route('admin.reports.attendance-statistics') }}?export=${format}&filter=${filter}`;

                Swal.fire({
                    title: `Mengekspor ${format.toUpperCase()}...`,
                    text: 'Mohon tunggu sebentar',
                    icon: 'info',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                        const newWindow = window.open(url, '_blank');
                        const checkDownload = setInterval(() => {
                            try {
                                if (newWindow && newWindow.closed) {
                                    clearInterval(checkDownload);
                                    Swal.fire('Berhasil!',
                                        `Data telah diekspor ke ${format.toUpperCase()}.`, 'success');
                                }
                            } catch (e) {
                                clearInterval(checkDownload);
                                Swal.fire('Berhasil!', `Data telah diekspor ke ${format.toUpperCase()}.`,
                                    'success');
                            }
                        }, 1000);
                    }
                });
            }

            function contactParent(studentId) {
                console.log('Attempting to contact parent for student ID:', studentId);
                Swal.fire({
                    title: 'Hubungi Orang Tua',
                    html: `
                      <p>Fitur untuk menghubungi orang tua siswa ini (ID: ${studentId}) akan segera tersedia.</p>
                      <p>Anda dapat menambahkan opsi seperti email atau SMS di sini.</p>
                  `,
                    icon: 'info',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3B82F6'
                });
            }

            document.addEventListener('DOMContentLoaded', function() {
                const tables = document.querySelectorAll('.overflow-x-auto');
                tables.forEach(table => {
                    table.style.scrollBehavior = 'smooth';
                });

                document.getElementById('classFilter').addEventListener('change', function() {
                    const selectedPeriod = this.value;
                    Swal.fire({
                        title: 'Filter Diubah',
                        text: `Tabel performa kehadiran per kelas akan diperbarui untuk periode: ${selectedPeriod}. (Implementasi backend diperlukan)`,
                        icon: 'info',
                        timer: 2000,
                        showConfirmButton: false
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
