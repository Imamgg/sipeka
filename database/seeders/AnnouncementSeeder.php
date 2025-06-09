<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil user dengan role admin sebagai author
        $adminUser = User::where('role', 'admin')->first();

        if (!$adminUser) {
            $this->command->error('No admin user found. Please create admin user first.');
            return;
        }

        $admin = Admin::where('user_id', $adminUser->id)->first();
        if (!$admin) {
            $admin = Admin::create([
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
        ];

        foreach ($announcements as $announcement) {
            Announcement::create($announcement);
        }

        $this->command->info('Sample announcements have been created successfully!');
    }
}
