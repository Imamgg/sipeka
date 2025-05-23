<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Classes;
use Carbon\Carbon;
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
}
