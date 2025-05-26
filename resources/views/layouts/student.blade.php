<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Student Portal') - {{ config('app.name', 'SIPEKA') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-200 fixed w-full z-30 top-0">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between px-0 md:px-16">
                <div class="flex items-center justify-start">
                    <!-- Mobile menu button -->
                    <button id="toggleSidebarMobile" aria-expanded="true" aria-controls="sidebar"
                        class="lg:hidden mr-2 text-gray-600 hover:text-gray-900 cursor-pointer p-2 hover:bg-gray-100 focus:bg-gray-100 focus:ring-2 focus:ring-gray-100 rounded">
                        <svg id="toggleSidebarMobileHamburger" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <svg id="toggleSidebarMobileClose" class="w-6 h-6 hidden" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <!-- Brand -->
                    <a href="{{ route('student.dashboard') }}" class="text-xl font-bold flex items-center lg:ml-2.5">
                        <span class="self-center whitespace-nowrap text-blue-600">SIPEKA</span>
                        <span class="ml-2 text-sm font-normal text-gray-500">Student Portal</span>
                    </a>
                </div>
                <div class="flex items-center">
                    <x-dropdown>
                        <x-slot name="trigger">
                            <div class="flex items-center ml-3">
                                <div class="relative">
                                    <button type="button"
                                        class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300"
                                        id="user-menu-button" aria-expanded="false">
                                        <span class="sr-only">Open user menu</span>
                                        <div
                                            class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white text-sm font-medium">
                                            {{ substr(Auth::user()->name, 0, 1) }}
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </x-slot>
                        <x-slot name="content">
                            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow"
                                id="dropdown-user">
                                <div class="px-4 py-3">
                                    <p class="text-sm text-gray-900">{{ Auth::user()->name }}</p>
                                    <p class="text-sm font-medium text-gray-900 truncate">
                                        {{ Auth::user()->email }}
                                    </p>
                                </div>
                                <ul class="py-1">
                                    <li>
                                        <a href="{{ route('student.profile.edit') }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit"
                                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign
                                                out</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <aside id="sidebar"
        class="fixed top-0 left-0 z-20 flex-col flex-shrink-0 w-64 h-full pt-16 font-normal duration-300 transition-all hidden lg:flex"
        aria-label="Sidebar">
        <div
            class="relative flex-1 flex flex-col min-h-0 bg-gradient-to-b from-blue-50 via-white to-blue-50 border-r border-blue-200 shadow-xl pt-0">
            <!-- Sidebar Header -->
            <div class="px-6 py-4 bg-gradient-to-r from-blue-500 to-blue-600 text-white">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-white">Student Portal</h3>
                        <p class="text-xs text-blue-100">SIPEKA Learning</p>
                    </div>
                </div>
            </div>

            <div class="flex-1 flex flex-col pt-6 pb-4 overflow-y-auto">
                <div class="flex-1 px-4 space-y-2">
                    <!-- Dashboard -->
                    <a href="{{ route('student.dashboard') }}"
                        class="{{ request()->routeIs('student.dashboard') ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg border-0' : 'text-slate-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-amber-50 hover:text-blue-700' }} group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 transform hover:scale-[1.02] hover:shadow-md">
                        <div
                            class="{{ request()->routeIs('student.dashboard') ? 'bg-white/20' : 'bg-blue-100 group-hover:bg-blue-200' }} p-2 rounded-lg mr-3 transition-colors duration-200">
                            <svg class="{{ request()->routeIs('student.dashboard') ? 'text-white' : 'text-blue-600 group-hover:text-blue-700' }} h-5 w-5"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6a2 2 0 01-2 2H10a2 2 0 01-2-2V5z"></path>
                            </svg>
                        </div>
                        <span class="font-medium">Dashboard</span>
                        @if (request()->routeIs('student.dashboard'))
                            <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a> <!-- Schedule -->
                    <a href="{{ route('student.schedules.index') }}"
                        class="{{ request()->routeIs('student.schedule*') ? 'bg-gradient-to-r from-emerald-500 to-emerald-600 text-white shadow-lg border-0' : 'text-slate-700 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-amber-50 hover:text-emerald-700' }} group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 transform hover:scale-[1.02] hover:shadow-md">
                        <div
                            class="{{ request()->routeIs('student.schedule*') ? 'bg-white/20' : 'bg-emerald-100 group-hover:bg-emerald-200' }} p-2 rounded-lg mr-3 transition-colors duration-200">
                            <svg class="{{ request()->routeIs('student.schedule*') ? 'text-white' : 'text-emerald-600 group-hover:text-emerald-700' }} h-5 w-5"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <span class="font-medium">Jadwal Pelajaran</span>
                        @if (request()->routeIs('student.schedule*'))
                            <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>

                    <!-- Grades -->
                    <a href="{{ route('student.grades.index') }}"
                        class="{{ request()->routeIs('student.grades*') ? 'bg-gradient-to-r from-amber-500 to-amber-600 text-white shadow-lg border-0' : 'text-slate-700 hover:bg-gradient-to-r hover:from-amber-50 hover:to-blue-50 hover:text-amber-700' }} group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 transform hover:scale-[1.02] hover:shadow-md">
                        <div
                            class="{{ request()->routeIs('student.grades*') ? 'bg-white/20' : 'bg-amber-100 group-hover:bg-amber-200' }} p-2 rounded-lg mr-3 transition-colors duration-200">
                            <svg class="{{ request()->routeIs('student.grades*') ? 'text-white' : 'text-amber-600 group-hover:text-amber-700' }} h-5 w-5"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                        </div>
                        <span class="font-medium">Nilai & Rapor</span>
                        @if (request()->routeIs('student.grades*'))
                            <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>

                    <!-- Attendance -->
                    <a href="{{ route('student.attendances.index') }}"
                        class="{{ request()->routeIs('student.attendance*') ? 'bg-gradient-to-r from-purple-500 to-purple-600 text-white shadow-lg border-0' : 'text-slate-700 hover:bg-gradient-to-r hover:from-purple-50 hover:to-amber-50 hover:text-purple-700' }} group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 transform hover:scale-[1.02] hover:shadow-md">
                        <div
                            class="{{ request()->routeIs('student.attendance*') ? 'bg-white/20' : 'bg-purple-100 group-hover:bg-purple-200' }} p-2 rounded-lg mr-3 transition-colors duration-200">
                            <svg class="{{ request()->routeIs('student.attendance*') ? 'text-white' : 'text-purple-600 group-hover:text-purple-700' }} h-5 w-5"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                </path>
                            </svg>
                        </div>
                        <span class="font-medium">Absensi</span>
                        @if (request()->routeIs('student.attendance*'))
                            <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>

                    <!-- Announcements -->
                    <a href="{{ route('student.announcements.index') }}"
                        class="{{ request()->routeIs('student.announcements*') ? 'bg-gradient-to-r from-rose-500 to-rose-600 text-white shadow-lg border-0' : 'text-slate-700 hover:bg-gradient-to-r hover:from-rose-50 hover:to-amber-50 hover:text-rose-700' }} group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 transform hover:scale-[1.02] hover:shadow-md">
                        <div
                            class="{{ request()->routeIs('student.announcements*') ? 'bg-white/20' : 'bg-rose-100 group-hover:bg-rose-200' }} p-2 rounded-lg mr-3 transition-colors duration-200">
                            <svg class="{{ request()->routeIs('student.announcements*') ? 'text-white' : 'text-rose-600 group-hover:text-rose-700' }} h-5 w-5"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                                </path>
                            </svg>
                        </div>
                        <span class="font-medium">Pengumuman</span>
                        @if (request()->routeIs('student.announcements*'))
                            <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>
                </div>
            </div>

            <!-- Footer -->
            <div class="px-4 py-4 bg-gradient-to-r from-blue-100 to-blue-50 border-t border-blue-200">
                <div class="text-center">
                    <p class="text-xs text-blue-600 font-medium">© {{ date('Y') }} SIPEKA</p>
                    <p class="text-xs text-blue-500">Student Learning Portal</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main content -->
    <div class="flex flex-col flex-1 lg:ml-64">
        <main class="flex-1 pt-16">
            {{ $slot }}
        </main>
    </div>

    <!-- Mobile sidebar backdrop -->
    <div class="hidden fixed inset-0 z-10 bg-gray-600 bg-opacity-50 lg:hidden" id="sidebarBackdrop"></div>

    <!-- Scripts -->
    <script>
        const toggleSidebarMobile = document.getElementById('toggleSidebarMobile');
        const sidebar = document.getElementById('sidebar');
        const sidebarBackdrop = document.getElementById('sidebarBackdrop');
        const hamburger = document.getElementById('toggleSidebarMobileHamburger');
        const close = document.getElementById('toggleSidebarMobileClose');
        sidebar.classList.add('flex');

        toggleSidebarMobile.addEventListener('click', function() {
            sidebar.classList.toggle('hidden');
            sidebarBackdrop.classList.toggle('hidden');
            hamburger.classList.toggle('hidden');
            close.classList.toggle('hidden');
        });

        sidebarBackdrop.addEventListener('click', function() {
            sidebar.classList.add('hidden');
            sidebarBackdrop.classList.add('hidden');
            hamburger.classList.remove('hidden');
            close.classList.add('hidden');
        });

        // User dropdown
        const userMenuButton = document.getElementById('user-menu-button');
        const userDropdown = document.getElementById('dropdown-user');

        userMenuButton.addEventListener('click', function() {
            userDropdown.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!userMenuButton.contains(event.target) && !userDropdown.contains(event.target)) {
                userDropdown.classList.add('hidden');
            }
        });

        // Flash messages
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if ($errors->any())
            let errorMessages = [];
            @foreach ($errors->all() as $error)
                errorMessages.push('{{ $error }}');
            @endforeach

            Swal.fire({
                icon: 'error',
                title: 'Validation Errors',
                html: errorMessages.join('<br>'),
                timer: 5000,
                showConfirmButton: true
            });
        @endif
    </script>

    @stack('scripts')
</body>

</html>
