@extends('layouts.app')

<x-teacher-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-calendar-alt me-2"></i>Schedule Details
                        </h4>
                        <a href="{{ route('teacher.schedules.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Schedules
                        </a>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Schedule Information -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card border-primary">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Schedule Information
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-sm-4"><strong>Subject:</strong></div>
                                            <div class="col-sm-8">{{ $schedule->subject->name }}</div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-4"><strong>Class:</strong></div>
                                            <div class="col-sm-8">
                                                <span
                                                    class="badge bg-primary fs-6">{{ $schedule->classes->name }}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-4"><strong>Day:</strong></div>
                                            <div class="col-sm-8">{{ $schedule->day }}</div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-4"><strong>Time:</strong></div>
                                            <div class="col-sm-8">
                                                {{ date('H:i', strtotime($schedule->start_time)) }} -
                                                {{ date('H:i', strtotime($schedule->end_time)) }}
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-4"><strong>Room:</strong></div>
                                            <div class="col-sm-8">{{ $schedule->room ?? 'Not specified' }}</div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-4"><strong>Duration:</strong></div>
                                            <div class="col-sm-8">
                                                @php
                                                    $start = \Carbon\Carbon::parse($schedule->start_time);
                                                    $end = \Carbon\Carbon::parse($schedule->end_time);
                                                    $duration = $start->diffInMinutes($end);
                                                @endphp
                                                {{ $duration }} minutes
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card border-info">
                                    <div class="card-header bg-info text-white">
                                        <h5 class="mb-0"><i class="fas fa-users me-2"></i>Class Information</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-sm-4"><strong>Class Name:</strong></div>
                                            <div class="col-sm-8">{{ $schedule->classes->name }}</div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-4"><strong>Total Students:</strong></div>
                                            <div class="col-sm-8">
                                                <span
                                                    class="badge bg-success">{{ $schedule->classes->students->count() }}
                                                    students</span>
                                            </div>
                                        </div>
                                        @if ($schedule->classes->description)
                                            <div class="row mb-3">
                                                <div class="col-sm-4"><strong>Description:</strong></div>
                                                <div class="col-sm-8">{{ $schedule->classes->description }}</div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Students in Class -->
                        <div class="mt-4">
                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    <h5 class="mb-0">
                                        <i class="fas fa-users me-2"></i>Students in {{ $schedule->classes->name }}
                                        <span
                                            class="badge bg-light text-dark ms-2">{{ $schedule->classes->students->count() }}</span>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    @if ($schedule->classes->students->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Student ID</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($schedule->classes->students as $index => $student)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $student->student_id }}</td>
                                                            <td>{{ $student->name }}</td>
                                                            <td>{{ $student->user->email ?? '-' }}</td>
                                                            <td>
                                                                <a href="{{ route('teacher.students.show', $student) }}"
                                                                    class="btn btn-sm btn-outline-primary"
                                                                    title="View Student Details">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-user-times fa-3x mb-3"></i>
                                                <p>No students found in this class.</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="mt-4">
                            <div class="card">
                                <div class="card-header bg-warning text-dark">
                                    <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3 mb-2">
                                            <a href="{{ route('teacher.attendance.create', ['class_id' => $schedule->classes->id, 'subject_id' => $schedule->subject->id]) }}"
                                                class="btn btn-success w-100">
                                                <i class="fas fa-check-circle me-2"></i>Take Attendance
                                            </a>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <a href="{{ route('teacher.grades.create', ['class_id' => $schedule->classes->id, 'subject_id' => $schedule->subject->id]) }}"
                                                class="btn btn-primary w-100">
                                                <i class="fas fa-graduation-cap me-2"></i>Add Grades
                                            </a>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <a href="{{ route('teacher.materials.create', ['class_id' => $schedule->classes->id, 'subject_id' => $schedule->subject->id]) }}"
                                                class="btn btn-info w-100">
                                                <i class="fas fa-file-upload me-2"></i>Upload Material
                                            </a>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <a href="{{ route('teacher.students.index', ['class_id' => $schedule->classes->id]) }}"
                                                class="btn btn-warning w-100">
                                                <i class="fas fa-users me-2"></i>View Students
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-teacher-layout>

@push('styles')
    <style>
        .card {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 1rem;
        }

        .table th {
            border-top: none;
        }

        .badge {
            font-size: 0.8em;
        }

        .btn-outline-primary:hover {
            transform: translateY(-1px);
        }

        .text-muted {
            color: #6c757d !important;
        }
    </style>
@endpush
