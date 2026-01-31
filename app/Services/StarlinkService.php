<?php

namespace App\Services;

use App\Models\StarlinkAccount;
use App\Models\StarlinkToken;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class StarlinkService
{
    protected string $apiBase = 'https://starlink.com/api/public/v2';

    /**
     * Retrieve a valid token from DB
     * Uses default account if none provided
     */
    protected function getAccessToken(?int $accountId = null): string
    {
        // Resolve default account if none passed
        if (!$accountId) {
            $accountId = StarlinkAccount::where('active', 'y')
                ->where('is_default', 'y')
                ->value('id');

            if (!$accountId) {
                Log::critical('No default Starlink account configured');
                throw new RuntimeException('Default Starlink account not configured');
            }
        }

        $token = StarlinkToken::where('account_id', $accountId)
            ->latest('expires_at')
            ->first();

        if (!$token) {
            Log::critical("Starlink token missing for account: {$accountId}");
            throw new RuntimeException("Starlink token not available for account {$accountId}");
        }

        if ($token->expires_at->isPast()) {
            Log::critical("Starlink token expired for account: {$accountId}");
            throw new RuntimeException("Starlink token expired for account {$accountId}");
        }

        return $token->access_token;
    }

    /**
     * Generic API request handler
     */
    public function request(
        string $method,
        string $endpoint,
        array $payload = [],
        ?int $accountId = null
    ): array {
        $url = $this->apiBase . $endpoint;

        $response = Http::withToken($this->getAccessToken($accountId))
                    ->acceptJson()
                    ->timeout(15)
                    ->retry(2, 500)
            ->$method($url, $payload);

        if (!$response->successful()) {
            Log::error('Starlink API request failed', [
                'method' => strtoupper($method),
                'url' => $url,
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
        }

        return $response->throw()->json();
    }

    /* =======================
       PUBLIC API METHODS
       ======================= */

    public function account(?int $accountId = null): array
    {
        return $this->request('get', '/account', [], $accountId);
    }

    public function allUserTerminals(?int $accountId = null): array
    {
        return $this->request('get', '/user-terminals', [], $accountId);
    }

    public function allSubscribers(?int $accountId = null): array
    {
        return $this->request('get', '/service-lines', [], $accountId);
    }

    public function getServiceLine(string $serviceLineNumber, ?int $accountId = null): array
    {
        return $this->request(
            'get',
            "/service-lines/{$serviceLineNumber}",
            [],
            $accountId
        );
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


    public function dataUsage(array $payload, ?int $accountId = null): array
    {
        return $this->request('post', '/data-usage/query', $payload, $accountId);
    }
}
