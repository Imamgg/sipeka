<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'subject_id',
        'teacher_id',
        'title',
        'description',
        'file_path',
        'type', // 'material' or 'assignment'
        'published_at',
        'due_date',
    ];

    protected $casts = [
        'published_at' => 'date',
        'due_date' => 'date',
    ];

    public function subject()
    {
        return $this->belongsTo(Subjects::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function classes()
    {
        return $this->belongsToMany(
            Classes::class,
            'material_id',
        );
    }
}
