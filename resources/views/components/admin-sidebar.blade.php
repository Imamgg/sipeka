<aside id="sidebar"
    class="fixed inset-y-0 left-0 transform -translate-x-full md:translate-x-0 transition duration-200 ease-in-out z-40 hidden sm:flex">
    <div class="w-64 bg-sidebar flex-shrink-0 fixed inset-y-0 left-0 z-10 overflow-y-auto">
        <div class="flex flex-col h-full">
            <!-- Logo -->
            <div class="flex items-center p-4 border-b border-gray-700">
                <div class="bg-white p-2 rounded-md mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <h1 class="text-xl font-bold">SIPEKA</h1>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto py-4">
                <ul class="space-y-1 px-3">
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center px-3 py-2 rounded-md active-nav-item">
                            <x-icons.dashboard class="mr-3" />
                            Dashboard
                        </a>
                    </li>

                    <!-- Data Master Section -->
                    <li class="mt-6">
                        <h3 class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                            Data Master
                        </h3>
                    </li>
                    <li>
                        <a href="/admin/students"
                            class="flex items-center px-3 py-2 rounded-md text-gray-300 hover:bg-sidebar-hover hover:text-white">
                            <x-icons.users class="mr-3" />
                            Siswa
                        </a>
                    </li>
                    <li>
                        <a href="/admin/teachers"
                            class="flex items-center px-3 py-2 rounded-md text-gray-300 hover:bg-sidebar-hover hover:text-white">
                            <x-icons.user class="mr-3" />
                            Guru
                        </a>
                    </li>
                    <li>
                        <a href="/admin/classes"
                            class="flex items-center px-3 py-2 rounded-md text-gray-300 hover:bg-sidebar-hover hover:text-white">
                            <x-icons.apartmen class="mr-3" />
                            Kelas
                        </a>
                    </li>
                    <li>
                        <a href="/admin/subjects"
                            class="flex items-center px-3 py-2 rounded-md text-gray-300 hover:bg-sidebar-hover hover:text-white">
                            <x-icons.books class="mr-3" />
                            Mata Pelajaran
                        </a>
                    </li>

                    <!-- Akademik Section -->
                    <li class="mt-6">
                        <h3 class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                            Akademik
                        </h3>
                    </li>
                    <li>
                        <a href="/admin/schedules"
                            class="flex items-center px-3 py-2 rounded-md text-gray-300 hover:bg-sidebar-hover hover:text-white">
                            <x-icons.calender class="mr-3" />
                            Jadwal
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center px-3 py-2 rounded-md text-gray-300 hover:bg-sidebar-hover hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Penilaian
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center px-3 py-2 rounded-md text-gray-300 hover:bg-sidebar-hover hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Laporan
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center px-3 py-2 rounded-md text-gray-300 hover:bg-sidebar-hover hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Pengaturan
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- User Profile -->
            <div class="p-4 border-t border-gray-700">
                <a href="#" class="flex items-center">
                    <div class="flex items-center justify-center h-8 w-8 bg-gray-700 rounded-full">
                        <span class="text-sm font-medium">I</span>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">Imamgg</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</aside>
