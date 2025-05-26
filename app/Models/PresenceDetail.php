<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PresenceDetail extends Model
{
    protected $fillable = [
        'presence_id',
        'student_id',
        'status',
        'verification_status',
        'verified_by',
        'verified_at',
        'verification_note',
    ];

    public function presence()
    {
        return $this->belongsTo(Presence::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
