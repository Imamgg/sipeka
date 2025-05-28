<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\ClassSchedule;
use App\Models\Subjects;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get sample teachers, students, and subjects
        $teachers = Teacher::with(['classSchedules.subject', 'classSchedules.class'])->get();
        $gradeTypes = ['assignment', 'quiz', 'midterm', 'final', 'daily'];

        foreach ($teachers as $teacher) {
            foreach ($teacher->classSchedules as $schedule) {
                // Get students in this class
                $students = Student::where('class_id', $schedule->class_id)->get();

                foreach ($students as $student) {
                    // Create 3-5 random grades per student per subject
                    $gradeCount = rand(3, 5);

                    for ($i = 0; $i < $gradeCount; $i++) {
                        Grade::create([
                            'student_id' => $student->id,
                            'subject_id' => $schedule->subject_id,
                            'teacher_id' => $teacher->id,
                            'type_assessment' => ucfirst($gradeTypes[array_rand($gradeTypes)]),
                            'grade_type' => $gradeTypes[array_rand($gradeTypes)],
                            'grade' => rand(60, 100),
                            'score' => rand(60, 100),
                            'semester' => rand(0, 1) ? 'Odd' : 'Even',
                            'date' => Carbon::now()->subDays(rand(1, 30)),
                            'description' => 'Sample grade entry for ' . $gradeTypes[array_rand($gradeTypes)],
                        ]);
                    }
                }
            }
        }

        $this->command->info('Sample grades created successfully!');
    }
}
