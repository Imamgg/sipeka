<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <div class="mb-6">
            <form action="{{ route('admin.attendances.index') }}" method="GET"
                class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4">
                <div>
                    <x-input-label for="verification_status" :value="__('Status Verifikasi')" />
                    <select id="verification_status" name="verification_status"
                        class="mt-1 block w-full rounded-md border-gray-300">
                        <option value="all" {{ request('verification_status') == 'all' ? 'selected' : '' }}>
                            Semua</option>
                        <option value="pending" {{ request('verification_status') == 'pending' ? 'selected' : '' }}>
                            Menunggu
                            Verifikasi</option>
                        <option value="verified" {{ request('verification_status') == 'verified' ? 'selected' : '' }}>
                            Terverifikasi
                        </option>
                        <option value="rejected" {{ request('verification_status') == 'rejected' ? 'selected' : '' }}>
                            Ditolak
                        </option>
                    </select>
                </div>

                <div>
                    <x-input-label for="teacher_id" :value="__('Guru')" />
                    <select id="teacher_id" name="teacher_id" class="mt-1 block w-full rounded-md border-gray-300">
                        <option value="">Semua Guru</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}"
                                {{ request('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <x-input-label for="subject_id" :value="__('Mata Pelajaran')" />
                    <select id="subject_id" name="subject_id" class="mt-1 block w-full rounded-md border-gray-300">
                        <option value="">Semua Mata Pelajaran</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}"
                                {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <x-input-label for="class_id" :value="__('Kelas')" />
                    <select id="class_id" name="class_id" class="mt-1 block w-full rounded-md border-gray-300">
                        <option value="">Semua Kelas</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}"
                                {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                {{ $class->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <x-input-label for="date_from" :value="__('Tanggal Dari')" />
                    <input type="date" id="date_from" name="date_from" value="{{ request('date_from') }}"
                        class="mt-1 block w-full rounded-md border-gray-300">
                </div>

                <div>
                    <x-input-label for="date_to" :value="__('Tanggal Sampai')" />
                    <input type="date" id="date_to" name="date_to" value="{{ request('date_to') }}"
                        class="mt-1 block w-full rounded-md border-gray-300">
                </div>

                <div class="flex items-end col-span-full md:col-span-1">
                    <x-primary-button type="submit" class="ml-4">
                        {{ __('Filter') }}
                    </x-primary-button>
                    <a href="{{ route('admin.attendances.index') }}"
                        class="inline-flex items-center px-4 py-2 ml-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:ring ring-gray-300">
                        {{ __('Reset') }}
                    </a>
                </div>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Siswa
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kelas
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Mata Pelajaran
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Guru
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status Kehadiran
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status Verifikasi
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($attendances as $attendance)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $attendance->presence->date->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $attendance->student->user->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $attendance->student->class->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $attendance->presence->classSchedule->subject->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $attendance->presence->classSchedule->teacher->user->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($attendance->status == 'present')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Hadir
                                    </span>
                                @elseif ($attendance->status == 'absent')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Tidak Hadir
                                    </span>
                                @elseif ($attendance->status == 'sick')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Sakit
                                    </span>
                                @elseif ($attendance->status == 'permission')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        Izin
                                    </span>
                                @else
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        {{ $attendance->status }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($attendance->verification_status == 'pending')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Menunggu Verifikasi
                                    </span>
                                @elseif ($attendance->verification_status == 'verified')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Terverifikasi
                                    </span>
                                @else
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.attendances.show', $attendance) }}"
                                    class="text-indigo-600 hover:text-indigo-900">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">
                                Tidak ada data kehadiran yang ditemukan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $attendances->links() }}
        </div>
    </div>
</x-app-layout>
