@props(['serverStatus'])
<x-app-layout>
    <div class="bg-gradient-to-br from-indigo-50 via-white to-blue-50 relative overflow-hidden border-b border-gray-100">
        <div class="relative px-6 py-8 sm:px-10">
            <div class="max-w-7xl mx-auto">
                <div class="text-center">
                    <div
                        class="inline-flex items-center px-4 py-2 rounded-full bg-indigo-100 text-indigo-700 text-sm font-medium mb-6">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Manajemen Server
                    </div>
                    <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">
                        Status <span
                            class="bg-gradient-to-r from-indigo-600 to-blue-600 bg-clip-text text-transparent">Server</span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                        Kelola status server dan mode pemeliharaan sistem SIPEKA
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Alert Messages -->
            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Current Server Status Card -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl mb-8">
                <div class="p-8">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">Status Server Saat Ini</h2>
                        <div class="flex items-center space-x-2">
                            @if ($serverStatus->is_online)
                                <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                                <span class="text-green-600 font-semibold">Online</span>
                            @else
                                <div class="w-3 h-3 bg-red-500 rounded-full animate-pulse"></div>
                                <span class="text-red-600 font-semibold">Maintenance</span>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Status Info -->
                        <div class="space-y-4">
                            <div class="p-4 bg-gray-50 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <p
                                    class="text-lg font-semibold {{ $serverStatus->is_online ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $serverStatus->is_online ? 'Server Online' : 'Mode Maintenance' }}
                                </p>
                            </div>

                            @if (!$serverStatus->is_online && $serverStatus->maintenance_started_at)
                                <div class="p-4 bg-gray-50 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Maintenance
                                        Dimulai</label>
                                    <p class="text-gray-900">
                                        {{ $serverStatus->maintenance_started_at->format('d M Y, H:i') }} WIB</p>
                                </div>
                            @endif

                            @if ($serverStatus->updated_by)
                                <div class="p-4 bg-gray-50 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Terakhir Diubah
                                        Oleh</label>
                                    <p class="text-gray-900">{{ $serverStatus->updatedBy->name ?? 'Unknown' }}</p>
                                </div>
                            @endif
                        </div>

                        <!-- Current Message -->
                        @if (!$serverStatus->is_online && $serverStatus->maintenance_message)
                            <div class="space-y-4">
                                <div class="p-4 bg-yellow-50 border-l-4 border-yellow-400 rounded-lg">
                                    <label class="block text-sm font-medium text-yellow-800 mb-1">Pesan
                                        Maintenance</label>
                                    <p class="text-yellow-700">{{ $serverStatus->maintenance_message }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Server Control Card -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl">
                <div class="p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Kontrol Server</h2>

                    <form action="{{ route('admin.server.update-status') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Status Toggle -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Mode Server</label>
                            <div class="space-y-3">
                                <label
                                    class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50 {{ $serverStatus->is_online ? 'border-green-500 bg-green-50' : 'border-gray-300' }}">
                                    <input type="radio" name="is_online" value="1"
                                        {{ $serverStatus->is_online ? 'checked' : '' }}
                                        class="h-4 w-4 text-green-600 focus:ring-green-500">
                                    <div class="ml-3">
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span class="font-medium text-gray-900">Online</span>
                                        </div>
                                        <p class="text-sm text-gray-500">Server dapat diakses oleh semua pengguna</p>
                                    </div>
                                </label>

                                <label
                                    class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50 {{ !$serverStatus->is_online ? 'border-red-500 bg-red-50' : 'border-gray-300' }}">
                                    <input type="radio" name="is_online" value="0"
                                        {{ !$serverStatus->is_online ? 'checked' : '' }}
                                        class="h-4 w-4 text-red-600 focus:ring-red-500">
                                    <div class="ml-3">
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L5.082 15.5c-.77.833.192 2.5 1.732 2.5z">
                                                </path>
                                            </svg>
                                            <span class="font-medium text-gray-900">Maintenance</span>
                                        </div>
                                        <p class="text-sm text-gray-500">Hanya admin yang dapat mengakses sistem</p>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Maintenance Message -->
                        <div id="maintenanceMessage" class="{{ $serverStatus->is_online ? 'hidden' : '' }}">
                            <label for="maintenance_message" class="block text-sm font-medium text-gray-700 mb-2">
                                Pesan Maintenance
                            </label>
                            <textarea id="maintenance_message" name="maintenance_message" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Masukkan pesan yang akan ditampilkan kepada pengguna...">{{ old('maintenance_message', $serverStatus->maintenance_message) }}</textarea>
                            <p class="mt-1 text-sm text-gray-500">
                                Pesan ini akan ditampilkan ketika pengguna mencoba login saat server dalam mode
                                maintenance.
                            </p>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit"
                                class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                    </path>
                                </svg>
                                Update Status Server
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle maintenance message visibility
        document.addEventListener('DOMContentLoaded', function() {
            const radioButtons = document.querySelectorAll('input[name="is_online"]');
            const maintenanceMessage = document.getElementById('maintenanceMessage');

            radioButtons.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.value === '0') {
                        maintenanceMessage.classList.remove('hidden');
                    } else {
                        maintenanceMessage.classList.add('hidden');
                    }
                });
            });
        });
    </script>
</x-app-layout>
