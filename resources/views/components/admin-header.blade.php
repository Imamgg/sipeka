<header
    class="bg-gray-800 bg-opacity-80 backdrop-blur-sm shadow-lg flex items-center justify-between p-4 fixed top-0 z-30 w-full">
    <div class="flex items-center">
        <!-- Mobile menu button -->
        <button id="toggleSidebarMobile" aria-expanded="true" aria-controls="sidebar"
            class="lg:hidden mr-2 text-gray-300 hover:text-white cursor-pointer p-2 hover:bg-gray-700 focus:bg-gray-700 focus:ring-2 focus:ring-gray-700 rounded">
            <svg id="toggleSidebarMobileHamburger" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                    clip-rule="evenodd"></path>
            </svg>
            <svg id="toggleSidebarMobileClose" class="w-6 h-6 hidden" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>
        <h2 class="ml-2 text-xl font-bold tracking-tight text-white">Admin Dashboard</h2>
    </div>
    <div class="flex items-center space-x-4">
        <button
            class="relative p-2 rounded-full text-gray-300 hover:text-white hover:bg-gray-700 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-blue-500 tooltip"
            data-tooltip="Notifikasi">
            <span
                class="absolute -top-1 -right-1 h-5 w-5 flex items-center justify-center rounded-full bg-red-500 text-xs text-white">2</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
        </button>
        <div class="relative">
            <div class="flex items-center z-50">
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
</header>
