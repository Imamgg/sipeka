import { Button } from '@/components/ui/button';
import { Dialog, DialogClose, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle } from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Tooltip, TooltipContent, TooltipProvider, TooltipTrigger } from '@/components/ui/tooltip';
import AppLayout from '@/layouts/app/app-sidebar-layout';
import { Head, Link, router } from '@inertiajs/react';
import { Edit, Eye, Plus, Search, Trash2 } from 'lucide-react';
import { useState } from 'react';
import { toast } from 'sonner';
import { useDebouncedCallback } from 'use-debounce';

interface Student {
    id: number;
    name: string;
    email: string;
    nis: string;
    nisn: string | null;
    gender: 'M' | 'F';
    created_at: string;
    updated_at: string;
}

interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

interface Props {
    students: {
        data: Student[];
        links: PaginationLink[];
        total: number;
    };
    filters: {
        search: string;
    };
}

export default function Index({ students, filters }: Props) {
    const [searchText, setSearchText] = useState(filters.search || '');
    const [deleteId, setDeleteId] = useState<number | null>(null);
    const [deleteDialogOpen, setDeleteDialogOpen] = useState(false);

    const debouncedSearch = useDebouncedCallback((value: string) => {
        router.get('/students', { search: value }, { preserveState: true });
    }, 300); // 300ms delay

    function handleSearchChange(e: React.ChangeEvent<HTMLInputElement>) {
        const value = e.target.value;
        setSearchText(value);
        debouncedSearch(value);
    }

    function openDeleteDialog(id: number) {
        setDeleteId(id);
        setDeleteDialogOpen(true);
    }

    function handleDelete() {
        if (deleteId === null) return;

        router.delete(`/students/${deleteId}`, {
            onSuccess: () => {
                toast.success('Siswa berhasil dihapus');
                setDeleteDialogOpen(false);
            },
            onError: (errors) => {
                toast.error(errors.general || 'Gagal menghapus siswa');
                setDeleteDialogOpen(false);
            },
        });
    }

    return (
        <AppLayout>
            <Head title="Data Siswa" />
            <div className="flex h-full flex-1 flex-col gap-6 rounded-xl p-6">
                <div className="glass-card border-glow rounded-xl p-6 shadow-sm">
                    <h1 className="deco-line text-2xl font-bold" style={{ '--line-color': 'rgba(99, 102, 241, 0.7)' } as React.CSSProperties}>
                        Data Siswa
                    </h1>
                    <p className="text-muted-foreground mt-1">
                        Kelola data siswa dengan mudah. Tambahkan, edit, atau hapus siswa sesuai kebutuhan Anda.
                    </p>
                </div>
                <div className="rounded-xl border p-6 shadow-md">
                    <div className="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                        <div className="relative w-full sm:max-w-sm lg:w-72">
                            <Input
                                type="text"
                                placeholder="Cari berdasarkan nama atau NIS..."
                                value={searchText}
                                onChange={handleSearchChange}
                                className="focus:border-primary focus:ring-primary w-full border-gray-300 transition-all dark:border-gray-600 dark:text-white"
                            />
                            <Search className="absolute top-1/2 right-3 h-4 w-4 -translate-y-1/2 text-gray-400" />
                        </div>
                        <Button asChild className="bg-primary hover:bg-primary/90 w-full shadow-sm transition-all hover:shadow md:w-auto">
                            <Link href="/students/create">
                                <Plus className="mr-2 h-4 w-4" />
                                Tambah Siswa
                            </Link>
                        </Button>
                    </div>

                    <div className="overflow-hidden rounded-xl border border-gray-200 shadow-sm transition-all hover:shadow dark:border-gray-700">
                        <div className="overflow-x-auto">
                            <table className="w-full border-collapse">
                                <thead>
                                    <tr className="bg-gradient-to-r from-gray-50 to-gray-100 text-left text-sm font-medium text-gray-500 dark:from-gray-700 dark:to-gray-800 dark:text-gray-300">
                                        <th className="hidden px-4 py-3.5 whitespace-nowrap md:table-cell">No</th>
                                        <th className="px-4 py-3.5 whitespace-nowrap first:pl-6 last:pr-6">NIS</th>
                                        <th className="hidden px-4 py-3.5 whitespace-nowrap sm:table-cell">NISN</th>
                                        <th className="px-4 py-3.5 whitespace-nowrap">Nama</th>
                                        <th className="hidden px-4 py-3.5 whitespace-nowrap md:table-cell">Email</th>
                                        <th className="hidden px-4 py-3.5 whitespace-nowrap lg:table-cell">Jenis Kelamin</th>
                                        <th className="px-4 py-3.5 text-center whitespace-nowrap">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody className="divide-y divide-gray-200 dark:divide-gray-700">
                                    {students.data.length > 0 ? (
                                        students.data.map((student, index) => (
                                            <tr
                                                key={student.id}
                                                className="group backdrop-blur-sm transition-colors hover:bg-blue-50/30 dark:hover:bg-blue-900/10"
                                            >
                                                <td className="hidden px-4 py-4 text-sm text-gray-600 md:table-cell dark:text-gray-400">
                                                    <div className="font-medium">{index + 1}</div>
                                                </td>
                                                <td className="px-4 py-4 text-sm whitespace-nowrap first:pl-6 last:pr-6 dark:text-gray-300">
                                                    <div className="font-medium">{student.nis}</div>
                                                </td>
                                                <td className="hidden px-4 py-4 text-sm whitespace-nowrap sm:table-cell dark:text-gray-300">
                                                    {student.nisn || '-'}
                                                </td>
                                                <td className="px-4 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                                    <div className="flex flex-col">
                                                        <span>{student.name}</span>
                                                        <span className="mt-1 text-xs text-gray-500 sm:hidden">{student.email}</span>
                                                    </div>
                                                </td>
                                                <td className="hidden px-4 py-4 text-sm text-gray-600 md:table-cell dark:text-gray-400">
                                                    {student.email}
                                                </td>
                                                <td className="hidden px-4 py-4 text-sm lg:table-cell dark:text-gray-300">
                                                    <span
                                                        className={`inline-flex rounded-full px-2.5 py-1 text-xs font-medium backdrop-blur-sm ${
                                                            student.gender === 'M'
                                                                ? 'bg-blue-100/80 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300'
                                                                : 'bg-pink-100/80 text-pink-800 dark:bg-pink-900/40 dark:text-pink-300'
                                                        }`}
                                                    >
                                                        {student.gender === 'M' ? 'Laki-laki' : 'Perempuan'}
                                                    </span>
                                                </td>
                                                <td className="px-4 py-4 text-right text-sm whitespace-nowrap">
                                                    <TooltipProvider>
                                                        <div className="flex items-center justify-end gap-1">
                                                            <Tooltip>
                                                                <TooltipTrigger asChild>
                                                                    <Button
                                                                        variant="ghost"
                                                                        size="sm"
                                                                        asChild
                                                                        className="h-8 w-8 p-0 text-blue-600 transition-all hover:bg-blue-100/50 hover:text-blue-700 dark:text-blue-400 dark:hover:bg-blue-900/30"
                                                                    >
                                                                        <Link href={`/students/${student.id}`}>
                                                                            <Eye className="h-4 w-4" />
                                                                        </Link>
                                                                    </Button>
                                                                </TooltipTrigger>
                                                                <TooltipContent>Lihat detail</TooltipContent>
                                                            </Tooltip>

                                                            <Tooltip>
                                                                <TooltipTrigger asChild>
                                                                    <Button
                                                                        variant="ghost"
                                                                        size="sm"
                                                                        asChild
                                                                        className="h-8 w-8 p-0 text-amber-600 transition-all hover:bg-amber-100/50 hover:text-amber-700 dark:text-amber-400 dark:hover:bg-amber-900/30"
                                                                    >
                                                                        <Link href={`/students/${student.id}/edit`}>
                                                                            <Edit className="h-4 w-4" />
                                                                        </Link>
                                                                    </Button>
                                                                </TooltipTrigger>
                                                                <TooltipContent>Edit</TooltipContent>
                                                            </Tooltip>

                                                            <Tooltip>
                                                                <TooltipTrigger asChild>
                                                                    <Button
                                                                        variant="ghost"
                                                                        size="sm"
                                                                        className="h-8 w-8 cursor-pointer p-0 text-red-600 transition-all hover:bg-red-100/50 hover:text-red-700 dark:text-red-400 dark:hover:bg-red-900/30"
                                                                        onClick={() => openDeleteDialog(student.id)}
                                                                    >
                                                                        <Trash2 className="h-4 w-4" />
                                                                    </Button>
                                                                </TooltipTrigger>
                                                                <TooltipContent>Hapus</TooltipContent>
                                                            </Tooltip>
                                                        </div>
                                                    </TooltipProvider>
                                                </td>
                                            </tr>
                                        ))
                                    ) : (
                                        <tr>
                                            <td colSpan={6} className="px-4 py-10 text-center">
                                                <div className="flex flex-col items-center justify-center">
                                                    <div className="mb-3 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 p-4 shadow-inner dark:from-gray-700 dark:to-gray-800">
                                                        <Search className="h-7 w-7 text-gray-400 dark:text-gray-500" />
                                                    </div>
                                                    <h3 className="mb-1 text-base font-medium text-gray-900 dark:text-white">Data tidak ditemukan</h3>
                                                    <p className="max-w-md text-sm text-gray-500 dark:text-gray-400">
                                                        Tidak ada data siswa yang ditemukan sesuai pencarian Anda
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                    )}
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {students.links && (
                        <div className="mt-6 flex flex-col items-center justify-between gap-4 sm:flex-row">
                            <p className="text-sm text-gray-600 dark:text-gray-400">
                                Menampilkan <span className="font-medium">{students.data.length}</span> dari{' '}
                                <span className="font-medium">{students.total}</span> data
                            </p>
                            <div className="flex flex-wrap justify-center gap-1">
                                {Object.values(students.links).map((link: PaginationLink, i) => {
                                    if (!link.url) return null;

                                    return (
                                        <Button
                                            key={i}
                                            variant={link.active ? 'default' : 'outline'}
                                            size="sm"
                                            onClick={() => router.get(link.url as string)}
                                            disabled={!link.url}
                                            className={`text-xs ${link.active ? 'bg-gradient-to-r from-indigo-500 to-blue-500 text-white shadow-sm' : 'transition-all hover:bg-blue-50/50 hover:shadow-sm dark:hover:bg-blue-900/20'}`}
                                        >
                                            <span dangerouslySetInnerHTML={{ __html: link.label }}></span>
                                        </Button>
                                    );
                                })}
                            </div>
                        </div>
                    )}
                </div>
            </div>
            {/* Delete Confirmation Dialog */}
            <Dialog open={deleteDialogOpen} onOpenChange={setDeleteDialogOpen}>
                <DialogContent className="sm:max-w-md">
                    <DialogHeader>
                        <DialogTitle>Konfirmasi Hapus Siswa</DialogTitle>
                        <DialogDescription>Apakah Anda yakin ingin menghapus siswa ini? Tindakan ini tidak dapat dibatalkan.</DialogDescription>
                    </DialogHeader>
                    <DialogFooter className="gap-2 sm:gap-2">
                        <DialogClose asChild>
                            <Button variant="outline" className="cursor-pointer transition-all hover:bg-gray-100 dark:hover:bg-gray-700">
                                Batal
                            </Button>
                        </DialogClose>
                        <Button variant="destructive" onClick={handleDelete} className="cursor-pointer shadow-sm transition-all hover:shadow">
                            Hapus
                        </Button>
                    </DialogFooter>
                </DialogContent>
            </Dialog>
        </AppLayout>
    );
}
