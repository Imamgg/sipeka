@extends('layouts.teacher')

@section('title', 'Class Performance Report')

@section('content')
    <div class="report-container">
        <!-- Header -->
        <div class="report-header">
            <div class="header-content">
                <h2 class="report-title">Class Performance Report</h2>
                <p class="report-subtitle">Overview of performance across all your classes</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('teacher.reports.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left btn-icon"></i>Back to Reports
                </a>
            </div>
        </div> <!-- Performance Cards -->
        <div class="performance-grid">
            @forelse($classPerformance as $performance)
                <div class="performance-card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="fas fa-users card-icon"></i>{{ $performance['class']->name }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <!-- Student Count -->
                        <div class="stat-row">
                            <span class="stat-label">Total Students</span>
                            <span class="badge badge-info">{{ $performance['student_count'] }}</span>
                        </div>

                        <!-- Grade Statistics -->
                        <div class="stats-section">
                            <h6 class="section-title">Grade Statistics</h6>
                            <div class="stats-grid">
                                <div class="stat-item">
                                    <div class="stat-value stat-primary">
                                        {{ $performance['grade_stats']['average_score'] }}</div>
                                    <small class="stat-text">Average</small>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-value stat-success">{{ $performance['grade_stats']['total_grades'] }}
                                    </div>
                                    <small class="stat-text">Total Grades</small>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-value stat-success">
                                        {{ $performance['grade_stats']['highest_score'] }}</div>
                                    <small class="stat-text">Highest</small>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-value stat-danger">{{ $performance['grade_stats']['lowest_score'] }}
                                    </div>
                                    <small class="stat-text">Lowest</small>
                                </div>
                            </div>
                        </div>

                        <!-- Attendance Statistics -->
                        <div class="stats-section">
                            <h6 class="section-title">Attendance (This Month)</h6>
                            <div class="stats-grid attendance-stats">
                                <div class="stat-item">
                                    <div class="stat-value stat-success">
                                        {{ $performance['attendance_stats']['attendance_rate'] }}%</div>
                                    <small class="stat-text">Rate</small>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-value stat-info">
                                        {{ $performance['attendance_stats']['total_sessions'] }}</div>
                                    <small class="stat-text">Sessions</small>
                                </div>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div class="progress-section">
                            <div class="progress-header">
                                <small class="progress-label">Overall Performance</small>
                                <small class="progress-value">{{ $performance['grade_stats']['average_score'] }}%</small>
                            </div>
                            <div class="progress-bar">
                                @php
                                    $score = $performance['grade_stats']['average_score'];
                                    $color = $score >= 80 ? 'success' : ($score >= 70 ? 'warning' : 'danger');
                                @endphp
                                <div class="progress-fill progress-{{ $color }}"
                                    style="width: {{ $score }}%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="action-buttons">
                            <a href="{{ route('teacher.reports.grades', ['class_id' => $performance['class']->id]) }}"
                                class="btn btn-primary btn-sm">
                                <i class="fas fa-chart-line btn-icon"></i>Grade Details
                            </a>
                            <a href="{{ route('teacher.reports.attendance', ['class_id' => $performance['class']->id]) }}"
                                class="btn btn-info btn-sm">
                                <i class="fas fa-calendar-check btn-icon"></i>Attendance
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-card">
                        <div class="empty-body">
                            <i class="fas fa-chart-bar empty-icon"></i>
                            <h5 class="empty-title">No Class Data Available</h5>
                            <p class="empty-text">You don't have any classes assigned yet.</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div> @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Add any interactive features here
                console.log('Class Performance Report loaded');
            });
        </script>
    @endpush

    @push('styles')
        <style>
            /* Report Container */
            .report-container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 20px;
            }

            /* Header */
            .report-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 30px;
                padding: 20px 0;
                border-bottom: 2px solid #e9ecef;
            }

            .header-content h2.report-title {
                color: #2c3e50;
                margin: 0;
                font-size: 28px;
                font-weight: 600;
            }

            .header-content p.report-subtitle {
                color: #6c757d;
                margin: 5px 0 0 0;
                font-size: 14px;
            }

            .header-actions {
                display: flex;
                gap: 10px;
            }

            /* Buttons */
            .btn {
                padding: 8px 16px;
                border: none;
                border-radius: 6px;
                font-size: 14px;
                font-weight: 500;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                cursor: pointer;
                transition: all 0.2s ease;
            }

            .btn-icon {
                margin-right: 8px;
            }

            .btn-secondary {
                background-color: #6c757d;
                color: white;
            }

            .btn-secondary:hover {
                background-color: #545b62;
            }

            .btn-primary {
                background-color: #007bff;
                color: white;
            }

            .btn-primary:hover {
                background-color: #0056b3;
            }

            .btn-info {
                background-color: #17a2b8;
                color: white;
            }

            .btn-info:hover {
                background-color: #138496;
            }

            .btn-sm {
                padding: 6px 12px;
                font-size: 12px;
            }

            /* Performance Grid */
            .performance-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
                gap: 20px;
                margin-bottom: 30px;
            }

            .performance-card {
                background: white;
                border-radius: 10px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                overflow: hidden;
                height: fit-content;
            }

            .card-header {
                background: linear-gradient(135deg, #007bff, #0056b3);
                color: white;
                padding: 20px;
            }

            .card-header h5.card-title {
                margin: 0;
                font-size: 18px;
                font-weight: 600;
                display: flex;
                align-items: center;
            }

            .card-icon {
                margin-right: 10px;
                font-size: 16px;
            }

            .card-body {
                padding: 20px;
            }

            /* Stats */
            .stat-row {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
                padding-bottom: 15px;
                border-bottom: 1px solid #e9ecef;
            }

            .stat-label {
                color: #6c757d;
                font-size: 14px;
            }

            .stats-section {
                margin-bottom: 20px;
            }

            .section-title {
                color: #6c757d;
                margin: 0 0 15px 0;
                font-size: 14px;
                font-weight: 600;
            }

            .stats-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 15px;
                text-align: center;
            }

            .attendance-stats {
                grid-template-columns: 1fr 1fr;
            }

            .stat-item {
                padding: 10px;
                border-radius: 6px;
                background: #f8f9fa;
            }

            .stat-value {
                font-size: 20px;
                font-weight: 700;
                margin-bottom: 5px;
            }

            .stat-primary {
                color: #007bff;
            }

            .stat-success {
                color: #28a745;
            }

            .stat-danger {
                color: #dc3545;
            }

            .stat-info {
                color: #17a2b8;
            }

            .stat-text {
                color: #6c757d;
                font-size: 12px;
            }

            /* Progress */
            .progress-section {
                margin-bottom: 10px;
            }

            .progress-header {
                display: flex;
                justify-content: space-between;
                margin-bottom: 8px;
            }

            .progress-label,
            .progress-value {
                color: #6c757d;
                font-size: 12px;
            }

            .progress-bar {
                width: 100%;
                height: 6px;
                background: #e9ecef;
                border-radius: 3px;
                overflow: hidden;
            }

            .progress-fill {
                height: 100%;
                transition: width 0.3s ease;
            }

            .progress-success {
                background: #28a745;
            }

            .progress-warning {
                background: #ffc107;
            }

            .progress-danger {
                background: #dc3545;
            }

            /* Badges */
            .badge {
                padding: 4px 8px;
                border-radius: 4px;
                font-size: 11px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .badge-info {
                background: #17a2b8;
                color: white;
            }

            /* Card Footer */
            .card-footer {
                background: #f8f9fa;
                padding: 15px 20px;
                border-top: 1px solid #e9ecef;
            }

            .action-buttons {
                display: flex;
                justify-content: space-between;
                gap: 10px;
            }

            /* Empty State */
            .empty-state {
                grid-column: 1 / -1;
            }

            .empty-card {
                background: white;
                border-radius: 10px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }

            .empty-body {
                text-align: center;
                padding: 60px 20px;
            }

            .empty-icon {
                font-size: 48px;
                color: #6c757d;
                margin-bottom: 20px;
            }

            .empty-title {
                color: #2c3e50;
                margin: 0 0 10px 0;
                font-size: 18px;
                font-weight: 600;
            }

            .empty-text {
                color: #6c757d;
                margin: 0;
                font-size: 14px;
            }

            /* Responsive */
            @media (max-width: 768px) {
                .report-header {
                    flex-direction: column;
                    gap: 20px;
                    align-items: flex-start;
                }

                .header-actions {
                    width: 100%;
                    justify-content: flex-start;
                    flex-wrap: wrap;
                }

                .performance-grid {
                    grid-template-columns: 1fr;
                }

                .action-buttons {
                    flex-direction: column;
                }

                .stats-grid {
                    grid-template-columns: 1fr;
                    gap: 10px;
                }
            }
        </style>
    @endpush
@endsection
