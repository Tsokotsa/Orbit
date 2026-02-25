<?php

namespace App\Http\Controllers;

use App\Models\StarlinkRouterUsage;
use Illuminate\Http\Request;
class StarlinkUsageController extends Controller
{
    public function graph($device)
    {
        return view('starlink.graph', compact('device'));
    }

    public function data($device)
    {
        return StarlinkRouterUsage::where('device_id', $device)
            ->orderBy('recorded_at')
            ->limit(200)
            ->get(['recorded_at', 'tx_mbps', 'rx_mbps']);
    }
}
