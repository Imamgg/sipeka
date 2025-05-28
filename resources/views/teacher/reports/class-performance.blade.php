@extends('layouts.teacher')

@section('title', 'Class Performance Report')

@section('content')
    <div class="container-fluid py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="h3 mb-0">Class Performance Report</h1>
                        <p class="text-muted">Overview of performance across all your classes</p>
                    </div>
                    <div>
                        <a href="{{ route('teacher.reports.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Reports
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Performance Cards -->
        <div class="row">
            @forelse($classPerformance as $performance)
                <div class="col-lg-6 col-xl-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-gradient-primary text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-users me-2"></i>{{ $performance['class']->name }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <!-- Student Count -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted">Total Students</span>
                                <span class="badge bg-info">{{ $performance['student_count'] }}</span>
                            </div>

                            <!-- Grade Statistics -->
                            <div class="mb-3">
                                <h6 class="text-muted mb-2">Grade Statistics</h6>
                                <div class="row text-center">
                                    <div class="col-6">
                                        <div class="border-end">
                                            <div class="h5 mb-0 text-primary">
                                                {{ $performance['grade_stats']['average_score'] }}</div>
                                            <small class="text-muted">Average</small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="h5 mb-0 text-success">{{ $performance['grade_stats']['total_grades'] }}
                                        </div>
                                        <small class="text-muted">Total Grades</small>
                                    </div>
                                </div>
                                <div class="row text-center mt-2">
                                    <div class="col-6">
                                        <div class="border-end">
                                            <div class="h6 mb-0 text-success">
                                                {{ $performance['grade_stats']['highest_score'] }}</div>
                                            <small class="text-muted">Highest</small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="h6 mb-0 text-danger">{{ $performance['grade_stats']['lowest_score'] }}
                                        </div>
                                        <small class="text-muted">Lowest</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Attendance Statistics -->
                            <div class="mb-3">
                                <h6 class="text-muted mb-2">Attendance (This Month)</h6>
                                <div class="row text-center">
                                    <div class="col-6">
                                        <div class="border-end">
                                            <div class="h5 mb-0 text-success">
                                                {{ $performance['attendance_stats']['attendance_rate'] }}%</div>
                                            <small class="text-muted">Rate</small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="h5 mb-0 text-info">
                                            {{ $performance['attendance_stats']['total_sessions'] }}</div>
                                        <small class="text-muted">Sessions</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Progress Bar -->
                            <div class="mb-2">
                                <div class="d-flex justify-content-between">
                                    <small class="text-muted">Overall Performance</small>
                                    <small class="text-muted">{{ $performance['grade_stats']['average_score'] }}%</small>
                                </div>
                                <div class="progress" style="height: 6px;">
                                    @php
                                        $score = $performance['grade_stats']['average_score'];
                                        $color = $score >= 80 ? 'success' : ($score >= 70 ? 'warning' : 'danger');
                                    @endphp
                                    <div class="progress-bar bg-{{ $color }}" role="progressbar"
                                        style="width: {{ $score }}%" aria-valuenow="{{ $score }}"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-light">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('teacher.reports.grades', ['class_id' => $performance['class']->id]) }}"
                                    class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-chart-line me-1"></i>Grade Details
                                </a>
                                <a href="{{ route('teacher.reports.attendance', ['class_id' => $performance['class']->id]) }}"
                                    class="btn btn-sm btn-outline-info">
                                    <i class="fas fa-calendar-check me-1"></i>Attendance
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center py-5">
                            <i class="fas fa-chart-bar fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No Class Data Available</h5>
                            <p class="text-muted">You don't have any classes assigned yet.</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Add any interactive features here
                console.log('Class Performance Report loaded');
            });
        </script>
    @endpush
@endsection
