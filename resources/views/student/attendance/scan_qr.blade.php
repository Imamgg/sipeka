<x-student-layout>
    <div class="p-6"> <!-- Error Messages -->
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
        @endif <!-- Info Messages -->
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

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md shadow-sm" role="alert">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">Ada kesalahan dalam pengiriman data:</p>
                        <ul class="mt-1 text-sm list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
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

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- QR Scanner Card -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4 text-center">Scanner QR Code</h2>

                <div class="flex flex-col items-center">
                    <div id="qr-reader" class="w-full max-w-md mb-4"></div>

                    <div class="text-center mb-6">
                        <p class="text-gray-500 mb-1">Arahkan kamera ke QR Code yang ditampilkan oleh guru</p>
                        <p class="text-sm text-gray-500">Pastikan QR Code terlihat jelas dan tidak terhalang</p>
                    </div>

                    <div class="flex flex-col space-y-2">
                        <button id="startButton"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                            Mulai Scan
                        </button>
                        <button id="stopButton"
                            class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg font-medium transition-colors hidden">
                            Berhenti Scan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Manual Entry Card -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4 text-center">Input Manual Token QR</h2>

                <form id="manualForm" action="{{ route('student.attendances.process-scan') }}" method="POST"
                    class="space-y-4">
                    @csrf
                    <div>
                        <label for="token" class="block text-sm font-semibold text-gray-700 mb-2">Token QR</label>
                        <input type="text" id="token" name="token" required
                            placeholder="Masukkan token QR (contoh: QR12345678)"
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                        @error('token')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                        Kirim
                    </button>
                </form>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h3 class="font-semibold text-gray-700 mb-3">Instruksi</h3>
                    <ol class="list-decimal list-inside space-y-2 text-gray-600 text-sm">
                        <li>Gunakan scanner QR code di sebelah kiri untuk scan otomatis</li>
                        <li>Jika scanner tidak berfungsi, minta token QR dari guru</li>
                        <li>Masukkan token QR pada form di atas</li>
                        <li>Klik tombol "Kirim" untuk mengirim absensi</li>
                    </ol>
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

            // Show loading state
            const submitBtn = document.querySelector('#manualForm button[type="submit"]');
            const originalBtnText = submitBtn.innerHTML;
            submitBtn.innerHTML =
                '<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Memproses...';

            // Handle the scanned code
            console.log(`Code matched = ${decodedText}`, decodedResult);

            // If URL contains a token parameter, extract it
            try {
                const url = new URL(decodedText);
                const token = url.searchParams.get("token");

                if (token) {
                    // Set the token in the manual form and submit
                    document.getElementById("token").value = token;
                } else {
                    // If token not found in URL params, use the entire decoded text
                    document.getElementById("token").value = decodedText;
                }
            } catch (e) {
                // If not a valid URL, use the entire decoded text
                document.getElementById("token").value = decodedText;
            }

            // Stop scanning while processing
            if (html5QrcodeScanner) {
                html5QrcodeScanner.pause();
            } // Submit the form
            document.getElementById("manualForm").submit();

            // Reset after a timeout (in case the form submission fails)
            setTimeout(() => {
                if (html5QrcodeScanner) {
                    html5QrcodeScanner.resume();
                }
                submitBtn.innerHTML = originalBtnText;
                processingQr = false;

                // Check if there are errors shown on the page
                if (document.querySelector('.bg-red-100')) {
                    showNotification('Terjadi kesalahan saat memproses QR code', 'error');
                }
            }, 5000);
        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // console.warn(`Code scan error = ${error}`);
        }

        // Function to display a temporary notification
        function showNotification(message, type = 'info') {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `fixed bottom-4 right-4 px-6 py-3 rounded-lg shadow-lg text-white ${
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
                    notification.remove();
                }, 500);
            }, 3000);
        }
        document.getElementById("startButton").addEventListener("click", function() {
            try {
                html5QrcodeScanner = new Html5QrcodeScanner(
                    "qr-reader", {
                        fps: 10,
                        qrbox: {
                            width: 250,
                            height: 250
                        }
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
                        document.getElementById("startButton").classList.remove("hidden");
                        document.getElementById("stopButton").classList.add("hidden");
                    }
                );

                document.getElementById("startButton").classList.add("hidden");
                document.getElementById("stopButton").classList.remove("hidden");
            } catch (error) {
                showNotification(`Gagal memulai scanner: ${error.message}`, 'error');
            }
        });

        document.getElementById("stopButton").addEventListener("click", function() {
            if (html5QrcodeScanner) {
                html5QrcodeScanner.clear();
                html5QrcodeScanner = null;

                document.getElementById("startButton").classList.remove("hidden");
                document.getElementById("stopButton").classList.add("hidden");
            }
        }); // Add loading state to manual form submission
        document.getElementById("manualForm").addEventListener("submit", function(e) {
            const form = this;
            const submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.innerHTML =
                '<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Memproses...';
            submitBtn.disabled = true;

            // Add a timeout to detect possible network issues
            const timeoutId = setTimeout(() => {
                if (submitBtn.disabled) {
                    submitBtn.innerHTML = 'Kirim';
                    submitBtn.disabled = false;
                    showNotification('Koneksi timeout. Silakan coba lagi.', 'error');
                }
            }, 15000); // 15 seconds timeout

            // Store timeout ID in a data attribute to clear it if needed
            form.dataset.timeoutId = timeoutId;
        });
    </script>
</x-student-layout>
