import React, { useState } from 'react';

import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { Button } from '@/components/ui/button';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import { Input } from '@/components/ui/input';
import { Sheet, SheetClose, SheetContent, SheetTrigger } from '@/components/ui/sheet';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarGroup,
    SidebarGroupContent,
    SidebarGroupLabel,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
    SidebarProvider,
    SidebarSeparator,
} from '@/components/ui/sidebar';
import { Link } from '@inertiajs/react';
import {
    Bell,
    BookOpen,
    Calendar,
    ChevronLeft,
    ChevronRight,
    GraduationCap,
    LayoutDashboard,
    LogOut,
    Menu,
    MessageSquare,
    Settings,
    Trophy,
    User,
    XCircle,
} from 'lucide-react';

interface NavItem {
    title: string;
    href: string;
    icon: React.ElementType;
    variant: 'default' | 'ghost';
    badge?: {
        text: string;
        color: string;
    };
}

export default function DashboardLayout({ children }: { children: React.ReactNode }) {
    const pathname = window.location.pathname;
    const [isCollapsed, setIsCollapsed] = useState(false);

    // Auto-collapse sidebar pada layar yang lebih kecil
    React.useEffect(() => {
        const handleResize = () => {
            setIsCollapsed(window.innerWidth < 1280);
        };

        handleResize(); // Check on initial load
        window.addEventListener('resize', handleResize);
        return () => window.removeEventListener('resize', handleResize);
    }, []);

    const studentNavItems: NavItem[] = [
        {
            title: 'Dashboard',
            href: '/dashboard',
            icon: LayoutDashboard,
            variant: pathname === '/dashboard' ? 'default' : 'ghost',
        },
        {
            title: 'Mata Pelajaran',
            href: '/mata-pelajaran',
            icon: BookOpen,
            variant: pathname === '/mata-pelajaran' ? 'default' : 'ghost',
        },
        {
            title: 'Jadwal',
            href: '/jadwal',
            icon: Calendar,
            variant: pathname === '/jadwal' ? 'default' : 'ghost',
        },
        {
            title: 'Tugas',
            href: '/tugas',
            icon: GraduationCap,
            variant: pathname === '/tugas' ? 'default' : 'ghost',
            badge: { text: '3', color: 'bg-[var(--color-royal-blue-500)] text-white' },
        },
        {
            title: 'Ekstrakurikuler',
            href: '/ekstrakurikuler',
            icon: Trophy,
            variant: pathname === '/ekstrakurikuler' ? 'default' : 'ghost',
        },
        {
            title: 'Pesan',
            href: '/pesan',
            icon: MessageSquare,
            variant: pathname === '/pesan' ? 'default' : 'ghost',
            badge: { text: '5', color: 'bg-amber-500 text-white' },
        },
    ];

    return (
        <SidebarProvider>
            <div className="flex min-h-screen w-full flex-col bg-[var(--color-royal-blue-50)] dark:bg-[var(--color-royal-blue-950)]">
                <header className="sticky top-0 z-30 flex h-16 items-center gap-4 border-b border-[var(--color-royal-blue-200)] bg-white px-4 shadow-sm md:px-6 dark:border-[var(--color-royal-blue-800)] dark:bg-[var(--color-royal-blue-900)]">
                    <Sheet>
                        <SheetTrigger asChild>
                            <Button
                                variant="outline"
                                size="icon"
                                className="border-[var(--color-royal-blue-300)] text-[var(--color-royal-blue-600)] hover:bg-[var(--color-royal-blue-100)] md:hidden dark:border-[var(--color-royal-blue-700)] dark:text-[var(--color-royal-blue-300)] dark:hover:bg-[var(--color-royal-blue-800)]"
                            >
                                <Menu className="h-5 w-5" />
                                <span className="sr-only">Toggle Menu</span>
                            </Button>
                        </SheetTrigger>{' '}
                        <SheetContent
                            side="left"
                            className="w-72 border-r border-[var(--color-royal-blue-200)] bg-white p-0 dark:border-[var(--color-royal-blue-700)] dark:bg-[var(--color-royal-blue-900)]"
                        >
                            <div className="flex h-16 items-center justify-between gap-2 border-b border-[var(--color-royal-blue-200)] px-4 dark:border-[var(--color-royal-blue-700)]">
                                <div className="flex items-center gap-2">
                                    <GraduationCap className="h-6 w-6 text-[var(--color-royal-blue-600)] dark:text-[var(--color-royal-blue-300)]" />
                                    <span className="text-lg font-bold tracking-tight text-[var(--color-royal-blue-700)] dark:text-[var(--color-royal-blue-200)]">
                                        SMA Nusantara
                                    </span>
                                </div>
                                <SheetClose className="rounded-full p-1 text-[var(--color-royal-blue-600)] hover:bg-[var(--color-royal-blue-100)] dark:text-[var(--color-royal-blue-300)] dark:hover:bg-[var(--color-royal-blue-800)]">
                                    <span className="sr-only">Close</span>
                                    <XCircle className="h-5 w-5" />
                                </SheetClose>
                            </div>
                            <div className="px-4 py-6">
                                <div className="mb-6 flex flex-col items-center">
                                    <Avatar className="mb-3 h-20 w-20 border-2 border-[var(--color-royal-blue-300)] dark:border-[var(--color-royal-blue-500)]">
                                        <AvatarImage src="/placeholder.svg?height=80&width=80" alt="User" />
                                        <AvatarFallback className="bg-[var(--color-royal-blue-200)] text-xl text-[var(--color-royal-blue-700)] dark:bg-[var(--color-royal-blue-800)] dark:text-[var(--color-royal-blue-200)]">
                                            BS
                                        </AvatarFallback>
                                    </Avatar>
                                    <h3 className="font-bold text-[var(--color-royal-blue-700)] dark:text-[var(--color-royal-blue-200)]">
                                        Budi Siswa
                                    </h3>
                                    <p className="text-sm text-[var(--color-royal-blue-500)] dark:text-[var(--color-royal-blue-400)]">
                                        Kelas 11 - IPA 2
                                    </p>
                                </div>
                                <SidebarSeparator className="my-4 bg-[var(--color-royal-blue-200)] dark:bg-[var(--color-royal-blue-700)]" />
                                <nav className="grid gap-2 text-[var(--color-royal-blue-700)] dark:text-[var(--color-royal-blue-300)]">
                                    {studentNavItems.map((item, index) => (
                                        <Link
                                            key={index}
                                            href={item.href}
                                            className={`ripple flex items-center justify-between gap-2 rounded-md px-3 py-2.5 transition-all duration-200 ${
                                                item.variant === 'default'
                                                    ? 'bg-[var(--color-royal-blue-500)] font-medium text-white dark:bg-[var(--color-royal-blue-600)]'
                                                    : 'hover:bg-[var(--color-royal-blue-100)] dark:hover:bg-[var(--color-royal-blue-800)]'
                                            }`}
                                        >
                                            <div className="flex items-center gap-3">
                                                <item.icon
                                                    className={`h-5 w-5 ${
                                                        item.variant === 'default'
                                                            ? 'text-white'
                                                            : 'text-[var(--color-royal-blue-600)] dark:text-[var(--color-royal-blue-400)]'
                                                    }`}
                                                />
                                                <span>{item.title}</span>
                                            </div>{' '}
                                            {item.badge && (
                                                <span className={`rounded-full px-2 py-0.5 text-xs ${item.badge.color} badge-pulse`}>
                                                    {item.badge.text}
                                                </span>
                                            )}
                                        </Link>
                                    ))}
                                </nav>
                            </div>
                        </SheetContent>
                    </Sheet>
                    <div className="flex items-center gap-2">
                        <GraduationCap className="h-6 w-6 text-[var(--color-royal-blue-600)] dark:text-[var(--color-royal-blue-300)]" />
                        <span className="text-lg font-bold tracking-tight text-[var(--color-royal-blue-700)] dark:text-[var(--color-royal-blue-200)]">
                            SIPEKA EDU
                        </span>
                    </div>
                    <div className="flex-1">
                        <div className="hidden md:flex">
                            <Input
                                placeholder="Cari..."
                                className="w-[200px] border-[var(--color-royal-blue-300)] focus-visible:ring-[var(--color-royal-blue-500)] lg:w-[300px] dark:border-[var(--color-royal-blue-700)] dark:bg-[var(--color-royal-blue-800)/50] dark:placeholder:text-[var(--color-royal-blue-400)]"
                            />
                        </div>
                    </div>
                    <div className="flex items-center gap-4">
                        <Button
                            variant="ghost"
                            size="icon"
                            className="relative text-[var(--color-royal-blue-600)] hover:bg-[var(--color-royal-blue-100)] dark:text-[var(--color-royal-blue-300)] dark:hover:bg-[var(--color-royal-blue-800)]"
                        >
                            <Bell className="h-5 w-5" />
                            <span className="sr-only">Notifications</span>
                            <span className="absolute top-1 right-1 flex h-2 w-2 rounded-full bg-red-600"></span>
                        </Button>
                        <DropdownMenu>
                            <DropdownMenuTrigger asChild>
                                <Button
                                    variant="ghost"
                                    size="icon"
                                    className="rounded-full hover:bg-[var(--color-royal-blue-100)] dark:hover:bg-[var(--color-royal-blue-800)]"
                                >
                                    <Avatar className="h-8 w-8 border border-[var(--color-royal-blue-300)] dark:border-[var(--color-royal-blue-600)]">
                                        <AvatarImage src="/placeholder.svg?height=32&width=32" alt="User" />
                                        <AvatarFallback className="bg-[var(--color-royal-blue-200)] text-[var(--color-royal-blue-700)] dark:bg-[var(--color-royal-blue-800)] dark:text-[var(--color-royal-blue-200)]">
                                            BS
                                        </AvatarFallback>
                                    </Avatar>
                                </Button>
                            </DropdownMenuTrigger>
                            <DropdownMenuContent
                                align="end"
                                className="border-[var(--color-royal-blue-200)] dark:border-[var(--color-royal-blue-700)] dark:bg-[var(--color-royal-blue-900)]"
                            >
                                <DropdownMenuLabel className="text-[var(--color-royal-blue-700)] dark:text-[var(--color-royal-blue-200)]">
                                    Akun Saya
                                </DropdownMenuLabel>
                                <DropdownMenuSeparator className="bg-[var(--color-royal-blue-200)] dark:bg-[var(--color-royal-blue-700)]" />
                                <DropdownMenuItem className="text-[var(--color-royal-blue-600)] focus:bg-[var(--color-royal-blue-100)] dark:text-[var(--color-royal-blue-300)] dark:focus:bg-[var(--color-royal-blue-800)]">
                                    <User className="mr-2 h-4 w-4" />
                                    Profil
                                </DropdownMenuItem>
                                <DropdownMenuItem className="text-[var(--color-royal-blue-600)] focus:bg-[var(--color-royal-blue-100)] dark:text-[var(--color-royal-blue-300)] dark:focus:bg-[var(--color-royal-blue-800)]">
                                    <Settings className="mr-2 h-4 w-4" />
                                    Pengaturan
                                </DropdownMenuItem>
                                <DropdownMenuSeparator className="bg-[var(--color-royal-blue-200)] dark:bg-[var(--color-royal-blue-700)]" />
                                <DropdownMenuItem className="text-red-500 focus:bg-red-50 dark:focus:bg-red-950/50">
                                    <LogOut className="mr-2 h-4 w-4" />
                                    Keluar
                                </DropdownMenuItem>
                            </DropdownMenuContent>
                        </DropdownMenu>
                    </div>
                </header>
                <div className="flex flex-1">
                    {' '}
                    <Sidebar
                        className="sidebar-transition hidden border-r border-[var(--color-royal-blue-200)] bg-white lg:flex dark:border-[var(--color-royal-blue-700)] dark:bg-[var(--color-royal-blue-900)]"
                        data-state={isCollapsed ? 'collapsed' : 'expanded'}
                        style={{ width: isCollapsed ? '4rem' : '16rem' }}
                    >
                        <SidebarHeader className="h-16 border-b border-[var(--color-royal-blue-200)] dark:border-[var(--color-royal-blue-700)]">
                            <div className="flex items-center gap-2 px-4 py-2">
                                <GraduationCap className="h-6 w-6 text-[var(--color-royal-blue-600)] dark:text-[var(--color-royal-blue-300)]" />{' '}
                                <span
                                    className={`text-lg font-bold tracking-tight text-[var(--color-royal-blue-700)] dark:text-[var(--color-royal-blue-200)] ${isCollapsed ? 'opacity-0' : 'opacity-100'} transition-opacity duration-300`}
                                >
                                    SMA Nusantara
                                </span>
                            </div>
                        </SidebarHeader>
                        <SidebarContent className="sidebar-scrollbar overflow-y-auto px-3 py-4">
                            {!isCollapsed && (
                                <div className="mb-6 flex flex-col items-center">
                                    <Avatar className="mb-3 h-20 w-20 border-2 border-[var(--color-royal-blue-300)] dark:border-[var(--color-royal-blue-500)]">
                                        <AvatarImage src="/placeholder.svg?height=80&width=80" alt="User" />
                                        <AvatarFallback className="bg-[var(--color-royal-blue-200)] text-xl text-[var(--color-royal-blue-700)] dark:bg-[var(--color-royal-blue-800)] dark:text-[var(--color-royal-blue-200)]">
                                            BS
                                        </AvatarFallback>
                                    </Avatar>
                                    <h3 className="font-bold text-[var(--color-royal-blue-700)] dark:text-[var(--color-royal-blue-200)]">
                                        Budi Siswa
                                    </h3>
                                    <p className="text-sm text-[var(--color-royal-blue-500)] dark:text-[var(--color-royal-blue-400)]">
                                        Kelas 11 - IPA 2
                                    </p>
                                </div>
                            )}
                            <SidebarGroup>
                                <SidebarGroupLabel
                                    className={`text-[var(--color-royal-blue-500)] dark:text-[var(--color-royal-blue-400)] ${isCollapsed ? 'sr-only' : ''}`}
                                >
                                    Menu Utama
                                </SidebarGroupLabel>
                                <SidebarGroupContent>
                                    <SidebarMenu>
                                        {studentNavItems.map((item, index) => (
                                            <SidebarMenuItem key={index}>
                                                <SidebarMenuButton
                                                    asChild
                                                    isActive={item.variant === 'default'}
                                                    className={
                                                        item.variant === 'default'
                                                            ? 'bg-[var(--color-royal-blue-500)] text-white dark:bg-[var(--color-royal-blue-600)]'
                                                            : 'text-[var(--color-royal-blue-700)] hover:bg-[var(--color-royal-blue-100)] dark:text-[var(--color-royal-blue-300)] dark:hover:bg-[var(--color-royal-blue-800)]'
                                                    }
                                                >
                                                    <Link href={item.href} className="flex w-full items-center justify-between">
                                                        <div className="flex items-center gap-3">
                                                            <item.icon
                                                                className={
                                                                    item.variant === 'default'
                                                                        ? 'text-white'
                                                                        : 'text-[var(--color-royal-blue-600)] dark:text-[var(--color-royal-blue-400)]'
                                                                }
                                                            />{' '}
                                                            <span
                                                                className={`${isCollapsed ? 'absolute opacity-0' : 'opacity-100'} transition-opacity duration-300`}
                                                            >
                                                                {item.title}
                                                            </span>
                                                        </div>
                                                        {item.badge && !isCollapsed && (
                                                            <span className={`rounded-full px-2 py-0.5 text-xs ${item.badge.color}`}>
                                                                {item.badge.text}
                                                            </span>
                                                        )}{' '}
                                                        {item.badge && isCollapsed && (
                                                            <span
                                                                className={`absolute top-0 right-0 flex h-3 w-3 rounded-full ${item.badge.color === 'bg-amber-500 text-white' ? 'bg-amber-500' : 'bg-[var(--color-royal-blue-500)]'} animate-pulse`}
                                                            ></span>
                                                        )}
                                                    </Link>
                                                </SidebarMenuButton>
                                            </SidebarMenuItem>
                                        ))}
                                    </SidebarMenu>
                                </SidebarGroupContent>
                            </SidebarGroup>
                        </SidebarContent>{' '}
                        <SidebarFooter className="border-t border-[var(--color-royal-blue-200)] p-3 dark:border-[var(--color-royal-blue-700)]">
                            <div className="flex items-center justify-between">
                                <Button
                                    variant="outline"
                                    size="sm"
                                    className="flex w-full justify-center border-[var(--color-royal-blue-300)] text-[var(--color-royal-blue-600)] transition-all duration-200 hover:bg-[var(--color-royal-blue-100)] dark:border-[var(--color-royal-blue-700)] dark:text-[var(--color-royal-blue-300)] dark:hover:bg-[var(--color-royal-blue-800)]"
                                    onClick={() => setIsCollapsed(!isCollapsed)}
                                >
                                    {isCollapsed ? <ChevronRight className="h-4 w-4" /> : <ChevronLeft className="h-4 w-4" />}
                                    {!isCollapsed && <span className="ml-2">Collapse</span>}
                                </Button>
                            </div>
                        </SidebarFooter>
                    </Sidebar>
                    <main className="flex-1 overflow-y-auto p-4 md:p-6">{children}</main>
                </div>
            </div>
        </SidebarProvider>
    );
}
