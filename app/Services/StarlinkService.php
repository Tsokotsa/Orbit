<?php

namespace App\Services;

use App\Models\StarlinkToken;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class StarlinkService
{
    protected string $apiBase = 'https://starlink.com/api/public/v2';

    /**
     * Retrieve a valid token from DB
     */
    protected function getAccessToken(): string
    {
        $token = StarlinkToken::query()
            ->latest('expires_at')
            ->first();

        if (!$token) {
            Log::critical('Starlink token missing from database');
            throw new RuntimeException('Starlink token not available');
        }

        if ($token->expires_at->isPast()) {
            Log::critical('Starlink token expired and refresh job failed');
            throw new RuntimeException('Starlink token expired');
        }

        return $token->access_token;
    }

    /**
     * Generic API request handler
     */
    protected function request(
        string $method,
        string $endpoint,
        array $payload = []
    ): array {
        $url = $this->apiBase . $endpoint;

        $response = Http::withToken($this->getAccessToken())
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

    public function account(): array
    {
        return $this->request('get', '/account');
    }

    public function allSubscribers(): array
    {

        return $this->request('get', '/service-lines');

    }


    public function dataUsage(array $payload): array
    {
        return $this->request('post', '/data-usage/query', $payload);
    }
}
