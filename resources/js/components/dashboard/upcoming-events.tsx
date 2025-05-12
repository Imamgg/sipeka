import { cn } from '@/lib/utils';
import { CalendarClock, ChevronRight } from 'lucide-react';
import React from 'react';

interface Event {
    id: string;
    title: string;
    date: string;
    time?: string;
    location?: string;
    type: 'exam' | 'meeting' | 'deadline' | 'holiday';
}

interface UpcomingEventsProps extends React.HTMLAttributes<HTMLDivElement> {
    events: Event[];
}

export function UpcomingEvents({ events, className, ...props }: UpcomingEventsProps) {
    return (
        <div className={cn('bg-card overflow-hidden rounded-xl border shadow-sm', className)} {...props}>
            <div className="flex items-center justify-between border-b p-6">
                <div className="flex items-center gap-2">
                    <CalendarClock className="text-primary h-5 w-5" />
                    <h3 className="font-semibold">Jadwal Mendatang</h3>
                </div>
                <button className="text-primary flex items-center text-sm hover:underline">
                    Kalender
                    <ChevronRight className="ml-1 h-4 w-4" />
                </button>
            </div>

            <div className="divide-y">
                {events.map((event) => (
                    <div key={event.id} className="hover:bg-muted/50 p-4 transition-colors">
                        <div className="flex items-start gap-4">
                            <div className="bg-primary/10 text-primary flex h-12 w-12 flex-shrink-0 flex-col items-center justify-center rounded-md">
                                <span className="text-xs font-medium">{new Date(event.date).toLocaleDateString('id-ID', { month: 'short' })}</span>
                                <span className="text-lg font-bold">{new Date(event.date).getDate()}</span>
                            </div>

                            <div className="flex-1">
                                <h4 className="font-medium">{event.title}</h4>
                                <div className="text-muted-foreground mt-1 text-xs">
                                    {event.time && <p>{event.time}</p>}
                                    {event.location && <p>{event.location}</p>}
                                </div>
                            </div>

                            <div className="flex-shrink-0">
                                <span
                                    className={cn('inline-block rounded-full px-2 py-1 text-xs font-medium', {
                                        'bg-blue-100 text-blue-700 dark:bg-blue-800/20 dark:text-blue-400': event.type === 'meeting',
                                        'bg-amber-100 text-amber-700 dark:bg-amber-800/20 dark:text-amber-400': event.type === 'exam',
                                        'bg-red-100 text-red-700 dark:bg-red-800/20 dark:text-red-400': event.type === 'deadline',
                                        'bg-green-100 text-green-700 dark:bg-green-800/20 dark:text-green-400': event.type === 'holiday',
                                    })}
                                >
                                    {event.type === 'meeting' && 'Rapat'}
                                    {event.type === 'exam' && 'Ujian'}
                                    {event.type === 'deadline' && 'Tenggat'}
                                    {event.type === 'holiday' && 'Libur'}
                                </span>
                            </div>
                        </div>
                    </div>
                ))}
            </div>
        </div>
    );
}
