import { Button } from '@/components/ui/button';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import { cn } from '@/lib/utils';
import { Bell } from 'lucide-react';
import { useState } from 'react';

interface Notification {
    id: string;
    title: string;
    message: string;
    time: string;
    read: boolean;
    type: 'info' | 'success' | 'warning' | 'error';
}

interface NotificationMenuProps {
    notifications: Notification[];
    onMarkAsRead: (id: string) => void;
    onMarkAllAsRead: () => void;
    className?: string;
}

export function NotificationMenu({ notifications, onMarkAsRead, onMarkAllAsRead, className }: NotificationMenuProps) {
    const [open, setOpen] = useState(false);
    const unreadCount = notifications.filter((n) => !n.read).length;

    return (
        <DropdownMenu open={open} onOpenChange={setOpen}>
            <DropdownMenuTrigger asChild>
                <Button variant="ghost" size="icon" className={cn('relative', className)}>
                    <Bell className="h-5 w-5" />
                    {unreadCount > 0 && (
                        <span className="bg-primary text-primary-foreground absolute -top-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full text-[10px] font-medium">
                            {unreadCount > 9 ? '9+' : unreadCount}
                        </span>
                    )}
                </Button>
            </DropdownMenuTrigger>
            <DropdownMenuContent className="w-[350px]" align="end">
                <div className="flex items-center justify-between p-4">
                    <DropdownMenuLabel className="font-normal">Notifikasi</DropdownMenuLabel>
                    {unreadCount > 0 && (
                        <Button
                            variant="ghost"
                            className="text-muted-foreground hover:text-foreground text-xs"
                            onClick={() => {
                                onMarkAllAsRead();
                                setOpen(false);
                            }}
                        >
                            Tandai semua dibaca
                        </Button>
                    )}
                </div>
                <DropdownMenuSeparator />

                {notifications.length === 0 ? (
                    <div className="flex items-center justify-center py-8">
                        <p className="text-muted-foreground text-sm">Tidak ada notifikasi</p>
                    </div>
                ) : (
                    <div className="max-h-[300px] overflow-y-auto">
                        {notifications.map((notification) => (
                            <DropdownMenuItem
                                key={notification.id}
                                className={cn('flex cursor-pointer flex-col items-start gap-1 p-4 text-left', !notification.read && 'bg-muted/50')}
                                onClick={() => {
                                    onMarkAsRead(notification.id);
                                }}
                            >
                                <div className="flex w-full items-center justify-between">
                                    <span className="font-medium">{notification.title}</span>
                                    <span
                                        className={cn('ml-2 h-2 w-2 flex-shrink-0 rounded-full', {
                                            'bg-blue-500': notification.type === 'info' && !notification.read,
                                            'bg-green-500': notification.type === 'success' && !notification.read,
                                            'bg-amber-500': notification.type === 'warning' && !notification.read,
                                            'bg-red-500': notification.type === 'error' && !notification.read,
                                            'bg-transparent': notification.read,
                                        })}
                                    />
                                </div>
                                <p className="text-muted-foreground text-sm">{notification.message}</p>
                                <span className="text-muted-foreground text-xs">{notification.time}</span>
                            </DropdownMenuItem>
                        ))}
                    </div>
                )}

                <DropdownMenuSeparator />
                <DropdownMenuItem className="justify-center" asChild>
                    <a href="/notifikasi" className="text-primary w-full text-center text-sm">
                        Lihat semua notifikasi
                    </a>
                </DropdownMenuItem>
            </DropdownMenuContent>
        </DropdownMenu>
    );
}
