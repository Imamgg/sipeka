<x-teacher-layout>
    <div class="p-6">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">QR Code Attendance</h1>
                    <p class="text-gray-600">Kelola sesi absensi dengan QR code untuk siswa</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('teacher.attendance.export', [
                        'class_id' => $selectedClass,
                        'subject_id' => $selectedSubject,
                        'date_from' => $dateFrom,
                        'date_to' => $dateTo,
                        'status' => $status,
                    ]) }}"
                        class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-lg font-semibold shadow-md flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        Export CSV
                    </a>
                    <a href="{{ route('teacher.attendance.create-qr') }}"
                        class="bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white px-6 py-3 rounded-lg font-semibold transform hover:scale-105 transition-all duration-200 shadow-lg flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Buat Sesi QR Baru
                    </a>
                </div>
            </div>
        </div>

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
                                        {{ \Carbon\Carbon::parse($attendance->start_time)->timezone('Asia/Jakarta')->format('H:i') }}
                                        -
                                        {{ \Carbon\Carbon::parse($attendance->end_time)->timezone('Asia/Jakarta')->format('H:i') }}
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
                                            method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus sesi ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-100 hover:bg-red-200 text-red-800 p-2 rounded-lg transition-colors"
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
</x-teacher-layout>
