<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\Teacher\TeacherDashboardController;
use App\Models\Teacher;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    // Admin routes
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('students', StudentController::class);
    Route::resource('teachers', TeacherController::class);

    Route::get('student/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
    Route::get('teacher/dashboard', [TeacherDashboardController::class, 'index'])->name('teacher.dashboard');
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
