<x-student-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Jadwal Pelajaran - {{ $student->class->name ?? 'Kelas tidak ditemukan' }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Jadwal Pelajaran Mingguan</h3>
                                <p class="text-sm text-gray-600 mt-1">
                                    Kelas: {{ $student->class->name ?? 'Belum ditetapkan' }} |
                                    NIS: {{ $student->nis }}
                                </p>
                            </div>
                            <a href="{{ route('student.dashboard') }}"
                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition-colors">
                                Kembali
                            </a>
                        </div>
                    </div>

                    @if ($schedules->count() > 0)
                        <div class="grid grid-cols-1 gap-6">
                            @php
                                $days = [
                                    'Monday' => 'Senin',
                                    'Tuesday' => 'Selasa',
                                    'Wednesday' => 'Rabu',
                                    'Thursday' => 'Kamis',
                                    'Friday' => 'Jumat',
                                    'Saturday' => 'Sabtu',
                                    'Sunday' => 'Minggu',
                                ];
                                $currentDay = Carbon\Carbon::now()->format('l');
                            @endphp

                            @foreach ($days as $englishDay => $indonesianDay)
                                @if (isset($schedules[$englishDay]))
                                    <div
                                        class="border rounded-lg overflow-hidden {{ $englishDay === $currentDay ? 'border-blue-500 bg-blue-50' : 'border-gray-200' }}">
                                        <div
                                            class="bg-gray-50 px-6 py-3 border-b {{ $englishDay === $currentDay ? 'bg-blue-100' : '' }}">
                                            <h4 class="text-lg font-semibold text-gray-900 flex items-center">
                                                {{ $indonesianDay }}
                                                @if ($englishDay === $currentDay)
                                                    <span
                                                        class="ml-2 px-2 py-1 bg-blue-500 text-white text-xs rounded-full">Hari
                                                        Ini</span>
                                                @endif
                                            </h4>
                                        </div>
                                        <div class="p-6">
                                            <div class="space-y-4">
                                                @foreach ($schedules[$englishDay] as $schedule)
                                                    @php
                                                        $startTime = Carbon\Carbon::parse($schedule->start_time);
                                                        $endTime = Carbon\Carbon::parse($schedule->end_time);
                                                        $now = Carbon\Carbon::now();
                                                        $isCurrentClass = false;

                                                        if ($englishDay === $currentDay) {
                                                            $todayStart = Carbon\Carbon::today()->setTimeFrom(
                                                                $startTime,
                                                            );
                                                            $todayEnd = Carbon\Carbon::today()->setTimeFrom($endTime);
                                                            $isCurrentClass = $now->between($todayStart, $todayEnd);
                                                        }
                                                    @endphp

                                                    <div
                                                        class="flex items-center p-4 rounded-lg border {{ $isCurrentClass ? 'border-green-500 bg-green-50' : 'border-gray-200 bg-gray-50' }}">
                                                        <div class="flex-shrink-0 mr-4">
                                                            <div
                                                                class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                                                <svg class="w-6 h-6 text-blue-600" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                                                    </path>
                                                                </svg>
                                                            </div>
                                                        </div>

                                                        <div class="flex-1">
                                                            <div class="flex items-center justify-between">
                                                                <div>
                                                                    <h5 class="text-lg font-semibold text-gray-900">
                                                                        {{ $schedule->subject->name }}
                                                                        @if ($isCurrentClass)
                                                                            <span
                                                                                class="ml-2 px-2 py-1 bg-green-500 text-white text-xs rounded-full">Sedang
                                                                                Berlangsung</span>
                                                                        @endif
                                                                    </h5>
                                                                    <p class="text-sm text-gray-600">
                                                                        Guru:
                                                                        {{ $schedule->teacher->user->name ?? 'Guru tidak ditemukan' }}
                                                                    </p>
                                                                </div>
                                                                <div class="text-right">
                                                                    <div class="text-lg font-semibold text-gray-900">
                                                                        {{ $startTime->format('H:i') }} -
                                                                        {{ $endTime->format('H:i') }}
                                                                    </div>
                                                                    <div class="text-sm text-gray-500">
                                                                        {{ $startTime->diffInMinutes($endTime) }} menit
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="border rounded-lg overflow-hidden border-gray-200">
                                        <div class="bg-gray-50 px-6 py-3 border-b">
                                            <h4 class="text-lg font-semibold text-gray-900">{{ $indonesianDay }}</h4>
                                        </div>
                                        <div class="p-6">
                                            <div class="text-center py-8 text-gray-500">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                                </svg>
                                                <p class="mt-2">Tidak ada jadwal untuk hari {{ $indonesianDay }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <!-- Weekly Summary -->
                        <div class="mt-8 bg-gray-50 rounded-lg p-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Mingguan</h4>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @php
                                    $totalSchedules = $schedules->flatten()->count();
                                    $totalDays = $schedules->count();
                                    $subjects = $schedules->flatten()->pluck('subject.name')->unique();
                                    $teachers = $schedules->flatten()->pluck('teacher.user.name')->unique();
                                @endphp

                                <div class="text-center">
                                    <div class="text-2xl font-bold text-blue-600">{{ $totalSchedules }}</div>
                                    <div class="text-sm text-gray-600">Total Jadwal</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-green-600">{{ $totalDays }}</div>
                                    <div class="text-sm text-gray-600">Hari Aktif</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-purple-600">{{ $subjects->count() }}</div>
                                    <div class="text-sm text-gray-600">Mata Pelajaran</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-orange-600">{{ $teachers->count() }}</div>
                                    <div class="text-sm text-gray-600">Guru</div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-4 8V9a1 1 0 011-1h2a1 1 0 011 1v6m-4 0a1 1 0 01-1-1V9a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1m-4 0h8" />
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">Belum Ada Jadwal</h3>
                            <p class="mt-2 text-sm text-gray-500">
                                Jadwal pelajaran untuk kelas Anda belum tersedia.<br>
                                Silakan hubungi admin atau wali kelas untuk informasi lebih lanjut.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-student-layout>
