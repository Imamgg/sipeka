<x-teacher-layout>
    <div class="container-fluid py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="h3 mb-0">Student Details</h1>
                        <p class="text-muted">{{ $student->name }} - {{ $student->classes->name }}</p>
                    </div>
                    <div>
                        <a href="{{ route('teacher.students.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Students
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Student Information -->
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-gradient-primary text-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-user me-2"></i>Student Information
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center"
                                style="width: 80px; height: 80px;">
                                <i class="fas fa-user text-white fa-2x"></i>
                            </div>
                            <h5 class="mt-2 mb-0">{{ $student->name }}</h5>
                            <small class="text-muted">{{ $student->nisn }}</small>
                        </div>

                        <hr>

                        <div class="mb-2">
                            <strong>Class:</strong>
                            <span class="ms-2">{{ $student->classes->name }}</span>
                        </div>
                        <div class="mb-2">
                            <strong>Email:</strong>
                            <span class="ms-2">{{ $student->user->email }}</span>
                        </div>
                        @if ($student->place_of_birth)
                            <div class="mb-2">
                                <strong>Place of Birth:</strong>
                                <span class="ms-2">{{ $student->place_of_birth }}</span>
                            </div>
                        @endif
                        @if ($student->date_of_birth)
                            <div class="mb-2">
                                <strong>Date of Birth:</strong>
                                <span class="ms-2">{{ $student->date_of_birth->format('d M Y') }}</span>
                            </div>
                        @endif
                        @if ($student->gender)
                            <div class="mb-2">
                                <strong>Gender:</strong>
                                <span class="ms-2">{{ ucfirst($student->gender) }}</span>
                            </div>
                        @endif
                        @if ($student->phone_number)
                            <div class="mb-2">
                                <strong>Phone:</strong>
                                <span class="ms-2">{{ $student->phone_number }}</span>
                            </div>
                        @endif
                        @if ($student->address)
                            <div class="mb-2">
                                <strong>Address:</strong>
                                <div class="ms-2">{{ $student->address }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Grades -->
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-gradient-success text-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-graduation-cap me-2"></i>Recent Grades
                        </h5>
                    </div>
                    <div class="card-body">
                        @if ($student->grades->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach ($student->grades->take(10) as $grade)
                                    <div class="list-group-item px-0">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="mb-1">{{ $grade->subject->name }}</h6>
                                                <p class="mb-1 text-muted small">{{ ucfirst($grade->grade_type) }}</p>
                                                @if ($grade->description)
                                                    <small class="text-muted">{{ $grade->description }}</small>
                                                @endif
                                            </div>
                                            <div class="text-end">
                                                <span
                                                    class="badge bg-{{ $grade->score >= 80 ? 'success' : ($grade->score >= 70 ? 'warning' : 'danger') }} fs-6">
                                                    {{ $grade->score }}
                                                </span>
                                                <div class="small text-muted">{{ $grade->date->format('d/m/Y') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            @if ($student->grades->count() > 10)
                                <div class="text-center mt-3">
                                    <a href="{{ route('teacher.grades.index', ['student_id' => $student->id]) }}"
                                        class="btn btn-outline-success btn-sm">
                                        View All Grades
                                    </a>
                                </div>
                            @endif
                        @else
                            <div class="text-center py-3">
                                <i class="fas fa-graduation-cap fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0">No grades recorded yet</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Attendance -->
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-gradient-info text-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-calendar-check me-2"></i>Recent Attendance
                        </h5>
                    </div>
                    <div class="card-body">
                        @if ($student->presences->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach ($student->presences as $presence)
                                    <div class="list-group-item px-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <div class="fw-medium">{{ $presence->date->format('d M Y') }}</div>
                                                @if ($presence->subject)
                                                    <small class="text-muted">{{ $presence->subject->name }}</small>
                                                @endif
                                            </div>
                                            <div>
                                                @php
                                                    $statusColors = [
                                                        'present' => 'success',
                                                        'late' => 'warning',
                                                        'absent' => 'danger',
                                                        'sick' => 'info',
                                                        'permit' => 'secondary',
                                                    ];
                                                @endphp
                                                <span
                                                    class="badge bg-{{ $statusColors[$presence->status] ?? 'secondary' }}">
                                                    {{ ucfirst($presence->status) }}
                                                </span>
                                            </div>
                                        </div>
                                        @if ($presence->notes)
                                            <small class="text-muted">{{ $presence->notes }}</small>
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                            <div class="text-center mt-3">
                                <a href="{{ route('teacher.attendance.index', ['student_id' => $student->id]) }}"
                                    class="btn btn-outline-info btn-sm">
                                    View All Attendance
                                </a>
                            </div>
                        @else
                            <div class="text-center py-3">
                                <i class="fas fa-calendar-check fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0">No attendance records yet</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-bolt me-2"></i>Quick Actions
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <a href="{{ route('teacher.grades.create', ['student_id' => $student->id]) }}"
                                    class="btn btn-success w-100">
                                    <i class="fas fa-plus me-2"></i>Add Grade
                                </a>
                            </div>
                            <div class="col-md-3 mb-2">
                                <a href="{{ route('teacher.attendance.create', ['class_id' => $student->class_id]) }}"
                                    class="btn btn-info w-100">
                                    <i class="fas fa-calendar-plus me-2"></i>Record Attendance
                                </a>
                            </div>
                            <div class="col-md-3 mb-2">
                                <a href="{{ route('teacher.grades.index', ['student_id' => $student->id]) }}"
                                    class="btn btn-outline-primary w-100">
                                    <i class="fas fa-chart-line me-2"></i>View Grades
                                </a>
                            </div>
                            <div class="col-md-3 mb-2">
                                <a href="{{ route('teacher.attendance.index', ['student_id' => $student->id]) }}"
                                    class="btn btn-outline-info w-100">
                                    <i class="fas fa-history me-2"></i>View Attendance
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-teacher-layout>
