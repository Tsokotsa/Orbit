<?php

namespace App\Services;

use App\Models\StarlinkAccount;
use App\Models\StarlinkToken;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use RuntimeException;
use Throwable;
use Carbon\Carbon;

class StarlinkService
{
    protected string $apiBase = 'https://starlink.com/api/public/v2';

    /**
     * Retrieve a valid token from DB
     */
    protected function getAccessToken(?int $accountId = null): string
    {
        if (!$accountId) {
            $accountId = StarlinkAccount::where('active', 'y')
                ->where('is_default', 'y')
                ->value('id');

            if (!$accountId) {
                Log::critical('Starlink: No default account configured');
                throw new RuntimeException('Default Starlink account not configured');
            }
        }

        $token = StarlinkToken::where('account_id', $accountId)
            ->latest('expires_at')
            ->first();

        if (!$token) {
            Log::critical("Starlink: Token missing", [
                'account_id' => $accountId,
            ]);
            throw new RuntimeException("Starlink token not available for account {$accountId}");
        }

        if ($token->expires_at->isPast()) {
            Log::critical("Starlink: Token expired", [
                'account_id' => $accountId,
                'expired_at' => $token->expires_at,
            ]);
            throw new RuntimeException("Starlink token expired for account {$accountId}");
        }

        return $token->access_token;
    }

    /**
     * Generic API request handler (Enterprise Safe)
     */
    public function request(
        string $method,
        string $endpoint,
        array $payload = [],
        ?int $accountId = null,
        bool $silent = false
    ): array {

        $url = $this->apiBase . $endpoint;

        $correlationId = (string) Str::uuid();
        $startTime = microtime(true);

        try {

            $response = Http::withToken($this->getAccessToken($accountId))
                        ->acceptJson()
                        ->connectTimeout(10)
                        ->timeout(90)

                        ->retry(
                            4,
                            function ($attempt) {
                                return 1000 * $attempt; // exponential backoff
                            },
                            function ($exception, $request) {

                                if ($exception instanceof \Illuminate\Http\Client\ConnectionException) {
                                    return true;
                                }

                                if ($exception instanceof \Illuminate\Http\Client\RequestException) {
                                    $status = $exception->response?->status();

                                    return in_array($status, [429, 500, 502, 503, 504]);
                                }

                                return false;
                            }
                        )

                        ->withHeaders([
                            'X-Correlation-ID' => $correlationId,
                        ])

                ->$method($url, $payload);

            $duration = round((microtime(true) - $startTime) * 1000, 2);

            if (!$response->successful()) {

                Log::warning('Starlink API returned non-success status', [
                    'correlation_id' => $correlationId,
                    'endpoint' => $endpoint,
                    'method' => strtoupper($method),
                    'account_id' => $accountId,
                    'status' => $response->status(),
                    'duration_ms' => $duration,
                    'body' => $response->body(),
                ]);
            } else {

                Log::info('Starlink API success', [
                    'correlation_id' => $correlationId,
                    'endpoint' => $endpoint,
                    'account_id' => $accountId,
                    'status' => $response->status(),
                    'duration_ms' => $duration,
                ]);
            }

            return $response->throw()->json();

        } catch (Throwable $e) {

            Log::critical('Starlink API exception', [
                'correlation_id' => $correlationId,
                'endpoint' => $endpoint,
                'account_id' => $accountId,
                'message' => $e->getMessage(),
            ]);

            if (!$silent) {
                throw new RuntimeException(
                    "Starlink API request failed [{$endpoint}]",
                    previous: $e
                );
            }

            return [];
        }
    }

    /* =======================
       PUBLIC API METHODS
       ======================= */

    public function account(?int $accountId = null, bool $silent = false): array
    {
        return $this->request('get', '/account', [], $accountId, $silent);
    }

    public function fetchAccountData(?int $accountId = null): ?array
    {
        $response = $this->account($accountId, true);

        if (!isset($response['content'])) {
            return null;
        }

        $content = $response['content'];

        return [
            'account_number' => $content['accountNumber'],
            'account_name' => $content['accountName'] ?? null,
            'region_code' => $content['regionCode'] ?? null,
            'is_valid' => $response['isValid'] ?? false,
            'has_suspension' => !empty($content['activeSuspensions']),
            'suspension_payload' => $content['activeSuspensions'] ?? [],
            'raw_payload' => $response,
        ];
    }


    public function allUserTerminals(?int $accountId = null, bool $silent = false): array
    {
        return $this->request('get', '/user-terminals', [], $accountId, $silent);
    }

    // public function getUserTerminalByServiceLine(string $serviceLineNumber, ?int $accountId = null): array
    // {
    //     Log::info("Running function " . __FUNCTION__ . " For SL: [ $serviceLineNumber ]");

    //     $res = $this->request('get', '/user-terminals', ['serviceLineNumbers' => $serviceLineNumber], $accountId);

    //     $results = $res['content']['results'] ?? [];
    //     if (!empty($results) && !empty($results[0]['routers'])) {
    //         return $results[0]['routers'][0];
    //     }
    //     return [];
    // }

    public function getUserTerminalByServiceLine(string $serviceLineNumber, ?int $accountId = null): array
    {
        Log::info("Running function " . __FUNCTION__ . " For SL: [ $serviceLineNumber ]");

        $res = $this->request('get', '/user-terminals', [
            'serviceLineNumbers' => $serviceLineNumber
        ], $accountId, $silent = true);

        $results = $res['content']['results'] ?? [];

        if (!empty($results)) {
            return $results[0]; // return full service line object
        }

        return [];
    }


    // public function allSubscribers(?int $accountId = null): array
    // {
    //     return $this->request('get', '/service-lines', [], $accountId);
    // }

    public function allSubscribers(?int $accountId = null): array
    {
        $all = [];
        $pageIndex = 0; // Starlink uses 0-based index
        $limit = 100;

        do {
            $response = $this->request('get', '/service-lines', [
                'pageIndex' => $pageIndex,
                'limit' => $limit
            ], $accountId);

            $content = $response['content'] ?? [];

            $results = $content['results'] ?? [];
            $isLastPage = $content['isLastPage'] ?? true;

            // Merge results
            $all = array_merge($all, $results);

            \Log::info("Subscribers page {$pageIndex} fetched: " . count($results));

            $pageIndex++;

            // Safety break (avoid infinite loop)
            if ($pageIndex > 5) {
                \Log::warning('Pagination stopped at 5 pages (safety limit)');
                break;
            }

        } while (!$isLastPage);

        \Log::info('Total subscribers fetched: ' . count($all));

        return $all;
    }

    public function getServiceLine(string $serviceLineNumber, ?int $accountId = null): array
    {
        Log::info("Running function " . __FUNCTION__ . " For SL: [ $serviceLineNumber ]");
        return $this->request(
            'get',
            "/service-lines/{$serviceLineNumber}",
            [],
            $accountId
        );
    }

    // public function updateNickname(string $serviceLineNumber, ?int $accountId = null, $nickname): array
    public function updateNickname(string $serviceLineNumber, string $nickname, ?int $accountId = null): array
    {
        $endpoint = "/service-lines/{$serviceLineNumber}/nickname";

        $payload = [
            'nickname' => $nickname,
        ];

        Log::info("Nickname will be updated for", [
            'serviceLine' => $serviceLineNumber,
            'accountId' => $accountId,
        ]);

        return $this->request('put', $endpoint, $payload, $accountId);
    }

    public function updateIPpolicy(string $serviceLineNumber, ?int $accountId = null, bool $isPublic = false): array
    {
        $endpoint = "/service-lines/{$serviceLineNumber}/public-ip";

        $payload = [
            'publicIp' => $isPublic,
        ];

        Log::info("Public IP set will be updated for", [
            'serviceLine' => $serviceLineNumber,
            'accountId' => $accountId,
        ]);

        return $this->request('put', $endpoint, $payload, $accountId);
    }

    public function deactivateServiceLine(
        string $serviceLineNumber,
        bool $endNow = true,
        ?int $accountId = null
    ): array {
        $endpoint = "/service-lines/{$serviceLineNumber}?endNow=" . ($endNow ? 'true' : 'false');

        Log::info("Starlink: Started service deactivation", [
            'serviceLine' => $serviceLineNumber,
            'accountId' => $accountId,
        ]);

        return $this->request('delete', $endpoint, [], $accountId);
    }

    public function resumeServiceLine(
        string $serviceLineNumber,
        ?int $accountId = null
    ): array {
        // 1. Fetch service line details
        Log::info("Fetching the product for  " . $serviceLineNumber);
        $serviceLine = $this->getServiceLine($serviceLineNumber, $accountId);

        // 2. Extract productReferenceId
        Log::info("The Product Reference is " . json_encode($serviceLine));

        $productReferenceId = $serviceLine['content']['productReferenceId']
            ?? null;

        if (!$productReferenceId) {
            Log::critical('Starlink resume failed: productReferenceId missing', [
                'serviceLine' => $serviceLineNumber,
                'accountId' => $accountId,
                'response' => $serviceLine,
            ]);

            throw new RuntimeException(
                "Cannot resume service line {$serviceLineNumber}: productReferenceId not found"
            );
        }

        // 3. Resume service
        $endpoint = "/service-lines/{$serviceLineNumber}/product";

        $payload = [
            'productReferenceId' => $productReferenceId,
            'recurringDataBlocks' => null,
        ];

        Log::info('Starlink: Resuming service line', [
            'serviceLine' => $serviceLineNumber,
            'productReferenceId' => $productReferenceId,
            'accountId' => $accountId,
        ]);

        return $this->request('put', $endpoint, $payload, $accountId);
    }

    public function streamTelemetry(
        int $batchSize = 1000,
        int $maxLingerMs = 15000,
        ?int $accountId = null
    ): array {
        return $this->request(
            'post',
            '/telemetry/stream',
            [
                'batchSize' => $batchSize,
                'maxLingerMs' => $maxLingerMs,
            ],
            $accountId
        );
    }

    // This is to normalise the values we save for the telemetry. 
    public function normalizeValues(array $response): array
    {
        $rows = [];

        Log::info("Starlink normalising values for DB storing");

        $values = $response['data']['values'] ?? [];
        $columns = $response['data']['columnNamesByDeviceType'] ?? [];

        foreach ($values as $row) {
            $deviceType = $row[0] ?? null;

            if (!$deviceType || !isset($columns[$deviceType])) {
                continue;
            }

            $assoc = array_combine($columns[$deviceType], $row);

            if (isset($assoc['DeviceId'])) {
                $assoc['DeviceId'] = preg_replace('/^(ut|r|i)/', '', $assoc['DeviceId']);
            }

            $rows[] = $assoc;
        }

        return $rows;
    }


    // public function dataUsage(string $serviceLineNumber, ?int $accountId = null): array
    // {
    //     $endpoint = "/data-usage/query";

    //     $payload = [
    //         'serviceLineNumbers' => [$serviceLineNumber], // must be array
    //     ];

    //     Log::info("Data Usage is being queried for", [
    //         'serviceLine' => $serviceLineNumber,
    //         'accountId' => $accountId,
    //     ]);

    //     return $this->request('post', $endpoint, $payload, $accountId);
    // }

    public function dataUsage(string $serviceLineNumber, int $accountId)
    {
        $endpoint = "/data-usage/query";

        $payload = [
            "serviceLineNumbers" => [$serviceLineNumber],
            "previousBillingCycles" => 1,
            "activeServiceLinesOnly" => true
        ];

        Log::info("Data Usage is being queried for", [
            'serviceLine' => $serviceLineNumber,
            'accountId' => $accountId,
        ]);

        return $this->request('post', $endpoint, $payload, $accountId);
    }

    public function telemetry(string $routerId, string $terminalId, int $accountId)
    {
        $endpoint = "/telemetry/query";

        $payload = [
            "includeUserTerminals" => true,
            "includeRouters" => true,
            "routerIds" => [$routerId],
            "userTerminalIds" => [$terminalId]
        ];

        Log::info("Starlink telemetry is being queried", [
            'routerId' => $routerId,
            'terminalId' => $terminalId,
            'accountId' => $accountId,
        ]);

        return $this->request('post', $endpoint, $payload, $accountId);
    }

    public function telemetryTimeFilter(
        ?string $routerId,
        string $terminalId,
        int $accountId,
        string $range = '15m'
    ) {

        $endpoint = "/telemetry/query";

        $endTime = Carbon::now();

        switch ($range) {
            case '30m':
                $startTime = $endTime->copy()->subMinutes(30);
                $granularity = "1m";
                break;

            case '1h':
                $startTime = $endTime->copy()->subHour();
                $granularity = "5m";
                break;

            case '1mo':
                $startTime = $endTime->copy()->subMonth();
                $granularity = "1d";
                break;

            default:
                $startTime = $endTime->copy()->subMinutes(15);
                $granularity = "1m";
        }

        $payload = [
            "includeUserTerminals" => true,
            "includeRouters" => !empty($routerId),
            "userTerminalIds" => [$terminalId],

            "metrics" => [
                "ping_latency_ms",
                "ping_loaded_latency_ms",
                "ping_drop_rate"
            ],

            "startTime" => $startTime->toIso8601String(),
            "endTime" => $endTime->toIso8601String(),
            "granularity" => $granularity
        ];

        // Only add router filter if router exists
        if (!empty($routerId)) {
            $payload["routerIds"] = [$routerId];
        }

        return $this->request('post', $endpoint, $payload, $accountId);
    }


}
