<x-teacher-layout>
    <div class="student-details-container">
        <!-- Header -->
        <div class="student-header">
            <div class="header-content">
                <h2 class="page-title">Student Details</h2>
                <p class="page-subtitle">{{ $student->name }} - {{ $student->classes->name }}</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('teacher.students.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left btn-icon"></i>Back to Students
                </a>
            </div>
        </div>

        <div class="student-content">
            <!-- Student Information -->
            <div class="info-card">
                <div class="card-header card-header-primary">
                    <h5 class="card-title">
                        <i class="fas fa-user card-icon"></i>Student Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="student-profile">
                        <div class="profile-avatar">
                            <i class="fas fa-user avatar-icon"></i>
                        </div>
                        <h5 class="profile-name">{{ $student->name }}</h5>
                        <small class="profile-nisn">{{ $student->nisn }}</small>
                    </div>

                    <div class="profile-divider"></div>

                    <div class="student-info">
                        <div class="info-item">
                            <strong>Class:</strong>
                            <span class="info-value">{{ $student->classes->name }}</span>
                        </div>
                        <div class="info-item">
                            <strong>Email:</strong>
                            <span class="info-value">{{ $student->user->email }}</span>
                        </div>
                        @if ($student->place_of_birth)
                            <div class="info-item">
                                <strong>Place of Birth:</strong>
                                <span class="info-value">{{ $student->place_of_birth }}</span>
                            </div>
                        @endif
                        @if ($student->date_of_birth)
                            <div class="info-item">
                                <strong>Date of Birth:</strong>
                                <span class="info-value">{{ $student->date_of_birth->format('d M Y') }}</span>
                            </div>
                        @endif
                        @if ($student->gender)
                            <div class="info-item">
                                <strong>Gender:</strong>
                                <span class="info-value">{{ ucfirst($student->gender) }}</span>
                            </div>
                        @endif
                        @if ($student->phone_number)
                            <div class="info-item">
                                <strong>Phone:</strong>
                                <span class="info-value">{{ $student->phone_number }}</span>
                            </div>
                        @endif
                        @if ($student->address)
                            <div class="info-item">
                                <strong>Address:</strong>
                                <div class="info-value">{{ $student->address }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div> <!-- Grades -->
            <div class="details-card">
                <div class="card-header card-header-success">
                    <h5 class="card-title">
                        <i class="fas fa-graduation-cap card-icon"></i>Recent Grades
                    </h5>
                </div>
                <div class="card-body">
                    @if ($student->grades->count() > 0)
                        <div class="grade-list">
                            @foreach ($student->grades->take(10) as $grade)
                                <div class="grade-item">
                                    <div class="grade-content">
                                        <div class="grade-info">
                                            <h6 class="grade-subject">{{ $grade->subject->name }}</h6>
                                            <p class="grade-type">{{ ucfirst($grade->grade_type) }}</p>
                                            @if ($grade->description)
                                                <small class="grade-description">{{ $grade->description }}</small>
                                            @endif
                                        </div>
                                        <div class="grade-score-section">
                                            <span
                                                class="grade-score score-{{ $grade->score >= 80 ? 'high' : ($grade->score >= 70 ? 'medium' : 'low') }}">
                                                {{ $grade->score }}
                                            </span>
                                            <div class="grade-date">{{ $grade->date->format('d/m/Y') }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if ($student->grades->count() > 10)
                            <div class="view-all-section">
                                <a href="{{ route('teacher.grades.index', ['student_id' => $student->id]) }}"
                                    class="btn btn-outline btn-success">
                                    View All Grades
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="empty-state">
                            <i class="fas fa-graduation-cap empty-icon"></i>
                            <p class="empty-text">No grades recorded yet</p>
                        </div>
                    @endif
                </div>
            </div> <!-- Attendance -->
            <div class="details-card">
                <div class="card-header card-header-info">
                    <h5 class="card-title">
                        <i class="fas fa-calendar-check card-icon"></i>Recent Attendance
                    </h5>
                </div>
                <div class="card-body">
                    @if ($student->presences->count() > 0)
                        <div class="attendance-list">
                            @foreach ($student->presences as $presence)
                                <div class="attendance-item">
                                    <div class="attendance-content">
                                        <div class="attendance-info">
                                            <div class="attendance-date">{{ $presence->date->format('d M Y') }}</div>
                                            @if ($presence->subject)
                                                <small
                                                    class="attendance-subject">{{ $presence->subject->name }}</small>
                                            @endif
                                        </div>
                                        <div class="attendance-status-section">
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
                                                class="attendance-status status-{{ $statusColors[$presence->status] ?? 'secondary' }}">
                                                {{ ucfirst($presence->status) }}
                                            </span>
                                        </div>
                                    </div>
                                    @if ($presence->notes)
                                        <small class="attendance-notes">{{ $presence->notes }}</small>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <div class="view-all-section">
                            <a href="{{ route('teacher.attendance.index', ['student_id' => $student->id]) }}"
                                class="btn btn-outline btn-info">
                                View All Attendance
                            </a>
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-calendar-check empty-icon"></i>
                            <p class="empty-text">No attendance records yet</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions-container">
            <div class="quick-actions-card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-bolt card-icon"></i>Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="actions-grid">
                        <div class="action-item">
                            <a href="{{ route('teacher.grades.create', ['student_id' => $student->id]) }}"
                                class="btn btn-success btn-full">
                                <i class="fas fa-plus btn-icon"></i>Add Grade
                            </a>
                        </div>
                        <div class="action-item">
                            <a href="{{ route('teacher.attendance.create', ['class_id' => $student->class_id]) }}"
                                class="btn btn-info btn-full">
                                <i class="fas fa-calendar-plus btn-icon"></i>Record Attendance
                            </a>
                        </div>
                        <div class="action-item">
                            <a href="{{ route('teacher.grades.index', ['student_id' => $student->id]) }}"
                                class="btn btn-outline btn-primary btn-full">
                                <i class="fas fa-chart-line btn-icon"></i>View Grades
                            </a>
                        </div>
                        <div class="action-item">
                            <a href="{{ route('teacher.attendance.index', ['student_id' => $student->id]) }}"
                                class="btn btn-outline btn-info btn-full">
                                <i class="fas fa-history btn-icon"></i>View Attendance
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-teacher-layout>

<style>
    /* Container Styles */
    .student-details-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
        background: #f8f9fa;
        min-height: 100vh;
    }

    /* Header Styles */
    .student-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding: 1.5rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .header-content {
        flex: 1;
    }

    .page-title {
        font-size: 2rem;
        font-weight: 700;
        color: #2c3e50;
        margin: 0 0 0.5rem 0;
    }

    .page-subtitle {
        color: #6c757d;
        font-size: 1rem;
        margin: 0;
    }

    .header-actions {
        margin-left: 1rem;
    }

    /* Button Styles */
    .btn {
        display: inline-flex;
        align-items: center;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .btn-icon {
        margin-right: 0.5rem;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
    }

    .btn-secondary:hover {
        background-color: #545b62;
        transform: translateY(-1px);
    }

    .btn-success {
        background-color: #28a745;
        color: white;
    }

    .btn-success:hover {
        background-color: #218838;
        transform: translateY(-1px);
    }

    .btn-info {
        background-color: #17a2b8;
        color: white;
    }

    .btn-info:hover {
        background-color: #138496;
        transform: translateY(-1px);
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        transform: translateY(-1px);
    }

    .btn-outline {
        background-color: transparent;
        border: 2px solid;
    }

    .btn-outline.btn-success {
        color: #28a745;
        border-color: #28a745;
        background-color: transparent;
    }

    .btn-outline.btn-success:hover {
        background-color: #28a745;
        color: white;
    }

    .btn-outline.btn-info {
        color: #17a2b8;
        border-color: #17a2b8;
        background-color: transparent;
    }

    .btn-outline.btn-info:hover {
        background-color: #17a2b8;
        color: white;
    }

    .btn-outline.btn-primary {
        color: #007bff;
        border-color: #007bff;
        background-color: transparent;
    }

    .btn-outline.btn-primary:hover {
        background-color: #007bff;
        color: white;
    }

    .btn-full {
        width: 100%;
        justify-content: center;
    }

    /* Content Layout */
    .student-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    /* Card Styles */
    .info-card,
    .details-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        height: fit-content;
    }

    .card-header {
        padding: 1.5rem;
        color: white;
    }

    .card-header-primary {
        background: linear-gradient(135deg, #007bff, #0056b3);
    }

    .card-header-success {
        background: linear-gradient(135deg, #28a745, #20694a);
    }

    .card-header-info {
        background: linear-gradient(135deg, #17a2b8, #117a8b);
    }

    .card-title {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 600;
        display: flex;
        align-items: center;
    }

    .card-icon {
        margin-right: 0.75rem;
        font-size: 1.125rem;
    }

    .card-body {
        padding: 1.5rem;
    }

    /* Student Profile */
    .student-profile {
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .profile-avatar {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #007bff, #0056b3);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem auto;
    }

    .avatar-icon {
        font-size: 2rem;
        color: white;
    }

    .profile-name {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin: 0 0 0.5rem 0;
    }

    .profile-nisn {
        color: #6c757d;
        font-size: 0.875rem;
    }

    .profile-divider {
        height: 1px;
        background: #e9ecef;
        margin: 1.5rem 0;
    }

    /* Student Info */
    .student-info {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 0.75rem;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .info-value {
        color: #495057;
        text-align: right;
        flex: 1;
        margin-left: 1rem;
    }

    /* Grade and Attendance Lists */
    .grade-list,
    .attendance-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .grade-item,
    .attendance-item {
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 8px;
        border-left: 4px solid #007bff;
    }

    .grade-content,
    .attendance-content {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .grade-info,
    .attendance-info {
        flex: 1;
    }

    .grade-subject {
        font-size: 1rem;
        font-weight: 600;
        color: #2c3e50;
        margin: 0 0 0.25rem 0;
    }

    .grade-type,
    .attendance-subject {
        color: #6c757d;
        font-size: 0.875rem;
        margin: 0 0 0.25rem 0;
    }

    .grade-description,
    .attendance-notes {
        color: #6c757d;
        font-size: 0.75rem;
        margin-top: 0.5rem;
        display: block;
    }

    .attendance-date {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.25rem;
    }

    /* Score and Status Styles */
    .grade-score-section,
    .attendance-status-section {
        text-align: right;
        margin-left: 1rem;
    }

    .grade-score,
    .attendance-status {
        display: inline-block;
        padding: 0.375rem 0.75rem;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .grade-score.score-high {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .grade-score.score-medium {
        background: #fff3cd;
        color: #856404;
        border: 1px solid #ffeaa7;
    }

    .grade-score.score-low {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .attendance-status.status-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .attendance-status.status-warning {
        background: #fff3cd;
        color: #856404;
        border: 1px solid #ffeaa7;
    }

    .attendance-status.status-danger {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .attendance-status.status-info {
        background: #d1ecf1;
        color: #0c5460;
        border: 1px solid #bee5eb;
    }

    .attendance-status.status-secondary {
        background: #e2e3e5;
        color: #383d41;
        border: 1px solid #d6d8db;
    }

    .grade-date {
        color: #6c757d;
        font-size: 0.75rem;
        margin-top: 0.25rem;
    }

    /* View All Section */
    .view-all-section {
        text-align: center;
        margin-top: 1.5rem;
        padding-top: 1rem;
        border-top: 1px solid #e9ecef;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
    }

    .empty-icon {
        font-size: 3rem;
        color: #6c757d;
        margin-bottom: 1rem;
    }

    .empty-text {
        color: #6c757d;
        font-size: 1rem;
        margin: 0;
    }

    /* Quick Actions */
    .quick-actions-container {
        grid-column: 1 / -1;
    }

    .quick-actions-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
    }

    .action-item {
        margin: 0;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .student-details-container {
            padding: 1rem;
        }

        .student-header {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }

        .header-actions {
            margin-left: 0;
        }

        .student-content {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .page-title {
            font-size: 1.5rem;
        }

        .grade-content,
        .attendance-content {
            flex-direction: column;
            gap: 0.75rem;
        }

        .grade-score-section,
        .attendance-status-section {
            text-align: left;
            margin-left: 0;
        }

        .actions-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .info-item {
            flex-direction: column;
            gap: 0.5rem;
        }

        .info-value {
            text-align: left;
            margin-left: 0;
        }
    }
</style>
