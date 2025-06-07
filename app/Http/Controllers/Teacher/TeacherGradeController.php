<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Classes;
use App\Models\Subjects;
use App\Models\ClassSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class TeacherGradeController extends Controller
{
  /**
   * Display a listing of grades for the authenticated teacher.
   */
  public function index(Request $request)
  {
    $user = Auth::user();
    $teacher = $user->teacher;

    if (!$teacher) {
      return redirect()->route('teacher.dashboard')->with('error', 'Teacher data not found.');
    }

    // Get classes and subjects taught by this teacher
    $taughtClassIds = ClassSchedule::where('teacher_id', $teacher->id)
      ->distinct('class_id')
      ->pluck('class_id');

    $taughtSubjectIds = ClassSchedule::where('teacher_id', $teacher->id)
      ->distinct('subject_id')
      ->pluck('subject_id');

    $classes = Classes::whereIn('id', $taughtClassIds)->orderBy('class_name')->get();
    $subjects = Subjects::whereIn('id', $taughtSubjectIds)->orderBy('subject_name')->get();

    // Build query for grades
    $query = Grade::with(['student.user', 'subject', 'teacher.user'])
      ->where('teacher_id', $teacher->id);

    // Apply filters
    if ($request->filled('class_id')) {
      $query->whereHas('student', function ($q) use ($request) {
        $q->where('class_id', $request->class_id);
      });
    }

    if ($request->filled('subject_id')) {
      $query->where('subject_id', $request->subject_id);
    }

    if ($request->filled('grade_type')) {
      $query->where('grade_type', $request->grade_type);
    }

    if ($request->filled('semester')) {
      $query->where('semester', $request->semester);
    }

    // Get grades with pagination
    $grades = $query->orderBy('date', 'desc')
      ->orderBy('created_at', 'desc')
      ->paginate(20);

    return view('teacher.grades.index', compact('grades', 'classes', 'subjects'));
  }

  /**
   * Show the form for creating new grades.
   */
  public function create(Request $request)
  {
    $user = Auth::user();
    $teacher = $user->teacher;

    if (!$teacher) {
      return redirect()->route('teacher.dashboard')->with('toast_error', 'Data guru tidak ditemukan.');
    }

    // Get classes and subjects taught by this teacher
    $taughtClassIds = ClassSchedule::where('teacher_id', $teacher->id)
      ->distinct('class_id')
      ->pluck('class_id');

    $taughtSubjectIds = ClassSchedule::where('teacher_id', $teacher->id)
      ->distinct('subject_id')
      ->pluck('subject_id');

    $classes = Classes::whereIn('id', $taughtClassIds)->orderBy('class_name')->get();
    $subjects = Subjects::whereIn('id', $taughtSubjectIds)->orderBy('subject_name')->get();

    // Initialize empty collection for students - will be loaded via AJAX
    $students = collect();
    $selectedClassId = $request->get('class_id');
    $selectedSubjectId = $request->get('subject_id');

    return view('teacher.grades.create', compact('classes', 'subjects', 'students', 'selectedClassId', 'selectedSubjectId'));
  }

  /**
   * Store newly created grades in storage.
   */
  public function store(Request $request)
  {
    $user = Auth::user();
    $teacher = $user->teacher;

    if (!$teacher) {
      return redirect()->route('teacher.dashboard')->with('toast_error', 'Data guru tidak ditemukan.');
    }


    // Validate basic form data
    $validator = Validator::make($request->all(), [
      'class_id' => 'required|exists:classes,id',
      'subject_id' => 'required|exists:subjects,id',
      'grade_type' => 'required|in:tugas,kuis,uts,uas',
      'assessment_name' => 'nullable|string|max:255',
      'assessment_date' => 'nullable|date',
      'semester' => 'nullable|in:Ganjil,Genap',
      'notes' => 'nullable|string|max:1000',
      'students' => 'required|array|min:1',
      'students.*.student_id' => 'required|exists:students,id',
      'students.*.grade' => 'nullable|numeric|min:0|max:100',
    ], [
      'students.required' => 'Data siswa tidak boleh kosong',
      'students.min' => 'Minimal harus ada 1 siswa',
      'students.*.student_id.required' => 'ID siswa tidak boleh kosong',
      'students.*.student_id.exists' => 'Siswa tidak ditemukan di database',
      'students.*.grade.numeric' => 'Nilai harus berupa angka',
      'students.*.grade.min' => 'Nilai minimal adalah 0',
      'students.*.grade.max' => 'Nilai maksimal adalah 100',
    ]);

    if ($validator->fails()) {
      return redirect()->back()
        ->withErrors($validator)
        ->withInput();
    }

    // Additional validation: Check if at least one grade is filled
    $hasValidGrades = false;
    foreach ($request->students as $studentData) {
      if (!empty($studentData['grade']) || $studentData['grade'] === '0') {
        $hasValidGrades = true;
        break;
      }
    }

    if (!$hasValidGrades) {
      return redirect()->back()
        ->with('toast_error', 'Minimal harus ada satu siswa yang diberi nilai.')
        ->withInput();
    }

    // Verify teacher has access to the class and subject
    $hasAccess = $this->verifyTeacherAccess($teacher->id, $request->class_id, $request->subject_id);

    if (!$hasAccess) {
      return redirect()->back()
        ->with('toast_error', 'Anda tidak memiliki izin untuk memberikan nilai pada kelas atau mata pelajaran ini.')
        ->withInput();
    }

    try {
      DB::beginTransaction();

      $currentSemester = $request->semester ?: $this->getCurrentSemester();
      $assessmentDate = $request->assessment_date ? Carbon::parse($request->assessment_date) : Carbon::now();

      $gradesSaved = 0;

      foreach ($request->students as $studentData) {
        // Skip if grade is empty or null
        if (empty($studentData['grade']) && $studentData['grade'] !== '0') {
          continue;
        }

        // Verify student belongs to the selected class
        $student = Student::where('id', $studentData['student_id'])
          ->where('class_id', $request->class_id)
          ->first();

        if (!$student) {
          continue;
        }

        // Pastikan nilai valid dan dalam bentuk numerik
        $score = is_numeric($studentData['grade']) ? (float) $studentData['grade'] : 0;

        // Batasi nilai antara 0-100
        $score = max(0, min(100, $score));

        // Format nilai dengan 2 angka desimal
        $score = round($score, 2);

        $grade = Grade::create([
          'student_id' => $student->id,
          'subject_id' => $request->subject_id,
          'teacher_id' => $teacher->id,
          'grade_type' => $request->grade_type,
          'type_assessment' => $request->assessment_name ?: $this->getDefaultAssessmentName($request->grade_type),
          'score' => $score,
          'grade' => $score, // Use numeric score instead of letter grade
          'semester' => $currentSemester,
          'date' => $assessmentDate,
          'description' => $request->notes,
          'verification_status' => 'pending',
        ]);

        $gradesSaved++;
      }

      DB::commit();

      // Provide feedback based on actual grades saved
      if ($gradesSaved > 0) {
        return redirect()->route('teacher.grades.index')
          ->with('toast_success', 'Nilai berhasil disimpan untuk ' . $gradesSaved . ' siswa.');
      } else {
        return redirect()->back()
          ->with('toast_warning', 'Tidak ada nilai yang disimpan. Pastikan Anda telah mengisi nilai untuk setidaknya satu siswa.')
          ->withInput();
      }
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()->back()
        ->with('toast_error', 'Terjadi kesalahan saat menyimpan nilai. Silahkan hubungi administrator.')
        ->withInput();
    }
  }

  /**
   * Show the form for editing the specified grade.
   */
  public function edit($id)
  {
    $user = Auth::user();
    $teacher = $user->teacher;

    if (!$teacher) {
      return redirect()->route('teacher.dashboard')->with('toast_error', 'Data guru tidak ditemukan.');
    }

    $grade = Grade::with(['student.user', 'subject'])
      ->where('id', $id)
      ->where('teacher_id', $teacher->id)
      ->first();

    if (!$grade) {
      return redirect()->route('teacher.grades.index')
        ->with('toast_error', 'Nilai tidak ditemukan atau Anda tidak memiliki izin untuk mengeditnya.');
    }

    return view('teacher.grades.edit', compact('grade'));
  }

  /**
   * Update the specified grade in storage.
   */
  public function update(Request $request, $id)
  {
    $user = Auth::user();
    $teacher = $user->teacher;

    if (!$teacher) {
      return redirect()->route('teacher.dashboard')->with('toast_error', 'Data guru tidak ditemukan.');
    }

    $grade = Grade::where('id', $id)
      ->where('teacher_id', $teacher->id)
      ->first();

    if (!$grade) {
      return redirect()->route('teacher.grades.index')
        ->with('toast_error', 'Nilai tidak ditemukan atau Anda tidak memiliki izin untuk mengeditnya.');
    }

    // Validate the request
    $validator = Validator::make($request->all(), [
      'grade_type' => 'required|in:tugas,kuis,uts,uas',
      'assessment_name' => 'nullable|string|max:255',
      'score' => 'required|numeric|min:0|max:100',
      'description' => 'nullable|string|max:1000',
    ]);

    if ($validator->fails()) {
      return redirect()->back()
        ->withErrors($validator)
        ->withInput();
    }

    try {
      $grade->update([
        'grade_type' => $request->grade_type,
        'type_assessment' => $request->assessment_name ?: $this->getDefaultAssessmentName($request->grade_type),
        'score' => $request->score,
        'grade' => $request->score, // Use numeric score instead of letter grade
        'description' => $request->description,
        'verification_status' => 'pending', // Reset verification status when updated
      ]);

      return redirect()->route('teacher.grades.index')
        ->with('success', 'Grade has been successfully updated.');
    } catch (\Exception $e) {
      return redirect()->back()
        ->with('error', 'An error occurred while updating the grade. Please try again.')
        ->withInput();
    }
  }

  /**
   * Remove the specified grade from storage.
   */
  public function destroy($id)
  {
    $user = Auth::user();
    $teacher = $user->teacher;

    if (!$teacher) {
      return redirect()->route('teacher.dashboard')->with('error', 'Teacher data not found.');
    }

    $grade = Grade::where('id', $id)
      ->where('teacher_id', $teacher->id)
      ->first();

    if (!$grade) {
      return redirect()->route('teacher.grades.index')
        ->with('error', 'Grade not found or you do not have permission to delete it.');
    }

    try {
      $grade->delete();

      return redirect()->route('teacher.grades.index')
        ->with('success', 'Grade has been successfully deleted.');
    } catch (\Exception $e) {
      return redirect()->route('teacher.grades.index')
        ->with('error', 'An error occurred while deleting the grade. Please try again.');
    }
  }

  /**
   * Verify teacher has access to grade the specified class and subject.
   */
  private function verifyTeacherAccess($teacherId, $classId, $subjectId)
  {
    return ClassSchedule::where('teacher_id', $teacherId)
      ->where('class_id', $classId)
      ->where('subject_id', $subjectId)
      ->exists();
  }

  /**
   * Get the current semester based on the date.
   */
  private function getCurrentSemester()
  {
    $currentMonth = Carbon::now()->month;

    // Assuming semester Ganjil is July-December, semester Genap is January-June
    return $currentMonth >= 7 ? 'Ganjil' : 'Genap';
  }

  /**
   * Convert numerical score to letter grade.
   */
  private function convertScoreToGrade($score)
  {
    if ($score >= 90) return 'A';
    if ($score >= 80) return 'B';
    if ($score >= 70) return 'C';
    if ($score >= 60) return 'D';
    return 'E';
  }

  /**
   * Get default assessment name based on grade type.
   */
  private function getDefaultAssessmentName($gradeType)
  {
    $names = [
      'tugas' => 'Tugas',
      'kuis' => 'Kuis',
      'uts' => 'Ujian Tengah Semester',
      'uas' => 'Ujian Akhir Semester',
    ];

    return $names[$gradeType] ?? 'Penilaian';
  }

  /**
   * Export grades to CSV format.
   */
  public function export(Request $request)
  {
    $user = Auth::user();
    $teacher = $user->teacher;

    if (!$teacher) {
      return redirect()->route('teacher.dashboard')->with('error', 'Teacher data not found.');
    }

    // Build query for grades
    $query = Grade::with(['student.user', 'subject'])
      ->where('teacher_id', $teacher->id);

    // Apply filters
    if ($request->filled('class_id')) {
      $query->whereHas('student', function ($q) use ($request) {
        $q->where('class_id', $request->class_id);
      });
    }

    if ($request->filled('subject_id')) {
      $query->where('subject_id', $request->subject_id);
    }

    if ($request->filled('grade_type')) {
      $query->where('grade_type', $request->grade_type);
    }

    $grades = $query->orderBy('date', 'desc')->get();

    $filename = 'grades_export_' . Carbon::now()->format('Y-m-d_H-i-s') . '.csv';

    $headers = [
      'Content-Type' => 'text/csv',
      'Content-Disposition' => "attachment; filename=\"$filename\"",
    ];

    $callback = function () use ($grades) {
      $file = fopen('php://output', 'w');

      // Add CSV headers
      fputcsv($file, [
        'Student Name',
        'NISN',
        'Subject',
        'Grade Type',
        'Assessment',
        'Score',
        'Grade',
        'Semester',
        'Date',
        'Description'
      ]);

      // Add data rows
      foreach ($grades as $grade) {
        fputcsv($file, [
          $grade->student->user->name,
          $grade->student->nisn,
          $grade->subject->name,
          ucfirst($grade->grade_type),
          $grade->type_assessment,
          $grade->score,
          $grade->grade,
          $grade->semester,
          $grade->date->format('Y-m-d'),
          $grade->description
        ]);
      }

      fclose($file);
    };

    return response()->stream($callback, 200, $headers);
  }

  /**
   * Get grade statistics for dashboard.
   */
  public function getStatistics(Request $request)
  {
    $user = Auth::user();
    $teacher = $user->teacher;

    if (!$teacher) {
      return response()->json(['error' => 'Teacher data not found.'], 404);
    }

    // Build query for grades
    $query = Grade::where('teacher_id', $teacher->id);

    // Apply filters if provided
    if ($request->filled('class_id')) {
      $query->whereHas('student', function ($q) use ($request) {
        $q->where('class_id', $request->class_id);
      });
    }

    if ($request->filled('subject_id')) {
      $query->where('subject_id', $request->subject_id);
    }

    if ($request->filled('semester')) {
      $query->where('semester', $request->semester);
    }

    $grades = $query->get();

    // Calculate statistics
    $statistics = [
      'total_grades' => $grades->count(),
      'average_score' => $grades->avg('score'),
      'highest_score' => $grades->max('score'),
      'lowest_score' => $grades->min('score'),
      'grade_distribution' => [
        'A' => $grades->where('grade', 'A')->count(),
        'B' => $grades->where('grade', 'B')->count(),
        'C' => $grades->where('grade', 'C')->count(),
        'D' => $grades->where('grade', 'D')->count(),
        'E' => $grades->where('grade', 'E')->count(),
      ],
      'grade_type_distribution' => [
        'tugas' => $grades->where('grade_type', 'tugas')->count(),
        'kuis' => $grades->where('grade_type', 'kuis')->count(),
        'uts' => $grades->where('grade_type', 'uts')->count(),
        'uas' => $grades->where('grade_type', 'uas')->count(),
      ],
      'recent_grades' => $grades->sortByDesc('created_at')->take(5)->map(function ($grade) {
        return [
          'student_name' => $grade->student->user->name,
          'subject_name' => $grade->subject->name,
          'score' => $grade->score,
          'grade' => $grade->grade,
          'date' => $grade->date->format('Y-m-d'),
        ];
      })->values(),
    ];

    return response()->json($statistics);
  }

  /**
   * Show bulk import form.
   */
  public function import()
  {
    $user = Auth::user();
    $teacher = $user->teacher;

    if (!$teacher) {
      return redirect()->route('teacher.dashboard')->with('error', 'Teacher data not found.');
    }

    // Get classes and subjects taught by this teacher
    $taughtClassIds = ClassSchedule::where('teacher_id', $teacher->id)
      ->distinct('class_id')
      ->pluck('class_id');

    $taughtSubjectIds = ClassSchedule::where('teacher_id', $teacher->id)
      ->distinct('subject_id')
      ->pluck('subject_id');

    $classes = Classes::whereIn('id', $taughtClassIds)->orderBy('class_name')->get();
    $subjects = Subjects::whereIn('id', $taughtSubjectIds)->orderBy('subject_name')->get();

    return view('teacher.grades.import', compact('classes', 'subjects'));
  }

  /**
   * Process bulk import from CSV.
   */
  public function processImport(Request $request)
  {
    $user = Auth::user();
    $teacher = $user->teacher;

    if (!$teacher) {
      return redirect()->route('teacher.dashboard')->with('error', 'Teacher data not found.');
    }

    // Validate the request
    $validator = Validator::make($request->all(), [
      'csv_file' => 'required|file|mimes:csv,txt|max:2048',
      'class_id' => 'required|exists:classes,id',
      'subject_id' => 'required|exists:subjects,id',
      'grade_type' => 'required|in:tugas,kuis,uts,uas',
      'assessment_name' => 'nullable|string|max:255',
      'assessment_date' => 'nullable|date',
      'semester' => 'nullable|in:Ganjil,Genap',
    ]);

    if ($validator->fails()) {
      return redirect()->back()
        ->withErrors($validator)
        ->withInput();
    }

    // Verify teacher has access
    $hasAccess = $this->verifyTeacherAccess($teacher->id, $request->class_id, $request->subject_id);

    if (!$hasAccess) {
      return redirect()->back()
        ->with('error', 'You do not have permission to grade this class or subject.')
        ->withInput();
    }

    try {
      $file = $request->file('csv_file');
      $csvData = array_map('str_getcsv', file($file->getRealPath()));
      $header = array_shift($csvData); // Remove header row

      // Expected CSV format: NISN, Grade
      $expectedHeaders = ['NISN', 'Grade'];
      if (count($header) < 2 || strtoupper($header[0]) !== 'NISN' || strtoupper($header[1]) !== 'GRADE') {
        return redirect()->back()
          ->with('error', 'CSV format incorrect. Expected columns: NISN, Grade')
          ->withInput();
      }

      DB::beginTransaction();

      $successCount = 0;
      $errorCount = 0;
      $errors = [];

      $currentSemester = $request->semester ?: $this->getCurrentSemester();
      $assessmentDate = $request->assessment_date ? Carbon::parse($request->assessment_date) : Carbon::now();

      foreach ($csvData as $rowIndex => $row) {
        if (count($row) < 2) {
          $errors[] = "Row " . ($rowIndex + 2) . ": Incomplete data";
          $errorCount++;
          continue;
        }

        $nisn = trim($row[0]);
        $score = trim($row[1]);

        // Validate score
        if (!is_numeric($score) || $score < 0 || $score > 100) {
          $errors[] = "Row " . ($rowIndex + 2) . ": Invalid score '$score' for NISN $nisn";
          $errorCount++;
          continue;
        }

        // Find student
        $student = Student::where('nisn', $nisn)
          ->where('class_id', $request->class_id)
          ->first();

        if (!$student) {
          $errors[] = "Row " . ($rowIndex + 2) . ": Student with NISN '$nisn' not found in selected class";
          $errorCount++;
          continue;
        }

        // Create grade
        Grade::create([
          'student_id' => $student->id,
          'subject_id' => $request->subject_id,
          'teacher_id' => $teacher->id,
          'grade_type' => $request->grade_type,
          'type_assessment' => $request->assessment_name ?: $this->getDefaultAssessmentName($request->grade_type),
          'score' => $score,
          'grade' => $score, // Use numeric score instead of letter grade
          'semester' => $currentSemester,
          'date' => $assessmentDate,
          'description' => 'Imported from CSV',
          'verification_status' => 'pending',
        ]);

        $successCount++;
      }

      DB::commit();

      $message = "Import completed: $successCount grades imported successfully";
      if ($errorCount > 0) {
        $message .= ", $errorCount errors occurred";
      }

      return redirect()->route('teacher.grades.index')
        ->with('success', $message)
        ->with('import_errors', $errors);
    } catch (\Exception $e) {
      DB::rollBack();

      return redirect()->back()
        ->with('error', 'An error occurred during import: ' . $e->getMessage())
        ->withInput();
    }
  }

  /**
   * Load students via AJAX for grade input.
   */
  public function loadStudents(Request $request)
  {
    $user = Auth::user();
    $teacher = $user->teacher;

    if (!$teacher) {
      return response()->json(['success' => false, 'message' => 'Data guru tidak ditemukan.'], 404);
    }

    // Validate the request
    $validator = Validator::make($request->all(), [
      'class_id' => 'required|exists:classes,id',
      'subject_id' => 'required|exists:subjects,id',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'success' => false,
        'message' => 'Kelas atau mata pelajaran tidak valid.',
        'errors' => $validator->errors()
      ], 400);
    }

    // Verify teacher has access to this class and subject
    $hasAccess = $this->verifyTeacherAccess($teacher->id, $request->class_id, $request->subject_id);

    if (!$hasAccess) {
      return response()->json([
        'success' => false,
        'message' => 'Anda tidak memiliki izin untuk mengakses kelas atau mata pelajaran ini.'
      ], 403);
    }

    try {
      // Get students from the selected class
      $students = Student::with('user')
        ->where('class_id', $request->class_id)
        ->whereHas('user')  // Ensure user exists
        ->join('users', 'students.user_id', '=', 'users.id')
        ->orderBy('users.name')
        ->select('students.*')
        ->get();

      if ($students->isEmpty()) {
        return response()->json([
          'success' => true,
          'students' => [],
          'message' => 'Tidak ada siswa di kelas ini.'
        ]);
      }

      // Format student data for frontend
      $studentData = $students->map(function ($student) {
        return [
          'id' => $student->id,
          'name' => $student->user->name,
          'nisn' => $student->nisn
        ];
      });

      return response()->json([
        'success' => true,
        'students' => $studentData,
        'message' => 'Daftar siswa berhasil dimuat.'
      ]);
    } catch (\Exception $e) {

      return response()->json([
        'success' => false,
        'message' => 'Terjadi kesalahan saat memuat daftar siswa. Silakan coba lagi.'
      ], 500);
    }
  }
}
