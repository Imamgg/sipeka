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
        'target', // 'all', 'students', 'teachers'
        'class_target',
        'priority', // 'low', 'medium', 'high'
        'attachment', // file path for attachments
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
    public function scopeForTarget($query, $target, $classId = null)
    {
        return $query->where(function ($q) use ($target, $classId) {
            $q->where('target', 'all')
                ->orWhere('target', $target);

            if ($target === 'students' && $classId) {
                $q->orWhere(function ($subQ) use ($classId) {
                    $subQ->where('target', 'classes')
                        ->whereJsonContains('class_target', $classId);
                });
            }
        });
    }
}
