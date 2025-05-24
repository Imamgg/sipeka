<header
    class="bg-gray-800 bg-opacity-80 backdrop-blur-sm shadow-lg flex items-center justify-between p-4 fixed top-0 z-30 w-full md:w-[calc(100%-16rem)]">
    <div class="flex items-center">
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
            <button id="userMenuBtn"
                class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-blue-500">
                <div class="h-8 w-8 rounded-full bg-blue-600 flex items-center justify-center text-white font-semibold">
                    A
                </div>
            </button>
            <!-- User dropdown menu (hidden by default) -->
            <div id="userMenu"
                class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                <a href="{{ route('profile.update') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Your
                    Profile</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Sign out
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
