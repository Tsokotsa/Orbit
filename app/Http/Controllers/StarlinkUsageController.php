<?php

namespace App\Http\Controllers;

use App\Models\StarlinkRouterUsage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
class StarlinkUsageController extends Controller
{
    public function graph($device)
    {
        return view('starlink.graph', compact('device'));
    }

    public function data($device)
    {
        $device = "Router-010000000000000000ECB1C2";


        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $usage = StarlinkRouterUsage::where('device_id', $device)
            ->whereBetween('recorded_at', [$startOfMonth, $endOfMonth])
            ->selectRaw('DATE(recorded_at) as day,
                 SUM(rx_mbps) as total_download,
                 SUM(tx_mbps) as total_upload')
            ->groupBy('day')
            ->orderBy('day')
            ->get();


        return response()->json([
            'labels' => $usage->pluck('recorded_at')->map(function ($item) {
                return Carbon::parse($item)->toIso8601String();
            }),
            'download' => $usage->pluck('rx_mbps')->map(fn($val) => (float) $val),
            'upload' => $usage->pluck('tx_mbps')->map(fn($val) => (float) $val),
        ]);


    }

    public function usageMonthly($device)
    {
        $device = "Router-010000000000000000ECB1C2";

        $month = request('month', 'current');

        if ($month === 'last') {
            $start = Carbon::now()->subMonth()->startOfMonth();
            $end = Carbon::now()->subMonth()->endOfMonth();
        } else {
            $start = Carbon::now()->startOfMonth();
            $end = Carbon::now()->endOfMonth();
        }

        $usage = StarlinkRouterUsage::where('device_id', $device)
            ->whereBetween('recorded_at', [$start, $end])
            ->selectRaw("
            DATE(recorded_at) as day,
            SUM(rx_mbps * 60 / 8 / 1024) as download_gb,
            SUM(tx_mbps * 60 / 8 / 1024) as upload_gb
        ")
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        return response()->json([
            'labels' => $usage->pluck('day'),
            'download' => $usage->pluck('download_gb')->map(fn($v) => round($v, 2)),
            'upload' => $usage->pluck('upload_gb')->map(fn($v) => round($v, 2)),
            'total_download' => round($usage->sum('download_gb'), 2),
            'total_upload' => round($usage->sum('upload_gb'), 2),
        ]);
    }
}
