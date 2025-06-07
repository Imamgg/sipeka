<x-student-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nilai Siswa - {{ $student->classes->class_name ?? 'Kelas tidak ditemukan' }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Nilai dan Rapor Digital</h3>
                                <p class="text-sm text-gray-600 mt-1">
                                    {{ $student->user->name }} | NIS: {{ $student->nis }} |
                                    Kelas: {{ $student->classes->class_name ?? 'Belum ditetapkan' }}
                                </p>
                            </div>
                            <a href="{{ route('student.dashboard') }}"
                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition-colors">
                                Kembali
                            </a>
                        </div>
                    </div>

                    <!-- Semester Selector -->
                    <div class="mb-6">
                        <div class="flex space-x-4">
                            <a href="{{ route('student.grades.index', ['semester' => 'Ganjil']) }}"
                                class="px-4 py-2 rounded-lg {{ $currentSemester == 'Ganjil' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }} transition-colors">
                                Semester Ganjil
                            </a>
                            <a href="{{ route('student.grades.index', ['semester' => 'Genap']) }}"
                                class="px-4 py-2 rounded-lg {{ $currentSemester == 'Genap' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }} transition-colors">
                                Semester Genap
                            </a>
                        </div>
                    </div>

                    @if ($grades->count() > 0)
                        <!-- Grade Summary -->
                        <div class="mb-8 bg-gradient-to-r from-blue-50 to-purple-50 rounded-lg p-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Nilai Semester
                                {{ $currentSemester }}</h4>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @php
                                    $totalSubjects = count($subjectAverages);
                                    $averageGrade =
                                        $totalSubjects > 0 ? round(array_sum($subjectAverages) / $totalSubjects, 2) : 0;
                                    $highestGrade = $totalSubjects > 0 ? max($subjectAverages) : 0;
                                    $lowestGrade = $totalSubjects > 0 ? min($subjectAverages) : 0;
                                @endphp

                                <div class="text-center">
                                    <div class="text-2xl font-bold text-blue-600">{{ $totalSubjects }}</div>
                                    <div class="text-sm text-gray-600">Mata Pelajaran</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-green-600">{{ $averageGrade }}</div>
                                    <div class="text-sm text-gray-600">Rata-rata</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-purple-600">{{ $highestGrade }}</div>
                                    <div class="text-sm text-gray-600">Tertinggi</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-orange-600">{{ $lowestGrade }}</div>
                                    <div class="text-sm text-gray-600">Terendah</div>
                                </div>
                            </div>
                        </div>

                        <!-- Grades by Subject -->
                        <div class="space-y-6">
                            @foreach ($grades as $subjectName => $assessmentTypes)
                                <div class="border rounded-lg overflow-hidden">
                                    <div class="bg-gray-50 px-6 py-4 border-b">
                                        <div class="flex justify-between items-center">
                                            <h4 class="text-lg font-semibold text-gray-900">{{ $subjectName }}</h4>
                                            <div class="text-right">
                                                <div class="text-lg font-bold text-blue-600">
                                                    {{ $subjectAverages[$subjectName] ?? 0 }}
                                                </div>
                                                <div class="text-sm text-gray-500">Rata-rata</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-6">
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                            @foreach ($assessmentTypes as $assessmentType => $gradeList)
                                                <div class="bg-gray-50 rounded-lg p-4">
                                                    <h5 class="font-semibold text-gray-900 mb-3 capitalize">
                                                        {{ str_replace('_', ' ', $assessmentType) }}
                                                    </h5>
                                                    <div class="space-y-2">
                                                        @foreach ($gradeList as $grade)
                                                            <div
                                                                class="flex justify-between items-center p-2 bg-white rounded border">
                                                                <div class="text-sm text-gray-600">
                                                                    {{ $grade->created_at->format('d M Y') }}
                                                                </div>
                                                                <div
                                                                    class="text-lg font-bold {{ $grade->grade >= 75 ? 'text-green-600' : ($grade->grade >= 60 ? 'text-yellow-600' : 'text-red-600') }}">
                                                                    {{ $grade->grade }}
                                                                </div>
                                                            </div>
                                                            @if ($grade->description)
                                                                <div class="text-xs text-gray-500 mt-1 pl-2">
                                                                    {{ $grade->description }}
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Grade Distribution Chart -->
                        <div class="mt-8 bg-white border rounded-lg p-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Distribusi Nilai</h4>
                            <div class="grid grid-cols-4 gap-4">
                                @php
                                    $allGrades = $grades->flatten();
                                    $excellent = $allGrades->where('grade', '>=', 85)->count();
                                    $good = $allGrades->whereBetween('grade', [75, 84])->count();
                                    $fair = $allGrades->whereBetween('grade', [60, 74])->count();
                                    $poor = $allGrades->where('grade', '<', 60)->count();
                                    $total = $allGrades->count();
                                @endphp

                                <div class="text-center p-4 bg-green-50 rounded-lg">
                                    <div class="text-2xl font-bold text-green-600">{{ $excellent }}</div>
                                    <div class="text-sm text-gray-600">Sangat Baik</div>
                                    <div class="text-xs text-gray-500">(85-100)</div>
                                    @if ($total > 0)
                                        <div class="text-xs text-gray-500">{{ round(($excellent / $total) * 100, 1) }}%
                                        </div>
                                    @endif
                                </div>

                                <div class="text-center p-4 bg-blue-50 rounded-lg">
                                    <div class="text-2xl font-bold text-blue-600">{{ $good }}</div>
                                    <div class="text-sm text-gray-600">Baik</div>
                                    <div class="text-xs text-gray-500">(75-84)</div>
                                    @if ($total > 0)
                                        <div class="text-xs text-gray-500">{{ round(($good / $total) * 100, 1) }}%
                                        </div>
                                    @endif
                                </div>

                                <div class="text-center p-4 bg-yellow-50 rounded-lg">
                                    <div class="text-2xl font-bold text-yellow-600">{{ $fair }}</div>
                                    <div class="text-sm text-gray-600">Cukup</div>
                                    <div class="text-xs text-gray-500">(60-74)</div>
                                    @if ($total > 0)
                                        <div class="text-xs text-gray-500">{{ round(($fair / $total) * 100, 1) }}%
                                        </div>
                                    @endif
                                </div>

                                <div class="text-center p-4 bg-red-50 rounded-lg">
                                    <div class="text-2xl font-bold text-red-600">{{ $poor }}</div>
                                    <div class="text-sm text-gray-600">Kurang</div>
                                    <div class="text-xs text-gray-500">(<60)< /div>
                                            @if ($total > 0)
                                                <div class="text-xs text-gray-500">
                                                    {{ round(($poor / $total) * 100, 1) }}%</div>
                                            @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Print/Export Options -->
                            <div class="mt-6 bg-gray-50 rounded-lg p-4">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h5 class="font-semibold text-gray-900">Rapor Digital</h5>
                                        <p class="text-sm text-gray-600">Unduh atau cetak rapor untuk semester
                                            {{ $currentSemester }}</p>
                                    </div>
                                    <div class="space-x-2">
                                        <button onclick="window.print()"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-colors">
                                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                                                </path>
                                            </svg>
                                            Cetak
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-12">
                                <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                </svg>
                                <h3 class="mt-4 text-lg font-medium text-gray-900">Belum Ada Nilai</h3>
                                <p class="mt-2 text-sm text-gray-500">
                                    Nilai untuk semester {{ $currentSemester }} belum tersedia.<br>
                                    Silakan hubungi guru mata pelajaran untuk informasi lebih lanjut.
                                </p>
                            </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Print Styles -->
    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            body {
                font-size: 12pt;
            }

            .print-header {
                text-align: center;
                margin-bottom: 20px;
                border-bottom: 2px solid #000;
                padding-bottom: 10px;
            }
        }
    </style>
</x-student-layout>
