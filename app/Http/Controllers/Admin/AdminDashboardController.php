<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalTeachers = Teacher::count();
        $totalStudents = Student::count();

        return Inertia::render('admin/dashboard', [
            'stats' => [
                'totalTeachers' => $totalTeachers,
                'totalStudents' => $totalStudents,
            ]
        ]);
    }
}
