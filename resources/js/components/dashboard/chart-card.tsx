import { cn } from '@/lib/utils';
import React from 'react';

interface ChartCardProps extends React.HTMLAttributes<HTMLDivElement> {
    title: string;
    subtitle?: string;
    children: React.ReactNode;
    actions?: React.ReactNode;
    glassEffect?: boolean;
}

export function ChartCard({ title, subtitle, children, actions, glassEffect = false, className, ...props }: ChartCardProps) {
    return (
        <div
            className={cn(
                'relative overflow-hidden rounded-xl border shadow-sm',
                glassEffect && 'bg-white/30 backdrop-blur-sm dark:bg-black/30',
                !glassEffect && 'bg-card',
                className,
            )}
            {...props}
        >
            <div className="p-6 pb-2">
                <div className="flex flex-col gap-1 md:flex-row md:items-center md:justify-between">
                    <div>
                        <h3 className="text-lg font-semibold">{title}</h3>
                        {subtitle && <p className="text-muted-foreground text-sm">{subtitle}</p>}
                    </div>
                    {actions && <div className="flex items-center gap-2">{actions}</div>}
                </div>
            </div>
            <div className="px-6 pb-6">{children}</div>

            {/* Decorative elements for futuristic effect */}
            <div className="bg-primary/10 absolute top-0 right-0 -mt-8 -mr-8 h-16 w-16 rounded-full"></div>
            <div className="bg-primary/5 absolute bottom-0 left-0 -mb-8 -ml-8 h-16 w-16 rounded-full"></div>
        </div>
    );
}
