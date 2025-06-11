<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get teachers with their names to match specific homeroom assignments
        $teachers = DB::table('teachers')
            ->join('users', 'teachers.user_id', '=', 'users.id')
            ->select('teachers.id', 'users.name')
            ->get();

        if ($teachers->isEmpty()) {
            $this->command->warn('No teachers found. Please run TeacherSeeder first.');
            return;
        }

        $academicYear = '2025/2026';

        // Define classes with their designated homeroom teachers
        $classes = [
            // Kelas X (10)
            ['class_name' => 'X IPA', 'level' => 10, 'major' => 'IPA', 'teacher_name' => 'Eka Rizky R, S.Sos'],
            ['class_name' => 'X IPS', 'level' => 10, 'major' => 'IPS', 'teacher_name' => 'Fatimatuz Zahro, M.Pd'],

            // Kelas XI (11)
            ['class_name' => 'XI IPA', 'level' => 11, 'major' => 'IPA', 'teacher_name' => 'Yulianti, S.Pd'],
            ['class_name' => 'XI IPS', 'level' => 11, 'major' => 'IPS', 'teacher_name' => 'Enggar Sustiadi Pradana, S.Pd'],

            // Kelas XII (12)
            ['class_name' => 'XII IPA', 'level' => 12, 'major' => 'IPA', 'teacher_name' => 'Sri Sulastri Yuliana, S.Pd'],
            ['class_name' => 'XII IPS', 'level' => 12, 'major' => 'IPS', 'teacher_name' => 'Dhurotul Khoiriyah, S.Pd'],
        ];

        $this->command->info('Inserting ' . count($classes) . ' classes for academic year ' . $academicYear);

        // Assign specific teachers to classes based on their names
        foreach ($classes as $class) {
            // Find the teacher with the matching name
            $teacher = $teachers->where('name', $class['teacher_name'])->first();

            if (!$teacher) {
                $this->command->warn("Teacher {$class['teacher_name']} not found for class {$class['class_name']}. No homeroom teacher will be assigned.");
                $homeRoomTeacherId = null;
            } else {
                $homeRoomTeacherId = $teacher->id;
            }

            $classId = DB::table('classes')->insertGetId([
                'class_name' => $class['class_name'],
                'level' => $class['level'],
                'major' => $class['major'],
                'homeroom_teacher_id' => $homeRoomTeacherId,
                'academic_year' => $academicYear,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            $teacherName = $homeRoomTeacherId
                ? $class['teacher_name']
                : 'No homeroom teacher';

            $this->command->info("Created class {$class['class_name']} with homeroom teacher: {$teacherName}");
        }

        $this->command->info('All classes have been seeded successfully with designated homeroom teachers!');
    }
}
