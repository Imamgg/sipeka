import { cn } from '@/lib/utils';
import React from 'react';

interface DashboardCardProps extends React.HTMLAttributes<HTMLDivElement> {
    title: string;
    value: string | number;
    icon: React.ReactNode;
    trend?: {
        value: number;
        isPositive: boolean;
    };
    glassEffect?: boolean;
    gradient?: boolean;
    glowEffect?: boolean;
}

export function DashboardCard({
    title,
    value,
    icon,
    trend,
    glassEffect = false,
    gradient = false,
    glowEffect = false,
    className,
    ...props
}: DashboardCardProps) {
    return (
        <div
            className={cn(
                'hover-scale relative overflow-hidden rounded-xl border p-6 shadow-sm transition-all hover:shadow-md',
                glassEffect && 'glass-card',
                gradient && 'from-primary/5 to-primary/20 dark:from-primary/10 dark:to-primary/30 bg-gradient-to-br',
                glowEffect && 'border-glow',
                !glassEffect && !gradient && 'bg-card',
                className,
            )}
            {...props}
        >
            <div className="flex items-center justify-between">
                <div>
                    <p className="text-muted-foreground text-sm font-medium">{title}</p>
                    <h3 className="mt-2 text-3xl font-bold">{value}</h3>
                    {trend && (
                        <p className={cn('mt-1 flex items-center text-xs font-medium', trend.isPositive ? 'text-green-500' : 'text-red-500')}>
                            {trend.isPositive ? '↑' : '↓'} {Math.abs(trend.value)}%
                            <span className="text-muted-foreground ml-1">sejak bulan lalu</span>
                        </p>
                    )}
                </div>
                <div className={cn('text-primary opacity-80', glowEffect && 'pulse')}>{icon}</div>
            </div>
            <div className="bg-primary absolute right-0 bottom-0 -mr-3 -mb-3 h-24 w-24 rounded-full opacity-10"></div>

            {/* Decorative element for futuristic look */}
            <div className="bg-primary/30 absolute top-0 left-0 h-1 w-1/3 rounded-full"></div>
        </div>
    );
}
