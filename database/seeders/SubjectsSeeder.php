<?php

namespace Database\Seeders;

use App\Models\Subjects;
use Illuminate\Database\Seeder;

class SubjectsSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $subjects = [
      [
        'code_subject' => 'MTK001',
        'subject_name' => 'Matematika',
        'description' => 'Mata pelajaran yang mempelajari tentang angka, operasi matematika, geometri, dan logika.',
      ],
      [
        'code_subject' => 'BIN001',
        'subject_name' => 'Bahasa Indonesia',
        'description' => 'Mata pelajaran yang mempelajari tentang bahasa dan sastra Indonesia.',
      ],
      [
        'code_subject' => 'ING001',
        'subject_name' => 'Bahasa Inggris',
        'description' => 'Mata pelajaran yang mempelajari tentang bahasa Inggris dan komunikasi internasional.',
      ],
      [
        'code_subject' => 'IPA001',
        'subject_name' => 'Ilmu Pengetahuan Alam',
        'description' => 'Mata pelajaran yang mempelajari tentang fenomena alam dan sains dasar.',
      ],
      [
        'code_subject' => 'IPS001',
        'subject_name' => 'Ilmu Pengetahuan Sosial',
        'description' => 'Mata pelajaran yang mempelajari tentang masyarakat, geografi, sejarah, dan ekonomi.',
      ],
      [
        'code_subject' => 'PKN001',
        'subject_name' => 'Pendidikan Kewarganegaraan',
        'description' => 'Mata pelajaran yang mempelajari tentang hak dan kewajiban sebagai warga negara.',
      ],
      [
        'code_subject' => 'SEN001',
        'subject_name' => 'Seni Budaya',
        'description' => 'Mata pelajaran yang mempelajari tentang seni, budaya, dan kreativitas.',
      ],
      [
        'code_subject' => 'PJOK001',
        'subject_name' => 'Pendidikan Jasmani Olahraga dan Kesehatan',
        'description' => 'Mata pelajaran yang mempelajari tentang kesehatan, kebugaran, dan olahraga.',
      ],
      [
        'code_subject' => 'AGAMA001',
        'subject_name' => 'Pendidikan Agama',
        'description' => 'Mata pelajaran yang mempelajari tentang agama dan nilai-nilai spiritual.',
      ],
      [
        'code_subject' => 'TIK001',
        'subject_name' => 'Teknologi Informasi dan Komunikasi',
        'description' => 'Mata pelajaran yang mempelajari tentang teknologi informasi, komputer, dan komunikasi.',
      ],
      [
        'code_subject' => 'BHS001',
        'subject_name' => 'Bahasa Asing',
        'description' => 'Mata pelajaran yang mempelajari tentang bahasa asing lainnya.',
      ],
      [
        'code_subject' => 'KIM001',
        'subject_name' => 'Kimia',
        'description' => 'Mata pelajaran yang mempelajari tentang unsur, senyawa, dan reaksi kimia.',
      ],
      [
        'code_subject' => 'BIO001',
        'subject_name' => 'Biologi',
        'description' => 'Mata pelajaran yang mempelajari tentang kehidupan dan organisme.',
      ],
      [
        'code_subject' => 'FIS001',
        'subject_name' => 'Fisika',
        'description' => 'Mata pelajaran yang mempelajari tentang hukum fisika dan fenomena alam.',
      ],
      [
        'code_subject' => 'SEJ001',
        'subject_name' => 'Sejarah',
        'description' => 'Mata pelajaran yang mempelajari tentang peristiwa sejarah dan perkembangan peradaban.',
      ],
      [
        'code_subject' => 'GEOG001',
        'subject_name' => 'Geografi',
        'description' => 'Mata pelajaran yang mempelajari tentang bumi, lingkungan, dan interaksi manusia dengan alam.',
      ],
      [
        'code_subject' => 'EKON001',
        'subject_name' => 'Ekonomi',
        'description' => 'Mata pelajaran yang mempelajari tentang ekonomi, bisnis, dan keuangan.',
      ],
    ];

    foreach ($subjects as $subject) {
      Subjects::create($subject);
    }
  }
}
