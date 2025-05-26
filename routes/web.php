<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminStudentController;
use App\Http\Controllers\Admin\AdminTeacherController;
use App\Http\Controllers\Admin\AdminClassesController;
use App\Http\Controllers\Admin\AdminSubjectController;
use App\Http\Controllers\Admin\AdminScheduleController;
use App\Http\Controllers\Admin\AdminGradeController;
use App\Http\Controllers\Admin\ServerController;
use App\Http\Controllers\Teacher\TeacherDashboardController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\StudentProfileController;
use App\Http\Controllers\Student\StudentScheduleController;
use App\Http\Controllers\Student\StudentGradeController;
use App\Http\Controllers\Student\StudentAttendanceController;
use App\Http\Controllers\Student\StudentAnnouncementController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::redirect('/', '/login');

// Admin routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(
    function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('students', AdminStudentController::class);
        Route::resource('teachers', AdminTeacherController::class);
        Route::resource('classes', AdminClassesController::class);
        Route::resource('subjects', AdminSubjectController::class);
        Route::resource('schedules', AdminScheduleController::class);
        Route::get('/grades', [AdminGradeController::class, 'index'])->name('grades.index');
        Route::get('/grades/{grade}', [AdminGradeController::class, 'show'])->name('grades.show');
        Route::post('/grades/{grade}/verify', [AdminGradeController::class, 'verify'])->name('grades.verify');
        Route::get('/attendances', [AdminGradeController::class, 'attendance'])->name('attendances.index');
        Route::get('/attendances/{attendance}', [AdminGradeController::class, 'showAttendance'])->name('attendances.show');
        Route::post('/attendances/{attendance}/verify', [AdminGradeController::class, 'verifyAttendance'])->name('attendances.verify');

        // Server management routes
        Route::get('/server', [ServerController::class, 'index'])->name('server.index');
        Route::post('/server/update-status', [ServerController::class, 'updateStatus'])->name('server.update-status');
    }
);

// Teacher routes
Route::prefix('teacher')->middleware(['auth', 'role:teacher', 'server.status'])->group(function () {
    Route::get('/dashboard', [TeacherDashboardController::class, 'index'])->name('teacher.dashboard');
});

// Student routes
Route::prefix('student')->middleware(['auth', 'role:student', 'server.status'])->name('student.')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('profile/edit', [StudentProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [StudentProfileController::class, 'update'])->name('profile.update');
    Route::resource('schedules', StudentScheduleController::class);
    Route::resource('grades', StudentGradeController::class);
    Route::resource('attendances', StudentAttendanceController::class);
    Route::resource('announcements', StudentAnnouncementController::class);
});

Route::middleware(['auth', 'server.status'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'server.status'])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();

        if ($user) {
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'teacher') {
                return redirect()->route('teacher.dashboard');
            } elseif ($user->role === 'student') {
                return redirect()->route('student.dashboard');
            }
        }
        return redirect('/');
    })->name('dashboard');
});

require __DIR__ . '/auth.php';
