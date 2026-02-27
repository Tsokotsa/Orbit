<?php

namespace App\Http\Controllers;

use App\Models\StarlinkAccount;
use App\Services\StarlinkService;
use Illuminate\Http\JsonResponse;
use App\Models\StarlinkTelemetry;
use App\Models\StarlinkRouterUsage;
use Throwable;
use Log;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class StarlinkController extends Controller
{
    use AuthorizesRequests;
    protected StarlinkService $starlink;

    public function __construct(StarlinkService $starlink)
    {
        $this->starlink = $starlink;
    }



    public function account()
    {
        $this->authorize('viewAccount', auth()->user());
        $user = auth()->user();

        try {

            $accounts = StarlinkAccount::orderBy('id')->get();
            $subscribers = $this->starlink->allSubscribers();

            return view('starlink.index', [
                'accounts' => $accounts,
                'subscribers' => $subscribers,
                'user' => $user,
            ]);

        } catch (\Throwable $e) {

            report($e);

            return view('starlink.index', [
                'error' => 'Unable to load Starlink accounts',
                'accounts' => collect(),     // prevent other undefined errors
                'subscribers' => [],
                'user' => $user,             // ✅ important
            ]);
        }
    }

    public function subscribersAjax(Request $request)
    {
        $accountNumber = $request->input('account_number');

        // Find Starlink account ID for this number
        $account = StarlinkAccount::where('account_number', $accountNumber)->first();
        if (!$account) {
            return response()->json(['data' => []]);
        }

        $subscribers = $this->starlink->allSubscribers($account->id);

        // Transform into DataTables expected structure
        return datatables()->of($subscribers['content']['results'] ?? [])->toJson();
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

    public function view_subscriber(string $serviceLine)
    {
        $user = auth()->user();
        $service_line = $serviceLine;

        // get **raw array**, not JSON
        $usage = $this->usageMonthly($service_line, false);

        $subscriber = $this->starlink->getServiceLine($service_line);

        return view("starlink.view-subscriber")
            ->with([
                'subscriber' => $subscriber,
                'user' => $user,
                'usage' => $usage,
                'service_line' => $service_line
            ]);
        // Log::info(json_encode($subscriber));
        // return view("starlink.modals.partials.subscriber")->with(["subscriber" => $subscriber]);


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
        $this->authorize('activateLine', auth()->user());

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

    public function usageMonthly($service_line, $returnJson = true)
    {
        $sl = $this->starlink->getUserTerminalByServiceLine($service_line);
        $sl = $this->starlink->getUserTerminalByServiceLine($service_line);

        // Make sure routerId exists
        $routerId = $sl['routerId'] ?? null;

        if (!$routerId) {
            // No router assigned — handle gracefully
            Log::warning("Service Line {$service_line} has no router assigned");
            return []; // or throw exception, or return default device string
        }

        $device = "Router-" . $routerId;

        $month = request('month', 'current');
        $now = now(); // Africa/Maputo

        if ($month === 'last') {
            $start = $now->copy()->subMonth()->startOfMonth();
            $end = $now->copy()->subMonth()->endOfMonth();
        } else {
            $start = $now->copy()->startOfMonth();
            $end = $now->copy()->endOfMonth();
        }

        $queryStart = $start->copy()->startOfDay();
        $queryEnd = $end->copy()->endOfDay();

        Log::info("Querying usage from {$queryStart} to {$queryEnd}");

        $usage = StarlinkRouterUsage::where('device_id', $device)
            ->whereBetween('recorded_at', [$queryStart, $queryEnd])
            ->get()
            ->groupBy(function ($item) {
                return \Carbon\Carbon::parse($item->recorded_at)->format('Y-m-d');
            })
            ->map(function ($items) {
                return (object) [
                    'download_gb' => $items->sum(fn($row) => $row->rx_mbps * 60 / 8 / 1024),
                    'upload_gb' => $items->sum(fn($row) => $row->tx_mbps * 60 / 8 / 1024),
                ];
            });

        $period = \Carbon\CarbonPeriod::create($start->copy()->startOfDay(), $end->copy()->startOfDay());

        $labels = [];
        $download = [];
        $upload = [];

        foreach ($period as $date) {
            $day = $date->format('Y-m-d');
            $labels[] = $day;

            if (isset($usage[$day])) {
                $download[] = round($usage[$day]->download_gb, 2);
                $upload[] = round($usage[$day]->upload_gb, 2);
            } else {
                $download[] = 0;
                $upload[] = 0;
            }
        }

        $result = [
            'labels' => $labels,
            'download' => $download,
            'upload' => $upload,
            'total_download' => round(array_sum($download), 2),
            'total_upload' => round(array_sum($upload), 2),
        ];

        return $returnJson ? response()->json($result) : $result;
    }

}
