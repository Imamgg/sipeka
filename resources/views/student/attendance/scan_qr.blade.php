<x-student-layout>
    <div class="p-6">
        <!-- Error Messages -->
        @if (session('error'))
            <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md shadow-sm" role="alert">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Info Messages -->
        @if (session('info'))
            <div class="mb-6 bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded-md shadow-sm"
                role="alert">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">{{ session('info') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Success Messages -->
        @if (session('success'))
            <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md shadow-sm"
                role="alert">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Scan QR Absensi</h1>
                    <p class="text-gray-600">Scan QR code untuk menandai kehadiran Anda</p>
                </div>
                <a href="{{ route('student.attendances.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg font-semibold transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        <!-- QR Scanner Card -->
        <div class="max-w-4xl mx-auto">
            <!-- Main Scanner Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <!-- Header with Gradient -->
                <div class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 p-6">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h4m-4 8h4M4 4h4m0 0V2m0 2h4m0 0V2m0 2v2M4 4v4m0 0h4m0 0V6" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-white mb-2">Scanner QR Code Absensi</h2>
                        <p class="text-indigo-100">Scan QR code untuk mencatat kehadiran Anda</p>
                    </div>
                </div>

                <div class="p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Scanner Section -->
                        <div class="flex flex-col items-center space-y-6">
                            <!-- QR Reader Container -->
                            <div class="relative">
                                <div id="qr-reader"
                                    class="w-full max-w-sm mx-auto border-4 border-gray-200 rounded-2xl overflow-hidden shadow-lg">
                                </div>

                                <!-- Overlay untuk status -->
                                <div id="scanner-overlay"
                                    class="absolute inset-0 bg-black/50 rounded-2xl items-center justify-center hidden">
                                    <div class="text-white text-center">
                                        <div
                                            class="animate-spin rounded-full h-8 w-8 border-b-2 border-white mx-auto mb-3">
                                        </div>
                                        <p class="text-sm">Memproses QR Code...</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Controls -->
                            <div class="flex flex-col space-y-3 w-full max-w-sm">
                                <button id="startButton"
                                    class="group bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700 text-white px-8 py-3 rounded-xl font-semibold transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                    <div class="flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2 group-hover:rotate-12 transition-transform"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                        Mulai Scanner
                                    </div>
                                </button>

                                <button id="stopButton"
                                    class="group bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-8 py-3 rounded-xl font-semibold transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl hidden">
                                    <div class="flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2 group-hover:rotate-12 transition-transform"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z" />
                                        </svg>
                                        Berhenti Scanner
                                    </div>
                                </button>

                                <!-- Scanner Status -->
                                <div id="scanner-status"
                                    class="text-center p-3 rounded-xl bg-gray-50 border border-gray-200 hidden">
                                    <div class="flex items-center justify-center">
                                        <div class="w-2 h-2 bg-gray-400 rounded-full mr-2"></div>
                                        <span class="text-sm text-gray-600">Scanner tidak aktif</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Instructions & Tips -->
                        <div class="space-y-6">
                            <!-- Instructions -->
                            <div
                                class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-100">
                                <div class="flex items-start">
                                    <div
                                        class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-blue-900 mb-3">Cara Menggunakan Scanner</h3>
                                        <ol class="list-decimal list-inside space-y-2 text-blue-800 text-sm">
                                            <li>Klik tombol <strong>"Mulai Scanner"</strong> untuk mengaktifkan kamera
                                            </li>
                                            <li>Izinkan akses kamera ketika diminta oleh browser</li>
                                            <li>Arahkan kamera ke QR code yang ditampilkan oleh guru</li>
                                            <li>Pastikan QR code berada dalam frame scanner</li>
                                            <li>Tunggu hingga QR code terdeteksi dan absensi tercatat</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>

                            <!-- Tips -->
                            <div
                                class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl p-6 border border-amber-100">
                                <div class="flex items-start">
                                    <div
                                        class="w-10 h-10 bg-amber-500 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-amber-900 mb-3">Tips untuk Hasil Terbaik</h3>
                                        <ul class="space-y-2 text-amber-800 text-sm">
                                            <li class="flex items-start">
                                                <span
                                                    class="w-1.5 h-1.5 bg-amber-500 rounded-full mt-2 mr-2 flex-shrink-0"></span>
                                                Pastikan pencahayaan cukup terang
                                            </li>
                                            <li class="flex items-start">
                                                <span
                                                    class="w-1.5 h-1.5 bg-amber-500 rounded-full mt-2 mr-2 flex-shrink-0"></span>
                                                Jaga jarak yang tepat (10-30 cm dari layar)
                                            </li>
                                            <li class="flex items-start">
                                                <span
                                                    class="w-1.5 h-1.5 bg-amber-500 rounded-full mt-2 mr-2 flex-shrink-0"></span>
                                                Hindari pantulan cahaya pada QR code
                                            </li>
                                            <li class="flex items-start">
                                                <span
                                                    class="w-1.5 h-1.5 bg-amber-500 rounded-full mt-2 mr-2 flex-shrink-0"></span>
                                                Pastikan kamera tidak bergetar
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Troubleshooting -->
                            <div
                                class="bg-gradient-to-br from-red-50 to-pink-50 rounded-2xl p-6 border border-red-100">
                                <div class="flex items-start">
                                    <div
                                        class="w-10 h-10 bg-red-500 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-red-900 mb-3">Jika Mengalami Masalah</h3>
                                        <ul class="space-y-2 text-red-800 text-sm">
                                            <li class="flex items-start">
                                                <span
                                                    class="w-1.5 h-1.5 bg-red-500 rounded-full mt-2 mr-2 flex-shrink-0"></span>
                                                Refresh halaman dan coba lagi
                                            </li>
                                            <li class="flex items-start">
                                                <span
                                                    class="w-1.5 h-1.5 bg-red-500 rounded-full mt-2 mr-2 flex-shrink-0"></span>
                                                Periksa izin kamera di browser
                                            </li>
                                            <li class="flex items-start">
                                                <span
                                                    class="w-1.5 h-1.5 bg-red-500 rounded-full mt-2 mr-2 flex-shrink-0"></span>
                                                Hubungi guru untuk absensi manual
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include HTML5-QRCode library -->
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
    <script>
        let html5QrcodeScanner = null;
        let processingQr = false;

        function onScanSuccess(decodedText, decodedResult) {
            // Prevent multiple submissions while processing
            if (processingQr) {
                return;
            }

            processingQr = true;
            showScanStatus('QR Code terdeteksi, memproses...', 'info');

            // Handle the scanned code
            console.log(`Code matched = ${decodedText}`, decodedResult);

            let token = null;

            // Check if the scanned text is a URL with token parameter
            try {
                const url = new URL(decodedText);

                // Check if this is our attendance scan URL
                if (url.pathname === '/student/attendances/scan' && url.searchParams.has('token')) {
                    token = url.searchParams.get("token");
                    console.log('Extracted token from URL:', token);
                    showScanStatus(`Token ditemukan: ${token}`, 'success');
                } else {
                    // If it's a different URL format, try to extract token
                    token = url.searchParams.get("token");
                    if (!token) {
                        // If no token in URL params, use the entire decoded text
                        token = decodedText;
                    }
                    console.log('Token from different URL format:', token);
                }
            } catch (e) {
                // If not a valid URL, assume the entire decoded text is the token
                token = decodedText;
                console.log('Not a URL, using decoded text as token:', token);
                showScanStatus(`Menggunakan teks sebagai token: ${token}`, 'info');
            }

            if (token) {
                showScanStatus('Memproses absensi...', 'info');

                // Stop scanning while processing
                if (html5QrcodeScanner) {
                    html5QrcodeScanner.pause();
                }

                // Redirect to the scan URL with the token parameter for automatic processing
                const scanUrl = `{{ route('student.attendances.scan') }}?token=${encodeURIComponent(token)}`;
                window.location.href = scanUrl;
            } else {
                showNotification('QR code tidak valid - tidak dapat menemukan token', 'error');
                showScanStatus('QR code tidak valid', 'error');
                processingQr = false;
                return;
            }

            // Reset after a timeout (in case the redirection fails)
            setTimeout(() => {
                if (html5QrcodeScanner) {
                    html5QrcodeScanner.resume();
                }
                processingQr = false;

                // Check if we're still on the same page (redirection failed)
                if (window.location.pathname.includes('/attendances/scan')) {
                    showNotification('Terjadi kesalahan saat memproses QR code', 'error');
                    showScanStatus('Gagal memproses QR code', 'error');
                }
            }, 10000); // 10 seconds timeout
        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // console.warn(`Code scan error = ${error}`);
        }

        // Function to display a temporary notification
        function showNotification(message, type = 'info') {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `fixed bottom-4 right-4 px-6 py-3 rounded-lg shadow-lg text-white z-50 ${
                type === 'error' ? 'bg-red-600' : type === 'success' ? 'bg-green-600' : 'bg-blue-600'
            }`;
            notification.style.zIndex = '9999';
            notification.innerHTML = message;

            // Add to document
            document.body.appendChild(notification);

            // Remove after 3 seconds
            setTimeout(() => {
                notification.classList.add('opacity-0');
                notification.style.transition = 'opacity 0.5s ease-out';
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.remove();
                    }
                }, 500);
            }, 3000);
        }

        // Function to show scan status
        function showScanStatus(message, type = 'info') {
            const statusDiv = document.getElementById('scan-status');
            if (statusDiv) {
                statusDiv.remove();
            }

            const newStatus = document.createElement('div');
            newStatus.id = 'scan-status';
            newStatus.className = `mt-4 p-3 rounded-lg text-center ${
                type === 'error' ? 'bg-red-100 text-red-700' :
                type === 'success' ? 'bg-green-100 text-green-700' :
                'bg-blue-100 text-blue-700'
            }`;
            newStatus.innerHTML = message;

            const qrReader = document.getElementById('qr-reader');
            qrReader.parentNode.insertBefore(newStatus, qrReader.nextSibling);
        }

        document.getElementById("startButton").addEventListener("click", function() {
            try {
                // Clear any previous scan status
                const existingStatus = document.getElementById('scan-status');
                if (existingStatus) {
                    existingStatus.remove();
                }

                html5QrcodeScanner = new Html5QrcodeScanner(
                    "qr-reader", {
                        fps: 10,
                        qrbox: {
                            width: 250,
                            height: 250
                        },
                        rememberLastUsedCamera: true
                    },
                    /* verbose= */
                    false);

                // Handle errors during initialization
                html5QrcodeScanner.render(
                    onScanSuccess,
                    onScanFailure,
                    (errorMessage) => {
                        // This is an error callback for camera initialization errors
                        showNotification(`Error akses kamera: ${errorMessage}`, 'error');
                        showScanStatus('Gagal mengakses kamera', 'error');
                        document.getElementById("startButton").classList.remove("hidden");
                        document.getElementById("stopButton").classList.add("hidden");
                    }
                );

                document.getElementById("startButton").classList.add("hidden");
                document.getElementById("stopButton").classList.remove("hidden");
                showScanStatus('Scanner aktif - arahkan kamera ke QR code', 'info');
                showNotification('Scanner QR code berhasil dimulai', 'success');
            } catch (error) {
                showNotification(`Gagal memulai scanner: ${error.message}`, 'error');
                showScanStatus('Gagal memulai scanner', 'error');
            }
        });

        document.getElementById("stopButton").addEventListener("click", function() {
            if (html5QrcodeScanner) {
                html5QrcodeScanner.clear();
                html5QrcodeScanner = null;

                document.getElementById("startButton").classList.remove("hidden");
                document.getElementById("stopButton").classList.add("hidden");

                // Clear any status messages
                const existingStatus = document.getElementById('scan-status');
                if (existingStatus) {
                    existingStatus.remove();
                }
            }
        });
    </script>
</x-student-layout>
