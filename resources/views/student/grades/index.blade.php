<x-student-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-purple-50 to-pink-50">
        <!-- Hero Header Section -->
        <div
            class="relative overflow-hidden bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-800 shadow-xl rounded-2xl mx-6 mt-6 mb-8">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="absolute top-0 right-0 -mt-4 -mr-10 w-80 h-80 bg-white opacity-5 rounded-full"></div>
            <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-80 h-80 bg-white opacity-5 rounded-full"></div>
            <div class="relative px-8 py-10">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="flex items-center space-x-3 mb-4">
                            <div
                                class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div>
                                <div
                                    class="inline-flex items-center px-3 py-1 rounded-full bg-white bg-opacity-20 text-white text-sm font-medium">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                    Prestasi Akademik
                                </div>
                            </div>
                        </div>
                        <h1 class="text-4xl font-bold text-white mb-3">
                            Nilai & <span class="text-yellow-300">Rapor Siswa</span>
                        </h1>
                        <p class="text-purple-100 text-lg">Pantau perkembangan akademik dan prestasi belajar Anda secara
                            real-time</p>
                    </div>
                    <div class="hidden lg:block ml-8">
                        <div
                            class="w-32 h-32 bg-white bg-opacity-10 rounded-full flex items-center justify-center backdrop-blur-sm border border-white border-opacity-20">
                            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 pb-8">
            <!-- Enhanced Student Profile Card -->
            <div class="mb-8">
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
                    <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-purple-50 to-pink-50">
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Profil Siswa</h3>
                                <p class="text-sm text-gray-500">Informasi identitas dan kelas</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center space-x-6">
                            <div
                                class="w-20 h-20 bg-gradient-to-br from-purple-100 to-pink-100 rounded-full flex items-center justify-center">
                                <span class="text-2xl font-bold text-purple-700">
                                    {{ strtoupper(substr($student->user->name ?? 'N', 0, 2)) }}
                                </span>
                            </div>
                            <div class="flex-1">
                                <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $student->user->name }}</h2>
                                <div class="flex flex-wrap gap-3">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V4a2 2 0 118 0v2m-4 0a2 2 0 104 0m-4 0a2 2 0 014 0z" />
                                        </svg>
                                        NIS: {{ $student->nis }}
                                    </span>
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        Kelas: {{ $student->classes->class_name ?? 'Belum ditetapkan' }}
                                    </span>
                                    @if ($averageGrade)
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $averageGrade >= 80 ? 'bg-green-100 text-green-800' : ($averageGrade >= 70 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                                            </svg>
                                            Rata-rata: {{ number_format($averageGrade, 1) }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="text-right">
                                <a href="{{ route('student.dashboard') }}"
                                    class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-200 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-all duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                    </svg>
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap gap-4 text-sm text-gray-600 mt-1">
                <span><strong>NIS:</strong> {{ $student->nis }}</span>
                <span><strong>Kelas:</strong>
                    {{ $student->classes->class_name ?? 'Belum ditetapkan' }}</span>
            </div>
        </div>
    </div>
    </div>
    </div>

    <!-- Semester Selector -->
    <div class="mb-8">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Pilih Semester</h3>
            <div class="flex space-x-4">
                <a href="{{ route('student.grades.index', ['semester' => 'Ganjil']) }}"
                    class="px-6 py-3 rounded-xl font-medium transition-all duration-200 {{ $currentSemester == 'Ganjil' ? 'bg-gradient-to-r from-purple-500 to-pink-600 text-white shadow-lg' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Semester Ganjil
                </a>
                <a href="{{ route('student.grades.index', ['semester' => 'Genap']) }}"
                    class="px-6 py-3 rounded-xl font-medium transition-all duration-200 {{ $currentSemester == 'Genap' ? 'bg-gradient-to-r from-purple-500 to-pink-600 text-white shadow-lg' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Semester Genap
                </a>
            </div>
        </div>
    </div>

    @if ($grades->count() > 0)
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            @php
                $totalSubjects = count($subjectAverages);
                $averageGrade = $totalSubjects > 0 ? round(array_sum($subjectAverages) / $totalSubjects, 2) : 0;
                $highestGrade = $totalSubjects > 0 ? max($subjectAverages) : 0;
                $lowestGrade = $totalSubjects > 0 ? min($subjectAverages) : 0;
            @endphp

            <!-- Total Subjects -->
            <div
                class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-200">
                <div class="flex items-center">
                    <div
                        class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-2xl font-bold text-gray-900">{{ $totalSubjects }}</p>
                        <p class="text-sm text-gray-600">Mata Pelajaran</p>
                    </div>
                </div>
            </div>

            <!-- Average Grade -->
            <div
                class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-200">
                <div class="flex items-center">
                    <div
                        class="w-12 h-12 bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-2xl font-bold text-gray-900">{{ $averageGrade }}</p>
                        <p class="text-sm text-gray-600">Rata-rata</p>
                    </div>
                </div>
            </div>

            <!-- Highest Grade -->
            <div
                class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-200">
                <div class="flex items-center">
                    <div
                        class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-2xl font-bold text-gray-900">{{ $highestGrade }}</p>
                        <p class="text-sm text-gray-600">Tertinggi</p>
                    </div>
                </div>
            </div>

            <!-- Lowest Grade -->
            <div
                class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-200">
                <div class="flex items-center">
                    <div
                        class="w-12 h-12 bg-gradient-to-r from-amber-500 to-amber-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-2xl font-bold text-gray-900">{{ $lowestGrade }}</p>
                        <p class="text-sm text-gray-600">Terendah</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grades by Subject -->
        <div class="space-y-6 mb-8">
            @foreach ($grades as $subjectName => $assessmentTypes)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <!-- Subject Header -->
                    <div class="bg-gradient-to-r from-indigo-50 to-purple-50 px-6 py-4 border-b border-gray-100">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <div
                                    class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <h4 class="text-xl font-bold text-gray-900">{{ $subjectName }}</h4>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-indigo-600">
                                    {{ $subjectAverages[$subjectName] ?? 0 }}
                                </div>
                                <div class="text-sm text-gray-600">Rata-rata</div>
                            </div>
                        </div>
                    </div>

                    <!-- Assessment Types -->
                    <div class="p-6">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                            @foreach ($assessmentTypes as $assessmentType => $gradeList)
                                <div
                                    class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-5 border border-gray-200">
                                    <div class="flex items-center mb-4">
                                        <div
                                            class="w-8 h-8 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center mr-3">
                                            @if ($assessmentType == 'tugas')
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            @elseif($assessmentType == 'ulangan')
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                </svg>
                                            @else
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            @endif
                                        </div>
                                        <h5 class="text-lg font-semibold text-gray-900 capitalize">
                                            {{ str_replace('_', ' ', $assessmentType) }}
                                        </h5>
                                    </div>
                                    <div class="space-y-3">
                                        @foreach ($gradeList as $grade)
                                            <div
                                                class="bg-white rounded-lg p-4 border border-gray-200 hover:shadow-sm transition-all duration-200">
                                                <div class="flex justify-between items-center mb-2">
                                                    <div class="text-sm text-gray-600 font-medium">
                                                        {{ $grade->created_at->format('d M Y') }}
                                                    </div>
                                                    <div class="flex items-center">
                                                        <span
                                                            class="text-2xl font-bold {{ $grade->grade >= 75 ? 'text-emerald-600' : ($grade->grade >= 60 ? 'text-amber-600' : 'text-red-600') }}">
                                                            {{ $grade->grade }}
                                                        </span>
                                                        <div class="ml-2">
                                                            @if ($grade->grade >= 75)
                                                                <div class="w-3 h-3 bg-emerald-500 rounded-full">
                                                                </div>
                                                            @elseif($grade->grade >= 60)
                                                                <div class="w-3 h-3 bg-amber-500 rounded-full">
                                                                </div>
                                                            @else
                                                                <div class="w-3 h-3 bg-red-500 rounded-full">
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                @if ($grade->description)
                                                    <div class="text-xs text-gray-500 bg-gray-50 rounded-lg p-2 mt-2">
                                                        <span class="font-medium">Catatan:</span>
                                                        {{ $grade->description }}
                                                    </div>
                                                @endif
                                            </div>
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
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
            <div class="flex items-center mb-6">
                <div
                    class="w-10 h-10 bg-gradient-to-r from-pink-500 to-rose-600 rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <h4 class="text-xl font-bold text-gray-900">Distribusi Nilai</h4>
            </div>

            @php
                $allGrades = $grades->flatten();
                $excellent = $allGrades->where('grade', '>=', 85)->count();
                $good = $allGrades->whereBetween('grade', [75, 84])->count();
                $fair = $allGrades->whereBetween('grade', [60, 74])->count();
                $poor = $allGrades->where('grade', '<', 60)->count();
                $total = $allGrades->count();
            @endphp

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Excellent -->
                <div class="bg-gradient-to-br from-emerald-50 to-green-50 rounded-xl p-6 border border-emerald-100">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-emerald-500 rounded-xl flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div class="text-3xl font-bold text-emerald-600 mb-1">{{ $excellent }}</div>
                        <div class="text-sm font-semibold text-emerald-700 mb-1">Sangat Baik</div>
                        <div class="text-xs text-emerald-600 mb-2">(85-100)</div>
                        @if ($total > 0)
                            <div class="text-xs text-emerald-500 bg-emerald-100 rounded-full px-3 py-1">
                                {{ round(($excellent / $total) * 100, 1) }}%
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Good -->
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-100">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                            </svg>
                        </div>
                        <div class="text-3xl font-bold text-blue-600 mb-1">{{ $good }}</div>
                        <div class="text-sm font-semibold text-blue-700 mb-1">Baik</div>
                        <div class="text-xs text-blue-600 mb-2">(75-84)</div>
                        @if ($total > 0)
                            <div class="text-xs text-blue-500 bg-blue-100 rounded-full px-3 py-1">
                                {{ round(($good / $total) * 100, 1) }}%
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Fair -->
                <div class="bg-gradient-to-br from-amber-50 to-yellow-50 rounded-xl p-6 border border-amber-100">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-amber-500 rounded-xl flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="text-3xl font-bold text-amber-600 mb-1">{{ $fair }}</div>
                        <div class="text-sm font-semibold text-amber-700 mb-1">Cukup</div>
                        <div class="text-xs text-amber-600 mb-2">(60-74)</div>
                        @if ($total > 0)
                            <div class="text-xs text-amber-500 bg-amber-100 rounded-full px-3 py-1">
                                {{ round(($fair / $total) * 100, 1) }}%
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Poor -->
                <div class="bg-gradient-to-br from-red-50 to-rose-50 rounded-xl p-6 border border-red-100">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-red-500 rounded-xl flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                        <div class="text-3xl font-bold text-red-600 mb-1">{{ $poor }}</div>
                        <div class="text-sm font-semibold text-red-700 mb-1">Kurang</div>
                        <div class="text-xs text-red-600 mb-2">(&lt;60)</div>
                        @if ($total > 0)
                            <div class="text-xs text-red-500 bg-red-100 rounded-full px-3 py-1">
                                {{ round(($poor / $total) * 100, 1) }}%
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Print/Export Options -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="bg-gradient-to-r from-slate-50 to-gray-50 rounded-xl p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex items-start">
                        <div
                            class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                        </div>
                        <div>
                            <h5 class="text-lg font-bold text-gray-900 mb-2">Rapor Digital</h5>
                            <p class="text-sm text-gray-600">Unduh atau cetak rapor untuk semester
                                {{ $currentSemester }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <button onclick="window.print()"
                            class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-medium rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                            Cetak Rapor
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- No Grades State -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12">
            <div class="text-center">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Belum Ada Nilai</h3>
                <p class="text-gray-600 mb-6 max-w-md mx-auto">
                    Nilai untuk semester {{ $currentSemester }} belum tersedia. Silakan hubungi guru mata
                    pelajaran untuk informasi lebih lanjut.
                </p>
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-100">
                    <div class="flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-500 mr-3" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-blue-700 font-medium">Nilai akan muncul setelah guru menginput hasil
                            penilaian</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
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
