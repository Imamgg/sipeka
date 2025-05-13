<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TeacherDashboardController extends Controller
{
  public function index()
  {
    // In a real application, you would get the authenticated teacher
    // and fetch their specific data
    // Example: $teacher = auth()->user();

    // Static data for the dashboard (for demonstration)
    $stats = [
      'totalStudents' => 124,
      'classesTaught' => 5,
      'averageAttendance' => 92,
      'averageGrade' => 'B+',
    ];
    return Inertia::render('teacher/dashboard', [
      'stats' => $stats
    ]);
  }
}
