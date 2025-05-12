import { NavFooter } from '@/components/nav-footer';
import { NavUser } from '@/components/nav-user';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarGroup,
    SidebarGroupLabel,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/react';
import {
    BookOpen,
    Building2,
    CalendarClock,
    Database,
    FileSpreadsheet,
    Folder,
    GraduationCap,
    LayoutGrid,
    School,
    Settings,
    UserRound,
    Users,
} from 'lucide-react';
import AppLogo from './app-logo';

// Dashboard nav item
const dashboardNavItem: NavItem = {
    title: 'Dashboard',
    href: '/dashboard',
    icon: LayoutGrid,
};

// Data Master Items
const dataMasterNavItems: NavItem[] = [
    {
        title: 'Siswa',
        href: '/students',
        icon: Users,
    },
    {
        title: 'Guru',
        href: '/teachers',
        icon: UserRound,
    },
    {
        title: 'Kelas',
        href: '/classes',
        icon: Building2,
    },
    {
        title: 'Mata Pelajaran',
        href: '/subjects',
        icon: Database,
    },
];

// Akademik Items
const akademikNavItems: NavItem[] = [
    {
        title: 'Kegiatan Akademik',
        href: '/school/activities',
        icon: School,
    },
    {
        title: 'Penilaian',
        href: '/grades',
        icon: GraduationCap,
    },
    {
        title: 'Jadwal',
        href: '/jadwal',
        icon: CalendarClock,
    },
    {
        title: 'Laporan',
        href: '/reports',
        icon: FileSpreadsheet,
    },
];

// Pengaturan
const settingsNavItem: NavItem = {
    title: 'Pengaturan',
    href: '/pengaturan',
    icon: Settings,
};

const footerNavItems: NavItem[] = [
    {
        title: 'Repository',
        href: 'https://github.com/laravel/react-starter-kit',
        icon: Folder,
    },
    {
        title: 'Documentation',
        href: 'https://laravel.com/docs/starter-kits#react',
        icon: BookOpen,
    },
];

export function AppSidebar() {
    const page = usePage();

    return (
        <Sidebar collapsible="icon" variant="inset">
            <SidebarHeader>
                <SidebarMenu>
                    <SidebarMenuItem>
                        <SidebarMenuButton size="lg" asChild>
                            <Link href="/dashboard" prefetch>
                                <AppLogo />
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarHeader>

            <SidebarContent>
                {/* Dashboard */}
                <SidebarGroup className="px-2 py-0">
                    <SidebarMenu>
                        <SidebarMenuItem>
                            <SidebarMenuButton asChild isActive={dashboardNavItem.href === page.url} tooltip={{ children: dashboardNavItem.title }}>
                                <Link href={dashboardNavItem.href} prefetch>
                                    {dashboardNavItem.icon && <dashboardNavItem.icon />}
                                    <span>{dashboardNavItem.title}</span>
                                </Link>
                            </SidebarMenuButton>
                        </SidebarMenuItem>
                    </SidebarMenu>
                </SidebarGroup>

                {/* Data Master */}
                <SidebarGroup className="px-2 py-0">
                    <SidebarGroupLabel>Data Master</SidebarGroupLabel>
                    <SidebarMenu>
                        {dataMasterNavItems.map((item) => (
                            <SidebarMenuItem key={item.title}>
                                <SidebarMenuButton asChild isActive={item.href === page.url} tooltip={{ children: item.title }}>
                                    <Link href={item.href} prefetch>
                                        {item.icon && <item.icon />}
                                        <span>{item.title}</span>
                                    </Link>
                                </SidebarMenuButton>
                            </SidebarMenuItem>
                        ))}
                    </SidebarMenu>
                </SidebarGroup>

                {/* Akademik */}
                <SidebarGroup className="px-2 py-0">
                    <SidebarGroupLabel>Akademik</SidebarGroupLabel>
                    <SidebarMenu>
                        {akademikNavItems.map((item) => (
                            <SidebarMenuItem key={item.title}>
                                <SidebarMenuButton asChild isActive={item.href === page.url} tooltip={{ children: item.title }}>
                                    <Link href={item.href} prefetch>
                                        {item.icon && <item.icon />}
                                        <span>{item.title}</span>
                                    </Link>
                                </SidebarMenuButton>
                            </SidebarMenuItem>
                        ))}
                    </SidebarMenu>
                </SidebarGroup>

                {/* Pengaturan */}
                <SidebarGroup className="px-2 py-0">
                    <SidebarMenu>
                        <SidebarMenuItem>
                            <SidebarMenuButton asChild isActive={settingsNavItem.href === page.url} tooltip={{ children: settingsNavItem.title }}>
                                <Link href={settingsNavItem.href} prefetch>
                                    {settingsNavItem.icon && <settingsNavItem.icon />}
                                    <span>{settingsNavItem.title}</span>
                                </Link>
                            </SidebarMenuButton>
                        </SidebarMenuItem>
                    </SidebarMenu>
                </SidebarGroup>
            </SidebarContent>

            <SidebarFooter>
                <NavFooter items={footerNavItems} className="mt-auto" />
                <NavUser />
            </SidebarFooter>
        </Sidebar>
    );
}
