<x-student-layout>
    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Absensi QR Code</h1>
                    <p class="text-gray-600 mt-1">Scan QR code untuk melakukan absensi</p>
                </div>
                <a href="{{ route('student.attendances.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd"></path>
                    </svg>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <!-- QR Scanner Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Scanner QR Code</h3>
            </div>

            <div class="p-6">
                <!-- Manual QR Code Input -->
                <div class="bg-gray-50 rounded-lg p-6 mb-6">
                    <h4 class="text-md font-medium text-gray-900 mb-4">Input Manual QR Code</h4>
                    <form action="{{ route('student.attendances.store') }}" method="POST">
                        @csrf
                        <div class="flex gap-4">
                            <div class="flex-1">
                                <input type="text" name="qr_token" id="qr_token"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Masukkan kode QR atau scan barcode" required>
                            </div>
                            <button type="submit"
                                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                                Submit Absensi
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Camera Scanner (Future Enhancement) -->
                <div class="bg-gray-50 rounded-lg p-6 text-center">
                    <div class="text-gray-400 mb-4">
                        <svg class="mx-auto h-24 w-24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h4 class="text-lg font-medium text-gray-900 mb-2">Camera Scanner</h4>
                    <p class="text-gray-600 mb-4">Fitur scan kamera akan tersedia dalam pembaruan selanjutnya</p>
                    <button disabled
                        class="inline-flex items-center px-6 py-3 bg-gray-300 text-gray-500 font-medium rounded-lg cursor-not-allowed">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Buka Kamera
                    </button>
                </div>
            </div>
        </div>

        <!-- Active Sessions -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Sesi Absensi Aktif Hari Ini</h3>
            </div>

            <div class="p-6">
                @if ($activePresences->count() > 0)
                    <div class="grid gap-4">
                        @foreach ($activePresences as $presence)
                            <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <h4 class="font-medium text-gray-900">
                                            {{ $presence->classSchedule->subject->name ?? 'N/A' }}
                                        </h4>
                                        <div class="flex items-center mt-2 text-sm text-gray-600">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ \Carbon\Carbon::parse($presence->classSchedule->start_time)->format('H:i') }}
                                            -
                                            {{ \Carbon\Carbon::parse($presence->classSchedule->end_time)->format('H:i') }}
                                        </div>
                                        <div class="flex items-center mt-1 text-sm text-gray-600">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            {{ \Carbon\Carbon::parse($presence->date)->format('d M Y') }}
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <span class="w-2 h-2 bg-green-400 rounded-full mr-1 animate-pulse"></span>
                                            Aktif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="text-gray-500">
                            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-lg font-medium">Tidak ada sesi absensi aktif</p>
                            <p class="text-sm">Sesi absensi akan tersedia saat jadwal pelajaran dimulai</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Instructions -->
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-6">
            <h4 class="text-lg font-medium text-blue-900 mb-4">Cara Melakukan Absensi</h4>
            <div class="space-y-3 text-sm text-blue-800">
                <div class="flex items-start">
                    <span
                        class="inline-flex items-center justify-center w-6 h-6 bg-blue-200 text-blue-800 rounded-full text-xs font-medium mr-3 mt-0.5">1</span>
                    <span>Pastikan sesi absensi untuk mata pelajaran sudah aktif (ditampilkan di atas)</span>
                </div>
                <div class="flex items-start">
                    <span
                        class="inline-flex items-center justify-center w-6 h-6 bg-blue-200 text-blue-800 rounded-full text-xs font-medium mr-3 mt-0.5">2</span>
                    <span>Dapatkan QR code dari guru atau masukkan kode manual yang diberikan</span>
                </div>
                <div class="flex items-start">
                    <span
                        class="inline-flex items-center justify-center w-6 h-6 bg-blue-200 text-blue-800 rounded-full text-xs font-medium mr-3 mt-0.5">3</span>
                    <span>Input kode pada form di atas atau scan menggunakan kamera (jika tersedia)</span>
                </div>
                <div class="flex items-start">
                    <span
                        class="inline-flex items-center justify-center w-6 h-6 bg-blue-200 text-blue-800 rounded-full text-xs font-medium mr-3 mt-0.5">4</span>
                    <span>Klik "Submit Absensi" untuk mencatat kehadiran</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-focus on QR token input
        document.getElementById('qr_token').focus();

        // Handle enter key submission
        document.getElementById('qr_token').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.target.closest('form').submit();
            }
        });
    </script>
</x-student-layout>
