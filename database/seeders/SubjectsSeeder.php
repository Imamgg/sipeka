<?php

namespace Database\Seeders;

use App\Models\Subjects;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            ['code_subject' => 'AGAMA', 'subject_name' => 'Pendidikan Agama dan Budi Pekerti', 'description' => 'Mata pelajaran yang fokus pada pendidikan agama dan pembentukan karakter.'],
            ['code_subject' => 'PPKN', 'subject_name' => 'Pendidikan Pancasila dan Kewarganegaraan', 'description' => 'Mata pelajaran yang mengajarkan nilai-nilai Pancasila dan kewarganegaraan.'],
            ['code_subject' => 'INDO', 'subject_name' => 'Bahasa Indonesia', 'description' => 'Mata pelajaran yang fokus pada bahasa nasional Indonesia.'],
            ['code_subject' => 'MTK', 'subject_name' => 'Matematika', 'description' => 'Mata pelajaran yang mempelajari tentang angka, ruang, kuantitas dan perubahan.'],
            ['code_subject' => 'SEJIN', 'subject_name' => 'Sejarah Indonesia', 'description' => 'Mata pelajaran tentang sejarah bangsa Indonesia.'],
            ['code_subject' => 'INGGRIS', 'subject_name' => 'Bahasa Inggris', 'description' => 'Mata pelajaran bahasa asing yang fokus pada kemampuan berbahasa Inggris.'],
            ['code_subject' => 'SENBUD', 'subject_name' => 'Seni Budaya', 'description' => 'Mata pelajaran yang mempelajari berbagai aspek seni dan budaya.'],
            ['code_subject' => 'PJOK', 'subject_name' => 'Pendidikan Jasmani, Olah Raga, dan Kesehatan', 'description' => 'Mata pelajaran yang fokus pada aktivitas fisik dan kesehatan.'],
            ['code_subject' => 'PKWU', 'subject_name' => 'Prakarya dan Kewirausahaan', 'description' => 'Mata pelajaran yang mengembangkan keterampilan kewirausahaan.'],
            ['code_subject' => 'JAWA', 'subject_name' => 'Bahasa Daerah (Jawa)', 'description' => 'Mata pelajaran yang fokus pada bahasa dan budaya Jawa.'],
            ['code_subject' => 'KBHR', 'subject_name' => 'Kebaharian', 'description' => 'Mata pelajaran yang fokus pada ilmu kebaharian dan kelautan.'],
            ['code_subject' => 'BIO', 'subject_name' => 'Biologi', 'description' => 'Mata pelajaran yang mempelajari tentang makhluk hidup.'],
            ['code_subject' => 'FIS', 'subject_name' => 'Fisika', 'description' => 'Mata pelajaran yang mempelajari materi, energi, dan interaksinya.'],
            ['code_subject' => 'KIM', 'subject_name' => 'Kimia', 'description' => 'Mata pelajaran yang mempelajari komposisi, struktur, dan sifat materi.'],
            ['code_subject' => 'SEJ', 'subject_name' => 'Sejarah', 'description' => 'Mata pelajaran inti IPS yang mempelajari sejarah secara umum.'],
            ['code_subject' => 'GEO', 'subject_name' => 'Geografi', 'description' => 'Mata pelajaran yang mempelajari tentang bumi dan fenomenanya.'],
            ['code_subject' => 'SOS', 'subject_name' => 'Sosiologi', 'description' => 'Mata pelajaran yang mempelajari perilaku sosial manusia.'],
            ['code_subject' => 'EKO', 'subject_name' => 'Ekonomi', 'description' => 'Mata pelajaran yang mempelajari produksi, distribusi, dan konsumsi barang dan jasa.'],
            ['code_subject' => 'BSING', 'subject_name' => 'Bahasa dan Sastra Inggris', 'description' => 'Mata pelajaran yang mempelajari bahasa dan sastra Inggris secara mendalam.'],
            ['code_subject' => 'JEPANG', 'subject_name' => 'Bahasa Jepang', 'description' => 'Mata pelajaran yang fokus pada kemampuan berbahasa Jepang.'],
            ['code_subject' => 'BK', 'subject_name' => 'Bimbingan Konseling', 'description' => 'Mata pelajaran yang memberikan bimbingan dan konseling kepada siswa.'],
            ['code_subject' => 'LABKEP', 'subject_name' => 'Laboratorium Kepemimpinan', 'description' => 'Mata pelajaran yang mengembangkan kemampuan kepemimpinan siswa.'],
        ];

        foreach ($subjects as $subject) {
            Subjects::create($subject);
        }
    }
}
