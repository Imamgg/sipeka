<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StudentDashboardController extends Controller
{
  public function index()
  {
    // In a real application, you would get the authenticated student
    // and fetch their specific data
    // Example: $student = auth()->user();

    // Static data for the dashboard (for demonstration)
    $stats = [
      'overallGPA' => '3.85',
      'attendanceRate' => 98,
      'completedAssignments' => 24,
      'upcomingTests' => 3,
    ];
    return Inertia::render('student/dashboard', [
      'stats' => $stats
    ]);
  }
}
