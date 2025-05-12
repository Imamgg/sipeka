import { Button } from '@/components/ui/button';
import { Dialog, DialogClose, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle } from '@/components/ui/dialog';
import AppLayout from '@/layouts/app/app-sidebar-layout';
import { Head, Link, router } from '@inertiajs/react';
import { ArrowLeft, CalendarDays, Clock, Edit, Mail, MapPin, PhoneCall, Trash2, User, Users } from 'lucide-react';
import { useState } from 'react';
import { toast } from 'sonner';

interface Student {
    id: number;
    user_id: number;
    name: string;
    email: string;
    nis: string;
    nisn: string | null;
    place_of_birth: string;
    date_of_birth: string;
    gender: 'M' | 'F';
    address: string;
    phone_number: string | null;
    father_name: string | null;
    mother_name: string | null;
    created_at: string;
    updated_at: string;
}

interface Props {
    student: Student;
}

const Show = ({ student }: Props) => {
    const [deleteDialogOpen, setDeleteDialogOpen] = useState(false);

    function handleDelete() {
        setDeleteDialogOpen(true);
    }

    function confirmDelete() {
        router.delete(`/students/${student.id}`, {
            onSuccess: () => {
                toast.success('Siswa berhasil dihapus');
            },
            onError: (errors) => {
                toast.error(errors.general || 'Gagal menghapus siswa');
            },
        });
    }

    function formatDate(dateString: string) {
        const date = new Date(dateString);
        return new Intl.DateTimeFormat('id-ID', {
            day: 'numeric',
            month: 'long',
            year: 'numeric',
        }).format(date);
    }

    return (
        <AppLayout>
            <Head title={`Siswa - ${student.name}`} />

            <div className="flex h-full flex-1 flex-col gap-6 rounded-xl p-6">
                <div className="glass-card border-glow rounded-xl p-6 shadow-sm">
                    <h1 className="deco-line text-2xl font-bold" style={{ '--line-color': 'rgba(99, 102, 241, 0.7)' } as React.CSSProperties}>
                        Detail Siswa
                    </h1>
                    <p className="text-muted-foreground mt-1">
                        Informasi detail tentang siswa <span className="font-bold">{student.name}</span>. Anda dapat mengedit atau menghapus data
                        siswa di bawah ini.
                    </p>
                </div>

                <div className="rounded-xl border p-6 shadow-md">
                    <div className="mb-6 flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-center">
                        <div className="flex items-center gap-2">
                            <Button
                                variant="ghost"
                                size="sm"
                                asChild
                                className="rounded-lg transition-all hover:bg-blue-50 dark:hover:bg-blue-900/20"
                            >
                                <Link href="/students">
                                    <ArrowLeft className="mr-2 h-4 w-4" />
                                    Kembali
                                </Link>
                            </Button>
                        </div>

                        <div className="flex w-full gap-2 sm:w-auto">
                            <Button
                                variant="outline"
                                className="w-full rounded-lg transition-all hover:border-amber-300 hover:bg-amber-50 hover:text-amber-600 hover:shadow-sm sm:w-auto dark:hover:border-amber-700 dark:hover:bg-amber-900/20 dark:hover:text-amber-400"
                                asChild
                            >
                                <Link href={`/students/${student.id}/edit`}>
                                    <Edit className="mr-2 h-4 w-4" />
                                    Edit
                                </Link>
                            </Button>
                            <Button
                                variant="destructive"
                                className="w-full rounded-lg shadow-sm transition-all hover:shadow sm:w-auto"
                                onClick={handleDelete}
                            >
                                <Trash2 className="mr-2 h-4 w-4" />
                                Hapus
                            </Button>
                        </div>
                    </div>{' '}
                    <div className="grid grid-cols-1 gap-6 md:grid-cols-2">
                        {/* Informasi Umum */}
                        <div className="rounded-lg border border-gray-200 bg-white p-5 shadow-sm transition-all hover:shadow dark:border-gray-700 dark:bg-gray-800">
                            <div className="mb-4 flex items-center gap-3">
                                <div className="rounded-full bg-blue-100 p-2 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">
                                    <User className="h-5 w-5" />
                                </div>
                                <h2 className="text-lg font-semibold text-gray-900 dark:text-white">Informasi Umum</h2>
                            </div>

                            <dl className="space-y-4">
                                <div className="flex items-start gap-3 rounded-md p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800/60">
                                    <dt className="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">NIS</dt>
                                    <dd className="flex-1 text-gray-900 dark:text-white">{student.nis}</dd>
                                </div>

                                <div className="flex items-start gap-3 rounded-md p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800/60">
                                    <dt className="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">NISN</dt>
                                    <dd className="flex-1 text-gray-900 dark:text-white">{student.nisn || '-'}</dd>
                                </div>

                                <div className="flex items-start gap-3 rounded-md p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800/60">
                                    <dt className="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">
                                        <div className="flex items-center gap-2">
                                            <Mail className="h-4 w-4 text-gray-400" />
                                            <span>Email</span>
                                        </div>
                                    </dt>
                                    <dd className="flex-1 text-gray-900 dark:text-white">{student.email}</dd>
                                </div>

                                <div className="flex items-start gap-3 rounded-md p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800/60">
                                    <dt className="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">Jenis Kelamin</dt>
                                    <dd className="flex-1">
                                        <span
                                            className={`inline-flex rounded-full px-2.5 py-1 text-xs font-medium backdrop-blur-sm ${
                                                student.gender === 'M'
                                                    ? 'bg-blue-100/80 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300'
                                                    : 'bg-pink-100/80 text-pink-800 dark:bg-pink-900/40 dark:text-pink-300'
                                            }`}
                                        >
                                            {student.gender === 'M' ? 'Laki-laki' : 'Perempuan'}
                                        </span>
                                    </dd>
                                </div>

                                <div className="flex items-start gap-3 rounded-md p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800/60">
                                    <dt className="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">
                                        <div className="flex items-center gap-2">
                                            <CalendarDays className="h-4 w-4 text-gray-400" />
                                            <span>TTL</span>
                                        </div>
                                    </dt>
                                    <dd className="flex-1 text-gray-900 dark:text-white">
                                        {student.place_of_birth}, {formatDate(student.date_of_birth)}
                                    </dd>
                                </div>

                                <div className="flex items-start gap-3 rounded-md p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800/60">
                                    <dt className="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">
                                        <div className="flex items-center gap-2">
                                            <PhoneCall className="h-4 w-4 text-gray-400" />
                                            <span>Telepon</span>
                                        </div>
                                    </dt>
                                    <dd className="flex-1 text-gray-900 dark:text-white">{student.phone_number || '-'}</dd>
                                </div>

                                <div className="flex items-start gap-3 rounded-md p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800/60">
                                    <dt className="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">
                                        <div className="flex items-center gap-2">
                                            <MapPin className="h-4 w-4 text-gray-400" />
                                            <span>Alamat</span>
                                        </div>
                                    </dt>
                                    <dd className="flex-1 whitespace-pre-line text-gray-900 dark:text-white">{student.address}</dd>
                                </div>
                            </dl>
                        </div>{' '}
                        {/* Informasi Orang Tua & Waktu */}
                        <div className="space-y-6">
                            <div className="rounded-lg border border-gray-200 bg-white p-5 shadow-sm transition-all hover:shadow dark:border-gray-700 dark:bg-gray-800">
                                <div className="mb-4 flex items-center gap-3">
                                    <div className="rounded-full bg-amber-100 p-2 text-amber-600 dark:bg-amber-900/30 dark:text-amber-400">
                                        <Users className="h-5 w-5" />
                                    </div>
                                    <h2 className="text-lg font-semibold text-gray-900 dark:text-white">Informasi Orang Tua</h2>
                                </div>

                                <dl className="space-y-4">
                                    <div className="flex items-start gap-3 rounded-md p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800/60">
                                        <dt className="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">Nama Ayah</dt>
                                        <dd className="flex-1 text-gray-900 dark:text-white">{student.father_name || '-'}</dd>
                                    </div>

                                    <div className="flex items-start gap-3 rounded-md p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800/60">
                                        <dt className="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">Nama Ibu</dt>
                                        <dd className="flex-1 text-gray-900 dark:text-white">{student.mother_name || '-'}</dd>
                                    </div>
                                </dl>
                            </div>

                            <div className="rounded-lg border border-gray-200 bg-white p-5 shadow-sm transition-all hover:shadow dark:border-gray-700 dark:bg-gray-800">
                                <div className="mb-4 flex items-center gap-3">
                                    <div className="rounded-full bg-indigo-100 p-2 text-indigo-600 dark:bg-indigo-900/30 dark:text-indigo-400">
                                        <Clock className="h-5 w-5" />
                                    </div>
                                    <h2 className="text-lg font-semibold text-gray-900 dark:text-white">Informasi Waktu</h2>
                                </div>

                                <dl className="space-y-4">
                                    <div className="flex items-start gap-3 rounded-md p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800/60">
                                        <dt className="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">Dibuat</dt>
                                        <dd className="flex-1 text-gray-900 dark:text-white">{formatDate(student.created_at)}</dd>
                                    </div>

                                    <div className="flex items-start gap-3 rounded-md p-2 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800/60">
                                        <dt className="mt-0.5 w-28 flex-shrink-0 font-medium text-gray-500 dark:text-gray-400">Diperbarui</dt>
                                        <dd className="flex-1 text-gray-900 dark:text-white">{formatDate(student.updated_at)}</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <Dialog open={deleteDialogOpen} onOpenChange={setDeleteDialogOpen}>
                <DialogContent className="sm:max-w-md">
                    <DialogHeader>
                        <DialogTitle>Konfirmasi Hapus Siswa</DialogTitle>
                        <DialogDescription>
                            Apakah Anda yakin ingin menghapus siswa <span className="text-foreground font-medium">{student.name}</span>? Data yang
                            sudah dihapus tidak dapat dikembalikan.
                        </DialogDescription>
                    </DialogHeader>
                    <DialogFooter className="gap-2 sm:gap-0">
                        <DialogClose asChild>
                            <Button variant="outline" className="rounded-lg transition-all hover:bg-gray-100 dark:hover:bg-gray-700">
                                Batal
                            </Button>
                        </DialogClose>
                        <Button variant="destructive" onClick={confirmDelete} className="rounded-lg shadow-sm transition-all hover:shadow">
                            Hapus
                        </Button>
                    </DialogFooter>
                </DialogContent>
            </Dialog>
        </AppLayout>
    );
};

export default Show;
