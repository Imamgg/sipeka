<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    protected $fillable = [
        'class_schedule_id',
        'class_id',
        'subject_id',
        'student_id',
        'teacher_id',
        'date',
        'topic',
        'note',
        'qr_code_token',
        'start_time',
        'end_time',
        'is_active',
        'status',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
        'is_active' => 'boolean',
    ];

    public function classSchedule()
    {
        return $this->belongsTo(ClassSchedule::class);
    }

    public function presenceDetails()
    {
        return $this->hasMany(PresenceDetail::class);
    }

    public function classes()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subjects::class, 'subject_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function generateQrCodeToken()
    {
        return $this->qr_code_token;
    }
}
