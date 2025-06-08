<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    use HasFactory;
    protected $fillable = [
        'code_subject',
        'subject_name',
        'description',
    ];

    public function getNameAttribute()
    {
        return $this->subject_name;
    }

    public function classSchedules()
    {
        return $this->hasMany(ClassSchedule::class, 'subject_id');
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    /**
     * Get teachers who teach this subject through class schedules
     */
    public function teachers()
    {
        return $this->hasManyThrough(
            Teacher::class,
            ClassSchedule::class,
            'subject_id',
            'id',
            'id',
            'teacher_id'
        );
    }
}
