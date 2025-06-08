<x-error-layout>
    <div class="bg-gray-900 text-gray-50 flex items-center justify-center min-h-screen p-4 sm:p-6">
        <div class="text-center p-8 sm:p-10 rounded-2xl shadow-2xl max-w-xl mx-auto">
            <div class="mb-6">
                <span class="text-8xl sm:text-9xl font-extrabold text-red-500 block animate-shake">404</span>
            </div>

            <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-4 fade-in-slide-up">
                Halaman Tidak Ditemukan
            </h1>
            <p class="text-gray-300 text-lg sm:text-xl mb-8 leading-relaxed fade-in-slide-up delay-1">
                Kami mohon maaf, halaman yang Anda cari tidak dapat ditemukan.
                Mungkin Anda salah mengetik alamat, atau halaman tersebut telah dipindahkan.
            </p>

            <a href="{{ url('/') }}"
                class="inline-flex items-center px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg
                       transition-all duration-300 transform hover:scale-105 active:scale-95
                       focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-75
                       fade-in-slide-up delay-2">
                <svg class="w-6 h-6 mr-3 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7m-7 7H21">
                    </path>
                </svg>
                Kembali ke Beranda
            </a>

            <p class="mt-8 text-gray-500 text-sm fade-in-slide-up delay-3">
                &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Hak Cipta Dilindungi.
            </p>
        </div>

        <style>
            @keyframes shake {

                0%,
                100% {
                    transform: translateX(0);
                }

                10%,
                30%,
                50%,
                70%,
                90% {
                    transform: translateX(-5px);
                }

                20%,
                40%,
                60%,
                80% {
                    transform: translateX(5px);
                }
            }

            .animate-shake {
                animation: shake 0.8s cubic-bezier(.36, .07, .19, .97) both;
            }

            @keyframes fadeInSlideUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .fade-in-slide-up {
                animation: fadeInSlideUp 0.6s ease-out forwards;
                opacity: 0;
            }

            .fade-in-slide-up.delay-1 {
                animation-delay: 0.2s;
            }

            .fade-in-slide-up.delay-2 {
                animation-delay: 0.4s;
            }

            .fade-in-slide-up.delay-3 {
                animation-delay: 0.6s;
            }
        </style>
    </div>
</x-error-layout>
