<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    protected $fillable = [
        'code_subject',
        'subject_name',
        'description',
    ];

    public function classSchedules()
    {
        return $this->hasMany(ClassSchedule::class);
    }
    // belum ada tabel materi
    //     public function material()
    //     {
    //         return $this->belongsTo(Material::class);
    //     }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
