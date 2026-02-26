<?php

namespace App\Http\Controllers;

use App\Models\StarlinkRouterUsage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Log;
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

        $now = Carbon::now();

        if ($month === 'last') {
            $start = $now->copy()->subMonth()->startOfMonth()->startOfDay();
            $end = $now->copy()->subMonth()->endOfMonth()->endOfDay();
        } else {
            $start = $now->copy()->startOfMonth()->startOfDay();
            $end = $now->copy()->endOfMonth()->endOfDay();
            $today = now();
        }

        Log::info("We are querying Period from [ $start ] to [ $end ]");

        $usage = StarlinkRouterUsage::where('device_id', $device)
            ->whereBetween('recorded_at', [$start, $today])
            ->selectRaw("
            DATE(recorded_at) as day,
            SUM(rx_mbps * 60 / 8 / 1024) as download_gb,
            SUM(tx_mbps * 60 / 8 / 1024) as upload_gb
        ")
            ->groupBy('day')
            ->orderBy('day')
            ->get()
            ->map(function ($item) {
                $item->day = Carbon::parse($item->day)->format('Y-m-d');
                return $item;
            })
            ->keyBy('day');

        $period = CarbonPeriod::create($start, $end);

        $labels = [];
        $download = [];
        $upload = [];

        foreach ($period as $date) {
            $day = $date->format('Y-m-d');

            $labels[] = $day;

            $download[] = isset($usage[$day])
                ? round($usage[$day]->download_gb, 2)
                : 0;

            $upload[] = isset($usage[$day])
                ? round($usage[$day]->upload_gb, 2)
                : 0;
        }

        return response()->json([
            'labels' => $labels,
            'download' => $download,
            'upload' => $upload,
            'total_download' => round(array_sum($download), 2),
            'total_upload' => round(array_sum($upload), 2),
        ]);

    }
}
