<?php

namespace App\Http\Controllers;

use App\Models\StarlinkAccount;
use App\Services\StarlinkService;
use Illuminate\Http\JsonResponse;
use App\Models\StarlinkTelemetry;
use Throwable;
use Log;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StarlinkController extends Controller
{
    protected StarlinkService $starlink;

    public function __construct(StarlinkService $starlink)
    {
        $this->starlink = $starlink;
    }



    public function account()
    {
        try {
            $account = $this->starlink->account();
            $subscribers = $this->starlink->allSubscribers();

            Log::info("Account Retrieved " . json_encode($account));

            return view('starlink.index', [
                'account' => $account,
                'subscribers' => $subscribers
            ]);

        } catch (Throwable $e) {
            report($e);

            return view('starlink.index', [
                'error' => 'Unable to fetch Starlink account',
            ]);
        }
    }

    public function subscribersDatatable(Request $request)
    {


        // try {
        //     $subscribers = $this->starlink->allSubscribers();

        //     return $subscribers;
        //     return DataTables::of($subscribers)->make(true);

        // } catch (\Throwable $e) {
        //     \Log::error('Subscribers DataTable failed', ['error' => $e->getMessage()]);
        //     return response()->json(['data' => []], 500);
        // }



        // try {
        //     $subscribers = $this->starlink->allSubscribers();

        //     return response()->json([
        //         'data' => $subscribers
        //     ]);
        // } catch (\Throwable $e) {
        //     \Log::error('Subscribers DataTable failed', ['error' => $e->getMessage()]);
        //     return response()->json(['data' => []], 500);
        // }
    }

    public function view_subscriber(Request $request)
    {
        $subscriber = $this->starlink->getServiceLine("SL-DF-9722641-79642-67");

        // Log::info(json_encode($subscriber));

        dd($subscriber);

    }

    public function deactivate_line(string $serviceLineNumber): JsonResponse
    {
        $serviceLineNumber = "SL-DF-9678649-75021-72";

        return response()->json([
            'success' => true,
            'message' => 'Service line deactivated successfully',
            'data' => "200",
        ]);

        $starlink_acc = StarlinkAccount::where('id', 2)->first();  // IMPACT ACC

        try {
            // $response = $this->starlink->deactivateServiceLine($serviceLineNumber);
            $response = $this->starlink->deactivateServiceLine($serviceLineNumber, true, $starlink_acc->id);

            Log::info("Starlink Deactivation Response: " . json_encode($response));

            return response()->json([
                'success' => true,
                'message' => 'Service line deactivated successfully',
                'data' => $response,
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to deactivate service line',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function activate_line(string $serviceLineNumber): JsonResponse
    {
        $serviceLineNumber = "SL-DF-9678649-75021-72";

        return response()->json([
            'success' => true,
            'message' => 'Service line Activated successfully',
            'data' => "200",
        ]);

        $starlink_acc = StarlinkAccount::where('id', 2)->first();  // IMPACT ACC

        Log::info("This is the Account used " . $starlink_acc->id);

        try {
            // $response = $this->starlink->deactivateServiceLine($serviceLineNumber);
            $response = $this->starlink->resumeServiceLine($serviceLineNumber, $starlink_acc->id);

            Log::info("Starlink Activation Response: " . json_encode($response));

            return response()->json([
                'success' => true,
                'message' => 'Service Activated successfully',
                'data' => $response,
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to Activate service line',
                'error' => $e->getMessage(),
            ], 500);
        }

    }

    public function telemetry(Request $request)
    {
        $serviceLine = 'AST-2925665-31849-58';

        // 1️⃣ Read range from request
        $range = $request->get('range', '15m');

        // 2️⃣ Define ranges (Starlink-style)
        $ranges = [
            '15m' => ['from' => now()->subMinutes(15), 'bucket' => 30],
            '3h' => ['from' => now()->subHours(3), 'bucket' => 60],
            '1d' => ['from' => now()->subDay(), 'bucket' => 300],
            '7d' => ['from' => now()->subDays(7), 'bucket' => 1800],
            '30d' => ['from' => now()->subDays(30), 'bucket' => 7200],
        ];

        if (!isset($ranges[$range])) {
            abort(400, 'Invalid range');
        }

        // 3️⃣ Fetch telemetry
        $telemetries = StarlinkTelemetry::where('service_line_number', $serviceLine)
            ->where('observed_at', '>=', $ranges[$range]['from'])
            ->orderBy('observed_at')
            ->get();

        // 4️⃣ Bucket telemetry by time
        $bucketSize = $ranges[$range]['bucket'];

        $buckets = $telemetries->groupBy(function ($t) use ($bucketSize) {
            return $t->observed_at
                ->copy()
                ->startOfSecond()
                ->timestamp - ($t->observed_at->timestamp % $bucketSize);
        });

        // 5️⃣ Build series
        $downloadSeries = [];
        $uploadSeries = [];

        foreach ($buckets as $timestamp => $group) {
            $downloadSeries[] = [
                'x' => $timestamp * 1000, // JS expects ms
                'y' => round($group->avg(fn($t) => $t->metrics['DownlinkThroughput'] ?? 0), 2),
            ];

            $uploadSeries[] = [
                'x' => $timestamp * 1000,
                'y' => round($group->avg(fn($t) => $t->metrics['UplinkThroughput'] ?? 0), 2),
            ];
        }

        // 6️⃣ Stats (min / max / last)
        $downloadValues = collect($downloadSeries)->pluck('y');

        $stats = [
            'download' => [
                'min' => $downloadValues->min() ?? 0,
                'max' => $downloadValues->max() ?? 0,
                'last' => $downloadValues->last() ?? 0,
            ],
        ];

        // 7️⃣ Send to view
        $chartData = [
            'series' => [
                ['name' => 'Download', 'data' => $downloadSeries],
                ['name' => 'Upload', 'data' => $uploadSeries],
            ],
            'stats' => $stats,
            'range' => $range,
        ];

        return view('starlink.telemetry', compact('chartData'));
    }


    private function formatThroughput($value)
    {
        if ($value >= 1) {
            return round($value, 2); // Mbps
        }

        return round($value * 1000, 2); // Kbps
    }

    public function top_up()
    {
        return response()->json([
            'success' => true,
            'message' => 'Top Up Successfuly!',
            'data' => 200,
        ]);
    }

}
