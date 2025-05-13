import DashboardLayout from '@/components/dashboard-layout';
import { Button } from '@/components/ui/button';
import { Calendar, FileText } from 'lucide-react';

export default function teacherDashboard() {
    return (
        <DashboardLayout>
            <div className="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 className="bg-gradient-to-r from-[var(--color-royal-blue-600)] to-[var(--color-royal-blue-400)] bg-clip-text text-3xl font-bold tracking-tight text-transparent">
                        Dashboard Siswa
                    </h1>
                    <p className="text-muted-foreground">Selamat datang, Budi! Berikut ringkasan akademik kamu.</p>
                </div>
                <div className="flex items-center gap-2">
                    <Button
                        variant="outline"
                        size="sm"
                        className="border-[var(--color-royal-blue-300)] hover:bg-[var(--color-royal-blue-50)] hover:text-[var(--color-royal-blue-600)]"
                    >
                        <Calendar className="mr-2 h-4 w-4 text-[var(--color-royal-blue-400)]" />
                        Kalender Akademik
                    </Button>
                    <Button size="sm" className="bg-[var(--color-royal-blue-500)] hover:bg-[var(--color-royal-blue-600)]">
                        <FileText className="mr-2 h-4 w-4" />
                        Lihat Rapor
                    </Button>
                </div>
            </div>
        </DashboardLayout>
    );
}
