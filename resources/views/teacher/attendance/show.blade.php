<x-teacher-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200 flex flex-col sm:flex-row sm:justify-between sm:items-center">
                <h3 class="text-lg font-medium text-gray-900 mb-4 sm:mb-0">QR Attendance Session Details</h3>
                <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
                    @if ($session->status === 'pending')
                        <form action="{{ route('teacher.qr-attendance.start', $session) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="w-full sm:w-auto bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                                <i class="fas fa-play mr-1"></i> Start Session
                            </button>
                        </form>
                    @elseif($session->status === 'active')
                        <form action="{{ route('teacher.qr-attendance.end', $session) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="w-full sm:w-auto bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                                <i class="fas fa-stop mr-1"></i> End Session
                            </button>
                        </form>
                    @endif
                    <a href="{{ route('teacher.qr-attendance.index') }}"
                        class="w-full sm:w-auto bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200 text-center">
                        <i class="fas fa-arrow-left mr-1"></i> Back to Sessions
                    </a>
                </div>
            </div>
            <div class="p-6">
                <!-- Session Information -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <div class="lg:col-span-2">
                        <div class="bg-blue-50 border-l-4 border-blue-400 rounded-lg p-6">
                            <h4 class="text-xl font-semibold text-gray-900 mb-4">{{ $session->subject->subject_name }} -
                                {{ $session->class->class_name }}</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-3">
                                    <p class="text-sm"><span class="font-medium text-gray-700">Date:</span> <span
                                            class="text-gray-900">{{ $session->date->format('l, F j, Y') }}</span>
                                    </p>
                                    <p class="text-sm"><span class="font-medium text-gray-700">Duration:</span> <span
                                            class="text-gray-900">{{ $session->duration_minutes }} minutes</span></p>
                                    <p class="text-sm"><span class="font-medium text-gray-700">Late Threshold:</span>
                                        <span class="text-gray-900">{{ $session->late_threshold_minutes }}
                                            minutes</span>
                                    </p>
                                    @if ($session->location)
                                        <p class="text-sm"><span class="font-medium text-gray-700">Location:</span>
                                            <span class="text-gray-900">{{ $session->location }}</span>
                                        </p>
                                    @endif
                                </div>
                                <div class="space-y-3">
                                    <p class="text-sm">
                                        <span class="font-medium text-gray-700">Status:</span>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $session->status === 'active' ? 'bg-green-100 text-green-800' : ($session->status === 'completed' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                            {{ ucfirst($session->status) }}
                                        </span>
                                    </p>
                                    @if ($session->started_at)
                                        <p class="text-sm"><span class="font-medium text-gray-700">Started:</span> <span
                                                class="text-gray-900">{{ \Carbon\Carbon::parse($session->started_at)->setTimezone('Asia/Jakarta')->locale('id')->translatedFormat('H:i:s') }}</span>
                                        </p>
                                    @endif
                                    @if ($session->ended_at)
                                        <p class="text-sm"><span class="font-medium text-gray-700">Ended:</span> <span
                                                class="text-gray-900">{{ \Carbon\Carbon::parse($session->ended_at)->setTimezone('Asia/Jakarta')->locale('id')->translatedFormat('H:i:s') }}</span>
                                        </p>
                                    @endif
                                </div>
                            </div>

                            @if ($session->description)
                                <p class="text-sm mt-4"><span class="font-medium text-gray-700">Description:</span>
                                    <span class="text-gray-900">{{ $session->description }}</span>
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- QR Code Display -->
                    <div class="lg:col-span-1">
                        <div class="text-center">
                            @if ($session->status === 'active')
                                <div class="qr-code-container">
                                    <h5 class="text-lg font-medium text-gray-900 mb-4">Scan QR Code for Attendance</h5>
                                    <div
                                        class="qr-code-wrapper p-4 bg-white border-2 border-gray-200 rounded-lg shadow-sm mx-auto max-w-xs">
                                        {!! $session->getQrCode() !!}
                                    </div>
                                    <p class="text-gray-500 mt-3 text-sm">
                                        Valid until:
                                        {{ $session->started_at->addMinutes($session->duration_minutes)->setTimezone('Asia/Jakarta')->locale('id')->translatedFormat('H:i:s') }}
                                    </p>
                                    <button
                                        class="mt-3 bg-blue-100 hover:bg-blue-200 text-blue-700 px-3 py-1 rounded-md text-sm font-medium transition-colors duration-200"
                                        onclick="refreshQrCode()">
                                        <i class="fas fa-sync mr-1"></i> Refresh
                                    </button>
                                </div>
                            @else
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                    <i class="fas fa-info-circle text-blue-400 text-lg mb-2"></i>
                                    <p class="text-blue-700 text-sm">QR Code will be displayed when session is active
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Attendance Statistics -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <h3 class="text-2xl font-bold text-green-600">{{ $attendanceStats['present'] }}</h3>
                                <p class="text-green-700 text-sm font-medium">Present</p>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="fas fa-check text-green-400 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <h3 class="text-2xl font-bold text-yellow-600">{{ $attendanceStats['late'] }}</h3>
                                <p class="text-yellow-700 text-sm font-medium">Late</p>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="fas fa-clock text-yellow-400 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <h3 class="text-2xl font-bold text-red-600">{{ $attendanceStats['absent'] }}</h3>
                                <p class="text-red-700 text-sm font-medium">Absent</p>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="fas fa-times text-red-400 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <h3 class="text-2xl font-bold text-blue-600">{{ $attendanceStats['total'] }}</h3>
                                <p class="text-blue-700 text-sm font-medium">Total Students</p>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="fas fa-users text-blue-400 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Attendance List -->
                <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                    <div
                        class="px-6 py-4 border-b border-gray-200 flex flex-col sm:flex-row sm:justify-between sm:items-center">
                        <h5 class="text-lg font-medium text-gray-900 mb-2 sm:mb-0">Student Attendance</h5>
                        <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
                            <button
                                class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-md text-sm font-medium transition-colors duration-200"
                                onclick="refreshAttendance()">
                                <i class="fas fa-sync mr-1"></i> Refresh
                            </button>
                            @if ($session->status === 'completed')
                                <a href="{{ route('teacher.qr-attendance.export', $session) }}"
                                    class="w-full sm:w-auto bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-md text-sm font-medium transition-colors duration-200 text-center">
                                    <i class="fas fa-download mr-1"></i> Export
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200" id="attendanceTable">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Student ID</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Name</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Scan Time</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Delay</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($students as $student)
                                        @php
                                            $attendance = $studentAttendances
                                                ->where('student_id', $student->id)
                                                ->first();
                                        @endphp
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $student->student_id }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $student->user->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($attendance)
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $attendance->status === 'present' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                        {{ ucfirst($attendance->status) }}
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Absent</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                @if ($attendance && $attendance->scanned_at)
                                                    {{ $attendance->scanned_at->format('H:i:s') }}
                                                @else
                                                    <span class="text-gray-400">-</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                @if ($attendance && $attendance->scanned_at && $session->started_at)
                                                    @php
                                                        $delay = $session->started_at->diffInMinutes(
                                                            $attendance->scanned_at,
                                                        );
                                                    @endphp
                                                    @if ($delay > 0)
                                                        <span
                                                            class="{{ $delay > $session->late_threshold_minutes ? 'text-red-600' : 'text-yellow-600' }} font-medium">
                                                            +{{ $delay }} min
                                                        </span>
                                                    @else
                                                        <span class="text-green-600 font-medium">On time</span>
                                                    @endif
                                                @else
                                                    <span class="text-gray-400">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .qr-code-container {
            max-width: 300px;
            margin: 0 auto;
        }

        .qr-code-wrapper svg {
            width: 100%;
            height: auto;
            max-width: 200px;
        }

        /* Custom scrollbar for table */
        .overflow-x-auto::-webkit-scrollbar {
            height: 8px;
        }

        .overflow-x-auto::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>

    @push('scripts')
        <script>
            function refreshQrCode() {
                location.reload();
            }

            function refreshAttendance() {
                location.reload();
            }

            // Auto-refresh every 30 seconds if session is active
            @if ($session->status === 'active')
                setInterval(function() {
                    location.reload();
                }, 30000);
            @endif

            $(document).ready(function() {
                $('#attendanceTable').DataTable({
                    "pageLength": 25,
                    "order": [
                        [1, "asc"]
                    ],
                    "columnDefs": [{
                        "orderable": false,
                        "targets": [2, 3, 4]
                    }],
                    "dom": '<"flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4"<"mb-2 sm:mb-0"l><"mb-2 sm:mb-0"f>>rtip',
                    "language": {
                        "lengthMenu": "Show _MENU_ entries",
                        "search": "Search:",
                        "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                        "infoEmpty": "Showing 0 to 0 of 0 entries",
                        "infoFiltered": "(filtered from _MAX_ total entries)",
                        "paginate": {
                            "first": "First",
                            "last": "Last",
                            "next": "Next",
                            "previous": "Previous"
                        }
                    }
                });

                // Custom DataTable styling
                $('#attendanceTable_wrapper .dataTables_length select').addClass(
                    'border border-gray-300 rounded-md px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500'
                );
                $('#attendanceTable_wrapper .dataTables_filter input').addClass(
                    'border border-gray-300 rounded-md px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500'
                );
                $('#attendanceTable_wrapper .dataTables_paginate .paginate_button').addClass(
                    'px-3 py-1 text-sm border border-gray-300 bg-white hover:bg-gray-50 transition-colors duration-200'
                );
                $('#attendanceTable_wrapper .dataTables_paginate .paginate_button.current').addClass(
                    'bg-blue-600 text-white border-blue-600 hover:bg-blue-700');
            });
        </script>
    @endpush
</x-teacher-layout>
