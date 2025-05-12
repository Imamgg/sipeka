import { Breadcrumbs } from '@/components/breadcrumbs';
import { NotificationMenu } from '@/components/dashboard/notification-menu';
import { Button } from '@/components/ui/button';
import { SidebarTrigger } from '@/components/ui/sidebar';
import { useAppearance } from '@/hooks/use-appearance';
import { type BreadcrumbItem as BreadcrumbItemType } from '@/types';
import { Moon, Search, Sun } from 'lucide-react';
import { useEffect, useState } from 'react';

// Sample notifications data
const sampleNotifications = [
    {
        id: '1',
        title: 'Nilai Baru Dimasukkan',
        message: 'Nilai ujian matematika kelas X IPA 1 telah diperbarui',
        time: '5 menit yang lalu',
        read: false,
        type: 'info' as const,
    },
    {
        id: '2',
        title: 'Pemberitahuan Rapat',
        message: 'Rapat dewan guru akan dilaksanakan besok pukul 09:00',
        time: '1 jam yang lalu',
        read: false,
        type: 'warning' as const,
    },
    {
        id: '3',
        title: 'Pendaftaran Siswa Baru',
        message: 'Pendaftaran siswa baru telah dibuka untuk tahun ajaran 2025/2026',
        time: '1 hari yang lalu',
        read: true,
        type: 'success' as const,
    },
];

export function AppSidebarHeader({ breadcrumbs = [] }: { breadcrumbs?: BreadcrumbItemType[] }) {
    const [notifications, setNotifications] = useState(sampleNotifications);
    const { appearance, updateAppearance } = useAppearance();
    const [currentAppearance, setCurrentAppearance] = useState<'light' | 'dark' | 'system'>(appearance);

    useEffect(() => {
        setCurrentAppearance(appearance);
    }, [appearance]);

    const handleMarkAsRead = (id: string) => {
        setNotifications(notifications.map((notification) => (notification.id === id ? { ...notification, read: true } : notification)));
    };

    const handleMarkAllAsRead = () => {
        setNotifications(notifications.map((notification) => ({ ...notification, read: true })));
    };

    const toggleDarkMode = () => {
        const newMode = currentAppearance === 'dark' ? 'light' : 'dark';
        updateAppearance(newMode);
    };

    return (
        <header className="border-sidebar-border/50 flex h-16 shrink-0 items-center justify-between gap-2 border-b px-6 transition-[width,height] ease-linear group-has-data-[collapsible=icon]/sidebar-wrapper:h-12 md:px-4">
            <div className="flex items-center gap-2">
                <SidebarTrigger className="-ml-1" />
                <Breadcrumbs breadcrumbs={breadcrumbs} />
            </div>

            <div className="flex items-center gap-2">
                <Button variant="ghost" size="icon" className="text-muted-foreground hover:text-foreground">
                    <Search className="h-5 w-5" />
                </Button>

                <NotificationMenu notifications={notifications} onMarkAsRead={handleMarkAsRead} onMarkAllAsRead={handleMarkAllAsRead} />

                <Button variant="ghost" size="icon" onClick={toggleDarkMode} className="text-muted-foreground hover:text-foreground">
                    {currentAppearance === 'dark' ? <Sun className="h-5 w-5" /> : <Moon className="h-5 w-5" />}
                </Button>
            </div>
        </header>
    );
}
