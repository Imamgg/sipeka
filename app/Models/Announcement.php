<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'title',
        'content',
        'admin_id',
        'published_at',
        'expires_at',
        'is_active',
        'target', // 'all', 'students', 'teachers'
        'class_target',
        'attachment', // file path for attachments
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'expires_at' => 'datetime',
        'class_target' => 'array',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
