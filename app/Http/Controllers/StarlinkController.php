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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Jobs\PollStarlinkTelemetryJob;
use App\Models\StarlinkDataUsageNotification;

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

    public function view_subscriber(Request $request, $serviceLine)
    {
        $user = auth()->user();
        $service_line = $serviceLine;
        $accountId = $request->acc_n;

        $usage_monthly = $this->usageMonthly($service_line, $accountId);

        $usage_today = $this->starlink->dataUsage($service_line, $accountId);

        $account = StarlinkAccount::find($accountId);

        $dataBlocks = data_get($usage_today, 'content.results.0.servicePlan.dataPoolUsage.dataBlocks', []);

        $dataBlock = collect($dataBlocks)
            ->first(fn($block) => isset($block['totalAmountGB']) && $block['totalAmountGB'] > 0);

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
        // Get Last executed Job
        $last_executed = DB::table("starlink_telemetry_refresh")
            ->where("status", "done")
            ->latest('updated_at')
            ->first();

        //dd($last_executed->updated_at);

        $service_line = $serviceLine;
        $accountId = $request->acc_n;

        $device_data = [];

        // Get device from Starlink API (basic info, you can cache this too if needed)
        $device = $this->starlink->getUserTerminalByServiceLine($service_line, $accountId);

        //dd($device);

        // Safely extract IDs
        $routerId = data_get($device, 'routers.0.routerId');
        $terminalId = $device['userTerminalId'] ?? null;

        // Fetch latest telemetry snapshot from local DB
        $telemetry = null;
        if ($terminalId) {
            $telemetry = StarlinkRouterUsage::where('user_terminal_id', $terminalId)->first();
        }

        if (!empty($device)) {

            $device_data = [
                'kit' => $device['kitSerialNumber'] ?? null,
                'dish_sn' => $device['dishSerialNumber'] ?? null,
                'router_id' => $routerId,
                'terminal_id' => $terminalId,
            ];

            if ($telemetry) {

                $device_data['software_version'] = $telemetry->terminal_sw ?? null;

                // Convert uptimeSeconds to human-readable
                if (!empty($telemetry->terminal_uptime)) {
                    $device_data['uptime'] = CarbonInterval::seconds($telemetry->terminal_uptime)
                        ->cascade()
                        ->forHumans(['short' => true]);
                } else {
                    $device_data['uptime'] = '—';
                }

                $device_data['starlink_id'] = $telemetry->user_terminal_id ?? null;

                // Last router update
                $device_data['router_last_updated'] = isset($last_executed->updated_at)
                    ? Carbon::parse($last_executed->updated_at)->diffForHumans()
                    : '—';
            }
        }

        // Prepare device_status for graphs (same format as before)
        $device_status = [
            'content' => [
                'routers' => $telemetry ? [
                    $routerId => [
                        'routerId' => $routerId,
                        'internetPingLatencyMs' => $telemetry->internet_latency ?? null,
                        'internetPingDropRate' => $telemetry->internet_drop ?? null,
                        'popPingLatencyMs' => $telemetry->pop_latency ?? null,
                        'popPingDropRate' => $telemetry->pop_drop ?? null,
                        'dishPingLatencyMs' => $telemetry->dish_latency ?? null,
                        'dishPingDropRate' => $telemetry->dish_drop ?? null,
                        'clients2GhzRxRateMbpsAvg' => $telemetry->clients_2ghz_rx_rate_avg ?? 0,
                        'clients2GhzTxRateMbpsAvg' => $telemetry->clients_2ghz_tx_rate_avg ?? 0,
                        'clients5GhzRxRateMbpsAvg' => $telemetry->clients_5ghz_rx_rate_avg ?? 0,
                        'clients5GhzTxRateMbpsAvg' => $telemetry->clients_5ghz_tx_rate_avg ?? 0,
                    ]
                ] : [],
                'userTerminals' => $telemetry ? [
                    $terminalId => [
                        'userTerminalId' => $terminalId,
                        'timestamp' => $telemetry->timestamp,
                        'downlinkThroughputMbps' => $telemetry->downlink_mbps ?? 0,
                        'uplinkThroughputMbps' => $telemetry->uplink_mbps ?? 0,
                        'signalQuality' => $telemetry->signal_quality ?? 0,
                        'obstructionPercentTime' => $telemetry->obstruction_percent_time ?? 0,
                    ]
                ] : []
            ]
        ];
        // dd($device_status);
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

    public function usageMonthly(string $serviceLine, int $accountId): array
    {
        $response = $this->starlink->dataUsage($serviceLine, $accountId);

        $cycles = data_get($response, 'content.results.0.billingCycles', []);

        $labels = [];
        $usage = [];
        $previousTotal = 0.0;
        $currentTotal = 0.0;
        $cycleResetDate = null;

        foreach ($cycles as $index => $cycle) {

            // --- Build daily usage for graph ---
            foreach ($cycle['dailyDataUsage'] ?? [] as $day) {
                $date = isset($day['date']) ? Carbon::parse($day['date'])->format('Y-m-d') : null;
                if (!$date)
                    continue;

                // Sum daily usage across multiple blocks if present
                $dailyUsageGB = 0.0;

                // Check if the day has multiple blocks usage
                if (!empty($day['priorityGB'])) {
                    $dailyUsageGB += (float) $day['priorityGB'];
                }

                $usageMb = $dailyUsageGB * 1024; // Convert GB to MB
                $labels[] = $date;
                $usage[] = round($usageMb, 2);
            }

            // --- Calculate total consumed GB for this cycle ---
            $dataBlocks = data_get($cycle, 'dataPoolUsage.0.dataBlocks', []);

            // Sum all non-empty blocks
            $cycleConsumedGB = collect($dataBlocks)
                ->filter(fn($block) => isset($block['totalAmountGB']) && $block['totalAmountGB'] > 0)
                ->sum('consumedAmountGB');

            // Determine if this is the current (last) cycle
            if ($index === count($cycles) - 1) {
                $currentTotal = $cycleConsumedGB;
                $cycleResetDate = $cycle['startDate'] ?? null;
            } else {
                $previousTotal = $cycleConsumedGB;
            }
        }

        return [
            "labels" => $labels,
            "usage" => $usage,
            "previous_cycle_total_gb" => round($previousTotal, 2),
            "current_cycle_total_gb" => round($currentTotal, 2),
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

    public function refreshTelemetry(Request $request)
    {
        $user = auth()->user();

        try {

            // Block if a job is currently running
            $isRunning = DB::table('starlink_telemetry_refresh')
                ->where('status', 'running')
                ->exists();

            if ($isRunning) {
                return response()->json([
                    'success' => false,
                    'message' => 'Telemetry job already running. Please wait.'
                ]);
            }

            // Get last executed job
            $lastJob = DB::table('starlink_telemetry_refresh')
                ->latest('executed_at')
                ->first();

            // sBlock if last execution < 15 minutes
            if ($lastJob && $lastJob->executed_at && now()->diffInMinutes($lastJob->executed_at) < 15) {

                $nextAllowed = \Carbon\Carbon::parse($lastJob->executed_at)->addMinutes(15);

                return response()->json([
                    'success' => false,
                    'message' => 'Telemetry was refreshed recently. Try again at ' . $nextAllowed->format('H:i:s')
                ]);
            }

            // Create job record
            $jobId = DB::table('starlink_telemetry_refresh')->insertGetId([
                'status' => 'running',
                'executed_by' => "manual | user {$user->id}",
                'records_updated' => 0,
                'notes' => 'Started manually',
                'executed_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Log::info("Starting Starlink telemetry refresh JOBID = $jobId");

            // Dispatch jobs per account
            $accounts = StarlinkAccount::where('active', 'y')->get();

            foreach ($accounts as $account) {
                PollStarlinkTelemetryJob::dispatch($jobId, $account->id);
            }

            return response()->json([
                'success' => true,
                'job_id' => $jobId,
                'message' => 'Telemetry refresh job started'
            ]);

        } catch (\Throwable $e) {

            Log::error("Failed to start telemetry refresh: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Optional: frontend can poll this endpoint to check progress
    public function refreshStatus(int $jobId)
    {
        $job = DB::table('starlink_telemetry_refresh')->where('id', $jobId)->first();

        if (!$job) {
            return response()->json([
                'success' => false,
                'message' => 'Job not found'
            ]);
        }

        return response()->json([
            'success' => true,
            'status' => $job->status,
            'records' => $job->records_updated,
            'notes' => $job->notes
        ]);
    }

    public function storeNotification(Request $request)
    {
        $user = auth()->user();

        Log::info("Storing Notification for [ STARLINK USAGE NOTIFIATIONS ]");

        try {

            $validated = $request->validate([
                'client_id' => 'required|string',
                'threshold_percent' => 'required|integer',
                'channels' => 'nullable|array',
                'name' => 'nullable|string',
                'surname' => 'nullable|string',
                'mobile_number' => 'nullable|string',
                'email' => 'nullable|email',
                'whatsapp_nr' => 'nullable|string',
                'telegram_id' => 'nullable|string',
                'greetings' => 'nullable|string',
            ]);

            // Handle "none"
            $channels = $validated['channels'] ?? [];

            if (in_array('none', $channels)) {
                $channels = [];
            }

            $notification = StarlinkDataUsageNotification::updateOrCreate([
                'client_id' => $validated['client_id'],
                'service_id' => $request->service_id ?? null,
                'threshold_percent' => $validated['threshold_percent'],
                'channels' => $channels,
                'name' => $validated['name'] ?? null,
                'surname' => $validated['surname'] ?? null,
                'mobile_number' => $validated['mobile_number'] ?? null,
                'email' => $validated['email'] ?? null,
                'whatsapp_nr' => $validated['whatsapp_nr'] ?? null,
                'telegram_id' => $validated['telegram_id'] ?? null,
                'active' => true,
            ]);

            Log::info("Notificatiion stored for " . $validated['client_id'] . " " . $validated['name'] . " " . $validated['surname']);

            return response()->json([
                'success' => true,
                'message' => 'Notification saved successfully',
                'data' => $notification
            ]);

        } catch (\Throwable $e) {

            \Log::error("Notification save failed: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

}
