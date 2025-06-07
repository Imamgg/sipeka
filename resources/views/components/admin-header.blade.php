<div class="bg-gradient-to-br from-indigo-50 via-white to-blue-50 relative overflow-hidden border-b border-gray-100">
    <div class="relative px-6 py-12 sm:px-10">
        <div class="max-w-7xl mx-auto">
            <div class="text-center">
                <div
                    class="inline-flex items-center px-4 py-2 rounded-full bg-indigo-100 text-indigo-700 text-sm font-medium mb-6">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Dashboard Administrator
                </div>
                <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">
                    Selamat Datang, <span
                        class="bg-gradient-to-r from-indigo-600 to-blue-600 bg-clip-text text-transparent">{{ auth()->user()->name }}</span>
                </h1>
                <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">Kelola sistem pendidikan SIPEKA dengan
                    efisien dan mudah melalui dashboard yang terintegrasi</p>
                <div
                    class="inline-flex items-center space-x-8 bg-white rounded-2xl shadow-lg px-8 py-6 border border-gray-200">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-gray-900" id="current-date">
                            {{ \Carbon\Carbon::now()->timezone('Asia/Jakarta')->format('d') }}</div>
                        <div class="text-gray-500 text-sm font-medium">
                            {{ \Carbon\Carbon::now()->timezone('Asia/Jakarta')->format('F Y') }}</div>
                    </div>
                    <div class="w-px bg-gray-300 h-12"></div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-gray-900" id="current-time">
                            {{ \Carbon\Carbon::now()->timezone('Asia/Jakarta')->format('H:i') }}</div>
                        <div class="text-gray-500 text-sm font-medium">
                            {{ \Carbon\Carbon::now()->timezone('Asia/Jakarta')->format('l') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
