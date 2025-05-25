@props(['subject'])
<x-app-layout>
    <!-- Header Section with Gradient Background -->
    <div class="bg-gradient-to-br from-amber-50 via-white to-orange-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <!-- Page Badge -->
                <div
                    class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-gradient-to-r from-amber-100 to-orange-100 text-amber-800 border border-amber-200 mb-4">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                    Edit Mata Pelajaran
                </div>

                <!-- Main Title -->
                <h1 class="text-4xl font-bold text-gray-900 mb-3">
                    <span class="bg-gradient-to-r from-amber-600 to-orange-600 bg-clip-text text-transparent">
                        Edit Mata Pelajaran
                    </span>
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Perbarui informasi mata pelajaran <span
                        class="font-semibold text-amber-600">{{ $subject->subject_name }}</span>
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Back Button -->
        <div class="mb-8">
            <a href="{{ route('admin.subjects.index') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm hover:shadow-md">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar Mata Pelajaran
            </a>
        </div>

        <!-- Main Form Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-amber-50 to-orange-50 p-6 border-b border-gray-200">
                <div class="flex items-center gap-3">
                    <div class="rounded-full bg-amber-100 p-3 text-amber-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Informasi Mata Pelajaran</h2>
                        <p class="text-sm text-gray-600">Perbarui data mata pelajaran</p>
                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <form action="{{ route('admin.subjects.update', $subject) }}" method="POST" class="p-6"
                id="editSubjectForm">
                @csrf
                @method('PUT')
                <div class="grid gap-6 md:grid-cols-2">
                    <!-- Kode Mata Pelajaran -->
                    <div class="space-y-2">
                        <label for="code_subject" class="block text-sm font-medium text-gray-700">
                            Kode Mata Pelajaran <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="code_subject" id="code_subject"
                            value="{{ old('code_subject', $subject->code_subject) }}" placeholder="Contoh: MTK001"
                            class="w-full rounded-xl border @error('code_subject') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror bg-gray-50 px-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 transition-all duration-200">
                        @error('code_subject')
                            <p class="mt-1 text-sm text-red-500 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Nama Mata Pelajaran -->
                    <div class="space-y-2">
                        <label for="subject_name" class="block text-sm font-medium text-gray-700">
                            Nama Mata Pelajaran <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="subject_name" id="subject_name"
                            value="{{ old('subject_name', $subject->subject_name) }}" placeholder="Contoh: Matematika"
                            class="w-full rounded-xl border @error('subject_name') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror bg-gray-50 px-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 transition-all duration-200">
                        @error('subject_name')
                            <p class="mt-1 text-sm text-red-500 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="space-y-2 md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700">
                            Deskripsi
                        </label>
                        <textarea name="description" id="description" rows="4" placeholder="Deskripsi singkat tentang mata pelajaran..."
                            class="w-full rounded-xl border @error('description') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror bg-gray-50 px-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 transition-all duration-200 resize-none">{{ old('description', $subject->description) }}</textarea>
                        <p class="text-xs text-gray-500">Berikan deskripsi singkat tentang mata pelajaran (opsional)</p>
                        @error('description')
                            <p class="mt-1 text-sm text-red-500 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.subjects.index') }}"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm hover:shadow-md">
                        Batal
                    </a>
                    <button type="submit" id="submitBtn"
                        class="inline-flex items-center px-6 py-2 text-sm font-medium text-white bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-700 hover:to-orange-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed">
                        <svg class="w-5 h-5 mr-2 hidden" id="loadingIcon" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                        <svg class="w-5 h-5 mr-2" id="defaultIcon" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <span id="btnText">Simpan Perubahan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('editSubjectForm');
                const submitBtn = document.getElementById('submitBtn');
                const loadingIcon = document.getElementById('loadingIcon');
                const defaultIcon = document.getElementById('defaultIcon');
                const btnText = document.getElementById('btnText');

                form.addEventListener('submit', function() {
                    submitBtn.disabled = true;
                    loadingIcon.classList.remove('hidden');
                    defaultIcon.classList.add('hidden');
                    btnText.textContent = 'Menyimpan...';
                });
            });
        </script>
    @endpush
</x-app-layout>
