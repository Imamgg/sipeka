import { ActivityLog } from '@/components/dashboard/activity-log';
import { ChartCard } from '@/components/dashboard/chart-card';
import { ClassSummary } from '@/components/dashboard/class-summary';
import { DashboardCard } from '@/components/dashboard/dashboard-card';
import { StudentListCard } from '@/components/dashboard/student-list-card';
import { UpcomingEvents } from '@/components/dashboard/upcoming-events';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';
import { BookOpen, GraduationCap, LayoutGrid, LineChart, LineChartIcon, PieChart, School, UserCheck, Users } from 'lucide-react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

// Sample data - dalam aplikasi nyata, data ini akan berasal dari backend
const mockActivities = [
    {
        id: '1',
        user: {
            name: 'Budi Santoso',
            avatar: 'https://i.pravatar.cc/150?img=1',
        },
        action: 'menambahkan data siswa',
        target: 'Ahmad Rizki',
        time: '10 menit yang lalu',
        status: 'success' as const,
    },
    {
        id: '2',
        user: {
            name: 'Diana Putri',
            avatar: 'https://i.pravatar.cc/150?img=5',
        },
        action: 'memperbarui nilai ujian',
        target: 'Kelas XI IPA 2',
        time: '2 jam yang lalu',
        status: 'info' as const,
    },
    {
        id: '3',
        user: {
            name: 'Rudi Hermawan',
            avatar: 'https://i.pravatar.cc/150?img=3',
        },
        action: 'melaporkan ketidakhadiran',
        target: '5 siswa',
        time: '4 jam yang lalu',
        status: 'warning' as const,
    },
    {
        id: '4',
        user: {
            name: 'Sinta Dewi',
        },
        action: 'mengunggah dokumen',
        target: 'Jadwal UAS Semester Ganjil',
        time: '1 hari yang lalu',
        link: '#',
    },
];

const mockEvents = [
    {
        id: '1',
        title: 'Rapat Dewan Guru',
        date: '2025-05-15',
        time: '08:00 - 10:00',
        location: 'Ruang Rapat Utama',
        type: 'meeting' as const,
    },
    {
        id: '2',
        title: 'Ujian Tengah Semester',
        date: '2025-05-20',
        time: '07:30 - 12:30',
        location: 'Seluruh Ruang Kelas',
        type: 'exam' as const,
    },
    {
        id: '3',
        title: 'Batas Pengumpulan Nilai',
        date: '2025-05-25',
        type: 'deadline' as const,
    },
    {
        id: '4',
        title: 'Libur Nasional',
        date: '2025-05-30',
        type: 'holiday' as const,
    },
];

const mockClasses = [
    {
        id: '1',
        name: 'X IPA 1',
        totalStudents: 32,
        attendance: 95,
        teacher: 'Bu Aminah',
    },
    {
        id: '2',
        name: 'X IPA 2',
        totalStudents: 30,
        attendance: 88,
        teacher: 'Pak Budi',
    },
    {
        id: '3',
        name: 'XI IPS 1',
        totalStudents: 28,
        attendance: 92,
        teacher: 'Bu Siti',
    },
    {
        id: '4',
        name: 'XII IPA 1',
        totalStudents: 26,
        attendance: 78,
        teacher: 'Pak Darmawan',
    },
];

const mockStudents = [
    {
        id: '1',
        name: 'Rahmat Hidayat',
        avatar: 'https://i.pravatar.cc/150?img=11',
        class: 'X IPA 1',
        phone: '081234567890',
        status: 'active' as const,
    },
    {
        id: '2',
        name: 'Siti Nurhaliza',
        avatar: 'https://i.pravatar.cc/150?img=12',
        class: 'X IPA 2',
        phone: '081234567891',
        status: 'active' as const,
    },
    {
        id: '3',
        name: 'Ahmad Rizal',
        avatar: 'https://i.pravatar.cc/150?img=13',
        class: 'XI IPS 1',
        phone: '081234567892',
        status: 'inactive' as const,
    },
    {
        id: '4',
        name: 'Dina Fitriani',
        avatar: 'https://i.pravatar.cc/150?img=14',
        class: 'XII IPA 1',
        phone: '081234567893',
        status: 'active' as const,
    },
];

interface DashboardProps {
    stats: {
        totalTeachers: number;
        totalStudents: number;
    };
}

export default function Dashboard({ stats }: DashboardProps) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            <div className="flex h-full flex-1 flex-col gap-6 rounded-xl p-6">
                <div className="glass-card border-glow rounded-xl p-6 shadow-sm">
                    <h1 className="deco-line text-2xl font-bold" style={{ '--line-color': '#6366f1b3' } as React.CSSProperties}>
                        Selamat Datang, Admin!
                    </h1>
                    <p className="text-muted-foreground mt-1">
                        Selamat datang di Sistem Informasi Pendidikan dan Akademik. Kelola data siswa, nilai, dan kegiatan akademik dengan mudah.
                    </p>
                </div>

                {/* Dashboard Cards */}
                <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                    <DashboardCard
                        title="Total Siswa"
                        value={stats.totalStudents.toLocaleString()}
                        icon={<Users className="h-8 w-8" />}
                        trend={{ value: 12, isPositive: true }}
                        gradient
                        glowEffect
                    />
                    <DashboardCard
                        title="Total Guru"
                        value={stats.totalTeachers.toLocaleString()}
                        icon={<School className="h-8 w-8" />}
                        glassEffect
                    />
                    <DashboardCard
                        title="Total Mata Pelajaran"
                        value="96%"
                        icon={<UserCheck className="h-8 w-8" />}
                        trend={{ value: 2, isPositive: true }}
                        gradient
                    />
                    <DashboardCard title="Kelas Aktif" value="32" icon={<LayoutGrid className="h-8 w-8" />} glassEffect />
                </div>

                {/* Chart Section atas */}
                <div className="grid gap-6 lg:grid-cols-2">
                    <ChartCard
                        title="Statistik Akademik"
                        subtitle="Performa semester ini"
                        className="gradient-blue hover-scale"
                        actions={
                            <div className="flex space-x-2 text-sm">
                                <button className="text-primary hover:underline">Mingguan</button>
                                <button className="text-muted-foreground hover:text-primary hover:underline">Bulanan</button>
                                <button className="text-muted-foreground hover:text-primary hover:underline">Tahunan</button>
                            </div>
                        }
                    >
                        <div className="text-muted-foreground flex h-[300px] w-full items-center justify-center">
                            <LineChartIcon className="h-16 w-16 opacity-50" />
                            <span className="ml-2">Grafik Statistik Akademik</span>
                        </div>
                    </ChartCard>

                    <ChartCard title="Distribusi Nilai" subtitle="Persebaran nilai semester ganjil">
                        <div className="text-muted-foreground flex h-[300px] w-full items-center justify-center">
                            <PieChart className="h-16 w-16 opacity-50" />
                            <span className="ml-2">Grafik Distribusi Nilai</span>
                        </div>
                    </ChartCard>
                </div>

                {/* Data, Siswa dan Kelas */}
                <div className="grid gap-6 lg:grid-cols-2">
                    <StudentListCard students={mockStudents} title="Siswa Terbaru" viewAllLink="/siswa" />

                    <ClassSummary classes={mockClasses} viewAllLink="/kelas" />
                </div>

                {/* Activity and Events Section */}
                <div className="grid gap-6 lg:grid-cols-2">
                    <ActivityLog activities={mockActivities} title="Aktivitas Terbaru" viewAllLink="/activities" />

                    <UpcomingEvents events={mockEvents} />
                </div>

                {/* Quick Access Section */}
                <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                    <div className="hover:border-primary/50 hover:bg-accent flex cursor-pointer flex-col items-center justify-center gap-4 rounded-xl border p-6 text-center transition-colors">
                        <div className="bg-primary/10 rounded-full p-3">
                            <Users className="text-primary h-6 w-6" />
                        </div>
                        <h3 className="font-medium">Data Siswa</h3>
                        <p className="text-muted-foreground text-sm">Kelola data siswa, kelas, dan absensi</p>
                    </div>

                    <div className="hover:border-primary/50 hover:bg-accent flex cursor-pointer flex-col items-center justify-center gap-4 rounded-xl border p-6 text-center transition-colors">
                        <div className="bg-primary/10 rounded-full p-3">
                            <BookOpen className="text-primary h-6 w-6" />
                        </div>
                        <h3 className="font-medium">Kurikulum</h3>
                        <p className="text-muted-foreground text-sm">Kelola mata pelajaran dan materi</p>
                    </div>

                    <div className="hover:border-primary/50 hover:bg-accent flex cursor-pointer flex-col items-center justify-center gap-4 rounded-xl border p-6 text-center transition-colors">
                        <div className="bg-primary/10 rounded-full p-3">
                            <GraduationCap className="text-primary h-6 w-6" />
                        </div>
                        <h3 className="font-medium">Penilaian</h3>
                        <p className="text-muted-foreground text-sm">Kelola nilai ujian dan tugas</p>
                    </div>

                    <div className="hover:border-primary/50 hover:bg-accent flex cursor-pointer flex-col items-center justify-center gap-4 rounded-xl border p-6 text-center transition-colors">
                        <div className="bg-primary/10 rounded-full p-3">
                            <LineChart className="text-primary h-6 w-6" />
                        </div>
                        <h3 className="font-medium">Laporan</h3>
                        <p className="text-muted-foreground text-sm">Hasilkan laporan akademik</p>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
