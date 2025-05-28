<?php

namespace Database\Seeders;

use App\Models\Presence;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\ClassSchedule;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PresenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = Teacher::with(['classSchedules.subject', 'classSchedules.class'])->get();
        $statuses = ['present', 'absent', 'late', 'sick', 'permit'];

        foreach ($teachers as $teacher) {
            foreach ($teacher->classSchedules as $schedule) {
                $students = Student::where('class_id', $schedule->class_id)->get();

                // Create attendance for last 20 days
                for ($day = 0; $day < 20; $day++) {
                    $date = Carbon::now()->subDays($day);

                    // Skip weekends
                    if ($date->isWeekend()) {
                        continue;
                    }

                    foreach ($students as $student) {
                        // 80% chance of being present, 20% other statuses
                        $status = rand(1, 100) <= 80 ? 'present' : $statuses[array_rand($statuses)];

                        Presence::create([
                            'student_id' => $student->id,
                            'class_id' => $schedule->class_id,
                            'subject_id' => $schedule->subject_id,
                            'teacher_id' => $teacher->id,
                            'date' => $date,
                            'status' => $status,
                            'notes' => $status !== 'present' ? 'Auto-generated sample data' : null,
                        ]);
                    }
                }
            }
        }

        $this->command->info('Sample attendance records created successfully!');
    }
}
