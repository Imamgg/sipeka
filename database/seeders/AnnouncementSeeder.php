<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\Admin;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil user dengan role admin sebagai author
        $adminUser = \App\Models\User::where('role', 'admin')->first();

        if (!$adminUser) {
            $this->command->error('No admin user found. Please create admin user first.');
            return;
        }

        // Pastikan ada record admin terkait
        $admin = \App\Models\Admin::where('user_id', $adminUser->id)->first();
        if (!$admin) {
            $admin = \App\Models\Admin::create([
                'user_id' => $adminUser->id,
                'full_name' => $adminUser->name
            ]);
        }

        $announcements = [
            [
                'title' => 'Libur Nasional Hari Kemerdekaan',
                'content' => 'Dalam rangka memperingati Hari Kemerdekaan Republik Indonesia ke-80, maka seluruh kegiatan pembelajaran akan diliburkan pada tanggal 17 Agustus 2025. Kegiatan pembelajaran akan dimulai kembali pada tanggal 18 Agustus 2025.',
                'target' => 'all',
                'priority' => 'high',
                'is_active' => true,
                'user_id' => $admin->id,
                'published_at' => now(),
                'expires_at' => now()->addDays(30),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Jadwal Ujian Tengah Semester Ganjil 2025/2026',
                'content' => '<p>Dengan hormat,<br><br>Kami informasikan bahwa Ujian Tengah Semester (UTS) Ganjil tahun ajaran 2025/2026 akan dilaksanakan pada:</p><ul><li><strong>Tanggal:</strong> 15-22 September 2025</li><li><strong>Waktu:</strong> 07.30 - 10.30 WIB</li><li><strong>Tempat:</strong> Ruang kelas masing-masing</li></ul><p>Diharapkan semua siswa mempersiapkan diri dengan baik dan mengikuti ujian sesuai jadwal yang telah ditentukan.</p>',
                'target' => 'students',
                'priority' => 'medium',
                'is_active' => true,
                'user_id' => $admin->id,
                'published_at' => now()->subDays(2),
                'expires_at' => now()->addDays(45),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Rapat Koordinasi Guru Semester Ganjil',
                'content' => 'Kepada Bapak/Ibu Guru yang terhormat, dimohon untuk menghadiri rapat koordinasi yang akan dilaksanakan pada:<br><br><strong>Hari/Tanggal:</strong> Sabtu, 30 Agustus 2025<br><strong>Waktu:</strong> 08.00 - 12.00 WIB<br><strong>Tempat:</strong> Aula Sekolah<br><br>Agenda rapat meliputi:<br>1. Evaluasi pembelajaran semester genap 2024/2025<br>2. Persiapan pembelajaran semester ganjil 2025/2026<br>3. Pembahasan kurikulum terbaru<br>4. Lain-lain<br><br>Kehadiran Bapak/Ibu sangat diharapkan.',
                'target' => 'teachers',
                'priority' => 'high',
                'is_active' => true,
                'user_id' => $admin->id,
                'published_at' => now()->subDays(1),
                'expires_at' => now()->addDays(15),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pengumuman Kegiatan Ekstrakurikuler',
                'content' => 'Pendaftaran kegiatan ekstrakurikuler untuk semester ganjil 2025/2026 telah dibuka. Siswa dapat mendaftar melalui wali kelas masing-masing atau langsung ke koordinator ekstrakurikuler. Pendaftaran ditutup pada tanggal 5 September 2025.',
                'target' => 'students',
                'priority' => 'low',
                'is_active' => true,
                'user_id' => $admin->id,
                'published_at' => now()->subHours(6),
                'expires_at' => now()->addDays(20),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pemberitahuan Maintenance Sistem SIPEKA',
                'content' => 'Sistem SIPEKA akan menjalani maintenance rutin pada hari Minggu, 1 September 2025 dari pukul 22.00 - 02.00 WIB. Selama periode tersebut, sistem mungkin tidak dapat diakses. Mohon maaf atas ketidaknyamanan yang terjadi.',
                'target' => 'all',
                'priority' => 'medium',
                'is_active' => false,
                'user_id' => $admin->id,
                'published_at' => now()->addDays(3),
                'expires_at' => now()->addDays(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($announcements as $announcement) {
            Announcement::create($announcement);
        }

        $this->command->info('Sample announcements have been created successfully!');
    }
}
