<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    protected $fillable = [
        'class_schedule_id',
        'date',
        'topic',
        'note',
        'qr_code_token',
        'start_time',
        'end_time',
        'is_active',
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

    public function generateQrCodeToken()
    {
        return $this->qr_code_token;
    }
}
