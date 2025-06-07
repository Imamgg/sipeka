<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentGradeController extends Controller
{
  /**
   * Display a listing of the student's grades.
   */
  public function index()
  {
    $user = Auth::user();
    $student = Student::with(['classes'])->where('user_id', $user->id)->first();

    $currentSemester = request('semester', 'Ganjil');

    $grades = Grade::with(['subject'])
      ->where('student_id', $student->id)
      ->where('semester', $currentSemester)
      ->orderBy('subject_id')
      ->orderBy('type_assessment')
      ->get()
      ->groupBy(['subject.name', 'type_assessment']);

    // Calculate average per subject
    $subjectAverages = [];
    foreach ($grades as $subjectName => $assessmentTypes) {
      $totalScore = 0;
      $totalCount = 0;

      foreach ($assessmentTypes as $assessmentType => $gradeList) {
        foreach ($gradeList as $grade) {
          $totalScore += $grade->grade;
          $totalCount++;
        }
      }

      $subjectAverages[$subjectName] = $totalCount > 0 ? round($totalScore / $totalCount, 2) : 0;
    }

    return view('student.grades.index', compact('student', 'grades', 'subjectAverages', 'currentSemester'));
  }
}
