<aside id="sidebar"
    class="fixed top-0 left-0 z-20 flex-col flex-shrink-0 w-64 h-full pt-16 font-normal duration-300 transition-all hidden lg:flex"
    aria-label="Sidebar">
    <div
        class="relative flex-1 flex flex-col bg-gradient-to-b from-slate-50 via-white to-slate-50 border-r border-slate-200 shadow-xl pt-0">
        <div class="flex-1 flex flex-col pt-6 pb-4 overflow-y-auto">
            <div class="flex-1 px-4 space-y-1">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}"
                    class="{{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-amber-500 to-amber-600 text-white shadow-lg border-0' : 'text-slate-700 hover:bg-gradient-to-r hover:from-amber-50 hover:to-blue-50 hover:text-amber-700' }} group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 transform hover:scale-[1.02] hover:shadow-md">
                    <div
                        class="{{ request()->routeIs('dashboard') ? 'bg-white/20' : 'bg-amber-100 group-hover:bg-amber-200' }} p-2 rounded-lg mr-3 transition-colors duration-200">
                        <svg class="{{ request()->routeIs('dashboard') ? 'text-white' : 'text-amber-600 group-hover:text-amber-700' }} h-5 w-5"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6a2 2 0 01-2 2H10a2 2 0 01-2-2V5z"></path>
                        </svg>
                    </div>
                    <span class="font-medium">Dashboard</span>
                    @if (request()->routeIs('dashboard'))
                        <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                    @endif
                </a> <!-- Students -->
                <a href="/admin/students"
                    class="{{ request()->is('admin/students*') ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg border-0' : 'text-slate-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-amber-50 hover:text-blue-700' }} group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 transform hover:scale-[1.02] hover:shadow-md">
                    <div
                        class="{{ request()->is('admin/students*') ? 'bg-white/20' : 'bg-blue-100 group-hover:bg-blue-200' }} p-2 rounded-lg mr-3 transition-colors duration-200">
                        <svg class="{{ request()->is('admin/students*') ? 'text-white' : 'text-blue-600 group-hover:text-blue-700' }} h-5 w-5"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                            </path>
                        </svg>
                    </div>
                    <span class="font-medium">Siswa</span>
                    @if (request()->is('admin/students*'))
                        <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                    @endif
                </a>

                <!-- Teachers -->
                <a href="/admin/teachers"
                    class="{{ request()->is('admin/teachers*') ? 'bg-gradient-to-r from-emerald-500 to-emerald-600 text-white shadow-lg border-0' : 'text-slate-700 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-amber-50 hover:text-emerald-700' }} group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 transform hover:scale-[1.02] hover:shadow-md">
                    <div
                        class="{{ request()->is('admin/teachers*') ? 'bg-white/20' : 'bg-emerald-100 group-hover:bg-emerald-200' }} p-2 rounded-lg mr-3 transition-colors duration-200">
                        <svg class="{{ request()->is('admin/teachers*') ? 'text-white' : 'text-emerald-600 group-hover:text-emerald-700' }} h-5 w-5"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <span class="font-medium">Guru</span>
                    @if (request()->is('admin/teachers*'))
                        <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                    @endif
                </a>

                <!-- Classes -->
                <a href="/admin/classes"
                    class="{{ request()->is('admin/classes*') ? 'bg-gradient-to-r from-purple-500 to-purple-600 text-white shadow-lg border-0' : 'text-slate-700 hover:bg-gradient-to-r hover:from-purple-50 hover:to-amber-50 hover:text-purple-700' }} group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 transform hover:scale-[1.02] hover:shadow-md">
                    <div
                        class="{{ request()->is('admin/classes*') ? 'bg-white/20' : 'bg-purple-100 group-hover:bg-purple-200' }} p-2 rounded-lg mr-3 transition-colors duration-200">
                        <svg class="{{ request()->is('admin/classes*') ? 'text-white' : 'text-purple-600 group-hover:text-purple-700' }} h-5 w-5"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                    <span class="font-medium">Kelas</span>
                    @if (request()->is('admin/classes*'))
                        <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                    @endif
                </a>

                <!-- Subjects -->
                <a href="/admin/subjects"
                    class="{{ request()->is('admin/subjects*') ? 'bg-gradient-to-r from-indigo-500 to-indigo-600 text-white shadow-lg border-0' : 'text-slate-700 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-amber-50 hover:text-indigo-700' }} group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 transform hover:scale-[1.02] hover:shadow-md">
                    <div
                        class="{{ request()->is('admin/subjects*') ? 'bg-white/20' : 'bg-indigo-100 group-hover:bg-indigo-200' }} p-2 rounded-lg mr-3 transition-colors duration-200">
                        <svg class="{{ request()->is('admin/subjects*') ? 'text-white' : 'text-indigo-600 group-hover:text-indigo-700' }} h-5 w-5"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                    </div>
                    <span class="font-medium">Mata Pelajaran</span>
                    @if (request()->is('admin/subjects*'))
                        <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                    @endif
                </a> <!-- Schedules -->
                <a href="/admin/schedules"
                    class="{{ request()->is('admin/schedules*') ? 'bg-gradient-to-r from-teal-500 to-teal-600 text-white shadow-lg border-0' : 'text-slate-700 hover:bg-gradient-to-r hover:from-teal-50 hover:to-amber-50 hover:text-teal-700' }} group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 transform hover:scale-[1.02] hover:shadow-md">
                    <div
                        class="{{ request()->is('admin/schedules*') ? 'bg-white/20' : 'bg-teal-100 group-hover:bg-teal-200' }} p-2 rounded-lg mr-3 transition-colors duration-200">
                        <svg class="{{ request()->is('admin/schedules*') ? 'text-white' : 'text-teal-600 group-hover:text-teal-700' }} h-5 w-5"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <span class="font-medium">Jadwal</span>
                    @if (request()->is('admin/schedules*'))
                        <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                    @endif
                </a>

                <!-- Reports -->
                <a href="#"
                    class="{{ request()->is('admin/reports*') ? 'bg-gradient-to-r from-orange-500 to-orange-600 text-white shadow-lg border-0' : 'text-slate-700 hover:bg-gradient-to-r hover:from-orange-50 hover:to-amber-50 hover:text-orange-700' }} group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 transform hover:scale-[1.02] hover:shadow-md">
                    <div
                        class="{{ request()->is('admin/reports*') ? 'bg-white/20' : 'bg-orange-100 group-hover:bg-orange-200' }} p-2 rounded-lg mr-3 transition-colors duration-200">
                        <svg class="{{ request()->is('admin/reports*') ? 'text-white' : 'text-orange-600 group-hover:text-orange-700' }} h-5 w-5"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <span class="font-medium">Laporan</span>
                    @if (request()->is('admin/reports*'))
                        <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                    @endif
                </a>

                <!-- Verification Menu -->
                <div x-data="{ open: false }" class="relative">
                    <!-- Dropdown Toggle Button -->
                    <button @click="open = !open" type="button"
                        class="{{ request()->is('admin/grades*') || request()->is('admin/attendances*') ? 'bg-gradient-to-r from-violet-500 to-violet-600 text-white shadow-lg border-0' : 'text-slate-700 hover:bg-gradient-to-r hover:from-violet-50 hover:to-amber-50 hover:text-violet-700' }} w-full group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 transform hover:scale-[1.02] hover:shadow-md">
                        <div
                            class="{{ request()->is('admin/grades*') || request()->is('admin/attendances*') ? 'bg-white/20' : 'bg-violet-100 group-hover:bg-violet-200' }} p-2 rounded-lg mr-3 transition-colors duration-200">
                            <svg class="{{ request()->is('admin/grades*') || request()->is('admin/attendances*') ? 'text-white' : 'text-violet-600 group-hover:text-violet-700' }} h-5 w-5"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="font-medium">Verifikasi</span>
                        <svg class="ml-auto h-5 w-5 transition-transform duration-200"
                            :class="{ 'rotate-180': open, 'rotate-0': !open }" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open" @click.away="open = false"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95"
                        class="absolute left-5 right-5 mt-2 bg-white rounded-xl shadow-lg z-20 border border-gray-100 overflow-hidden">
                        <!-- Grade Verification -->
                        <a href="{{ route('admin.grades.index') }}"
                            class="block px-4 py-3 text-sm font-medium text-gray-700 hover:bg-violet-50 hover:text-violet-700 border-b border-gray-100 {{ request()->is('admin/grades*') ? 'bg-violet-50 text-violet-700' : '' }}">
                            <div class="flex items-center">
                                <svg class="h-5 w-5 mr-3 {{ request()->is('admin/grades*') ? 'text-violet-600' : 'text-gray-400' }}"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                                Verifikasi Nilai
                            </div>
                        </a>
                        <!-- Attendance Verification -->
                        <a href="{{ route('admin.attendances.index') }}"
                            class="block px-4 py-3 text-sm font-medium text-gray-700 hover:bg-violet-50 hover:text-violet-700 {{ request()->is('admin/attendances*') ? 'bg-violet-50 text-violet-700' : '' }}">
                            <div class="flex items-center">
                                <svg class="h-5 w-5 mr-3 {{ request()->is('admin/attendances*') ? 'text-violet-600' : 'text-gray-400' }}"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                    </path>
                                </svg>
                                Verifikasi Kehadiran
                            </div>
                        </a>
                    </div>
                </div>
                <span class="mx-4 my-4 border-t border-slate-200"></span>
            </div>
        </div>

        <!-- Footer -->
        <div class="px-4 py-4 bg-gradient-to-r from-slate-100 to-slate-50 border-t border-slate-200">
            <div class="text-center">
                <p class="text-xs text-slate-500 font-medium">© {{ date('Y') }} SIPEKA</p>
                <p class="text-xs text-slate-400">School Management System</p>
            </div>
        </div>
    </div>
</aside>
