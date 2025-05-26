<header
    class="bg-gradient-to-r from-slate-900 via-blue-900 to-slate-900 backdrop-blur-md shadow-2xl border-b border-slate-700/50 flex items-center justify-between px-4 sm:px-6 py-4 fixed top-0 z-40 w-full transition-all duration-300">
    <div class="flex items-center space-x-4">
        <!-- Mobile menu button -->
        <button id="toggleSidebarMobile" aria-expanded="true" aria-controls="sidebar"
            class="lg:hidden text-slate-300 hover:text-white hover:bg-slate-700/50 focus:bg-slate-700/50 focus:ring-2 focus:ring-blue-500/50 rounded-lg p-2.5 transition-all duration-200 group">
            <svg id="toggleSidebarMobileHamburger" class="w-5 h-5 transition-transform duration-200 group-hover:scale-110"
                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                    clip-rule="evenodd"></path>
            </svg>
            <svg id="toggleSidebarMobileClose"
                class="w-5 h-5 hidden transition-transform duration-200 group-hover:scale-110" fill="currentColor"
                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>

        <!-- Logo and title section -->
        <div class="flex items-center space-x-3">
            <div
                class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                <svg class="w-4 h-4 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                    </path>
                </svg>
            </div>
            <div>
                <h1 class="text-xl font-bold bg-gradient-to-r from-white to-blue-200 bg-clip-text text-transparent">
                    SIPEKA</h1>
                <p class="text-xs text-slate-400 font-medium">Admin Dashboard</p>
            </div>
        </div>
    </div> <!-- Right side controls -->
    <div class="flex items-center space-x-3">
        <!-- Search bar (hidden on mobile) -->
        <div class="hidden md:flex items-center">
            <div class="relative">
                <input type="text" placeholder="Quick search..."
                    class="w-64 px-4 py-2 pl-10 text-sm bg-slate-800/50 border border-slate-600/50 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition-all duration-200">
                <svg class="absolute left-3 top-2.5 w-4 h-4 text-slate-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m21 21-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>

        <div class="relative">
            <button
                class="relative p-2.5 rounded-lg text-slate-300 hover:text-white hover:bg-slate-700/50 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500/50 group"
                data-tooltip="Notifications">
                <span
                    class="absolute -top-1 -right-1 h-5 w-5 flex items-center justify-center rounded-full bg-gradient-to-r from-red-500 to-pink-500 text-xs text-white font-medium shadow-lg animate-pulse">2</span>
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 transition-transform duration-200 group-hover:scale-110" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
            </button>
        </div>

        <!-- Settings -->
        <a href="{{ route('admin.server.index') }}"
            class="p-2.5 rounded-lg text-slate-300 hover:text-white
            hover:bg-slate-700/50 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500/50
            group">
            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 transition-transform duration-200 group-hover:rotate-90" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                </path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
        </a>

        <!-- User profile dropdown -->
        <div class="relative">
            <div class="flex items-center">
                <x-dropdown>
                    <x-slot name="trigger">
                        <div
                            class="flex items-center space-x-3 bg-slate-800/30 rounded-lg p-2 hover:bg-slate-700/50 transition-all duration-200 cursor-pointer group">
                            <div class="relative">
                                <button type="button"
                                    class="flex text-sm rounded-full focus:ring-2 focus:ring-blue-500/50"
                                    id="user-menu-button" aria-expanded="false">
                                    <span class="sr-only">Open user menu</span>
                                    <div
                                        class="w-9 h-9 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white text-sm font-bold shadow-lg ring-2 ring-slate-700/50">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                </button>
                                <!-- Online indicator -->
                                <div
                                    class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-green-400 border-2 border-slate-900 rounded-full">
                                </div>
                            </div>
                            <div class="hidden md:block text-left">
                                <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-slate-400">{{ Auth::user()->role }}</p>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 transition-transform duration-200 group-hover:rotate-180"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7">
                                </path>
                            </svg>
                        </div>
                    </x-slot>
                    <x-slot name="content">
                        <div class="py-2 bg-white rounded-xl shadow-2xl border border-slate-200 min-w-56"
                            id="dropdown-user">
                            <div class="px-4 py-3 border-b border-slate-100">
                                <p class="text-sm font-semibold text-slate-900">{{ Auth::user()->name }}</p>
                                <p class="text-sm text-slate-500 truncate">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="py-2">
                                <a href="{{ route('profile.update') }}"
                                    class="flex items-center px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 transition-colors duration-150">
                                    <svg class="w-4 h-4 mr-3 text-slate-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                    Profile Settings
                                </a>
                                <div class="border-t border-slate-100 my-2"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-150">
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                            </path>
                                        </svg>
                                        Sign Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</header>
