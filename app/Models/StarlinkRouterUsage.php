<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StarlinkRouterUsage extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'recorded_at',
        'wan_tx_bytes',
        'wan_rx_bytes',
        'delta_tx_bytes',
        'delta_rx_bytes',
        'tx_mbps',
        'rx_mbps',
    ];

    protected $casts = [
        'recorded_at' => 'datetime',
    ];

}
