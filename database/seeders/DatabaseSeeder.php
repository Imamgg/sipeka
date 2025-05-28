<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Classes;
use App\Models\Subjects;
use App\Models\ClassSchedule;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Imamgg',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);


        // Create Teachers
        $this->createTeachers();

        // Create Students
        $this->createStudents();

        // Create Subjects
        $this->createSubjects();

        // Create Class Schedules
        $this->createClassSchedules();
    }

    /**
     * Create sample teachers
     */
    private function createTeachers()
    {
        Teacher::factory()->count(10)->create();
    }

    /**
     * Create sample students
     */
    private function createStudents()
    {
        // Create classes first
        $classes = Classes::factory()->count(6)->create();

        // Create students and assign them to random classes
        Student::factory()
            ->count(30)
            ->create([
                'class_id' => fn() => $classes->random()->id
            ]);
    }

    /**
     * Create sample subjects
     */
    private function createSubjects()
    {
        $commonSubjects = [
            'Mathematics' => 'Study of numbers, quantities, and shapes',
            'Physics' => 'Study of matter, energy, and the interaction between them',
            'Chemistry' => 'Study of substances, their properties, structure, and the changes they undergo',
            'Biology' => 'Study of living organisms and their interactions',
            'Literature' => 'Study of written works with artistic or intellectual value',
            'History' => 'Study of past events',
            'Geography' => 'Study of places and relationships between people and their environments',
            'Computer Science' => 'Study of computers and computational systems',
            'Physical Education' => 'Education in physical exercise, care of the body',
            'Art' => 'Expression or application of creative skill and imagination',
            'Music' => 'Study of vocal or instrumental sounds',
            'Economics' => 'Study of how goods and services are produced, distributed, and consumed',
            'Psychology' => 'Study of mind and behavior',
            'Sociology' => 'Study of society, patterns of social relationships, and culture'
        ];

        $counter = 1;
        foreach ($commonSubjects as $name => $description) {
            Subjects::factory()->create([
                'code_subject' => 'SUBJ-' . str_pad($counter, 4, '0', STR_PAD_LEFT),
                'subject_name' => $name,
                'description' => $description,
            ]);
            $counter++;
        }

        // Create a few additional random subjects as well
        Subjects::factory()->count(6)->create();
    }

    /**
     * Create sample class schedules
     */
    private function createClassSchedules()
    {
        // Get existing data
        $classes = Classes::all();
        $teachers = Teacher::all();
        $subjects = Subjects::all();

        // Days of the week for scheduling
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        // For each class, create multiple schedules with different subjects
        foreach ($classes as $class) {
            // Each class has 8-12 different subjects in their schedule
            $subjectsCount = fake()->numberBetween(8, 12);
            $classSubjects = $subjects->random($subjectsCount);

            foreach ($classSubjects as $subject) {
                // Assign a random teacher for this subject
                $teacher = $teachers->random();

                // Determine which day this subject is taught (avoid duplicates on same day for same class)
                $day = fake()->randomElement($days);

                // Random start time between 7:00 and 16:00
                $startHour = fake()->numberBetween(7, 16);
                $startMinute = fake()->randomElement([0, 15, 30, 45]);
                $startTime = sprintf('%02d:%02d:00', $startHour, $startMinute);

                // End time is 1-2 hours after start time
                $durationHours = fake()->randomElement([1, 1.5, 2]);
                $endHour = $startHour + floor($durationHours);
                $endMinute = ($startMinute + ($durationHours - floor($durationHours)) * 60) % 60;

                // If we roll over to the next hour
                if ($endMinute < $startMinute) {
                    $endHour++;
                }

                $endTime = sprintf('%02d:%02d:00', $endHour, $endMinute);

                // Create the class schedule
                ClassSchedule::create([
                    'class_id' => $class->id,
                    'teacher_id' => $teacher->id,
                    'subject_id' => $subject->id,
                    'day' => $day,
                    'semester' => fake()->randomElement(['Odd', 'Even']),
                    'start_time' => $startTime,
                    'end_time' => $endTime,
                ]);
            }
        }
    }
}
