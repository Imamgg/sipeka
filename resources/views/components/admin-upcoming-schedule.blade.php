<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
    <div class="px-6 py-4">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-semibold text-white flex items-center">
                <x-icons.calender class="h-5 w-5 mr-2" />
                Jadwal Mendatang
            </h3>
            <div class="flex space-x-1">
                <a href="{{ route('admin.schedules.index') }}"
                    class="p-1 text-blue-200 hover:text-white hover:bg-blue-800 rounded transition-colors duration-200">
                    <x-icons.arrow-right class="h-5 w-5" />
                </a>
            </div>
        </div>
    </div>
    <div class="p-6 space-y-4">
        <!-- Today Header -->
        <div class="flex items-center">
            <div class="h-1 flex-1 bg-gray-200 dark:bg-gray-700"></div>
            <span class="px-3 text-xs font-medium text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800">Hari
                ini
                ({{ $daysTranslation[Carbon\Carbon::now()->format('l')] ?? Carbon\Carbon::now()->format('l') }})</span>
            <div class="h-1 flex-1 bg-gray-200 dark:bg-gray-700"></div>
        </div>
        @forelse($todaySchedules as $index => $schedule)
            @php
                $colors = ['blue', 'blue', 'emerald', 'indigo', 'rose', 'amber'];
                $color = $colors[$index % count($colors)];
            @endphp
            <div
                class="group relative bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-all duration-200">
                <div class="absolute top-0 left-0 w-1 h-full bg-{{ $color }}-500 rounded-l-xl"></div>
                <div class="p-4 pl-6">
                    <div class="flex justify-between items-start">
                        <div class="flex items-center">
                            <div
                                class="flex-shrink-0 h-10 w-10 rounded-full bg-{{ $color }}-100 flex items-center justify-center text-{{ $color }}-600">
                                <x-icons.books height="h-6" width="w-6" />
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $schedule->subject->subject_name }}</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    {{ $schedule->class->class_name }} - {{ $schedule->teacher->user->name }}</p>
                            </div>
                        </div>
                        <span
                            class="text-xs font-semibold px-2 py-1 rounded-full bg-{{ $color }}-50 text-{{ $color }}-700 dark:bg-{{ $color }}-900 dark:text-{{ $color }}-300">
                            {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} -
                            {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                        </span>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-3">
                <p class="text-gray-500 dark:text-gray-400 text-sm">Tidak ada jadwal untuk hari ini</p>
            </div>
        @endforelse

        <!-- Tomorrow Header -->
        <div class="flex items-center pt-2">
            <div class="h-1 flex-1 bg-gray-200 dark:bg-gray-700"></div>
            <span class="px-3 text-xs font-medium text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800">
                Besok
                ({{ $daysTranslation[Carbon\Carbon::tomorrow()->format('l')] ?? Carbon\Carbon::tomorrow()->format('l') }})
            </span>
            <div class="h-1 flex-1 bg-gray-200 dark:bg-gray-700"></div>
        </div>
        @forelse($tomorrowSchedules as $index => $schedule)
            @php
                $colors = ['amber', 'emerald', 'rose', 'blue', 'blue', 'indigo'];
                $color = $colors[$index % count($colors)];
            @endphp
            <div
                class="group relative bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-all duration-200">
                <div class="absolute top-0 left-0 w-1 h-full bg-{{ $color }}-500 rounded-l-xl"></div>
                <div class="p-4 pl-6">
                    <div class="flex justify-between items-start">
                        <div class="flex items-center">
                            <div
                                class="flex-shrink-0 h-10 w-10 rounded-full bg-{{ $color }}-100 flex items-center justify-center text-{{ $color }}-600">
                                <x-icons.books height="h-6" width="w-6" />
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $schedule->subject->subject_name }}</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    {{ $schedule->class->class_name }} - {{ $schedule->teacher->user->name }}</p>
                            </div>
                        </div>
                        <span
                            class="text-xs font-semibold px-2 py-1 rounded-full bg-{{ $color }}-50 text-{{ $color }}-700 dark:bg-{{ $color }}-900 dark:text-{{ $color }}-300">
                            {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} -
                            {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                        </span>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-3">
                <p class="text-gray-500 dark:text-gray-400 text-sm">Tidak ada jadwal untuk besok</p>
            </div>
        @endforelse
    </div>
</div>
