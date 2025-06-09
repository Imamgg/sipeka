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
        User::factory()->create([
            'name' => 'Imamgg',
            'email' => 'admin@gmail.com',
            'phone_number' => '085335355129',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        Admin::create([
            'user_id' => 1,
            'full_name' => 'Imam Syafii',
        ]);

        //     $this->createTeachers();

        //     $this->createStudents();

        //     $this->createSubjects();

        //     $this->createClassSchedules();
        // }

        // /**
        //  * Create sample teachers
        //  */
        // private function createTeachers()
        // {
        //     Teacher::factory()->count(10)->create();
        // }

        // /**
        //  * Create sample students
        //  */
        // private function createStudents()
        // {
        //     $classes = Classes::factory()->count(6)->create();
        //     Student::factory()
        //         ->count(30)
        //         ->create([
        //             'class_id' => fn() => $classes->random()->id
        //         ]);
        // }

        // /**
        //  * Create sample subjects
        //  */
        // private function createSubjects()
        // {
        //     $commonSubjects = [
        //         'Bahasa Indonesia' => 'Mata pelajaran yang mempelajari bahasa Indonesia, termasuk tata bahasa, sastra, dan keterampilan berbahasa.',
        //         'Matematika' => 'Mata pelajaran yang mempelajari konsep-konsep matematika dasar seperti aritmetika, geometri, dan aljabar.',
        //         'Ilmu Pengetahuan Alam' => 'Mata pelajaran yang mempelajari fenomena alam, termasuk fisika, kimia, dan biologi.',
        //         'Ilmu Pengetahuan Sosial' => 'Mata pelajaran yang mempelajari aspek sosial, budaya, ekonomi, dan politik masyarakat.',
        //         'Bahasa Inggris' => 'Mata pelajaran yang mempelajari bahasa Inggris, termasuk tata bahasa, kosakata, dan keterampilan berbahasa.',
        //         'Pendidikan Pancasila dan Kewarganegaraan' => 'Mata pelajaran yang mempelajari nilai-nilai Pancasila, hak dan kewajiban warga negara, serta sistem pemerintahan Indonesia.',
        //         'Seni Budaya' => 'Mata pelajaran yang mempelajari seni rupa, seni musik, seni tari, dan seni pertunjukan.',
        //         'Pendidikan Jasmani, Olahraga, dan Kesehatan' => 'Mata pelajaran yang mempelajari aktivitas fisik, olahraga, dan pentingnya kesehatan.',
        //         'Prakarya dan Kewirausahaan' => 'Mata pelajaran yang mempelajari keterampilan prakarya, kerajinan, dan dasar-dasar kewirausahaan.',
        //     ];

        //     $counter = 1;
        //     foreach ($commonSubjects as $name => $description) {
        //         Subjects::factory()->create([
        //             'code_subject' => 'SUBJ-' . str_pad($counter, 4, '0', STR_PAD_LEFT),
        //             'subject_name' => $name,
        //             'description' => $description,
        //         ]);
        //         $counter++;
        //     }
        //     Subjects::factory()->count(6)->create();
        // }

        // /**
        //  * Create sample class schedules
        //  */
        // private function createClassSchedules()
        // {
        //     $classes = Classes::all();
        //     $teachers = Teacher::all();
        //     $subjects = Subjects::all();

        //     $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        //     foreach ($classes as $class) {
        //         $subjectsCount = fake()->numberBetween(8, 12);
        //         $classSubjects = $subjects->random($subjectsCount);

        //         foreach ($classSubjects as $subject) {
        //             $teacher = $teachers->random();

        //             $day = fake()->randomElement($days);

        //             $startHour = fake()->numberBetween(7, 16);
        //             $startMinute = fake()->randomElement([0, 15, 30, 45]);
        //             $startTime = sprintf('%02d:%02d:00', $startHour, $startMinute);

        //             $durationHours = fake()->randomElement([1, 1.5, 2]);
        //             $endHour = $startHour + floor($durationHours);
        //             $endMinute = ($startMinute + ($durationHours - floor($durationHours)) * 60) % 60;

        //             if ($endMinute < $startMinute) {
        //                 $endHour++;
        //             }

        //             $endTime = sprintf('%02d:%02d:00', $endHour, $endMinute);

        //             ClassSchedule::create([
        //                 'class_id' => $class->id,
        //                 'teacher_id' => $teacher->id,
        //                 'subject_id' => $subject->id,
        //                 'day' => $day,
        //                 'semester' => fake()->randomElement(['Odd', 'Even']),
        //                 'start_time' => $startTime,
        //                 'end_time' => $endTime,
        //             ]);
        //         }
        //     }
    }
}
