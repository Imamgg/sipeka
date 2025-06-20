<x-teacher-layout>
    <div class="p-6">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Absensi</h1>
                    <p class="text-gray-600">Kelola sesi absensi dengan QR code untuk siswa</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('teacher.attendance.create-qr') }}"
                        class="bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white px-6 py-3 rounded-lg font-semibold transform hover:scale-105 transition-all duration-200 shadow-lg flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Buat Absensi
                    </a>
                </div>
            </div>
        </div>

        <!-- Active QR Sessions -->
        @if ($activeQrSessions && $activeQrSessions->count() > 0)
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-gray-900">QR Sessions Aktif</h2>
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                        {{ $activeQrSessions->count() }} session aktif
                    </span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($activeQrSessions as $session)
                        <div
                            class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg border border-green-100 p-4">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center mb-2">
                                        <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse mr-2"></div>
                                        <h3 class="font-semibold text-gray-900">{{ $session->topic ?: 'QR Session' }}
                                        </h3>
                                    </div>
                                    <div class="text-sm text-gray-600 space-y-1">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                            {{ $session->classes->class_name ?? 'N/A' }}
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                            {{ $session->subject->subject_name ?? 'N/A' }}
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ \Carbon\Carbon::parse($session->date)->format('d M Y') }}
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ \Carbon\Carbon::parse($session->start_time)->format('H:i') }} -
                                            {{ \Carbon\Carbon::parse($session->end_time)->format('H:i') }}
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('teacher.attendance.show', $session->id) }}"
                                    class="ml-2 bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition-colors">
                                    Lihat QR
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Filters -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 mb-8">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kelas</label>
                    <select name="class_id"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                        <option value="">Semua Kelas</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}" {{ $selectedClass == $class->id ? 'selected' : '' }}>
                                {{ $class->class_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Mata Pelajaran</label>
                    <select name="subject_id"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                        <option value="">Semua Mapel</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}"
                                {{ $selectedSubject == $subject->id ? 'selected' : '' }}>
                                {{ $subject->subject_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Dari Tanggal</label>
                    <input type="date" name="date_from" value="{{ $dateFrom }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Sampai Tanggal</label>
                    <input type="date" name="date_to" value="{{ $dateTo }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                    <select name="status"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                        <option value="">Semua Status</option>
                        <option value="active" {{ $status == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ $status == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>

                <div class="md:col-span-5">
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                        Filter
                    </button>
                    <a href="{{ route('teacher.attendance.index') }}"
                        class="ml-2 bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Sessions List -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="text-left py-4 px-6 font-semibold text-gray-900">Sesi</th>
                            <th class="text-left py-4 px-6 font-semibold text-gray-900">Kelas & Mapel</th>
                            <th class="text-left py-4 px-6 font-semibold text-gray-900">Tanggal & Waktu</th>
                            <th class="text-left py-4 px-6 font-semibold text-gray-900">Status</th>
                            <th class="text-left py-4 px-6 font-semibold text-gray-900">Kehadiran</th>
                            <th class="text-center py-4 px-6 font-semibold text-gray-900">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($attendances as $attendance)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-4 px-6">
                                    <div>
                                        <div class="font-semibold text-gray-900">{{ $attendance->topic }}</div>
                                        <div class="text-sm text-gray-500">{{ $attendance->qr_code_token }}</div>
                                        <div class="text-sm text-gray-600 mt-1">{{ $attendance->note }}</div>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="font-semibold text-gray-900">{{ $attendance->classes->class_name }}
                                    </div>
                                    <div class="text-sm text-gray-500">{{ $attendance->subject->subject_name }}</div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="font-semibold text-gray-900">
                                        {{ \Carbon\Carbon::parse($attendance->date)->timezone('Asia/Jakarta')->format('d M Y') }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($attendance->start_time)->format('H:i') }}
                                        -
                                        {{ \Carbon\Carbon::parse($attendance->end_time)->format('H:i') }}
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <span
                                        class="{{ $attendance->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} px-3 py-1 rounded-full text-sm font-medium">
                                        {{ $attendance->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                    </span>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center space-x-2">
                                        <div class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-medium">
                                            {{ $attendance->present_count }} Hadir</div>
                                        <div
                                            class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs font-medium">
                                            {{ $attendance->late_count }} Terlambat</div>
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">Rate: {{ $attendance->attendance_rate }}%
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('teacher.attendance.show', $attendance->id) }}"
                                            class="bg-blue-100 hover:bg-blue-200 text-blue-800 p-2 rounded-lg transition-colors"
                                            title="Lihat Detail">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('teacher.attendance.toggle', $attendance->id) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="{{ $attendance->is_active ? 'bg-red-100 hover:bg-red-200 text-red-800' : 'bg-green-100 hover:bg-green-200 text-green-800' }} p-2 rounded-lg transition-colors"
                                                title="{{ $attendance->is_active ? 'Deaktivasi' : 'Aktivasi' }}">
                                                @if ($attendance->is_active)
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                @else
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                @endif
                                            </button>
                                        </form>
                                        <form action="{{ route('teacher.attendance.destroy', $attendance->id) }}"
                                            method="POST" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="bg-red-100 hover:bg-red-200 text-red-800 p-2 rounded-lg transition-colors delete-btn"
                                                title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-6 text-center text-gray-500">Tidak ada sesi absensi yang
                                    ditemukan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const deleteButtons = document.querySelectorAll('.delete-btn');
                deleteButtons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        const form = this.closest('form');
                        e.preventDefault();
                        Swal.fire({
                            title: 'Hapus Sesi Absensi?',
                            text: "Sesi absensi yang dihapus tidak dapat dikembalikan! Semua data kehadiran pada sesi ini akan hilang.",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#dc2626',
                            cancelButtonColor: '#6b7280',
                            confirmButtonText: 'Ya, Hapus!',
                            cancelButtonText: 'Batal',
                            reverseButtons: true,
                            customClass: {
                                popup: 'rounded-2xl border-0 shadow-2xl',
                                confirmButton: 'rounded-xl px-6 py-3 font-semibold',
                                cancelButton: 'rounded-xl px-6 py-3 font-semibold'
                            },
                            focusConfirm: false,
                            focusCancel: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire({
                                    title: 'Menghapus Sesi...',
                                    text: 'Sedang memproses penghapusan sesi absensi',
                                    icon: 'info',
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    showConfirmButton: false,
                                    customClass: {
                                        popup: 'rounded-2xl border-0 shadow-2xl'
                                    },
                                    didOpen: () => {
                                        Swal.showLoading();
                                    }
                                });
                                form.submit();
                            }
                        });
                    });
                });
            });
        </script>
    @endpush
</x-teacher-layout>
