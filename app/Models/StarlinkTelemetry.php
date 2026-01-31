<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StarlinkTelemetry extends Model
{
    protected $table = 'starlink_telemetries';
    protected $fillable = [
        'device_type',
        'device_id',
        'service_line_number',
        'observed_at',
        'metrics',
        'alerts',
        'raw',
    ];

    protected $casts = [
        'metrics' => 'array',
        'alerts' => 'array',
        'raw' => 'array',
        'observed_at' => 'datetime',
    ];

    public function device()
    {
        return $this->belongsTo(
            StarlinkDevice::class,
            'device_id',
            'device_id'
        );
    }
}
