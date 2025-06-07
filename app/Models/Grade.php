<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = [
        'student_id',
        'subject_id',
        'teacher_id',
        'type_assessment',
        'grade_type',
        'score',
        'grade',
        'semester',
        'date',
        'description',
        'verification_status',
        'verified_by',
        'verified_at',
        'verification_note',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subjects::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    /**
     * Get letter grade based on score.
     */
    public function getLetterGradeAttribute()
    {
        $score = $this->score;
        if ($score >= 90) return 'A';
        if ($score >= 80) return 'B';
        if ($score >= 70) return 'C';
        if ($score >= 60) return 'D';
        return 'E';
    }
}
