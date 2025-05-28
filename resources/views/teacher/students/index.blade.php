<x-teacher-layout>
    <div class="container-fluid py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="h3 mb-0">My Students</h1>
                        <p class="text-muted">Students in classes you teach</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Classes and Students -->
        <div class="row">
            @forelse($classes as $class)
                <div class="col-12 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-gradient-primary text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-users me-2"></i>{{ $class->name }}
                                </h5>
                                <span class="badge bg-light text-primary">
                                    {{ $class->students->count() }} Students
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($class->students->count() > 0)
                                <div class="row">
                                    @foreach ($class->students as $student)
                                        <div class="col-md-6 col-lg-4 mb-3">
                                            <div class="card border h-100">
                                                <div class="card-body p-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                                                style="width: 40px; height: 40px;">
                                                                <i class="fas fa-user text-white"></i>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="mb-1">{{ $student->name }}</h6>
                                                            <p class="text-muted small mb-1">NISN: {{ $student->nisn }}
                                                            </p>
                                                            <p class="text-muted small mb-0">{{ $student->user->email }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3">
                                                        <a href="{{ route('teacher.students.show', $student) }}"
                                                            class="btn btn-outline-primary btn-sm">
                                                            <i class="fas fa-eye me-1"></i>View Details
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-user-slash fa-3x text-muted mb-3"></i>
                                    <h6 class="text-muted">No students in this class</h6>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body text-center py-5">
                            <i class="fas fa-chalkboard-teacher fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No Classes Assigned</h5>
                            <p class="text-muted">You are not currently assigned to teach any classes.</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-teacher-layout>
