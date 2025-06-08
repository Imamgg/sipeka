<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'title',
        'content',
        'user_id',
        'published_at',
        'expires_at',
        'is_active',
        'target',
        'class_target',
        'priority',
        'attachment',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'expires_at' => 'datetime',
        'class_target' => 'array',
        'is_active' => 'boolean',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'user_id');
    }

    public function author()
    {
        return $this->belongsTo(Admin::class, 'user_id');
    }

    // Scope untuk pengumuman aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where('published_at', '<=', now())
            ->where(function ($q) {
                $q->whereNull('expires_at')
                    ->orWhere('expires_at', '>=', now());
            });
    }

    // Scope untuk target tertentu
    public function scopeForTarget($query, $target, $classIds = null)
    {
        return $query->where(function ($q) use ($target, $classIds) {
            $q->where('target', 'all')
                ->orWhere('target', $target);

            // Handle class-targeted announcements for both students and teachers
            if (($target === 'students' || $target === 'teachers') && $classIds) {
                $q->orWhere(function ($subQ) use ($classIds) {
                    $subQ->where('target', 'classes');

                    // Handle both single class ID and array of class IDs
                    if (is_array($classIds)) {
                        $subQ->where(function ($classQ) use ($classIds) {
                            foreach ($classIds as $classId) {
                                $classQ->orWhereJsonContains('class_target', (string)$classId);
                            }
                        });
                    } else {
                        $subQ->whereJsonContains('class_target', (string)$classIds);
                    }
                });
            }
        });
    }
}
