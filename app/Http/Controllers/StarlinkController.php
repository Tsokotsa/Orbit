<?php

namespace App\Http\Controllers;

use App\Models\StarlinkAccount;
use App\Services\StarlinkService;
use Illuminate\Http\JsonResponse;
use App\Models\StarlinkTelemetry;
use App\Models\StarlinkRouterUsage;
use Throwable;
use Carbon\Carbon;
use Carbon\CarbonInterval;
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
        // $account = StarlinkAccount::where('account_number', $accountNumber)->first();
        // if (!$account) {
        //     return response()->json(['data' => []]);
        // }



        // $subscribers = $this->starlink->allSubscribers($account->id);
        $subscribers = $this->starlink->allSubscribers($accountNumber);

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

    // public function view_subscriber(Request $request, $serviceLine)
    // {
    //     $user = auth()->user();
    //     $service_line = $serviceLine;
    //     $accountId = $request->acc_n;

    //     $usage_monthly = $this->usageMonthly($service_line, $accountId);

    //     $usage_today = $this->starlink->dataUsage($service_line, $accountId);

    //     $account = StarlinkAccount::where('id', $accountId)->first();
    //     $subscriber = $this->starlink->getServiceLine($service_line, $accountId);

    //     $dataBlock = collect(
    //         data_get($usage_today, 'content.results.0.servicePlan.dataPoolUsage.dataBlocks', [])
    //     )->first();

    //     $totalAmountGB = $dataBlock['totalAmountGB'] ?? 0;
    //     $consumedAmountGB = $dataBlock['consumedAmountGB'] ?? 0;

    //     $percentage = $totalAmountGB > 0 ? ($consumedAmountGB / $totalAmountGB) * 100 : 0;

    //     $usage_today = [
    //         'total_usage' => round($consumedAmountGB, 2),
    //         'limit' => $totalAmountGB,
    //         'percentage' => round($percentage, 2)
    //     ];

    //     return view("starlink.view-subscriber")
    //         ->with([
    //             'account' => $account,
    //             'subscriber' => $subscriber,
    //             'user' => $user,
    //             'usage' => $usage_monthly,
    //             'today_use' => $usage_today,
    //             'service_line' => $service_line
    //         ]);
    // }



    public function view_subscriber(Request $request, $serviceLine)
    {
        $user = auth()->user();
        $service_line = $serviceLine;
        $accountId = $request->acc_n;

        $usage_monthly = $this->usageMonthly($service_line, $accountId);

        $usage_today = $this->starlink->dataUsage($service_line, $accountId);

        $account = StarlinkAccount::find($accountId);

        $dataBlock = collect(
            data_get($usage_today, 'content.results.0.servicePlan.dataPoolUsage.dataBlocks', [])
        )->first();

        $totalAmountGB = $dataBlock['totalAmountGB'] ?? 0;
        $consumedAmountGB = $dataBlock['consumedAmountGB'] ?? 0;

        $percentage = $totalAmountGB > 0 ? ($consumedAmountGB / $totalAmountGB) * 100 : 0;


        $subscriber = $this->starlink->getServiceLine($service_line, $accountId);

        $usage_today = [
            'total_usage' => round($consumedAmountGB, 2),
            'limit' => $totalAmountGB,
            'percentage' => round($percentage, 2)
        ];

        return view("starlink.view-subscriber")->with([
            'account' => $account,
            'subscriber' => $subscriber,
            'user' => $user,
            'usage' => $usage_monthly,
            'today_use' => $usage_today,
            'service_line' => $service_line
        ]);
    }

    public function view_device(Request $request, $serviceLine)
    {
        $user = auth()->user();

        $service_line = $serviceLine;
        $accountId = $request->acc_n;

        $device_data = [];

        // Get device from Starlink API
        $device = $this->starlink->getUserTerminalByServiceLine($service_line, $accountId);

        $device_status = $this->starlink->telemetryTimeFilter($device['routers'][0]['routerId'], $device['userTerminalId'], $accountId);

        // dd($device_status);

        if (!empty($device)) {

            $device_data = [
                'kit' => $device['kitSerialNumber'] ?? null,
                'dish_sn' => $device['dishSerialNumber'] ?? null,
                'router_id' => $device['routers'][0]['routerId'] ?? null,
                'terminal_id' => $device['userTerminalId'] ?? null,
            ];

            // Fetch telemetry if IDs exist
            if (!empty($device_data['router_id']) && !empty($device_data['terminal_id'])) {

                $telemetry = $this->starlink->telemetry(
                    $device_data['router_id'],
                    $device_data['terminal_id'],
                    $accountId
                );

                $router = !empty($telemetry['content']['routers'])
                    ? reset($telemetry['content']['routers'])
                    : [];

                $terminal = !empty($telemetry['content']['userTerminals'])
                    ? reset($telemetry['content']['userTerminals'])
                    : [];

                $device_data['software_version'] = $terminal['softwareVersion'] ?? null;

                // Convert uptimeSeconds to human-readable
                if (!empty($terminal['uptimeSeconds'])) {
                    $device_data['uptime'] = CarbonInterval::seconds($terminal['uptimeSeconds'])
                        ->cascade()
                        ->forHumans(['short' => true]); // e.g., "2d 5h 30m"
                } else {
                    $device_data['uptime'] = '—';
                }

                $device_data['starlink_id'] = $terminal['userTerminalId'] ?? null;

                // Short timestamp for last updated
                $device_data['router_last_updated'] = isset($router['timestamp'])
                    ? Carbon::parse($router['timestamp'])->diffForHumans() // e.g., "5 minutes ago"
                    : '—';
            }
        }

        return view('starlink.view-device', [
            'user' => $user,
            'device_data' => $device_data,
            'service_line' => $service_line,
            'accountId' => $accountId,
            'device_status' => $device_status
        ]);
    }


    public function update_nickname(Request $request)
    {
        //$serviceLineNumber = "SL-DF-9678649-75021-72";
        // return "OK";
        $acc_id = $request->account_id;
        $sl = $request->service_line;
        $nickname = $request->nickname;

        try {

            $response = $this->starlink->updateNickname($sl, $acc_id, $nickname);

            Log::info("Starlink Updating NICKNAME : " . json_encode($response));

            return response()->json([
                'success' => true,
                'message' => 'Nickname Updated',
                'data' => $response,
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update nickname',
                'error' => $e->getMessage(),
            ], 500);
        }

    }

    public function update_ippolicy(Request $request)
    {
        //$serviceLineNumber = "SL-DF-9678649-75021-72";
        // return "OK";
        $acc_id = $request->account_id;
        $sl = $request->service_line;
        $isPublic = strtolower((string) $request->ippolicy) === 'public';

        //$starlink_acc = StarlinkAccount::where('id', $acc_id)->first();  // IMPACT ACC

        try {

            $response = $this->starlink->updateIPpolicy($sl, $acc_id, $isPublic);

            Log::info("Starlink Updating IPPOLICY : " . json_encode($response));

            return response()->json([
                'success' => true,
                'message' => 'Policy Updated',
                'data' => $response,
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update Policy',
                'error' => $e->getMessage(),
            ], 500);
        }

    }

    public function deactivate_line(Request $request): JsonResponse
    {
        // $serviceLineNumber = "SL-DF-9678649-75021-72";
        $acc_id = $request->account_id;
        $sl = $request->service_line;

        try {
            // $response = $this->starlink->deactivateServiceLine($serviceLineNumber);
            $response = $this->starlink->deactivateServiceLine($sl, true, $acc_id);

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

    public function activate_line(Request $request): JsonResponse
    {
        $this->authorize('activateLine', auth()->user());

        $acc_id = $request->account_id;
        $sl = $request->service_line;

        //$starlink_acc = StarlinkAccount::where('id', 2)->first();  // IMPACT ACC

        Log::info("This is the Account used " . $acc_id);

        try {
            // $response = $this->starlink->deactivateServiceLine($serviceLineNumber);
            $response = $this->starlink->resumeServiceLine($sl, $acc_id);

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

    // public function usageMonthly($service_line, $acc_id, $returnJson = false)
    // {
    //     Log::info("TSOKOTSA =========== Getting Service Line for {$service_line} and ACC: {$acc_id}");

    //     $sl = $this->starlink->getUserTerminalByServiceLine($service_line, $acc_id);

    //     // ✅ Validate service line response safely
    //     if (!$sl || empty($sl['routerId'])) {
    //         Log::warning("Service Line {$service_line} has no router assigned or not found.");

    //         return $returnJson
    //             ? response()->json($this->emptyUsageResponse())
    //             : $this->emptyUsageResponse();
    //     }

    //     $routerId = $sl['routerId'];
    //     $device = "Router-" . $routerId;

    //     Log::info("TSOKOTSA +++++++++++++++++++++++++ Querying Router [ {$device} ] +++++++++++++++++++++++++++++");

    //     $month = request('month', 'current');
    //     $now = now(); // Africa/Maputo

    //     if ($month === 'last') {
    //         $start = $now->copy()->subMonth()->startOfMonth();
    //         $end = $now->copy()->subMonth()->endOfMonth();
    //     } else {
    //         $start = $now->copy()->startOfMonth();
    //         $end = $now->copy()->endOfMonth();
    //     }

    //     $queryStart = $start->copy()->startOfDay();
    //     $queryEnd = $end->copy()->endOfDay();

    //     Log::info("Querying usage from {$queryStart} to {$queryEnd}");

    //     // ✅ Fetch & aggregate usage safely
    //     $usageCollection = StarlinkRouterUsage::where('device_id', $device)
    //         ->whereBetween('recorded_at', [$queryStart, $queryEnd])
    //         ->get();

    //     // If no records found — return structured empty response
    //     if ($usageCollection->isEmpty()) {
    //         Log::info("No usage records found for {$device}");

    //         return $returnJson
    //             ? response()->json($this->emptyUsageResponse())
    //             : $this->emptyUsageResponse();
    //     }

    //     $usage = $usageCollection
    //         ->groupBy(function ($item) {
    //             return \Carbon\Carbon::parse($item->recorded_at)->format('Y-m-d');
    //         })
    //         ->map(function ($items) {
    //             return (object) [
    //                 'download_mb' => $items->sum(fn($row) => ($row->rx_mbps * 60) / 8),
    //                 'upload_mb' => $items->sum(fn($row) => ($row->tx_mbps * 60) / 8),
    //             ];
    //         });

    //     $period = \Carbon\CarbonPeriod::create(
    //         $start->copy()->startOfDay(),
    //         $end->copy()->startOfDay()
    //     );

    //     $labels = [];
    //     $download = [];
    //     $upload = [];

    //     foreach ($period as $date) {
    //         $day = $date->format('Y-m-d');
    //         $labels[] = $day;

    //         if (isset($usage[$day])) {
    //             $download[] = round($usage[$day]->download_mb, 2);
    //             $upload[] = round($usage[$day]->upload_mb, 2);
    //         } else {
    //             $download[] = 0;
    //             $upload[] = 0;
    //         }
    //     }

    //     $result = [
    //         'labels' => $labels,
    //         'download' => $download,
    //         'upload' => $upload,
    //         'total_download' => round(array_sum($download), 2),
    //         'total_upload' => round(array_sum($upload), 2),
    //     ];

    //     return $returnJson
    //         ? response()->json($result)
    //         : $result;
    // }

    public function usageMonthly($serviceLine, $accountId)
    {
        $response = $this->starlink->dataUsage($serviceLine, $accountId);

        $cycles = data_get($response, 'content.results.0.billingCycles', []);

        $labels = [];
        $usage = [];

        $previousTotal = 0;
        $currentTotal = 0;
        $cycleResetDate = null;

        foreach ($cycles as $index => $cycle) {

            // Build graph data
            foreach ($cycle['dailyDataUsage'] ?? [] as $day) {

                $date = Carbon::parse($day['date'])->format('Y-m-d');

                $usageMb = ($day['priorityGB'] ?? 0) * 1024;

                $labels[] = $date;
                $usage[] = round($usageMb, 2);
            }

            // Extract totals directly from API
            $block = data_get($cycle, 'dataPoolUsage.0.dataBlocks.0');

            if ($block) {

                if ($index === count($cycles) - 1) {
                    $currentTotal = $block['consumedAmountGB'] ?? 0;

                    // Billing cycle reset line for graph
                    $cycleResetDate = $cycle['startDate'] ?? null;

                } else {
                    $previousTotal = $block['consumedAmountGB'] ?? 0;
                }
            }
        }

        return [
            "labels" => $labels,
            "usage" => $usage,
            "previous_cycle_total_gb" => $previousTotal,
            "current_cycle_total_gb" => $currentTotal,
            "cycle_reset_date" => $cycleResetDate
        ];
    }



    private function emptyUsageResponse()
    {
        return [
            'labels' => [],
            'download' => [],
            'upload' => [],
            'total_download' => 0,
            'total_upload' => 0,
        ];
    }

}
