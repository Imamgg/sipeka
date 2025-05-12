import { cn } from '@/lib/utils';
import { Link } from '@inertiajs/react';
import React from 'react';

interface Activity {
    id: string;
    user: {
        name: string;
        avatar?: string;
    };
    action: string;
    target: string;
    time: string;
    status?: 'success' | 'warning' | 'error' | 'info';
    link?: string;
}

interface ActivityLogProps extends React.HTMLAttributes<HTMLDivElement> {
    activities: Activity[];
    title?: string;
    viewAllLink?: string;
}

export function ActivityLog({ activities, title = 'Aktivitas Terbaru', viewAllLink, className, ...props }: ActivityLogProps) {
    return (
        <div className={cn('bg-card rounded-xl border p-6 shadow-sm', className)} {...props}>
            <div className="mb-6 flex items-center justify-between">
                <h3 className="text-lg font-semibold">{title}</h3>
                {viewAllLink && (
                    <Link href={viewAllLink} className="text-primary text-sm hover:underline">
                        Lihat Semua
                    </Link>
                )}
            </div>

            <div className="space-y-5">
                {activities.map((activity) => (
                    <div key={activity.id} className="flex items-start gap-4">
                        {activity.user.avatar ? (
                            <div className="h-10 w-10 overflow-hidden rounded-full">
                                <img src={activity.user.avatar} alt={activity.user.name} className="h-full w-full object-cover" />
                            </div>
                        ) : (
                            <div className="bg-primary/10 text-primary flex h-10 w-10 items-center justify-center rounded-full">
                                {activity.user.name.charAt(0).toUpperCase()}
                            </div>
                        )}

                        <div className="flex-1 space-y-1">
                            <div className="flex items-center gap-2">
                                <p className="font-medium">{activity.user.name}</p>
                                {activity.status && (
                                    <span
                                        className={cn('inline-flex items-center rounded-full px-2 py-1 text-xs font-medium', {
                                            'bg-green-100 text-green-700 dark:bg-green-800/20 dark:text-green-400': activity.status === 'success',
                                            'bg-yellow-100 text-yellow-700 dark:bg-yellow-800/20 dark:text-yellow-400': activity.status === 'warning',
                                            'bg-red-100 text-red-700 dark:bg-red-800/20 dark:text-red-400': activity.status === 'error',
                                            'bg-blue-100 text-blue-700 dark:bg-blue-800/20 dark:text-blue-400': activity.status === 'info',
                                        })}
                                    >
                                        {activity.status}
                                    </span>
                                )}
                            </div>
                            <p className="text-muted-foreground text-sm">
                                {activity.action} <strong>{activity.target}</strong>
                            </p>
                            <p className="text-muted-foreground text-xs">{activity.time}</p>
                        </div>

                        {activity.link && (
                            <Link href={activity.link} className="text-primary hover:underline">
                                Lihat
                            </Link>
                        )}
                    </div>
                ))}
            </div>
        </div>
    );
}
