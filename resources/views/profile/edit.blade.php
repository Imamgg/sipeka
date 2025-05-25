<x-app-layout>
    <!-- Modern Header Section with Gradient Background -->
    <div class="bg-gradient-to-br from-indigo-50 via-white to-purple-50 border-b border-gray-200/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <!-- Page Badge -->
                <div
                    class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-800 border border-blue-200/50 mb-4">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Profile Settings
                </div>

                <!-- Main Title -->
                <h1 class="text-4xl font-bold text-gray-900 mb-3">
                    <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                        Pengaturan Profil
                    </span>
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Kelola informasi akun dan preferensi keamanan Anda
                </p>
            </div>
        </div>
    </div>

    <div class="py-12 bg-gray-50/50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Profile Summary Card -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-200/50 overflow-hidden sticky top-8">
                        <div class="bg-gradient-to-br from-indigo-500 to-purple-600 p-6 text-white">
                            <div class="flex items-center space-x-4">
                                <div
                                    class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center text-2xl font-bold">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold">{{ Auth::user()->name }}</h3>
                                    <p class="text-indigo-100 text-sm">{{ Auth::user()->email }}</p>
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-white/20 text-white mt-2">
                                        {{ ucfirst(Auth::user()->role ?? 'User') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Status Akun</span>
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Aktif
                                    </span>
                                </div>

                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Bergabung</span>
                                    <span class="text-sm font-medium text-gray-900">
                                        {{ Auth::user()->created_at->format('M Y') }}
                                    </span>
                                </div>

                                @if (Auth::user()->email_verified_at)
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600">Email Verified</span>
                                        <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Settings Forms -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Profile Information Card -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200/50 overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 border-b border-gray-200/50">
                            <div class="flex items-center space-x-3">
                                <div class="rounded-xl bg-blue-100 p-3 text-blue-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Informasi Profil</h3>
                                    <p class="text-sm text-gray-600">Perbarui informasi akun dan alamat email Anda</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <!-- Password Update Card -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200/50 overflow-hidden">
                        <div class="bg-gradient-to-r from-amber-50 to-orange-50 p-6 border-b border-gray-200/50">
                            <div class="flex items-center space-x-3">
                                <div class="rounded-xl bg-amber-100 p-3 text-amber-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Keamanan Password</h3>
                                    <p class="text-sm text-gray-600">Perbarui password untuk menjaga keamanan akun</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <!-- Account Deletion Card -->
                    <div class="bg-white rounded-2xl shadow-lg border border-red-200/50 overflow-hidden">
                        <div class="bg-gradient-to-r from-red-50 to-pink-50 p-6 border-b border-red-200/50">
                            <div class="flex items-center space-x-3">
                                <div class="rounded-xl bg-red-100 p-3 text-red-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Hapus Akun</h3>
                                    <p class="text-sm text-gray-600">Hapus akun dan semua data secara permanen</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
