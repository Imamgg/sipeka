<div
    class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
    <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div
                    class="w-10 h-10 bg-gradient-to-r from-emerald-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg">
                    <x-icons.calendar class="h-5 w-5 text-white" />
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Jadwal Mendatang</h3>
                    <p class="text-sm text-gray-500">Lihat jadwal hari ini & besok</p>
                </div>
            </div>
            <a href="{{ route('admin.schedules.index') }}"
                class="inline-flex items-center text-sm text-emerald-600 hover:text-emerald-700 font-medium transition-colors group">
                Lihat Semua
                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>
    <div class="p-6 space-y-5">
        <!-- Today Header -->
        <div class="flex items-center">
            <div class="h-px flex-1 bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
            <span class="px-4 text-sm font-semibold text-gray-600 bg-gray-100 rounded-full border border-gray-200">
                Hari ini
                ({{ $daysTranslation[Carbon\Carbon::now()->format('l')] ?? Carbon\Carbon::now()->format('l') }})
            </span>
            <div class="h-px flex-1 bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
        </div>
        @forelse($todaySchedules as $index => $schedule)
            @php
                $colors = [
                    [
                        'bg' => 'blue',
                        'border' => 'blue-200',
                        'icon' => 'blue-100',
                        'text' => 'blue-600',
                        'badge' => 'blue-50',
                        'badgeText' => 'blue-700',
                    ],
                    [
                        'bg' => 'indigo',
                        'border' => 'indigo-200',
                        'icon' => 'indigo-100',
                        'text' => 'indigo-600',
                        'badge' => 'indigo-50',
                        'badgeText' => 'indigo-700',
                    ],
                    [
                        'bg' => 'emerald',
                        'border' => 'emerald-200',
                        'icon' => 'emerald-100',
                        'text' => 'emerald-600',
                        'badge' => 'emerald-50',
                        'badgeText' => 'emerald-700',
                    ],
                    [
                        'bg' => 'purple',
                        'border' => 'purple-200',
                        'icon' => 'purple-100',
                        'text' => 'purple-600',
                        'badge' => 'purple-50',
                        'badgeText' => 'purple-700',
                    ],
                    [
                        'bg' => 'rose',
                        'border' => 'rose-200',
                        'icon' => 'rose-100',
                        'text' => 'rose-600',
                        'badge' => 'rose-50',
                        'badgeText' => 'rose-700',
                    ],
                    [
                        'bg' => 'amber',
                        'border' => 'amber-200',
                        'icon' => 'amber-100',
                        'text' => 'amber-600',
                        'badge' => 'amber-50',
                        'badgeText' => 'amber-700',
                    ],
                ];
                $colorScheme = $colors[$index % count($colors)];
            @endphp
            <div
                class="group relative bg-gradient-to-r from-{{ $colorScheme['bg'] }}-50 to-white rounded-xl border border-{{ $colorScheme['border'] }} hover:shadow-md transition-all duration-200 hover:scale-[1.02]">
                <div
                    class="absolute top-0 left-0 w-1 h-full bg-gradient-to-b from-{{ $colorScheme['bg'] }}-400 to-{{ $colorScheme['bg'] }}-600 rounded-l-xl">
                </div>
                <div class="p-4 pl-6">
                    <div class="flex justify-between items-start">
                        <div class="flex items-center space-x-3">
                            <div
                                class="flex-shrink-0 h-11 w-11 rounded-xl bg-{{ $colorScheme['icon'] }} flex items-center justify-center border border-{{ $colorScheme['border'] }} group-hover:scale-110 transition-transform">
                                <x-icons.book class="h-5 w-5 text-{{ $colorScheme['text'] }}" />
                            </div>
                            <div>
                                <h4
                                    class="text-sm font-semibold text-gray-900 group-hover:text-{{ $colorScheme['text'] }} transition-colors">
                                    {{ $schedule->subject->subject_name }}
                                </h4>
                                <div class="mt-1 flex flex-col">
                                    <p class="text-xs text-gray-500">{{ $schedule->classes->class_name }}</p>
                                    <p class="text-xs text-gray-500">{{ $schedule->teacher->user->name }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col items-end space-y-1">
                            <span
                                class="text-xs font-bold px-3 py-1.5 rounded-full bg-{{ $colorScheme['badge'] }} text-{{ $colorScheme['badgeText'] }} border border-{{ $colorScheme['border'] }}">
                                {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} -
                                {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-6">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <p class="text-gray-500 text-sm font-medium">Tidak ada jadwal untuk hari ini</p>
                <p class="text-gray-400 text-xs mt-1">Nikmati hari yang santai!</p>
            </div>
        @endforelse

        <!-- Tomorrow Header -->
        <div class="flex items-center pt-2">
            <div class="h-px flex-1 bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
            <span class="px-4 text-sm font-semibold text-gray-600 bg-gray-100 rounded-full border border-gray-200">
                Besok
                ({{ $daysTranslation[Carbon\Carbon::tomorrow()->format('l')] ?? Carbon\Carbon::tomorrow()->format('l') }})
            </span>
            <div class="h-px flex-1 bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
        </div>
        @forelse($tomorrowSchedules as $index => $schedule)
            @php
                $colors = [
                    [
                        'bg' => 'amber',
                        'border' => 'amber-200',
                        'icon' => 'amber-100',
                        'text' => 'amber-600',
                        'badge' => 'amber-50',
                        'badgeText' => 'amber-700',
                    ],
                    [
                        'bg' => 'emerald',
                        'border' => 'emerald-200',
                        'icon' => 'emerald-100',
                        'text' => 'emerald-600',
                        'badge' => 'emerald-50',
                        'badgeText' => 'emerald-700',
                    ],
                    [
                        'bg' => 'rose',
                        'border' => 'rose-200',
                        'icon' => 'rose-100',
                        'text' => 'rose-600',
                        'badge' => 'rose-50',
                        'badgeText' => 'rose-700',
                    ],
                    [
                        'bg' => 'blue',
                        'border' => 'blue-200',
                        'icon' => 'blue-100',
                        'text' => 'blue-600',
                        'badge' => 'blue-50',
                        'badgeText' => 'blue-700',
                    ],
                    [
                        'bg' => 'purple',
                        'border' => 'purple-200',
                        'icon' => 'purple-100',
                        'text' => 'purple-600',
                        'badge' => 'purple-50',
                        'badgeText' => 'purple-700',
                    ],
                    [
                        'bg' => 'indigo',
                        'border' => 'indigo-200',
                        'icon' => 'indigo-100',
                        'text' => 'indigo-600',
                        'badge' => 'indigo-50',
                        'badgeText' => 'indigo-700',
                    ],
                ];
                $colorScheme = $colors[$index % count($colors)];
            @endphp
            <div
                class="group relative bg-gradient-to-r from-{{ $colorScheme['bg'] }}-50 to-white rounded-xl border border-{{ $colorScheme['border'] }} hover:shadow-md transition-all duration-200 hover:scale-[1.02]">
                <div
                    class="absolute top-0 left-0 w-1 h-full bg-gradient-to-b from-{{ $colorScheme['bg'] }}-400 to-{{ $colorScheme['bg'] }}-600 rounded-l-xl">
                </div>
                <div class="p-4 pl-6">
                    <div class="flex justify-between items-start">
                        <div class="flex items-center space-x-3">
                            <div
                                class="flex-shrink-0 h-11 w-11 rounded-xl bg-{{ $colorScheme['icon'] }} flex items-center justify-center border border-{{ $colorScheme['border'] }} group-hover:scale-110 transition-transform">
                                <x-icons.book class="h-5 w-5 text-{{ $colorScheme['text'] }}" />
                            </div>
                            <div>
                                <h4
                                    class="text-sm font-semibold text-gray-900 group-hover:text-{{ $colorScheme['text'] }} transition-colors">
                                    {{ $schedule->subject->subject_name }}
                                </h4>
                                <div class="mt-1 flex flex-col">
                                    <p class="text-xs text-gray-500">{{ $schedule->classes->class_name }}</p>
                                    <p class="text-xs text-gray-500">{{ $schedule->teacher->user->name }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col items-end space-y-1">
                            <span
                                class="text-xs font-bold px-3 py-1.5 rounded-full bg-{{ $colorScheme['badge'] }} text-{{ $colorScheme['badgeText'] }} border border-{{ $colorScheme['border'] }}">
                                {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} -
                                {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-6">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <p class="text-gray-500 text-sm font-medium">Tidak ada jadwal untuk besok</p>
                <p class="text-gray-400 text-xs mt-1">Persiapkan rencana yang menarik!</p>
            </div>
        @endforelse
    </div>
</div>
