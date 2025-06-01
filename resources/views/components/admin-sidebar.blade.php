<aside id="sidebar"
    class="fixed top-0 left-0 z-20 flex-col flex-shrink-0 w-64 h-full pt-16 font-normal duration-300 transition-all hidden lg:flex"
    aria-label="Sidebar">
    <div
        class="relative flex-1 flex flex-col bg-gradient-to-b from-slate-50 via-white to-slate-50 border-r border-slate-200 shadow-xl pt-0">
        <div class="flex-1 flex flex-col pt-6 pb-4 overflow-y-auto">
            <div class="flex-1 px-4 space-x-2">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}"
                    class="{{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-amber-500 to-amber-600 text-white shadow-lg border-0' : 'text-slate-700 hover:bg-gradient-to-r hover:from-amber-50 hover:to-blue-50 hover:text-amber-700' }} group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 transform hover:scale-[1.02] hover:shadow-md">
                    <div
                        class="{{ request()->routeIs('dashboard') ? 'bg-white/20' : 'bg-amber-100 group-hover:bg-amber-200' }} p-2 rounded-lg mr-3 transition-colors duration-200">
                        <x-icons.dashboard
                            class="{{ request()->routeIs('dashboard') ? 'text-white' : 'text-amber-600 group-hover:text-amber-700' }} h-5 w-5" />
                    </div>
                    <span class="font-medium">Dashboard</span>
                    @if (request()->routeIs('dashboard'))
                        <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                    @endif
                </a>

                <!-- Students -->
                <a href="/admin/students"
                    class="{{ request()->is('admin/students*') ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg border-0' : 'text-slate-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-amber-50 hover:text-blue-700' }} group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 transform hover:scale-[1.02] hover:shadow-md">
                    <div
                        class="{{ request()->is('admin/students*') ? 'bg-white/20' : 'bg-blue-100 group-hover:bg-blue-200' }} p-2 rounded-lg mr-3 transition-colors duration-200">
                        <x-icons.user
                            class="{{ request()->is('admin/students*') ? 'text-white' : 'text-blue-600 group-hover:text-blue-700' }} h-5 w-5" />
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
                        <x-icons.users
                            class="{{ request()->is('admin/teachers*') ? 'text-white' : 'text-emerald-600 group-hover:text-emerald-700' }} h-5 w-5" />
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
                        <x-icons.apartment
                            class="{{ request()->is('admin/classes*') ? 'text-white' : 'text-purple-600 group-hover:text-purple-700' }} h-5 w-5" />
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
                        <x-icons.book
                            class="{{ request()->is('admin/subjects*') ? 'text-white' : 'text-indigo-600 group-hover:text-indigo-700' }} h-5 w-5" />
                    </div>
                    <span class="font-medium">Mata Pelajaran</span>
                    @if (request()->is('admin/subjects*'))
                        <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                    @endif
                </a>

                <!-- Schedules -->
                <a href="/admin/schedules"
                    class="{{ request()->is('admin/schedules*') ? 'bg-gradient-to-r from-teal-500 to-teal-600 text-white shadow-lg border-0' : 'text-slate-700 hover:bg-gradient-to-r hover:from-teal-50 hover:to-amber-50 hover:text-teal-700' }} group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 transform hover:scale-[1.02] hover:shadow-md">
                    <div
                        class="{{ request()->is('admin/schedules*') ? 'bg-white/20' : 'bg-teal-100 group-hover:bg-teal-200' }} p-2 rounded-lg mr-3 transition-colors duration-200">
                        <x-icons.calendar
                            class="{{ request()->is('admin/schedules*') ? 'text-white' : 'text-teal-600 group-hover:text-teal-700' }} h-5 w-5" />
                    </div>
                    <span class="font-medium">Jadwal</span>
                    @if (request()->is('admin/schedules*'))
                        <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                    @endif
                </a>

                <!-- Reports -->
                <a href="/admin/reports"
                    class="{{ request()->is('admin/reports*') ? 'bg-gradient-to-r from-orange-500 to-orange-600 text-white shadow-lg border-0' : 'text-slate-700 hover:bg-gradient-to-r hover:from-orange-50 hover:to-amber-50 hover:text-orange-700' }} group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 transform hover:scale-[1.02] hover:shadow-md">
                    <div
                        class="{{ request()->is('admin/reports*') ? 'bg-white/20' : 'bg-orange-100 group-hover:bg-orange-200' }} p-2 rounded-lg mr-3 transition-colors duration-200">
                        <x-icons.document
                            class="{{ request()->is('admin/reports*') ? 'text-white' : 'text-orange-600 group-hover:text-orange-700' }} h-5 w-5" />
                    </div>
                    <span class="font-medium">Laporan</span>
                    @if (request()->is('admin/reports*'))
                        <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                    @endif
                </a>

                <!-- Verification Menu -->
                <x-dropdown>
                    <x-slot name="trigger">
                        <button type="button"
                            class="{{ request()->is('admin/grades*') || request()->is('admin/attendances*') ? 'bg-gradient-to-r from-violet-500 to-violet-600 text-white shadow-lg border-0' : 'text-slate-700 hover:bg-gradient-to-r hover:from-violet-50 hover:to-amber-50 hover:text-violet-700' }} w-full group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 transform hover:scale-[1.02] hover:shadow-md">
                            <div
                                class="{{ request()->is('admin/grades*') || request()->is('admin/attendances*') ? 'bg-white/20' : 'bg-violet-100 group-hover:bg-violet-200' }} p-2 rounded-lg mr-3 transition-colors duration-200">
                                <x-icons.check
                                    class="{{ request()->is('admin/grades*') || request()->is('admin/attendances*') ? 'text-white' : 'text-violet-600 group-hover:text-violet-700' }} h-5 w-5" />
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
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('admin.grades.index')" :active="request()->is('admin/grades*')">
                            <div class="flex items-center">
                                <x-icons.edit
                                    class="h-5 w-5 mr-3 {{ request()->is('admin/grades*') ? 'text-violet-600' : 'text-gray-400' }}" />
                                <span>Verifikasi Nilai</span>
                            </div>
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('admin.attendances.index')" :active="request()->is('admin/attendances*')">
                            <div class="flex items-center">
                                <x-icons.eye
                                    class="h-5 w-5 mr-3 {{ request()->is('admin/attendances*') ? 'text-violet-600' : 'text-gray-400' }}" />
                                <span>Verifikasi Kehadiran</span>
                            </div>
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
                <span class="mx-4 my-4 border-t border-slate-200"></span>
            </div>
        </div>
    </div>
</aside>
