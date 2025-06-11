<?php

namespace Database\Seeders;

use App\Models\Classes;
use App\Models\Subjects;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all classes
        $classes = Classes::all();

        // Get all teachers
        $teachers = Teacher::all();

        if ($classes->isEmpty()) {
            $this->command->warn('No classes found. Please run ClassesSeeder first.');
            return;
        }

        if ($teachers->isEmpty()) {
            $this->command->warn('No teachers found. Please run TeacherSeeder first.');
            return;
        }

        // Definisikan mata pelajaran untuk masing-masing jurusan
        $ipaSubjects = [
            'Pendidikan Agama dan Budi Pekerti',
            'Pendidikan Pancasila dan Kewarganegaraan',
            'Bahasa Indonesia',
            'Matematika',
            'Sejarah Indonesia',
            'Bahasa Inggris',
            'Seni Budaya',
            'Pendidikan Jasmani, Olah Raga, dan Kesehatan',
            'Prakarya dan Kewirausahaan',
            'Bahasa Daerah (Jawa)',
            'Kebaharian',
            'Matematika',
            'Biologi',
            'Fisika',
            'Kimia',
            'Bahasa dan Sastra Inggris',
            'Bahasa Jepang',
            'Bimbingan Konseling',
            'Laboratorium Kepemimpinan'
        ];

        $ipsSubjects = [
            'Pendidikan Agama dan Budi Pekerti',
            'Pendidikan Pancasila dan Kewarganegaraan',
            'Bahasa Indonesia',
            'Matematika',
            'Sejarah Indonesia',
            'Bahasa Inggris',
            'Seni Budaya',
            'Pendidikan Jasmani, Olah Raga, dan Kesehatan',
            'Prakarya dan Kewirausahaan',
            'Bahasa Daerah (Jawa)',
            'Kebaharian',
            'Sejarah',
            'Geografi',
            'Sosiologi',
            'Ekonomi',
            'Bahasa dan Sastra Inggris',
            'Bahasa Jepang',
            'Bimbingan Konseling',
            'Laboratorium Kepemimpinan'
        ];

        // Definisi slot waktu
        $timeSlots = [
            ['start' => '07:00:00', 'end' => '07:45:00'],
            ['start' => '07:45:00', 'end' => '08:30:00'],
            ['start' => '08:30:00', 'end' => '09:15:00'],
            ['start' => '09:15:00', 'end' => '10:00:00'],
            ['start' => '10:30:00', 'end' => '11:15:00'], // Setelah istirahat
            ['start' => '11:15:00', 'end' => '12:00:00'],
            ['start' => '12:00:00', 'end' => '12:45:00'],
            ['start' => '12:45:00', 'end' => '13:30:00'],
            ['start' => '13:30:00', 'end' => '14:15:00'], // Setelah makan siang
            ['start' => '14:15:00', 'end' => '15:00:00'],
            ['start' => '15:00:00', 'end' => '15:45:00'],
        ];

        // Hari-hari dalam seminggu
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        // Membuat jadwal untuk setiap kelas
        foreach ($classes as $class) {
            $this->command->info("Creating schedules for {$class->class_name}");

            // Ambil mata pelajaran berdasarkan jurusan
            $subjects = ($class->major === 'IPA') ? $ipaSubjects : $ipsSubjects;

            // Jika kelas 12, kurangi jumlah mata pelajaran
            foreach ($days as $dayIndex => $day) {
                // Lewatkan hari Minggu
                if ($day === 'Saturday' && ($class->level >= 11 || rand(0, 1) === 0)) {
                    // For higher grades, Saturday has fewer classes or none
                    $maxSlots = ($class->level === 12) ? 0 : 4; // No classes for grade 12, 4 slots for grade 11
                } else {
                    // Normal school days have up to 8 slots depending on grade
                    $maxSlots = 10 - ($class->level - 10); // Fewer slots for higher grades
                }

                // Assign subjects to time slots for this day
                for ($slotIndex = 0; $slotIndex < $maxSlots; $slotIndex++) {
                    // Select a subject based on position in the week and level
                    $subjectIndex = ($dayIndex * 5 + $slotIndex + $class->level) % count($subjects);
                    $subjectName = $subjects[$subjectIndex];

                    // Find the subject in the database
                    $subject = Subjects::where('subject_name', $subjectName)->first();
                    if (!$subject) {
                        $this->command->warn("Subject '$subjectName' not found, skipping.");
                        continue;
                    }

                    // Select a teacher (we're randomly assigning teachers for now)
                    $teacher = $teachers->random();

                    // Get time slot
                    $timeSlot = $timeSlots[$slotIndex];

                    // Create the schedule
                    DB::table('class_schedules')->insert([
                        'class_id' => $class->id,
                        'teacher_id' => $teacher->id,
                        'subject_id' => $subject->id,
                        'day' => $day,
                        'semester' => ($dayIndex % 2 == 0) ? 'Odd' : 'Even', // Alternate semesters
                        'start_time' => $timeSlot['start'],
                        'end_time' => $timeSlot['end'],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }
            }

            $this->command->info("Schedule for {$class->class_name} created successfully!");
        }

        $this->command->info("All class schedules have been created!");
    }
}
