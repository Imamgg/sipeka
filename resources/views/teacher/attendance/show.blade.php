<x-teacher-layout>
    <div class="p-6">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Detail Sesi QR</h1>
                    <p class="text-gray-600">{{ $attendance->topic }}</p>
                </div>
                <a href="{{ route('teacher.attendance.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- QR Code Card -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                <div class="text-center">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">QR Code Absensi</h2>
                    <div class="flex justify-center mb-4">
                        {!! $qrCode !!}
                    </div>
                    <p class="text-gray-500 mb-2">Scan QR code ini untuk absensi</p>
                    <p class="text-sm text-gray-500 mb-4">Token: <span
                            class="font-mono">{{ $attendance->qr_code_token }}</span></p>

                    <div>
                        <a href="{{ route('teacher.attendance.export-session', $attendance->id) }}"
                            class="bg-green-100 hover:bg-green-200 text-green-800 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Export CSV
                        </a>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-100">
                    <h3 class="font-semibold text-gray-700 mb-3">Status Sesi</h3>
                    <form action="{{ route('teacher.attendance.toggle', $attendance->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full {{ $attendance->is_active ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} text-white px-4 py-2 rounded-lg font-medium transition-colors">
                            {{ $attendance->is_active ? 'Nonaktifkan QR Code' : 'Aktifkan QR Code' }}
                        </button>
                    </form>

                    <div class="mt-3">
                        <form action="{{ route('teacher.attendance.send-notifications', $attendance->id) }}"
                            method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg font-medium transition-colors flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                                Kirim Notifikasi Ketidakhadiran
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Session Info Card -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Informasi Sesi</h2>

                <div class="space-y-4">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500">Kelas</h3>
                        <p class="text-gray-900">{{ $attendance->classes->class_name }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-500">Mata Pelajaran</h3>
                        <p class="text-gray-900">{{ $attendance->subject->subject_name }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-500">Tanggal</h3>
                        <p class="text-gray-900">
                            {{ \Carbon\Carbon::parse($attendance->date)->timezone('Asia/Jakarta')->format('d F Y') }}
                        </p>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-500">Waktu</h3>
                        <p class="text-gray-900">
                            {{ \Carbon\Carbon::parse($attendance->start_time)->timezone('Asia/Jakarta')->format('H:i') }}
                            -
                            {{ \Carbon\Carbon::parse($attendance->end_time)->timezone('Asia/Jakarta')->format('H:i') }}
                        </p>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-500">Status</h3>
                        <p
                            class="inline-block {{ $attendance->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} px-3 py-1 rounded-full text-sm font-medium">
                            {{ $attendance->is_active ? 'Aktif' : 'Tidak Aktif' }}
                        </p>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-500">Deskripsi</h3>
                        <p class="text-gray-900">{{ $attendance->note ?? '-' }}</p>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-100">
                    <h3 class="font-semibold text-gray-700 mb-3">Statistik Kehadiran</h3>

                    <div class="grid grid-cols-2 gap-2">
                        <div class="bg-green-50 p-3 rounded-lg text-center">
                            <span class="block text-2xl font-bold text-green-700">{{ $presentCount }}</span>
                            <span class="text-sm text-green-600">Hadir</span>
                        </div>

                        <div class="bg-yellow-50 p-3 rounded-lg text-center">
                            <span class="block text-2xl font-bold text-yellow-700">{{ $lateCount }}</span>
                            <span class="text-sm text-yellow-600">Terlambat</span>
                        </div>

                        <div class="bg-red-50 p-3 rounded-lg text-center">
                            <span class="block text-2xl font-bold text-red-700">{{ $absentCount }}</span>
                            <span class="text-sm text-red-600">Tidak Hadir</span>
                        </div>

                        <div class="bg-blue-50 p-3 rounded-lg text-center">
                            <span class="block text-2xl font-bold text-blue-700">{{ $attendanceRate }}%</span>
                            <span class="text-sm text-blue-600">Kehadiran</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Student List Card -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 h-full">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Daftar Siswa</h2>

                    <div class="relative overflow-y-auto" style="max-height: 500px;">
                        <table class="w-full">
                            <thead class="bg-gray-50 sticky top-0">
                                <tr>
                                    <th class="text-left py-3 px-4 font-semibold text-gray-900">Siswa</th>
                                    <th class="text-center py-3 px-4 font-semibold text-gray-900">Status</th>
                                    <th class="text-center py-3 px-4 font-semibold text-gray-900">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($attendance->presenceDetails as $detail)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-3 px-4">
                                            <div class="font-semibold text-gray-900">
                                                {{ $detail->student->user->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $detail->student->nisn }}</div>
                                        </td>
                                        <td class="py-3 px-4 text-center">
                                            @if ($detail->status == 'present')
                                                <span
                                                    class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">Hadir</span>
                                            @elseif($detail->status == 'absent')
                                                <span
                                                    class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-medium">Tidak
                                                    Hadir</span>
                                            @elseif($detail->status == 'sick')
                                                <span
                                                    class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium">Sakit</span>
                                            @elseif($detail->status == 'permission')
                                                <span
                                                    class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full text-xs font-medium">Izin</span>
                                            @endif

                                            @if ($detail->verification_status == 'verified')
                                                <div class="text-xs text-gray-500 mt-1">
                                                    {{ \Carbon\Carbon::parse($detail->verified_at)->timezone('Asia/Jakarta')->format('H:i') }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="py-3 px-4 text-center">
                                            <button type="button"
                                                onclick="showUpdateModal('{{ $detail->student->id }}', '{{ $detail->student->user->name }}')"
                                                class="bg-indigo-100 hover:bg-indigo-200 text-indigo-800 p-2 rounded-lg transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                    </path>
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- Update Status Modal -->
    <div id="updateModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center">
        <div class="bg-white rounded-xl shadow-xl max-w-md w-full mx-4">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-900">Update Status Kehadiran</h3>
                    <button type="button" onclick="hideUpdateModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <p class="mb-4">Update status kehadiran untuk: <span id="studentName" class="font-semibold"></span>
                </p>

                <form id="updateStatusForm" action="" method="POST">
                    @csrf
                    <input type="hidden" id="studentId" name="student_id">

                    <div class="mb-4"> <label class="block text-sm font-semibold text-gray-700 mb-2">Status
                            Kehadiran</label>
                        <select name="status"
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                            <option value="present">Hadir</option>
                            <option value="absent">Tidak Hadir</option>
                            <option value="permission">Izin</option>
                            <option value="sick">Sakit</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan (Opsional)</label>
                        <input type="text" name="note"
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <div class="flex justify-end space-x-2">
                        <button type="button" onclick="hideUpdateModal()"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            Batal
                        </button>
                        <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function showUpdateModal(studentId, studentName) {
            document.getElementById('studentId').value = studentId;
            document.getElementById('studentName').textContent = studentName;
            document.getElementById('updateStatusForm').action =
                "{{ route('teacher.attendance.update-student', $attendance->id) }}";
            const modal = document.getElementById('updateModal');
            modal.classList.remove('hidden');
            modal.style.display = 'flex';
        }

        function hideUpdateModal() {
            const modal = document.getElementById('updateModal');
            modal.classList.add('hidden');
            modal.style.display = 'none';
        }

        // Close modal when clicking outside
        document.getElementById('updateModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideUpdateModal();
            }
        });
    </script>
</x-teacher-layout>
