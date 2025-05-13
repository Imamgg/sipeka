import {
    BookOpen,
    Calendar,
    CheckCircle2,
    ChevronRight,
    Clock,
    FileText,
    GraduationCap,
    LineChart,
    ListChecks,
    MonitorSmartphone,
    MoreHorizontal,
} from 'lucide-react';

import DashboardLayout from '@/components/dashboard-layout';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuTrigger } from '@/components/ui/dropdown-menu';
import { Progress } from '@/components/ui/progress';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs';

export default function StudentDashboard() {
    return (
        <DashboardLayout>
            <div className="grid gap-6">
                <div className="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                    <div>
                        <h1 className="bg-gradient-to-r from-[var(--color-royal-blue-700)] to-[var(--color-royal-blue-500)] bg-clip-text text-3xl font-bold tracking-tight text-transparent dark:from-[var(--color-royal-blue-400)] dark:to-[var(--color-royal-blue-200)]">
                            Dashboard Siswa
                        </h1>
                        <p className="text-muted-foreground">Selamat datang, Budi! Berikut ringkasan akademik kamu.</p>
                    </div>
                    <div className="flex flex-wrap items-center gap-2">
                        <Button
                            variant="outline"
                            size="sm"
                            className="border-[var(--color-royal-blue-300)] transition-all duration-200 hover:bg-[var(--color-royal-blue-100)] hover:text-[var(--color-royal-blue-700)] dark:border-[var(--color-royal-blue-600)] dark:hover:bg-[var(--color-royal-blue-800)] dark:hover:text-[var(--color-royal-blue-300)]"
                        >
                            <Calendar className="mr-2 h-4 w-4 text-[var(--color-royal-blue-500)] dark:text-[var(--color-royal-blue-400)]" />
                            Kalender Akademik
                        </Button>
                        <Button
                            size="sm"
                            className="bg-[var(--color-royal-blue-600)] transition-all duration-200 hover:bg-[var(--color-royal-blue-700)] dark:bg-[var(--color-royal-blue-500)] dark:hover:bg-[var(--color-royal-blue-600)]"
                        >
                            <FileText className="mr-2 h-4 w-4" />
                            Lihat Rapor
                        </Button>
                    </div>
                </div>

                <Tabs defaultValue="overview" className="space-y-4">
                    <TabsList className="no-scrollbar w-full flex-nowrap overflow-x-auto bg-[var(--color-royal-blue-100)] p-1 dark:bg-[var(--color-royal-blue-800)/50]">
                        <TabsTrigger
                            value="overview"
                            className="whitespace-nowrap transition-all duration-200 data-[state=active]:bg-[var(--color-royal-blue-600)] data-[state=active]:text-white dark:data-[state=active]:bg-[var(--color-royal-blue-500)]"
                        >
                            Ringkasan
                        </TabsTrigger>
                        <TabsTrigger
                            value="mata-pelajaran"
                            className="whitespace-nowrap transition-all duration-200 data-[state=active]:bg-[var(--color-royal-blue-600)] data-[state=active]:text-white dark:data-[state=active]:bg-[var(--color-royal-blue-500)]"
                        >
                            Mata Pelajaran
                        </TabsTrigger>
                        <TabsTrigger
                            value="tugas"
                            className="whitespace-nowrap transition-all duration-200 data-[state=active]:bg-[var(--color-royal-blue-600)] data-[state=active]:text-white dark:data-[state=active]:bg-[var(--color-royal-blue-500)]"
                        >
                            Tugas
                        </TabsTrigger>
                        <TabsTrigger
                            value="nilai"
                            className="whitespace-nowrap transition-all duration-200 data-[state=active]:bg-[var(--color-royal-blue-600)] data-[state=active]:text-white dark:data-[state=active]:bg-[var(--color-royal-blue-500)]"
                        >
                            Nilai
                        </TabsTrigger>
                    </TabsList>

                    <TabsContent value="overview" className="space-y-4">
                        {/* Stats Cards with Glassmorphism */}
                        <div className="grid grid-cols-2 gap-4 md:grid-cols-2 lg:grid-cols-4">
                            <Card className="hover-scale border-[var(--color-royal-blue-300)] transition-all duration-300 hover:shadow-md dark:border-[var(--color-royal-blue-700)]">
                                <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                                    <CardTitle className="text-sm font-medium text-[var(--color-royal-blue-700)] dark:text-[var(--color-royal-blue-300)]">
                                        Rata-rata Nilai
                                    </CardTitle>
                                    <div className="rounded-full bg-[var(--color-royal-blue-100)] p-2 dark:bg-[var(--color-royal-blue-800)]">
                                        <GraduationCap className="h-4 w-4 text-[var(--color-royal-blue-600)] dark:text-[var(--color-royal-blue-400)]" />
                                    </div>
                                </CardHeader>
                                <CardContent>
                                    <div className="text-2xl font-bold text-[var(--color-royal-blue-700)] dark:text-[var(--color-royal-blue-200)]">
                                        85.5
                                    </div>
                                    <p className="flex items-center text-xs text-[var(--color-royal-blue-600)] dark:text-[var(--color-royal-blue-400)]">
                                        <span className="mr-1 rounded-full bg-[var(--color-royal-blue-100)] p-1 dark:bg-[var(--color-royal-blue-800)]">
                                            ↑
                                        </span>
                                        +2.5 dari semester lalu
                                    </p>
                                </CardContent>
                            </Card>

                            <Card className="hover-scale border-[var(--color-royal-blue-300)] transition-all duration-300 hover:shadow-md dark:border-[var(--color-royal-blue-700)]">
                                <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                                    <CardTitle className="text-sm font-medium text-[var(--color-royal-blue-700)] dark:text-[var(--color-royal-blue-300)]">
                                        Mata Pelajaran
                                    </CardTitle>
                                    <div className="rounded-full bg-[var(--color-royal-blue-100)] p-2 dark:bg-[var(--color-royal-blue-800)]">
                                        <BookOpen className="h-4 w-4 text-[var(--color-royal-blue-600)] dark:text-[var(--color-royal-blue-400)]" />
                                    </div>
                                </CardHeader>
                                <CardContent>
                                    <div className="text-2xl font-bold text-[var(--color-royal-blue-700)] dark:text-[var(--color-royal-blue-200)]">
                                        12
                                    </div>
                                    <p className="text-muted-foreground text-xs">Semester Genap 2024/2025</p>
                                </CardContent>
                            </Card>

                            <Card className="hover-scale border-[var(--color-royal-blue-300)] transition-all duration-300 hover:shadow-md dark:border-[var(--color-royal-blue-700)]">
                                <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                                    <CardTitle className="text-sm font-medium text-[var(--color-royal-blue-700)] dark:text-[var(--color-royal-blue-300)]">
                                        Tugas
                                    </CardTitle>
                                    <div className="rounded-full bg-[var(--color-royal-blue-100)] p-2 dark:bg-[var(--color-royal-blue-800)]">
                                        <FileText className="h-4 w-4 text-[var(--color-royal-blue-600)] dark:text-[var(--color-royal-blue-400)]" />
                                    </div>
                                </CardHeader>
                                <CardContent>
                                    <div className="text-2xl font-bold text-[var(--color-royal-blue-700)] dark:text-[var(--color-royal-blue-200)]">
                                        8
                                    </div>
                                    <p className="flex items-center text-xs text-amber-500">
                                        <span className="mr-1 rounded-full bg-amber-100 p-1 dark:bg-amber-900/30">!</span>3 harus dikumpulkan minggu
                                        ini
                                    </p>
                                </CardContent>
                            </Card>

                            <Card className="hover-scale border-[var(--color-royal-blue-300)] transition-all duration-300 hover:shadow-md dark:border-[var(--color-royal-blue-700)]">
                                <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                                    <CardTitle className="text-sm font-medium text-[var(--color-royal-blue-700)] dark:text-[var(--color-royal-blue-300)]">
                                        Kehadiran
                                    </CardTitle>
                                    <div className="rounded-full bg-[var(--color-royal-blue-100)] p-2 dark:bg-[var(--color-royal-blue-800)]">
                                        <CheckCircle2 className="h-4 w-4 text-[var(--color-royal-blue-600)] dark:text-[var(--color-royal-blue-400)]" />
                                    </div>
                                </CardHeader>
                                <CardContent>
                                    <div className="text-2xl font-bold text-[var(--color-royal-blue-700)] dark:text-[var(--color-royal-blue-200)]">
                                        98%
                                    </div>
                                    <p className="flex items-center text-xs text-green-500">
                                        <span className="mr-1 rounded-full bg-green-100 p-1 dark:bg-green-900/30">✓</span>
                                        Di atas rata-rata kelas
                                    </p>
                                </CardContent>
                            </Card>
                        </div>

                        <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-7">
                            <Card className="border-[var(--color-royal-blue-300)] transition-all duration-300 hover:shadow-md lg:col-span-4 dark:border-[var(--color-royal-blue-700)]">
                                <CardHeader className="pb-2">
                                    <div className="flex items-center justify-between">
                                        <div>
                                            <CardTitle className="text-[var(--color-royal-blue-700)] dark:text-[var(--color-royal-blue-300)]">
                                                Performa Akademik
                                            </CardTitle>
                                            <CardDescription>Perkembangan nilai kamu di semua mata pelajaran</CardDescription>
                                        </div>
                                        <div className="flex flex-wrap space-x-2">
                                            <Button
                                                variant="outline"
                                                size="sm"
                                                className="border-[var(--color-royal-blue-300)] text-xs text-[var(--color-royal-blue-700)] hover:bg-[var(--color-royal-blue-100)] dark:border-[var(--color-royal-blue-600)] dark:text-[var(--color-royal-blue-300)] dark:hover:bg-[var(--color-royal-blue-800)]"
                                            >
                                                Semester Ini
                                            </Button>
                                            <Button
                                                variant="ghost"
                                                size="sm"
                                                className="text-xs text-[var(--color-royal-blue-600)] hover:bg-[var(--color-royal-blue-100)] dark:text-[var(--color-royal-blue-400)] dark:hover:bg-[var(--color-royal-blue-800)]"
                                            >
                                                <MonitorSmartphone className="mr-1 h-3 w-3" />
                                                Tampilan Penuh
                                            </Button>
                                        </div>
                                    </div>
                                </CardHeader>
                                <CardContent>
                                    <div className="flex h-[300px] items-center justify-center rounded-md bg-gradient-to-br from-[var(--color-royal-blue-100)] to-[var(--color-royal-blue-50)] dark:from-[var(--color-royal-blue-900)/60] dark:to-[var(--color-royal-blue-900)/30]">
                                        <LineChart className="h-8 w-8 text-[var(--color-royal-blue-600)] dark:text-[var(--color-royal-blue-400)]" />
                                        <span className="ml-2 text-sm text-[var(--color-royal-blue-600)] dark:text-[var(--color-royal-blue-400)]">
                                            Grafik Performa
                                        </span>
                                    </div>
                                </CardContent>
                            </Card>

                            <Card className="border-[var(--color-royal-blue-300)] transition-all duration-300 hover:shadow-md lg:col-span-3 dark:border-[var(--color-royal-blue-700)]">
                                <CardHeader className="pb-2">
                                    <div className="flex items-center justify-between">
                                        <div>
                                            <CardTitle className="text-[var(--color-royal-blue-700)] dark:text-[var(--color-royal-blue-300)]">
                                                Tugas Mendatang
                                            </CardTitle>
                                            <CardDescription>Tugas yang harus segera dikumpulkan</CardDescription>
                                        </div>
                                        <Button
                                            variant="ghost"
                                            size="sm"
                                            className="text-xs text-[var(--color-royal-blue-600)] hover:bg-[var(--color-royal-blue-100)] dark:text-[var(--color-royal-blue-400)] dark:hover:bg-[var(--color-royal-blue-800)]"
                                        >
                                            <ListChecks className="mr-1 h-3 w-3" />
                                            Lihat Semua
                                        </Button>
                                    </div>
                                </CardHeader>
                                <CardContent>
                                    <div className="space-y-4">
                                        {[
                                            { course: 'Matematika', title: 'Tugas Kalkulus', due: 'Besok, 23:59', progress: 75 },
                                            { course: 'Fisika', title: 'Laporan Praktikum', due: '3 hari lagi', progress: 45 },
                                            { course: 'Bahasa Indonesia', title: 'Esai Sastra', due: '5 hari lagi', progress: 20 },
                                            { course: 'Biologi', title: 'Tugas Ekosistem', due: '1 minggu lagi', progress: 10 },
                                        ].map((item, index) => (
                                            <div
                                                key={index}
                                                className="rounded-lg border border-[var(--color-royal-blue-300)] bg-[var(--color-royal-blue-50)/50] p-3 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-md dark:border-[var(--color-royal-blue-700)] dark:bg-[var(--color-royal-blue-900)/30]"
                                            >
                                                <div className="flex items-center">
                                                    <div className="flex-1 space-y-1">
                                                        <div className="flex items-center gap-2">
                                                            <p className="text-sm leading-none font-medium text-[var(--color-royal-blue-700)] dark:text-[var(--color-royal-blue-300)]">
                                                                {item.title}
                                                            </p>
                                                            <Badge className="ml-auto bg-[var(--color-royal-blue-200)] text-[var(--color-royal-blue-700)] hover:bg-[var(--color-royal-blue-300)] dark:bg-[var(--color-royal-blue-800)] dark:text-[var(--color-royal-blue-300)]">
                                                                {item.course}
                                                            </Badge>
                                                        </div>
                                                        <div className="flex items-center text-xs text-[var(--color-royal-blue-600)] dark:text-[var(--color-royal-blue-400)]">
                                                            <Clock className="mr-1 h-3 w-3" />
                                                            {item.due}
                                                        </div>
                                                        <div className="pt-1">
                                                            <Progress
                                                                value={item.progress}
                                                                className="h-2 bg-[var(--color-royal-blue-200)] dark:bg-[var(--color-royal-blue-800)]"
                                                                indicatorClassName="bg-[var(--color-royal-blue-600)] dark:bg-[var(--color-royal-blue-500)]"
                                                            />
                                                            <div className="mt-1 flex justify-between text-xs">
                                                                <span className="text-[var(--color-royal-blue-600)] dark:text-[var(--color-royal-blue-400)]">
                                                                    {item.progress}% selesai
                                                                </span>
                                                                <Button
                                                                    variant="ghost"
                                                                    size="sm"
                                                                    className="h-auto p-0 text-xs text-[var(--color-royal-blue-600)] hover:text-[var(--color-royal-blue-700)] dark:text-[var(--color-royal-blue-400)] dark:hover:text-[var(--color-royal-blue-300)]"
                                                                >
                                                                    Lanjutkan <ChevronRight className="h-3 w-3" />
                                                                </Button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        ))}
                                    </div>
                                </CardContent>
                            </Card>
                        </div>

                        <div className="grid gap-4 md:grid-cols-2">
                            <Card className="border-[var(--color-royal-blue-300)] transition-all duration-300 hover:shadow-md dark:border-[var(--color-royal-blue-700)]">
                                <CardHeader>
                                    <div className="flex items-center justify-between">
                                        <div>
                                            <CardTitle className="text-[var(--color-royal-blue-700)] dark:text-[var(--color-royal-blue-300)]">
                                                Pengumuman Sekolah
                                            </CardTitle>
                                            <CardDescription>Informasi terbaru dari sekolah</CardDescription>
                                        </div>
                                        <Button
                                            variant="ghost"
                                            size="sm"
                                            className="text-xs text-[var(--color-royal-blue-600)] hover:bg-[var(--color-royal-blue-100)] dark:text-[var(--color-royal-blue-400)] dark:hover:bg-[var(--color-royal-blue-800)]"
                                        >
                                            <ListChecks className="mr-1 h-3 w-3" />
                                            Lihat Semua
                                        </Button>
                                    </div>
                                </CardHeader>
                                <CardContent className="scrollbar-thin scrollbar-thumb-[var(--color-royal-blue-300)] scrollbar-track-[var(--color-royal-blue-100)] dark:scrollbar-thumb-[var(--color-royal-blue-700)] dark:scrollbar-track-[var(--color-royal-blue-900)] max-h-[400px] overflow-y-auto">
                                    <div className="space-y-4">
                                        {[
                                            {
                                                title: 'Jadwal Ujian Tengah Semester',
                                                date: '2 hari yang lalu',
                                                content:
                                                    'Ujian Tengah Semester akan dilaksanakan pada tanggal 20-25 Mei 2025. Harap mempersiapkan diri dengan baik.',
                                            },
                                            {
                                                title: 'Libur Hari Raya',
                                                date: '1 minggu yang lalu',
                                                content:
                                                    'Sekolah akan libur pada tanggal 1-5 Juni 2025 dalam rangka Hari Raya. Kegiatan belajar mengajar akan dimulai kembali pada tanggal 6 Juni 2025.',
                                            },
                                            {
                                                title: 'Kompetisi Sains Nasional',
                                                date: '2 minggu yang lalu',
                                                content:
                                                    'Pendaftaran Kompetisi Sains Nasional telah dibuka. Siswa yang berminat dapat mendaftar di ruang guru paling lambat 15 Mei 2025.',
                                            },
                                        ].map((item, index) => (
                                            <div
                                                key={index}
                                                className="rounded-lg border border-[var(--color-royal-blue-300)] bg-[var(--color-royal-blue-50)/50] p-3 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-md dark:border-[var(--color-royal-blue-700)] dark:bg-[var(--color-royal-blue-900)/30]"
                                            >
                                                <div className="space-y-2">
                                                    <div className="flex items-center justify-between">
                                                        <h3 className="font-medium text-[var(--color-royal-blue-700)] dark:text-[var(--color-royal-blue-300)]">
                                                            {item.title}
                                                        </h3>
                                                        <span className="text-xs text-[var(--color-royal-blue-500)] dark:text-[var(--color-royal-blue-400)]">
                                                            {item.date}
                                                        </span>
                                                    </div>
                                                    <p className="text-muted-foreground text-sm">{item.content}</p>
                                                </div>
                                            </div>
                                        ))}
                                    </div>
                                </CardContent>
                            </Card>

                            <Card className="border-[var(--color-royal-blue-300)] transition-all duration-300 hover:shadow-md dark:border-[var(--color-royal-blue-700)]">
                                <CardHeader>
                                    <div className="flex items-center justify-between">
                                        <div>
                                            <CardTitle className="text-[var(--color-royal-blue-700)] dark:text-[var(--color-royal-blue-300)]">
                                                Kegiatan Ekstrakurikuler
                                            </CardTitle>
                                            <CardDescription>Aktivitas di luar jam pelajaran</CardDescription>
                                        </div>
                                        <Button
                                            variant="ghost"
                                            size="sm"
                                            className="text-xs text-[var(--color-royal-blue-600)] hover:bg-[var(--color-royal-blue-100)] dark:text-[var(--color-royal-blue-400)] dark:hover:bg-[var(--color-royal-blue-800)]"
                                        >
                                            <ListChecks className="mr-1 h-3 w-3" />
                                            Lihat Semua
                                        </Button>
                                    </div>
                                </CardHeader>
                                <CardContent className="scrollbar-thin scrollbar-thumb-[var(--color-royal-blue-300)] scrollbar-track-[var(--color-royal-blue-100)] dark:scrollbar-thumb-[var(--color-royal-blue-700)] dark:scrollbar-track-[var(--color-royal-blue-900)] max-h-[400px] overflow-y-auto">
                                    <div className="space-y-4">
                                        {[
                                            {
                                                name: 'Basket',
                                                day: 'Senin & Rabu',
                                                time: '15:30 - 17:00',
                                                location: 'Lapangan Olahraga',
                                            },
                                            {
                                                name: 'Paduan Suara',
                                                day: 'Jumat',
                                                time: '14:00 - 16:00',
                                                location: 'Ruang Musik',
                                            },
                                            {
                                                name: 'Robotik',
                                                day: 'Selasa & Kamis',
                                                time: '15:30 - 17:30',
                                                location: 'Lab Komputer',
                                            },
                                        ].map((item, index) => (
                                            <div
                                                key={index}
                                                className="rounded-lg border border-[var(--color-royal-blue-300)] bg-[var(--color-royal-blue-50)/50] p-3 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-md dark:border-[var(--color-royal-blue-700)] dark:bg-[var(--color-royal-blue-900)/30]"
                                            >
                                                <div className="flex justify-between">
                                                    <div>
                                                        <h3 className="font-medium text-[var(--color-royal-blue-700)] dark:text-[var(--color-royal-blue-300)]">
                                                            {item.name}
                                                        </h3>
                                                        <div className="text-muted-foreground text-sm">{item.day}</div>
                                                    </div>
                                                    <div className="text-right">
                                                        <div className="text-sm font-medium text-[var(--color-royal-blue-600)] dark:text-[var(--color-royal-blue-400)]">
                                                            {item.time}
                                                        </div>
                                                        <div className="text-muted-foreground text-xs">{item.location}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        ))}
                                    </div>
                                </CardContent>
                            </Card>
                        </div>
                    </TabsContent>

                    <TabsContent value="mata-pelajaran" className="space-y-4">
                        <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                            {[
                                {
                                    title: 'Matematika',
                                    teacher: 'Bpk. Ahmad Santoso',
                                    schedule: 'Senin, Rabu, Jumat - 08:00',
                                    progress: 85,
                                },
                                { title: 'Fisika', teacher: 'Ibu Siti Rahayu', schedule: 'Selasa, Kamis - 10:00', progress: 72 },
                                { title: 'Kimia', teacher: 'Bpk. Budi Hartono', schedule: 'Senin, Rabu - 13:00', progress: 68 },
                                {
                                    title: 'Bahasa Indonesia',
                                    teacher: 'Ibu Dewi Lestari',
                                    schedule: 'Selasa, Kamis - 08:00',
                                    progress: 90,
                                },
                                { title: 'Bahasa Inggris', teacher: 'Bpk. John Doe', schedule: 'Rabu, Jumat - 10:00', progress: 78 },
                                { title: 'Biologi', teacher: 'Ibu Ratna Sari', schedule: 'Senin, Kamis - 13:00', progress: 65 },
                                { title: 'Sejarah', teacher: 'Bpk. Agus Wijaya', schedule: 'Selasa - 13:00', progress: 82 },
                                { title: 'Ekonomi', teacher: 'Ibu Rina Wati', schedule: 'Jumat - 13:00', progress: 75 },
                                { title: 'Sosiologi', teacher: 'Bpk. Darmawan', schedule: 'Rabu - 14:00', progress: 80 },
                            ].map((course, index) => (
                                <Card
                                    key={index}
                                    className="hover-scale glass-card border-[var(--color-royal-blue-200)] dark:border-[var(--color-royal-blue-700)/50]"
                                >
                                    <CardHeader className="pb-2">
                                        <div className="flex items-center justify-between">
                                            <CardTitle className="text-[var(--color-royal-blue-700)] dark:text-[var(--color-royal-blue-300)]">
                                                {course.title}
                                            </CardTitle>
                                            <DropdownMenu>
                                                <DropdownMenuTrigger asChild>
                                                    <Button variant="ghost" size="sm" className="h-8 w-8 p-0">
                                                        <MoreHorizontal className="h-4 w-4" />
                                                    </Button>
                                                </DropdownMenuTrigger>
                                                <DropdownMenuContent align="end">
                                                    <DropdownMenuItem>Lihat Detail</DropdownMenuItem>
                                                    <DropdownMenuItem>Lihat Materi</DropdownMenuItem>
                                                    <DropdownMenuItem>Hubungi Guru</DropdownMenuItem>
                                                </DropdownMenuContent>
                                            </DropdownMenu>
                                        </div>
                                        <CardDescription>{course.teacher}</CardDescription>
                                    </CardHeader>
                                    <CardContent className="pb-2">
                                        <div className="text-muted-foreground flex items-center text-sm">
                                            <Calendar className="mr-1 h-4 w-4" />
                                            {course.schedule}
                                        </div>
                                        <div className="mt-4 space-y-2">
                                            <div className="flex items-center justify-between text-sm">
                                                <div>Progres Materi</div>
                                                <div className="font-medium">{course.progress}%</div>
                                            </div>
                                            <Progress
                                                value={course.progress}
                                                className="h-2 bg-[var(--color-royal-blue-100)] dark:bg-[var(--color-royal-blue-800)/30]"
                                                indicatorClassName="bg-[var(--color-royal-blue-500)]"
                                            />
                                        </div>
                                    </CardContent>
                                    <CardFooter>
                                        <Button className="w-full bg-[var(--color-royal-blue-500)] hover:bg-[var(--color-royal-blue-600)]">
                                            Lihat Detail
                                        </Button>
                                    </CardFooter>
                                </Card>
                            ))}
                        </div>
                    </TabsContent>

                    <TabsContent value="tugas" className="space-y-4">
                        <Card className="border-[var(--color-royal-blue-300)] dark:border-[var(--color-royal-blue-700)]">
                            <CardHeader>
                                <div className="flex items-center justify-between">
                                    <div>
                                        <CardTitle>Daftar Tugas</CardTitle>
                                        <CardDescription>Kelola tugas yang akan datang dan yang sudah lewat</CardDescription>
                                    </div>
                                    <Button className="bg-[var(--color-royal-blue-500)] hover:bg-[var(--color-royal-blue-600)]">
                                        <FileText className="mr-2 h-4 w-4" />
                                        Tambah Tugas
                                    </Button>
                                </div>
                            </CardHeader>
                            <CardContent>
                                <div className="space-y-6">
                                    <div className="mb-4 flex gap-2">
                                        <Button
                                            variant="outline"
                                            className="border-[var(--color-royal-blue-300)] text-[var(--color-royal-blue-600)] hover:bg-[var(--color-royal-blue-50)]"
                                        >
                                            Semua
                                        </Button>
                                        <Button
                                            variant="outline"
                                            className="border-[var(--color-royal-blue-300)] bg-[var(--color-royal-blue-500)] text-white"
                                        >
                                            Belum Selesai
                                        </Button>
                                        <Button
                                            variant="outline"
                                            className="border-[var(--color-royal-blue-300)] text-[var(--color-royal-blue-600)] hover:bg-[var(--color-royal-blue-50)]"
                                        >
                                            Selesai
                                        </Button>
                                    </div>

                                    {[
                                        {
                                            title: 'Tugas Kalkulus',
                                            course: 'Matematika',
                                            deadline: '14 Mei 2025, 23:59',
                                            status: 'belum',
                                            progress: 75,
                                            priority: 'tinggi',
                                        },
                                        {
                                            title: 'Laporan Praktikum',
                                            course: 'Fisika',
                                            deadline: '16 Mei 2025, 23:59',
                                            status: 'belum',
                                            progress: 45,
                                            priority: 'sedang',
                                        },
                                        {
                                            title: 'Esai Sastra',
                                            course: 'Bahasa Indonesia',
                                            deadline: '18 Mei 2025, 23:59',
                                            status: 'belum',
                                            progress: 20,
                                            priority: 'sedang',
                                        },
                                        {
                                            title: 'Tugas Ekosistem',
                                            course: 'Biologi',
                                            deadline: '20 Mei 2025, 23:59',
                                            status: 'belum',
                                            progress: 10,
                                            priority: 'rendah',
                                        },
                                    ].map((task, index) => (
                                        <div
                                            key={index}
                                            className="hover-scale rounded-lg border border-[var(--color-royal-blue-100)] bg-[var(--color-royal-blue-50)/50] p-4 dark:border-[var(--color-royal-blue-800)/30] dark:bg-[var(--color-royal-blue-900)/10]"
                                        >
                                            <div className="mb-2 flex items-center justify-between">
                                                <div className="flex items-center gap-3">
                                                    <div
                                                        className={`h-full min-h-[50px] w-2 rounded-full ${
                                                            task.priority === 'tinggi'
                                                                ? 'bg-red-500'
                                                                : task.priority === 'sedang'
                                                                  ? 'bg-amber-500'
                                                                  : 'bg-green-500'
                                                        }`}
                                                    ></div>
                                                    <div>
                                                        <h3 className="font-medium text-[var(--color-royal-blue-700)] dark:text-[var(--color-royal-blue-300)]">
                                                            {task.title}
                                                        </h3>
                                                        <div className="text-muted-foreground text-sm">{task.course}</div>
                                                    </div>
                                                </div>
                                                <Badge
                                                    className={`${
                                                        task.priority === 'tinggi'
                                                            ? 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400'
                                                            : task.priority === 'sedang'
                                                              ? 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400'
                                                              : 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400'
                                                    }`}
                                                >
                                                    {task.priority === 'tinggi'
                                                        ? 'Prioritas Tinggi'
                                                        : task.priority === 'sedang'
                                                          ? 'Prioritas Sedang'
                                                          : 'Prioritas Rendah'}
                                                </Badge>
                                            </div>
                                            <div className="mt-2 flex justify-between text-sm">
                                                <div className="flex items-center text-[var(--color-royal-blue-600)] dark:text-[var(--color-royal-blue-300)]">
                                                    <Clock className="mr-1 h-4 w-4" />
                                                    {task.deadline}
                                                </div>
                                                <div>{task.progress}% selesai</div>
                                            </div>
                                            <Progress
                                                value={task.progress}
                                                className="mt-2 h-2 bg-[var(--color-royal-blue-100)] dark:bg-[var(--color-royal-blue-800)/30]"
                                                indicatorClassName="bg-[var(--color-royal-blue-500)]"
                                            />
                                            <div className="mt-4 flex justify-between">
                                                <Button
                                                    variant="outline"
                                                    size="sm"
                                                    className="border-[var(--color-royal-blue-300)] text-[var(--color-royal-blue-600)] hover:bg-[var(--color-royal-blue-50)]"
                                                >
                                                    Detail
                                                </Button>
                                                <Button className="bg-[var(--color-royal-blue-500)] hover:bg-[var(--color-royal-blue-600)]">
                                                    Lanjutkan
                                                </Button>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            </CardContent>
                        </Card>
                    </TabsContent>

                    <TabsContent value="nilai" className="space-y-4">
                        <Card className="border-[var(--color-royal-blue-300)] dark:border-[var(--color-royal-blue-700)]">
                            <CardHeader>
                                <div className="flex items-center justify-between">
                                    <div>
                                        <CardTitle>Ringkasan Nilai</CardTitle>
                                        <CardDescription>Performa akademik kamu semester ini</CardDescription>
                                    </div>
                                    <Button
                                        variant="outline"
                                        className="border-[var(--color-royal-blue-300)] text-[var(--color-royal-blue-600)] hover:bg-[var(--color-royal-blue-50)]"
                                    >
                                        <FileText className="mr-2 h-4 w-4" />
                                        Unduh Rapor
                                    </Button>
                                </div>
                            </CardHeader>
                            <CardContent>
                                <div className="space-y-8">
                                    {/* Diagram Nilai */}
                                    <div className="gradient-blue rounded-lg p-6">
                                        <h3 className="mb-4 text-center font-medium">Diagram Nilai Per Mata Pelajaran</h3>
                                        <div className="flex h-[200px] items-center justify-center">
                                            <div className="text-center text-[var(--color-royal-blue-500)]">
                                                <LineChart className="mx-auto h-12 w-12" />
                                                <p className="mt-2">Diagram Nilai</p>
                                            </div>
                                        </div>
                                    </div>

                                    {/* Tabel Nilai */}
                                    <div className="overflow-hidden rounded-lg border border-[var(--color-royal-blue-200)] dark:border-[var(--color-royal-blue-700)/50]">
                                        <div className="border-b border-[var(--color-royal-blue-200)] bg-[var(--color-royal-blue-50)] p-3 dark:border-[var(--color-royal-blue-700)/50] dark:bg-[var(--color-royal-blue-900)/30]">
                                            <h3 className="font-medium">Daftar Nilai Semester Genap 2024/2025</h3>
                                        </div>
                                        <div className="p-0">
                                            <table className="w-full">
                                                <thead>
                                                    <tr className="border-b border-[var(--color-royal-blue-200)] dark:border-[var(--color-royal-blue-700)/50]">
                                                        <th className="p-3 text-left font-medium">Mata Pelajaran</th>
                                                        <th className="p-3 text-center font-medium">Tugas</th>
                                                        <th className="p-3 text-center font-medium">UTS</th>
                                                        <th className="p-3 text-center font-medium">UAS</th>
                                                        <th className="p-3 text-center font-medium">Nilai Akhir</th>
                                                        <th className="p-3 text-center font-medium">Grade</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {[
                                                        { subject: 'Matematika', assignment: 85, midterm: 80, final: 88, average: 85, grade: 'A' },
                                                        { subject: 'Fisika', assignment: 78, midterm: 75, final: 80, average: 78, grade: 'B' },
                                                        { subject: 'Kimia', assignment: 90, midterm: 85, final: 92, average: 90, grade: 'A' },
                                                        {
                                                            subject: 'Bahasa Indonesia',
                                                            assignment: 88,
                                                            midterm: 85,
                                                            final: 90,
                                                            average: 88,
                                                            grade: 'A',
                                                        },
                                                        {
                                                            subject: 'Bahasa Inggris',
                                                            assignment: 82,
                                                            midterm: 78,
                                                            final: 85,
                                                            average: 82,
                                                            grade: 'B',
                                                        },
                                                        { subject: 'Biologi', assignment: 75, midterm: 70, final: 80, average: 76, grade: 'B' },
                                                    ].map((item, index) => (
                                                        <tr
                                                            key={index}
                                                            className={`border-b border-[var(--color-royal-blue-200)] dark:border-[var(--color-royal-blue-700)/50] ${index % 2 === 0 ? 'bg-[var(--color-royal-blue-50)/50] dark:bg-[var(--color-royal-blue-900)/10]' : ''}`}
                                                        >
                                                            <td className="p-3 font-medium">{item.subject}</td>
                                                            <td className="p-3 text-center">{item.assignment}</td>
                                                            <td className="p-3 text-center">{item.midterm}</td>
                                                            <td className="p-3 text-center">{item.final}</td>
                                                            <td className="p-3 text-center font-medium">{item.average}</td>{' '}
                                                            <td className="p-3 text-center">
                                                                <span
                                                                    className={`flex h-8 w-8 items-center justify-center rounded-full font-medium text-white ${
                                                                        item.grade === 'A'
                                                                            ? 'bg-green-500'
                                                                            : item.grade === 'B'
                                                                              ? 'bg-[var(--color-royal-blue-500)]'
                                                                              : item.grade === 'C'
                                                                                ? 'bg-amber-500'
                                                                                : 'bg-red-500'
                                                                    }`}
                                                                >
                                                                    {item.grade}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    ))}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </CardContent>
                        </Card>
                    </TabsContent>
                </Tabs>
            </div>
        </DashboardLayout>
    );
}
