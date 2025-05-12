import { Button } from '@/components/ui/button';
import { cn } from '@/lib/utils';
import { Link } from '@inertiajs/react';
import { ChevronRight, PlusCircle, UserPlus } from 'lucide-react';
import React from 'react';

interface Student {
    id: string;
    name: string;
    avatar?: string;
    class: string;
    phone?: string;
    status: 'active' | 'inactive' | 'suspended';
}

interface StudentListCardProps extends React.HTMLAttributes<HTMLDivElement> {
    students: Student[];
    title?: string;
    viewAllLink?: string;
}

export function StudentListCard({ students, title = 'Siswa Terbaru', viewAllLink, className, ...props }: StudentListCardProps) {
    return (
        <div className={cn('bg-card overflow-hidden rounded-xl border shadow-sm', className)} {...props}>
            <div className="flex items-center justify-between border-b p-6">
                <div className="flex items-center gap-2">
                    <h3 className="font-semibold">{title}</h3>
                </div>
                <div className="flex items-center gap-2">
                    <Button variant="outline" size="sm" className="h-8 gap-1">
                        <UserPlus className="h-4 w-4" />
                        <span className="hidden sm:inline-block">Tambah Siswa</span>
                    </Button>
                    {viewAllLink && (
                        <Button variant="ghost" size="sm" asChild className="h-8 gap-1">
                            <Link href={viewAllLink}>
                                <span className="hidden sm:inline-block">Lihat Semua</span>
                                <ChevronRight className="h-4 w-4" />
                            </Link>
                        </Button>
                    )}
                </div>
            </div>

            <div className="divide-y">
                {students.map((student) => (
                    <div key={student.id} className="hover:bg-muted/50 flex items-center justify-between p-4 transition-colors">
                        <div className="flex items-center gap-3">
                            {student.avatar ? (
                                <div className="h-10 w-10 overflow-hidden rounded-full">
                                    <img src={student.avatar} alt={student.name} className="h-full w-full object-cover" />
                                </div>
                            ) : (
                                <div className="bg-primary/10 text-primary flex h-10 w-10 items-center justify-center rounded-full">
                                    {student.name.charAt(0).toUpperCase()}
                                </div>
                            )}

                            <div>
                                <p className="font-medium">{student.name}</p>
                                <p className="text-muted-foreground text-sm">{student.class}</p>
                            </div>
                        </div>

                        <div className="flex items-center gap-3">
                            {student.phone && <span className="text-muted-foreground hidden text-sm md:block">{student.phone}</span>}
                            <span
                                className={cn('inline-flex items-center rounded-full px-2 py-1 text-xs font-medium', {
                                    'bg-green-100 text-green-700 dark:bg-green-800/20 dark:text-green-400': student.status === 'active',
                                    'bg-yellow-100 text-yellow-700 dark:bg-yellow-800/20 dark:text-yellow-400': student.status === 'inactive',
                                    'bg-red-100 text-red-700 dark:bg-red-800/20 dark:text-red-400': student.status === 'suspended',
                                })}
                            >
                                {student.status === 'active' && 'Aktif'}
                                {student.status === 'inactive' && 'Nonaktif'}
                                {student.status === 'suspended' && 'Diskors'}
                            </span>
                        </div>
                    </div>
                ))}
            </div>

            {students.length === 0 && (
                <div className="flex flex-col items-center justify-center p-8 text-center">
                    <PlusCircle className="text-muted-foreground/50 h-12 w-12" />
                    <h3 className="mt-4 text-lg font-medium">Belum ada siswa</h3>
                    <p className="text-muted-foreground mt-2 text-sm">Tambahkan siswa baru untuk mulai mengelola data akademik</p>
                    <Button className="mt-4" size="sm">
                        <UserPlus className="mr-2 h-4 w-4" />
                        Tambah Siswa Baru
                    </Button>
                </div>
            )}
        </div>
    );
}
