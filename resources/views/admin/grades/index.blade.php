<x-app-layout>
    <!-- Header Section -->
    <div
        class="bg-gradient-to-br from-blue-50 via-white to-indigo-50 relative overflow-hidden border-b border-gray-100 rounded-xl mb-6">
        <div class="absolute inset-0 bg-grid-pattern opacity-5"></div>
        <div class="relative px-6 py-8 sm:px-10">
            <div class="max-w-7xl mx-auto">
                <div class="text-center">
                    <div
                        class="inline-flex items-center px-4 py-2 rounded-full bg-blue-100 text-blue-700 text-sm font-medium mb-4">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Manajemen Nilai Siswa
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-3">
                        Data <span
                            class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Nilai
                            Siswa</span>
                    </h1>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">Monitor dan kelola nilai siswa dari seluruh mata
                        pelajaran dan kelas</p>
                </div>
            </div>
        </div>
    </div>

    <div class="px-6 py-8 space-y-8 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <!-- Filter Section -->
            <div
                class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200 mb-8">
                <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Filter & Pencarian</h3>
                            <p class="text-sm text-gray-500">Gunakan filter untuk mencari data nilai yang spesifik</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <form action="{{ route('admin.grades.index') }}" method="GET"
                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                        <div class="space-y-2">
                            <x-input-label for="verification_status" :value="__('Status Verifikasi')"
                                class="text-sm font-medium text-gray-700" />
                            <select id="verification_status" name="verification_status"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors duration-200">
                                <option value="all" {{ request('verification_status') == 'all' ? 'selected' : '' }}>
                                    Semua Status</option>
                                <option value="pending"
                                    {{ request('verification_status') == 'pending' ? 'selected' : '' }}>
                                    Menunggu Verifikasi</option>
                                <option value="verified"
                                    {{ request('verification_status') == 'verified' ? 'selected' : '' }}>
                                    Terverifikasi</option>
                                <option value="rejected"
                                    {{ request('verification_status') == 'rejected' ? 'selected' : '' }}>
                                    Ditolak</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <x-input-label for="teacher_id" :value="__('Guru')"
                                class="text-sm font-medium text-gray-700" />
                            <select id="teacher_id" name="teacher_id"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors duration-200">
                                <option value="">Semua Guru</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}"
                                        {{ request('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                        {{ $teacher->user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="space-y-2">
                            <x-input-label for="subject_id" :value="__('Mata Pelajaran')"
                                class="text-sm font-medium text-gray-700" />
                            <select id="subject_id" name="subject_id"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors duration-200">
                                <option value="">Semua Mata Pelajaran</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}"
                                        {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->subject_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="space-y-2">
                            <x-input-label for="class_id" :value="__('Kelas')" class="text-sm font-medium text-gray-700" />
                            <select id="class_id" name="class_id" class="mt-1 block w-full rounded-md border-gray-300">
                                <option value="">Semua Kelas</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}"
                                        {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                        {{ $class->class_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-end">
                            <x-primary-button type="submit" class="ml-4">
                                {{ __('Filter') }}
                            </x-primary-button>
                            <a href="{{ route('admin.grades.index') }}"
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
                                    Jenis Penilaian
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nilai
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($grades as $grade)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $grade->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $grade->student->user->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $grade->student->classes->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $grade->subject->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $grade->teacher->user->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $grade->type_assessment }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-bold {{ $grade->grade >= 75 ? 'text-green-600' : ($grade->grade >= 60 ? 'text-yellow-600' : 'text-red-600') }}">
                                        {{ $grade->grade }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($grade->verification_status == 'pending')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Menunggu Verifikasi
                                            </span>
                                        @elseif ($grade->verification_status == 'verified')
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
                                        <a href="{{ route('admin.grades.show', $grade) }}"
                                            class="text-indigo-600 hover:text-indigo-900">Detail</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-6 py-4 text-center text-sm text-gray-500">
                                        Tidak ada data nilai yang ditemukan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $grades->links() }}
                </div>
            </div>
</x-app-layout>
