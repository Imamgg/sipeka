<x-teacher-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-calendar-alt me-2"></i>My Class Schedules
                        </h4>
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

                        <!-- Today's Schedule -->
                        @if ($todaySchedules->count() > 0)
                            <div class="alert alert-info">
                                <h5><i class="fas fa-clock me-2"></i>Today's Classes</h5>
                                <div class="row">
                                    @foreach ($todaySchedules as $schedule)
                                        <div class="col-md-4 mb-2">
                                            <div class="card border-primary">
                                                <div class="card-body p-3">
                                                    <h6 class="card-title mb-1">{{ $schedule->subject->name }}</h6>
                                                    <p class="card-text mb-1"> <small class="text-muted">
                                                            <i
                                                                class="fas fa-users me-1"></i>{{ $schedule->classes->name }}<br>
                                                            <i
                                                                class="fas fa-clock me-1"></i>{{ date('H:i', strtotime($schedule->start_time)) }}
                                                            - {{ date('H:i', strtotime($schedule->end_time)) }}
                                                        </small>
                                                    </p>
                                                    <a href="{{ route('teacher.schedules.show', $schedule) }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="fas fa-eye me-1"></i>View Details
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Weekly Schedule -->
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Day</th>
                                        <th>Time</th>
                                        <th>Subject</th>
                                        <th>Class</th>
                                        <th>Room</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($schedules as $schedule)
                                        <tr>
                                            <td>
                                                <i class="fas fa-calendar-day me-2"></i>
                                                {{ $schedule->day }}
                                            </td>
                                            <td>
                                                <i class="fas fa-clock me-2"></i>
                                                {{ date('H:i', strtotime($schedule->start_time)) }} -
                                                {{ date('H:i', strtotime($schedule->end_time)) }}
                                            </td>
                                            <td>
                                                <strong>{{ $schedule->subject->name }}</strong>
                                            </td>
                                            <td>
                                                <span class="badge bg-primary">{{ $schedule->classes->name }}</span>
                                            </td>
                                            <td>
                                                <i class="fas fa-door-open me-2"></i>
                                                {{ $schedule->room ?? 'Not specified' }}
                                            </td>
                                            <td>
                                                <a href="{{ route('teacher.schedules.show', $schedule) }}"
                                                    class="btn btn-sm btn-outline-primary" title="View Details">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4">
                                                <div class="text-muted">
                                                    <i class="fas fa-calendar-times fa-3x mb-3"></i>
                                                    <p>No schedules found. Please contact your administrator.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Weekly View -->
                        @if ($schedulesByDay->count() > 0)
                            <div class="mt-4">
                                <h5><i class="fas fa-calendar-week me-2"></i>Weekly Overview</h5>
                                <div class="row">
                                    @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day)
                                        <div class="col-md-2 mb-3">
                                            <div class="card">
                                                <div class="card-header bg-light">
                                                    <h6 class="mb-0 text-center">{{ $day }}</h6>
                                                </div>
                                                <div class="card-body p-2">
                                                    @if (isset($schedulesByDay[$day]))
                                                        @foreach ($schedulesByDay[$day] as $schedule)
                                                            <div class="small mb-2 p-2 bg-light rounded">
                                                                <strong>{{ $schedule->subject->name }}</strong><br>
                                                                <small class="text-muted">
                                                                    {{ date('H:i', strtotime($schedule->start_time)) }}<br>
                                                                    {{ $schedule->classes->name }}
                                                                </small>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <small class="text-muted">No classes</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
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
        }

        .table th {
            border-top: none;
        }

        .badge {
            font-size: 0.8em;
        }

        .text-muted {
            color: #6c757d !important;
        }

        .bg-light {
            background-color: #f8f9fa !important;
        }
    </style>
@endpush
