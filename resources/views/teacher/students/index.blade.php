<x-teacher-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 p-4 md:p-6">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 border border-gray-100">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="mb-4 md:mb-0">
                        <div class="flex items-center mb-2">
                            <div
                                class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                </svg>
                            </div>
                            <h1
                                class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
                                Siswa Saya
                            </h1>
                        </div>
                        <p class="text-gray-600 text-lg">Kelola dan lihat siswa di kelas Anda</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div
                            class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-4 py-2 rounded-xl font-semibold">
                            {{ $classes->sum(fn($class) => $class->students->count()) }} Total Siswa
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Classes and Students Grid -->
        <div class="space-y-8">
            @forelse($classes as $class)
                <div
                    class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover:shadow-2xl transition-all duration-300">
                    <!-- Class Header -->
                    <div class="bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 px-6 py-6">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="flex items-center mb-4 md:mb-0">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-xl md:text-2xl font-bold text-white mb-1">{{ $class->name }}</h2>
                                    <p class="text-blue-100">Manajemen Kelas</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="bg-white/20 backdrop-blur-sm px-4 py-2 rounded-xl border border-white/30">
                                    <span class="text-white font-semibold">{{ $class->students->count() }}
                                        Siswa</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Students Grid -->
                    <div class="p-6">
                        @if ($class->students->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                                @foreach ($class->students as $student)
                                    <div
                                        class="group bg-gradient-to-br from-white to-gray-50 rounded-xl p-6 border border-gray-200 hover:border-blue-300 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                                        <!-- Student Avatar -->
                                        <div class="flex items-center mb-4">
                                            <div class="relative">
                                                <div
                                                    class="w-14 h-14 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center ring-4 ring-blue-100 group-hover:ring-blue-200 transition-all duration-300">
                                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                    </svg>
                                                </div>
                                                <div
                                                    class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 rounded-full border-2 border-white">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Student Info -->
                                        <div class="mb-4">
                                            <h3
                                                class="font-bold text-gray-800 text-lg mb-2 group-hover:text-blue-600 transition-colors duration-300">
                                                {{ $student->user->name }}
                                            </h3>
                                            <div class="space-y-2">
                                                <div class="flex items-center text-sm text-gray-600">
                                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.998 1.998 0 013 12V7a4 4 0 014-4z" />
                                                    </svg>
                                                    <span class="font-medium">NISN:</span>
                                                    <span class="ml-1">{{ $student->nisn }}</span>
                                                </div>
                                                <div class="flex items-center text-sm text-gray-600">
                                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                                    </svg>
                                                    <span class="truncate">{{ $student->user->email }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Action Button -->
                                        <div class="pt-4 border-t border-gray-100">
                                            <a href="{{ route('teacher.students.show', $student) }}"
                                                class="w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-300 transform hover:scale-105 flex items-center justify-center group-hover:shadow-md">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <!-- Empty State for Class -->
                            <div class="text-center py-12">
                                <div
                                    class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum ada siswa yang terdaftar</h3>
                                <p class="text-gray-500 max-w-md mx-auto">Kelas ini belum memiliki siswa. Siswa akan muncul di sini setelah terdaftar.</p>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <!-- Empty State for No Classes -->
                <div class="bg-white rounded-2xl shadow-xl p-12 text-center border border-gray-100">
                    <div
                        class="w-32 h-32 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-8">
                        <svg class="w-16 h-16 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Belum ada Kelas yang Ditugaskan</h2>
                    <p class="text-gray-600 text-lg max-w-2xl mx-auto mb-8">
                        Anda saat ini tidak ditugaskan untuk mengajar kelas manapun. Setelah kelas ditugaskan kepada Anda, kelas tersebut akan muncul di sini beserta semua siswa yang terdaftar.
                    </p>
                    <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl p-6 max-w-md mx-auto">
                        <p class="text-sm text-gray-600">
                            <span class="font-semibold">Butuh bantuan?</span> Hubungi administrator Anda untuk mendapatkan penugasan kelas.
                        </p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-teacher-layout>
