<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'SIPEKA') }} - Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-blue-50 to-indigo-50">
    <div class="min-h-screen flex flex-col md:flex-row items-center justify-center px-4 sm:px-6 lg:px-8">
        <div
            class="w-full max-w-md p-8 md:p-10 rounded-2xl bg-white shadow-xl md:shadow-2xl mb-8 md:mb-0 md:mr-8 transition-all duration-300 transform hover:scale-[1.01]">
            <div class="absolute -top-8 left-1/2 transform -translate-x-1/2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-14 h-14 text-blue-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path d="M12 14l9-5-9-5-9 5 9 5z" />
                    <path
                        d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998a12.078 12.078 0 01.665-6.479L12 14z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998a12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                </svg>
            </div>

            <div class="space-y-3 mb-6">
                <h2 class="text-2xl font-bold text-center text-gray-900">Selamat Datang!</h2>

                @if (!$isServerOnline)
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-yellow-600 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                                </path>
                            </svg>
                            <h3 class="text-sm font-medium text-yellow-800">
                                Sistem Sedang Dalam Pemeliharaan
                            </h3>
                        </div>
                        <div class="mt-2">
                            <p class="text-sm text-yellow-700">
                                {{ $maintenanceMessage ?: 'Sistem sedang dalam mode pemeliharaan. Hanya administrator yang dapat mengakses sistem saat ini.' }}
                            </p>
                            @if ($serverStatus->maintenance_started_at)
                                <p class="text-xs text-yellow-600 mt-1">
                                    Dimulai:
                                    {{ $serverStatus->maintenance_started_at->setTimezone('Asia/Jakarta')->format('d/m/Y H:i') }}
                                </p>
                            @endif
                        </div>
                    </div>
                @endif

                <p class="text-gray-600 text-justify text-sm leading-relaxed">
                    @if (!$isServerOnline)
                        Hanya administrator yang dapat masuk selama periode pemeliharaan sistem.
                    @else
                        Silahkan masuk untuk akses ke pengelolaan kegiatan akademik
                        untuk memudahkan proses belajar mengajar.
                    @endif
                </p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-3">
                @csrf

                <!-- Login Field -->
                <div class="space-y-2">
                    <label for="login" class="text-xs text-gray-500 dark:text-gray-400">
                        Masukkan Email, NIS, atau NIP Anda untuk masuk ke sistem.
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                        </div>
                        <input type="text" name="login" id="login" value="{{ old('login') }}"
                            class="h-12 pl-10 pr-4 w-full rounded-lg @error('login') border-red-300 focus:border-red-400 focus:ring-red-400 @enderror"
                            autofocus />
                    </div>
                    @error('login')
                        <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>


                <!-- Password Field -->
                <div class="space-y-2">
                    <label for="password" class="text-xs text-gray-500 dark:text-gray-400">
                        Masukkan password Anda.
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="password" name="password" id="password" value="{{ old('password') }}"
                            class="h-12 pl-10 pr-12 w-full rounded-lg transition-colors @error('password') border-red-300 focus:border-red-400 focus:ring-red-400 @enderror" />
                        <button type="button" id="togglePassword"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd"
                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full cursor-pointer transition-all bg-blue-500 text-white px-6 py-2 rounded-lg border-blue-600 border-b-[4px] hover:brightness-110 hover:-translate-y-[1px] hover:border-b-[6px] active:border-b-[2px] active:brightness-90 active:translate-y-[2px]">
                    Masuk
                </button>
            </form>

            <div class="mt-8 text-center block">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    &copy; {{ date('Y') }} SIPEKA. All rights reserved.
                </p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');

            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function() {
                    const isPassword = passwordInput.type === 'password';
                    passwordInput.type = isPassword ? 'text' : 'password';

                    // Update icon
                    const icon = togglePassword.querySelector('svg');
                    if (isPassword) {
                        // Show "eye-slash" icon when password is visible
                        icon.innerHTML = `
                            <path d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21" />
                        `;
                    } else {
                        // Show "eye" icon when password is hidden
                        icon.innerHTML = `
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                        `;
                    }
                });
            }
        });
    </script>
</body>

</html>
