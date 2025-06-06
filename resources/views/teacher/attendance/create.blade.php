<x-teacher-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-white shadow-sm rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200 flex flex-col sm:flex-row sm:justify-between sm:items-center">
                <h3 class="text-lg font-medium text-gray-900 mb-4 sm:mb-0">Create New QR Attendance Session</h3>
                <a href="{{ route('teacher.qr-attendance.index') }}"
                    class="w-full sm:w-auto bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200 text-center">
                    <i class="fas fa-arrow-left mr-1"></i> Back to Sessions
                </a>
            </div>
            <div class="p-6">
                <form action="{{ route('teacher.qr-attendance.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="class_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Class <span class="text-red-500">*</span>
                            </label> <select name="class_id" id="class_id"
                                class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 {{ $errors->has('class_id') ? 'border-red-300' : 'border-gray-300' }}">
                                <option value="">Select Class</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}"
                                        {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                        {{ $class->class_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('class_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="subject_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Subject <span class="text-red-500">*</span>
                            </label> <select name="subject_id" id="subject_id"
                                class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 {{ $errors->has('subject_id') ? 'border-red-300' : 'border-gray-300' }}">
                                <option value="">Select Subject</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}"
                                        {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->subject_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('subject_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Session Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title" id="title"
                            class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 {{ $errors->has('title') ? 'border-red-300' : 'border-gray-300' }}"
                            value="{{ old('title') }}" maxlength="100"
                            placeholder="e.g., Mid-Semester Quiz, Class Discussion, Lab Session">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="session_date" class="block text-sm font-medium text-gray-700 mb-2">
                                Session Date <span class="text-red-500">*</span>
                            </label><input type="date" name="session_date" id="session_date"
                                class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 {{ $errors->has('session_date') ? 'border-red-300' : 'border-gray-300' }}"
                                value="{{ old('session_date', date('Y-m-d')) }}">
                            @error('session_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="start_time" class="block text-sm font-medium text-gray-700 mb-2">
                                Start Time <span class="text-red-500">*</span>
                            </label>
                            <input type="time" name="start_time" id="start_time"
                                class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 {{ $errors->has('start_time') ? 'border-red-300' : 'border-gray-300' }}"
                                value="{{ old('start_time', date('H:i')) }}">
                            @error('start_time')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="duration_minutes" class="block text-sm font-medium text-gray-700 mb-2">
                                Duration (Minutes) <span class="text-red-500">*</span>
                            </label> <input type="number" name="duration_minutes" id="duration_minutes"
                                class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 {{ $errors->has('duration_minutes') ? 'border-red-300' : 'border-gray-300' }}"
                                value="{{ old('duration_minutes', 90) }}" min="15" max="480">
                            @error('duration_minutes')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">How long the QR code will be valid for attendance</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="late_threshold_minutes" class="block text-sm font-medium text-gray-700 mb-2">
                                Late Threshold (Minutes)
                            </label> <input type="number" name="late_threshold_minutes" id="late_threshold_minutes"
                                class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 {{ $errors->has('late_threshold_minutes') ? 'border-red-300' : 'border-gray-300' }}"
                                value="{{ old('late_threshold_minutes', 15) }}" min="0" max="60">
                            @error('late_threshold_minutes')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">Minutes after session start when attendance is marked
                                as late</p>
                        </div>

                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                                Location
                            </label> <input type="text" name="location" id="location"
                                class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 {{ $errors->has('location') ? 'border-red-300' : 'border-gray-300' }}"
                                value="{{ old('location') }}" maxlength="100" placeholder="e.g., Room 101, Lab A">
                            @error('location')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Description
                        </label>
                        <textarea name="description" id="description"
                            class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 {{ $errors->has('description') ? 'border-red-300' : 'border-gray-300' }}"
                            rows="3" maxlength="500" placeholder="Optional description for this attendance session">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input type="checkbox" id="start_immediately" name="start_immediately" value="1"
                                class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                {{ old('start_immediately', true) ? 'checked' : '' }}>
                        </div>
                        <div class="ml-3">
                            <label for="start_immediately" class="text-sm font-medium text-gray-700">
                                Start session immediately
                            </label>
                            <p class="text-sm text-gray-500">If unchecked, you can manually start the session later</p>
                        </div>
                    </div>

                    <div
                        class="flex flex-col sm:flex-row sm:justify-end space-y-3 sm:space-y-0 sm:space-x-3 pt-6 border-t border-gray-200">
                        <a href="{{ route('teacher.qr-attendance.index') }}"
                            class="w-full sm:w-auto bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-md text-sm font-medium transition-colors duration-200 text-center">
                            Cancel
                        </a>
                        <button type="submit"
                            class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                            <i class="fas fa-qrcode mr-1"></i> Create QR Attendance Session
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div> @push('scripts')
        <script>
            $(document).ready(function() {
                // Set minimum date to today
                $('#session_date').attr('min', new Date().toISOString().split('T')[0]);

                // Auto-calculate end time based on duration
                $('#duration_minutes').on('input', function() {
                    const duration = $(this).val();
                    const helpText = $(this).siblings('.text-gray-500');

                    if (duration) {
                        const hours = Math.floor(duration / 60);
                        const minutes = duration % 60;
                        let durationText = 'Duration: ';

                        if (hours > 0) {
                            durationText += hours + ' hour' + (hours > 1 ? 's' : '');
                        }
                        if (minutes > 0) {
                            if (hours > 0) durationText += ' ';
                            durationText += minutes + ' minute' + (minutes > 1 ? 's' : '');
                        }

                        helpText.text(durationText + ' - How long the QR code will be valid for attendance');
                    } else {
                        helpText.text('How long the QR code will be valid for attendance');
                    }
                });

                // Form validation feedback
                $('form').on('submit', function() {
                    const submitBtn = $(this).find('button[type="submit"]');
                    submitBtn.prop('disabled', true).html(
                        '<i class="fas fa-spinner fa-spin mr-1"></i> Creating Session...');

                    // Re-enable button after 5 seconds as fallback
                    setTimeout(function() {
                        submitBtn.prop('disabled', false).html(
                            '<i class="fas fa-qrcode mr-1"></i> Create QR Attendance Session');
                    }, 5000);
                });
            });
        </script>
    @endpush
</x-teacher-layout>
