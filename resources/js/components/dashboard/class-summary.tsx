import { cn } from '@/lib/utils';
import { Link } from '@inertiajs/react';
import { ChevronRight, Users } from 'lucide-react';
import React from 'react';

interface ClassData {
    id: string;
    name: string;
    totalStudents: number;
    attendance: number;
    teacher: string;
}

interface ClassSummaryProps extends React.HTMLAttributes<HTMLDivElement> {
    classes: ClassData[];
    title?: string;
    viewAllLink?: string;
}

export function ClassSummary({ classes, title = 'Ringkasan Kelas', viewAllLink, className, ...props }: ClassSummaryProps) {
    return (
        <div className={cn('bg-card overflow-hidden rounded-xl border shadow-sm', className)} {...props}>
            <div className="flex items-center justify-between border-b p-6">
                <div className="flex items-center gap-2">
                    <Users className="text-primary h-5 w-5" />
                    <h3 className="font-semibold">{title}</h3>
                </div>
                {viewAllLink && (
                    <Link href={viewAllLink} className="text-primary flex items-center text-sm hover:underline">
                        Lihat Semua
                        <ChevronRight className="ml-1 h-4 w-4" />
                    </Link>
                )}
            </div>

            <div className="grid grid-cols-1 divide-y">
                {classes.map((classData) => (
                    <div key={classData.id} className="hover:bg-muted/50 p-4 transition-colors">
                        <div className="mb-2 flex items-center justify-between">
                            <h4 className="font-medium">{classData.name}</h4>
                            <span className="text-muted-foreground text-sm">{classData.teacher}</span>
                        </div>

                        <div className="flex items-center justify-between">
                            <div className="flex items-center gap-2">
                                <Users className="text-muted-foreground h-4 w-4" />
                                <span className="text-sm">{classData.totalStudents} siswa</span>
                            </div>

                            <div className="flex items-center">
                                <div className="bg-muted mr-2 h-2 w-24 overflow-hidden rounded-full">
                                    <div
                                        className={cn(
                                            'h-full rounded-full',
                                            classData.attendance >= 90 ? 'bg-green-500' : classData.attendance >= 75 ? 'bg-amber-500' : 'bg-red-500',
                                        )}
                                        style={{ width: `${classData.attendance}%` }}
                                    />
                                </div>
                                <span className="text-xs font-medium">{classData.attendance}% hadir</span>
                            </div>
                        </div>
                    </div>
                ))}
            </div>

            {classes.length === 0 && (
                <div className="flex flex-col items-center justify-center p-8 text-center">
                    <Users className="text-muted-foreground/50 h-12 w-12" />
                    <h3 className="mt-4 text-lg font-medium">Belum ada kelas</h3>
                    <p className="text-muted-foreground mt-2 text-sm">Tambahkan kelas baru untuk mulai mengelola data akademik</p>
                </div>
            )}
        </div>
    );
}
