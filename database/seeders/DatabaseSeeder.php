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

        $this->call([
            SubjectsSeeder::class,
            TeacherSeeder::class,
            ClassesSeeder::class,
            StudentSeeder::class,
            ScheduleSeeder::class,
        ]);
    }
}
