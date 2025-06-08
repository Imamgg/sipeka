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

        <!-- Top Section: QR Code and Session Info -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- QR Code Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="text-center">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">QR Code Absensi</h2>
                    <div class="flex justify-center mb-6">
                        {!! $qrCode !!}
                    </div>
                    <p class="text-gray-600 mb-2">Scan QR code ini untuk absensi</p>
                    <p class="text-sm text-gray-500 mb-6">
                        Token: <span
                            class="font-mono bg-gray-100 px-2 py-1 rounded">{{ $attendance->qr_code_token }}</span>
                    </p>

                    <!-- Action Buttons -->
                    <div class="space-y-3">
                        <a href="{{ route('teacher.attendance.export-session', $attendance->id) }}"
                            class="inline-flex items-center justify-center w-full bg-emerald-50 hover:bg-emerald-100 text-emerald-700 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Export CSV
                        </a>

                        <form action="{{ route('teacher.attendance.toggle', $attendance->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full {{ $attendance->is_active ? 'bg-red-50 hover:bg-red-100 text-red-700' : 'bg-green-50 hover:bg-green-100 text-green-700' }} px-4 py-2.5 rounded-lg font-medium transition-colors">
                                {{ $attendance->is_active ? 'Nonaktifkan QR Code' : 'Aktifkan QR Code' }}
                            </button>
                        </form>

                        <form action="{{ route('teacher.attendance.send-notifications', $attendance->id) }}"
                            method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full bg-amber-50 hover:bg-amber-100 text-amber-700 px-4 py-2.5 rounded-lg font-medium transition-colors flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                                Kirim Notifikasi
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Session Info Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Informasi Sesi</h2>

                <div class="space-y-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-1">Kelas</h3>
                            <p class="text-gray-900 font-medium">{{ $attendance->classes->class_name }}</p>
                        </div>
                        <div class="text-right">
                            <h3 class="text-sm font-medium text-gray-500 mb-1">Status</h3>
                            <span
                                class="inline-flex items-center {{ $attendance->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} px-2.5 py-1 rounded-full text-xs font-medium">
                                {{ $attendance->is_active ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-1">Mata Pelajaran</h3>
                            <p class="text-gray-900 font-medium">{{ $attendance->subject->subject_name }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-1">Tanggal</h3>
                            <p class="text-gray-900 font-medium">
                                {{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}
                            </p>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500 mb-1">Waktu</h3>
                        <p class="text-gray-900 font-medium">
                            {{ \Carbon\Carbon::parse($attendance->start_time)->format('H:i') }}
                            -
                            {{ \Carbon\Carbon::parse($attendance->end_time)->format('H:i') }}
                        </p>
                    </div>

                    @if ($attendance->note)
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-1">Deskripsi</h3>
                            <p class="text-gray-900">{{ $attendance->note }}</p>
                        </div>
                    @endif
                </div>

                <!-- Statistics -->
                <div class="mt-6 pt-6 border-t border-gray-100">
                    <h3 class="font-medium text-gray-900 mb-4">Statistik Kehadiran</h3>
                    <div class="grid grid-cols-4 gap-3">
                        <div class="text-center">
                            <div
                                class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                                <span class="text-lg font-bold text-green-700">{{ $presentCount }}</span>
                            </div>
                            <span class="text-xs text-gray-600">Hadir</span>
                        </div>
                        <div class="text-center">
                            <div
                                class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                                <span class="text-lg font-bold text-yellow-700">{{ $lateCount }}</span>
                            </div>
                            <span class="text-xs text-gray-600">Terlambat</span>
                        </div>
                        <div class="text-center">
                            <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                                <span class="text-lg font-bold text-red-700">{{ $absentCount }}</span>
                            </div>
                            <span class="text-xs text-gray-600">Tidak Hadir</span>
                        </div>
                        <div class="text-center">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                                <span class="text-lg font-bold text-blue-700">{{ $attendanceRate }}%</span>
                            </div>
                            <span class="text-xs text-gray-600">Kehadiran</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Student List Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Daftar Siswa</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="text-left py-4 px-6 font-medium text-gray-900">Siswa</th>
                            <th class="text-center py-4 px-6 font-medium text-gray-900">Status</th>
                            <th class="text-center py-4 px-6 font-medium text-gray-900">Waktu</th>
                            <th class="text-center py-4 px-6 font-medium text-gray-900">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($attendance->presenceDetails as $detail)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-4 px-6">
                                    <div class="font-medium text-gray-900">{{ $detail->student->user->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $detail->student->nisn }}</div>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    @if ($detail->status == 'present')
                                        <span
                                            class="inline-flex items-center bg-green-100 text-green-800 px-2.5 py-1 rounded-full text-xs font-medium">
                                            Hadir
                                        </span>
                                    @elseif($detail->status == 'absent')
                                        <span
                                            class="inline-flex items-center bg-red-100 text-red-800 px-2.5 py-1 rounded-full text-xs font-medium">
                                            Tidak Hadir
                                        </span>
                                    @elseif($detail->status == 'sick')
                                        <span
                                            class="inline-flex items-center bg-blue-100 text-blue-800 px-2.5 py-1 rounded-full text-xs font-medium">
                                            Sakit
                                        </span>
                                    @elseif($detail->status == 'permission')
                                        <span
                                            class="inline-flex items-center bg-purple-100 text-purple-800 px-2.5 py-1 rounded-full text-xs font-medium">
                                            Izin
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-center">
                                    @if ($detail->verification_status == 'verified')
                                        <span class="text-sm text-gray-600">
                                            {{ \Carbon\Carbon::parse($detail->verified_at)->timezone('Asia/Jakarta')->format('H:i') }}
                                        </span>
                                    @else
                                        <span class="text-sm text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <button type="button"
                                        onclick="showUpdateModal('{{ $detail->student->id }}', '{{ $detail->student->user->name }}')"
                                        class="inline-flex items-center justify-center w-8 h-8 bg-indigo-100 hover:bg-indigo-200 text-indigo-700 rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
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
    </div> <!-- Update Status Modal -->
    <div id="updateModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-xl max-w-md w-full">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-semibold text-gray-900">Update Status Kehadiran</h3>
                    <button type="button" onclick="hideUpdateModal()"
                        class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="mb-6">
                    <p class="text-gray-600">Update status kehadiran untuk:</p>
                    <p class="font-semibold text-gray-900" id="studentName"></p>
                </div>

                <form id="updateStatusForm" action="" method="POST">
                    @csrf
                    <input type="hidden" id="studentId" name="student_id">

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status Kehadiran</label>
                        <select name="status"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                            <option value="present">Hadir</option>
                            <option value="absent">Tidak Hadir</option>
                            <option value="permission">Izin</option>
                            <option value="sick">Sakit</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Catatan (Opsional)</label>
                        <input type="text" name="note"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                            placeholder="Masukkan catatan...">
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="hideUpdateModal()"
                            class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors">
                            Batal
                        </button>
                        <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2.5 rounded-lg text-sm font-medium transition-colors">
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
