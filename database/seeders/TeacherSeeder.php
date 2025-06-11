<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Faker\Factory as Faker;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Base NIP dengan format 19238816xxxx
        $baseNip = '19238816';

        // List nama guru yang akan diinput
        $teacherNames = [
            'Eka Rizky R, S.Sos', // Wali kelas X IPA
            'Fatimatuz Zahro, M.Pd', // Wali kelas X IPS
            'Yulianti, S.Pd', // Wali kelas XI IPA
            'Enggar Sustiadi Pradana, S.Pd', // Wali kelas XI IPS
            'Sri Sulastri Yuliana, S.Pd', // Wali kelas XII IPA
            'Dhurotul Khoiriyah, S.Pd', // Wali kelas XII IPS
            'Suprapti, S.Pd',
            'Muchammad Faruq, S.Pd.I',
            'Nanda Try Hastuti, S.Pd',
            'Agus Prijatmoko, S.Pd., M.M.',
            'Dra. Yanu Indriyati, M.Pd.',
            'Idahlya Mugirahayu, S.Pd',
            'Dra. Mariah Ulfah',
            'Widji, S.Pd., M.M.',
            'Yuswanto Purnomo, S.Pd.I',
            'Dhela Rochmatul Maghfiroh, S.Pd'
        ];

        $teachersData = [];

        // Generate data random untuk setiap guru dalam array
        foreach ($teacherNames as $index => $name) {
            $nameParts = explode(' ', $name);
            $firstName = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $nameParts[0]));

            $nipSuffix = str_pad($index + 1, 4, '0', STR_PAD_LEFT);

            $gender = (strpos($name, 'Eka') !== false || strpos($name, 'Fatimatuz') !== false ||
                strpos($name, 'Yulianti') !== false || strpos($name, 'Sri') !== false ||
                strpos($name, 'Dhurotul') !== false || strpos($name, 'Suprapti') !== false ||
                strpos($name, 'Nanda') !== false || strpos($name, 'Yanu') !== false ||
                strpos($name, 'Idahlya') !== false || strpos($name, 'Mariah') !== false ||
                strpos($name, 'Widji') !== false || strpos($name, 'Dhela') !== false) ? 'F' : 'M';

            $teachersData[] = [
                'name' => $name,
                'email' => $firstName . $faker->numberBetween(100, 999) . '@gmail.com',
                'phone_number' => '08' . $faker->numerify('##########'),
                'password' => 'password',
                'nip' => $baseNip . $nipSuffix, // Format: 19238816xxxx
                'place_of_birth' => $faker->city,
                'date_of_birth' => $faker->date('Y-m-d', '-30 years'),
                'gender' => $gender,
                'address' => 'Jl. ' . $faker->streetName . ' No. ' . $faker->buildingNumber,
            ];
        }

        // Tampilkan info guru yang akan diinsert
        $this->command->info('Inserting ' . count($teachersData) . ' teachers with unique NIPs');

        foreach ($teachersData as $teacher) {
            // Cek apakah NIP sudah ada di database
            $existingNip = DB::table('teachers')->where('nip', $teacher['nip'])->first();

            if ($existingNip) {
                $this->command->warn("NIP {$teacher['nip']} for {$teacher['name']} already exists, skipping.");
                continue;
            }

            // Insert data ke tabel users terlebih dahulu
            $userId = DB::table('users')->insertGetId([
                'name' => $teacher['name'],
                'email' => $teacher['email'],
                'phone_number' => $teacher['phone_number'],
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make($teacher['password']),
                'role' => 'teacher',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Kemudian insert data ke tabel teachers menggunakan user_id yang baru saja dibuat
            DB::table('teachers')->insert([
                'user_id' => $userId,
                'nip' => $teacher['nip'],
                'place_of_birth' => $teacher['place_of_birth'],
                'date_of_birth' => $teacher['date_of_birth'],
                'gender' => $teacher['gender'],
                'address' => $teacher['address'],
                'phone_number' => $teacher['phone_number'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            $this->command->info("Teacher {$teacher['name']} with NIP {$teacher['nip']} inserted successfully");
        }

        $this->command->info('All teachers have been seeded!');
    }
}
