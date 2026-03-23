<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StarlinkRouterUsage extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_terminal_id',
        'terminal_uptime',
        'terminal_sw',
        'router_id',
        'device_id',

        'recorded_at',
        'last_seen',

        'downlink_mbps',
        'uplink_mbps',

        'signal_quality',
        'obstruction_percent_time',

        'internet_latency',
        'internet_drop',

        'pop_latency',
        'pop_drop',

        'dish_latency',
        'dish_drop',

        'router_uptime',
        'router_sw',
        'router_hw_version',

        'clients',
        'clients_2ghz',
        'clients_5ghz',
        'clientsEthernet',

        'clients_2ghz_rx_rate_avg',
        'clients_2ghz_tx_rate_avg',

        'clients_5ghz_rx_rate_avg',
        'clients_5ghz_tx_rate_avg',

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
