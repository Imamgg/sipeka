<x-teacher-layout>
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex-1">
                    <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                        <svg class="w-8 h-8 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Detail Siswa
                    </h1>
                    <p class="text-gray-600 mt-2">{{ $student->user->name }} -
                        {{ $student->classes ? $student->classes->name : 'Tidak ada kelas' }}</p>
                </div>
                <div class="mt-4 sm:mt-0">
                    <a href="{{ route('teacher.students.index') }}"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Siswa
                    </a>
                </div>
            </div> <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Student Information -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-blue-600 px-6 py-4">
                        <h2 class="text-lg font-semibold text-white flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Informasi Siswa
                        </h2>
                    </div>
                    <div class="p-6">
                        <!-- Student Profile -->
                        <div class="text-center mb-6">
                            <div
                                class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $student->user->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $student->nisn }}</p>
                        </div>

                        <div class="border-t border-gray-200 pt-6">
                            <div class="space-y-4">
                                <div class="flex items-center justify-between py-3 px-4 bg-gray-50 rounded-lg">
                                    <span class="text-sm font-medium text-gray-500">Kelas:</span> <span
                                        class="inline-flex px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                        {{ $student->classes ? $student->classes->name : 'Tidak ada kelas' }}
                                    </span>
                                </div>
                                <div class="flex items-center justify-between py-3 px-4 bg-gray-50 rounded-lg">
                                    <span class="text-sm font-medium text-gray-500">Email:</span>
                                    <span class="text-sm text-gray-900">{{ $student->user->email }}</span>
                                </div>
                                @if ($student->place_of_birth)
                                    <div class="flex items-center justify-between py-3 px-4 bg-gray-50 rounded-lg">
                                        <span class="text-sm font-medium text-gray-500">Tempat Lahir:</span>
                                        <span class="text-sm text-gray-900">{{ $student->place_of_birth }}</span>
                                    </div>
                                @endif
                                @if ($student->date_of_birth)
                                    <div class="flex items-center justify-between py-3 px-4 bg-gray-50 rounded-lg">
                                        <span class="text-sm font-medium text-gray-500">Tanggal Lahir:</span>
                                        <span
                                            class="text-sm text-gray-900">{{ $student->date_of_birth->format('d M Y') }}</span>
                                    </div>
                                @endif
                                @if ($student->gender)
                                    <div class="flex items-center justify-between py-3 px-4 bg-gray-50 rounded-lg">
                                        <span class="text-sm font-medium text-gray-500">Jenis Kelamin:</span>
                                        <span class="text-sm text-gray-900">{{ $student->gender == 'M' ? 'Laki-laki' : 'Perempuan' }}</span>
                                    </div>
                                @endif
                                @if ($student->phone_number)
                                    <div class="flex items-center justify-between py-3 px-4 bg-gray-50 rounded-lg">
                                        <span class="text-sm font-medium text-gray-500">Telepon:</span>
                                        <span class="text-sm text-gray-900">{{ $student->phone_number }}</span>
                                    </div>
                                @endif
                                @if ($student->address)
                                    <div class="flex flex-col py-3 px-4 bg-gray-50 rounded-lg">
                                        <span class="text-sm font-medium text-gray-500 mb-2">Alamat:</span>
                                        <span class="text-sm text-gray-900">{{ $student->address }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div> <!-- Recent Grades -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-emerald-600 px-6 py-4">
                        <h2 class="text-lg font-semibold text-white flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Nilai Terbaru
                        </h2>
                    </div>
                    <div class="p-6">
                        @if ($student->grades->count() > 0)
                            <div class="space-y-4">
                                @foreach ($student->grades->take(10) as $grade)
                                    <div
                                        class="bg-gray-50 rounded-lg p-4 border-l-4 border-emerald-400 hover:bg-gray-100 transition-colors duration-200">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <h4 class="font-semibold text-gray-900 mb-1">
                                                    {{ $grade->subject->name }}</h4>
                                                <p class="text-sm text-gray-600 mb-1">{{ ucfirst($grade->grade_type) }}
                                                </p>
                                                @if ($grade->description)
                                                    <p class="text-xs text-gray-500">{{ $grade->description }}</p>
                                                @endif
                                            </div>
                                            <div class="text-right ml-4">
                                                @php
                                                    $scoreClass =
                                                        $grade->score >= 80
                                                            ? 'bg-green-100 text-green-800'
                                                            : ($grade->score >= 70
                                                                ? 'bg-yellow-100 text-yellow-800'
                                                                : 'bg-red-100 text-red-800');
                                                @endphp
                                                <span
                                                    class="inline-flex px-2 py-1 text-xs font-medium rounded-full {{ $scoreClass }}">
                                                    {{ $grade->score }}
                                                </span>
                                                <div class="text-xs text-gray-500 mt-1">{{ $grade->date }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            @if ($student->grades->count() > 10)
                                <div class="text-center mt-6 pt-4 border-t border-gray-200">
                                    <a href="{{ route('teacher.grades.index', ['student_id' => $student->id]) }}"
                                        class="inline-flex items-center px-4 py-2 border border-emerald-300 text-sm font-medium rounded-md text-emerald-700 bg-emerald-50 hover:bg-emerald-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors duration-200">
                                        Lihat Semua Nilai
                                    </a>
                                </div>
                            @endif
                        @else
                            <div class="text-center py-12">
                                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada nilai yang tercatat</h3>
                                <p class="text-gray-500">Nilai akan muncul di sini setelah ditambahkan.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div> <!-- Recent Attendance -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-8">
                <div class="bg-indigo-600 px-6 py-4">
                    <h2 class="text-lg font-semibold text-white flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Kehadiran Terbaru
                    </h2>
                </div>
                <div class="p-6">
                    @if ($student->presences->count() > 0)
                        <div class="space-y-4">
                            @foreach ($student->presences as $presence)
                                <div
                                    class="bg-gray-50 rounded-lg p-4 border-l-4 border-indigo-400 hover:bg-gray-100 transition-colors duration-200">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <div class="font-semibold text-gray-900 mb-1">
                                                {{ $presence->date->format('d M Y') }}</div>
                                            @if ($presence->subject)
                                                <p class="text-sm text-gray-600">{{ $presence->subject->name }}</p>
                                            @endif
                                        </div>
                                        <div class="text-right ml-4">
                                            @php
                                                $statusColors = [
                                                    'present' => 'bg-green-100 text-green-800',
                                                    'late' => 'bg-yellow-100 text-yellow-800',
                                                    'absent' => 'bg-red-100 text-red-800',
                                                    'sick' => 'bg-blue-100 text-blue-800',
                                                    'permit' => 'bg-gray-100 text-gray-800',
                                                ];
                                            @endphp
                                            <span
                                                class="inline-flex px-2 py-1 text-xs font-medium rounded-full {{ $statusColors[$presence->status] ?? 'bg-gray-100 text-gray-800' }}">
                                                {{ ucfirst($presence->status) }}
                                            </span>
                                        </div>
                                    </div>
                                    @if ($presence->notes)
                                        <p class="text-xs text-gray-500 mt-2">{{ $presence->notes }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <div class="text-center mt-6 pt-4 border-t border-gray-200">
                            <a href="{{ route('teacher.attendance.index', ['student_id' => $student->id]) }}"
                                class="inline-flex items-center px-4 py-2 border border-indigo-300 text-sm font-medium rounded-md text-indigo-700 bg-indigo-50 hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                Lihat Semua Kehadiran
                            </a>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada catatan kehadiran</h3>
                            <p class="text-gray-500">Catatan kehadiran akan muncul di sini setelah dicatat.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-teacher-layout>
