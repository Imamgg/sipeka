<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminStudentController;
use App\Http\Controllers\Admin\AdminTeacherController;
use App\Http\Controllers\Admin\AdminClassesController;
use App\Http\Controllers\Admin\AdminSubjectController;
use App\Http\Controllers\Admin\AdminScheduleController;
use App\Http\Controllers\Admin\AdminGradeController;
use App\Http\Controllers\Admin\AdminAnnouncementController;
use App\Http\Controllers\Admin\ServerController;
use App\Http\Controllers\Teacher\TeacherDashboardController;
use App\Http\Controllers\Teacher\TeacherProfileController;
use App\Http\Controllers\Teacher\TeacherStudentController;
use App\Http\Controllers\Teacher\TeacherGradeController;
use App\Http\Controllers\Teacher\TeacherAttendanceController;
use App\Http\Controllers\Teacher\TeacherMaterialController;
use App\Http\Controllers\Teacher\TeacherReportController;
use App\Http\Controllers\Teacher\TeacherScheduleController;
use App\Http\Controllers\Teacher\TeacherAnnouncementController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\StudentProfileController;
use App\Http\Controllers\Student\StudentScheduleController;
use App\Http\Controllers\Student\StudentGradeController;
use App\Http\Controllers\Student\StudentAttendanceController;
use App\Http\Controllers\Student\StudentMaterialController;
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
        Route::resource('announcements', AdminAnnouncementController::class);
        Route::post('/announcements/{announcement}/toggle-status', [AdminAnnouncementController::class, 'toggleStatus'])->name('announcements.toggle-status');
        Route::get('/announcements/{announcement}/download', [AdminAnnouncementController::class, 'download'])->name('announcements.download');
        Route::post('/server/update-status', [ServerController::class, 'updateStatus'])->name('server.update-status');
        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('/', [AdminReportController::class, 'index'])->name('index');
            Route::get('/student-performance', [AdminReportController::class, 'studentPerformance'])->name('student-performance');
            Route::get('/teacher-performance', [AdminReportController::class, 'teacherPerformance'])->name('teacher-performance');
            Route::get('/attendance-statistics', [AdminReportController::class, 'attendanceStatistics'])->name('attendance-statistics');
            Route::get('/grade-distribution', [AdminReportController::class, 'gradeDistribution'])->name('grade-distribution');
        });
        // Server Management routes
        Route::get('/server', [ServerController::class, 'index'])->name('server.index');
    }
);

// Teacher routes
Route::prefix('teacher')->middleware(['auth', 'role:teacher', 'server.status'])->name('teacher.')->group(function () {
    Route::get('/dashboard', [TeacherDashboardController::class, 'index'])->name('dashboard');
    Route::get('profile/edit', [TeacherProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [TeacherProfileController::class, 'update'])->name('profile.update');
    Route::resource('schedules', TeacherScheduleController::class)->only(['index', 'show']);
    Route::resource('students', TeacherStudentController::class)->only(['index', 'show']);
    Route::get('students/by-class', [TeacherStudentController::class, 'getStudentsByClass'])->name('students.by-class');
    Route::resource('grades', TeacherGradeController::class);
    Route::post('grades/load-students', [TeacherGradeController::class, 'loadStudents'])->name('grades.load-students');
    Route::get('grades/export', [TeacherGradeController::class, 'export'])->name('grades.export');
    Route::get('grades/import', [TeacherGradeController::class, 'import'])->name('grades.import');
    Route::post('grades/import', [TeacherGradeController::class, 'processImport'])->name('grades.import.process');
    Route::get('grades/statistics', [TeacherGradeController::class, 'getStatistics'])->name('grades.statistics');
    Route::get('grades/students/ajax', [TeacherGradeController::class, 'getStudents'])->name('grades.students');

    Route::get('attendance', [TeacherAttendanceController::class, 'index'])->name('attendance.index');
    Route::get('attendance/create', [TeacherAttendanceController::class, 'create'])->name('attendance.create');
    Route::post('attendance', [TeacherAttendanceController::class, 'store'])->name('attendance.store');
    Route::get('attendance/create-qr', [TeacherAttendanceController::class, 'createQrSession'])->name('attendance.create-qr');
    Route::post('attendance/create-qr', [TeacherAttendanceController::class, 'storeQrSession'])->name('attendance.store-qr');
    Route::get('attendance/{id}', [TeacherAttendanceController::class, 'show'])->name('attendance.show');
    Route::post('attendance/{id}/toggle', [TeacherAttendanceController::class, 'toggleStatus'])->name('attendance.toggle');
    Route::delete('attendance/{id}', [TeacherAttendanceController::class, 'destroy'])->name('attendance.destroy');
    Route::post('attendance/{id}/update-student', [TeacherAttendanceController::class, 'updateStudentStatus'])->name('attendance.update-student');
    Route::post('attendance/{id}/send-notifications', [TeacherAttendanceController::class, 'sendAbsenceNotifications'])->name('attendance.send-notifications');
    Route::get('attendance/students/ajax', [TeacherAttendanceController::class, 'getStudents'])->name('attendance.students');
    Route::get('attendance/export', [TeacherAttendanceController::class, 'export'])->name('attendance.export');
    Route::get('attendance/{id}/export', [TeacherAttendanceController::class, 'exportSession'])->name('attendance.export-session');

    Route::resource('materials', TeacherMaterialController::class);
    Route::get('materials/{material}/download', [TeacherMaterialController::class, 'download'])->name('materials.download');
    Route::resource('announcements', TeacherAnnouncementController::class)->only(['index', 'show']);
    Route::get('announcements/{announcement}/download', [TeacherAnnouncementController::class, 'download'])->name('announcements.download');
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', [TeacherReportController::class, 'index'])->name('index');
        Route::get('/grades', [TeacherReportController::class, 'gradeReport'])->name('grades');
        Route::get('/attendance', [TeacherReportController::class, 'attendanceReport'])->name('attendance');
        Route::get('/class-performance', [TeacherReportController::class, 'classPerformance'])->name('class-performance');
    });
});

// Student routes
Route::prefix('student')->middleware(['auth', 'role:student', 'server.status'])->name('student.')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('profile/edit', [StudentProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [StudentProfileController::class, 'update'])->name('profile.update');
    Route::resource('schedules', StudentScheduleController::class);
    Route::resource('grades', StudentGradeController::class);

    Route::get('attendances', [StudentAttendanceController::class, 'index'])->name('attendances.index');
    Route::get('attendances/scan', [StudentAttendanceController::class, 'scanQr'])->name('attendances.scan');
    Route::get('attendances/success/{id}', [StudentAttendanceController::class, 'scanSuccess'])->name('attendances.success');

    Route::get('materials', [StudentMaterialController::class, 'index'])->name('materials.index');
    Route::get('materials/{material}', [StudentMaterialController::class, 'show'])->name('materials.show');
    Route::get('materials/{material}/download', [StudentMaterialController::class, 'download'])->name('materials.download');
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
