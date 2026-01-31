<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StarlinkDevice extends Model
{
    protected $fillable = [
        'service_line_number',
        'device_id',
        'device_type',
        'kit_serial',
        'dish_serial',
    ];

    public function telemetry()
    {
        return $this->hasMany(
            StarlinkTelemetry::class,
            'device_id',
            'device_id'
        );
    }
}
