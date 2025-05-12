<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin
        $user = User::create([
            'name' => 'Imamgg',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
        ]);

        Admin::create([
            'user_id' => $user->id,
            'name' => 'Imamgg',
            'email' => 'admin@gmail.com',
        ]);

        // Create 5 Teachers
        $teachers = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@gmail.com',
                'nip' => '198507152010011001',
                'place_of_birth' => 'Jakarta',
                'date_of_birth' => '1985-07-15',
                'gender' => 'M',
                'address' => 'Jl. Merdeka No. 123, Jakarta Selatan',
                'phone_number' => '081234567890',
            ],
            [
                'name' => 'Siti Rahayu',
                'email' => 'siti.rahayu@gmail.com',
                'nip' => '198603222011012001',
                'place_of_birth' => 'Bandung',
                'date_of_birth' => '1986-03-22',
                'gender' => 'F',
                'address' => 'Jl. Asia Afrika No. 45, Bandung',
                'phone_number' => '081345678901',
            ],
            [
                'name' => 'Ahmad Hidayat',
                'email' => 'ahmad.hidayat@gmail.com',
                'nip' => '198808102012011002',
                'place_of_birth' => 'Surabaya',
                'date_of_birth' => '1988-08-10',
                'gender' => 'M',
                'address' => 'Jl. Pemuda No. 67, Surabaya',
                'phone_number' => '081456789012',
            ],
            [
                'name' => 'Dewi Lestari',
                'email' => 'dewi.lestari@gmail.com',
                'nip' => '199001152013012001',
                'place_of_birth' => 'Yogyakarta',
                'date_of_birth' => '1990-01-15',
                'gender' => 'F',
                'address' => 'Jl. Malioboro No. 89, Yogyakarta',
                'phone_number' => '081567890123',
            ],
            [
                'name' => 'Rudi Hartono',
                'email' => 'rudi.hartono@gmail.com',
                'nip' => '198712252012011003',
                'place_of_birth' => 'Semarang',
                'date_of_birth' => '1987-12-25',
                'gender' => 'M',
                'address' => 'Jl. Pahlawan No. 34, Semarang',
                'phone_number' => '081678901234',
            ],
        ];

        foreach ($teachers as $teacherData) {
            $user = User::create([
                'name' => $teacherData['name'],
                'email' => $teacherData['email'],
                'password' => Hash::make('password'),
                'role' => 'teacher',
                'email_verified_at' => now(),
            ]);

            Teacher::create([
                'user_id' => $user->id,
                'nip' => $teacherData['nip'],
                'place_of_birth' => $teacherData['place_of_birth'],
                'date_of_birth' => $teacherData['date_of_birth'],
                'gender' => $teacherData['gender'],
                'address' => $teacherData['address'],
                'phone_number' => $teacherData['phone_number'],
            ]);
        }

        // Create 5 Students
        $students = [
            [
                'name' => 'Andi Pratama',
                'email' => 'andi.pratama@gmail.com',
                'nis' => '2025001',
                'nisn' => '1234567890',
                'place_of_birth' => 'Jakarta',
                'date_of_birth' => '2007-03-15',
                'gender' => 'M',
                'address' => 'Jl. Sudirman No. 123, Jakarta Pusat',
                'phone_number' => '082123456789',
                'father_name' => 'Bambang Pratama',
                'mother_name' => 'Sri Wati',
            ],
            [
                'name' => 'Putri Wulandari',
                'email' => 'putri.wulandari@gmail.com',
                'nis' => '2025002',
                'nisn' => '2345678901',
                'place_of_birth' => 'Bandung',
                'date_of_birth' => '2007-05-22',
                'gender' => 'F',
                'address' => 'Jl. Dago No. 45, Bandung',
                'phone_number' => '082234567890',
                'father_name' => 'Dedi Wulandara',
                'mother_name' => 'Ratna Sari',
            ],
            [
                'name' => 'Dimas Permana',
                'email' => 'dimas.permana@gmail.com',
                'nis' => '2025003',
                'nisn' => '3456789012',
                'place_of_birth' => 'Surabaya',
                'date_of_birth' => '2007-08-10',
                'gender' => 'M',
                'address' => 'Jl. Tunjungan No. 67, Surabaya',
                'phone_number' => '082345678901',
                'father_name' => 'Agus Permana',
                'mother_name' => 'Linda Wijaya',
            ],
            [
                'name' => 'Sinta Dewi',
                'email' => 'sinta.dewi@gmail.com',
                'nis' => '2025004',
                'nisn' => '4567890123',
                'place_of_birth' => 'Yogyakarta',
                'date_of_birth' => '2007-11-18',
                'gender' => 'F',
                'address' => 'Jl. Parangtritis No. 89, Yogyakarta',
                'phone_number' => '082456789012',
                'father_name' => 'Hendra Kusuma',
                'mother_name' => 'Maya Sari',
            ],
            [
                'name' => 'Fajar Ramadhan',
                'email' => 'fajar.ramadhan@gmail.com',
                'nis' => '2025005',
                'nisn' => '5678901234',
                'place_of_birth' => 'Semarang',
                'date_of_birth' => '2007-12-25',
                'gender' => 'M',
                'address' => 'Jl. Pandanaran No. 34, Semarang',
                'phone_number' => '082567890123',
                'father_name' => 'Irwan Ramadhan',
                'mother_name' => 'Dina Astuti',
            ],
        ];

        foreach ($students as $studentData) {
            $user = User::create([
                'name' => $studentData['name'],
                'email' => $studentData['email'],
                'password' => Hash::make('password'),
                'role' => 'student',
                'email_verified_at' => now(),
            ]);

            Student::create([
                'user_id' => $user->id,
                'nis' => $studentData['nis'],
                'nisn' => $studentData['nisn'],
                'place_of_birth' => $studentData['place_of_birth'],
                'date_of_birth' => $studentData['date_of_birth'],
                'gender' => $studentData['gender'],
                'address' => $studentData['address'],
                'phone_number' => $studentData['phone_number'],
                'father_name' => $studentData['father_name'],
                'mother_name' => $studentData['mother_name'],
            ]);
        }
    }
}
