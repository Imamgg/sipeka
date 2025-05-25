<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServerStatus extends Model
{
    protected $table = 'server_status';

    protected $fillable = [
        'is_online',
        'maintenance_message',
        'maintenance_started_at',
        'updated_by'
    ];

    protected $casts = [
        'is_online' => 'boolean',
        'maintenance_started_at' => 'datetime'
    ];

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public static function current()
    {
        return self::first() ?? self::create([
            'is_online' => true,
            'maintenance_message' => null
        ]);
    }

    public static function isOnline()
    {
        return self::current()->is_online;
    }

    public static function setOffline($message = null, $userId = null)
    {
        $status = self::current();
        $status->update([
            'is_online' => false,
            'maintenance_message' => $message ?? 'Sistem sedang dalam pemeliharaan.',
            'maintenance_started_at' => now(),
            'updated_by' => $userId
        ]);
        return $status;
    }

    public static function setOnline($userId = null)
    {
        $status = self::current();
        $status->update([
            'is_online' => true,
            'maintenance_message' => null,
            'maintenance_started_at' => null,
            'updated_by' => $userId
        ]);
        return $status;
    }
}
