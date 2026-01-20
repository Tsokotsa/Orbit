<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Log;

class CalixService
{
    protected string $host;
    protected string $user;
    protected string $password;

    public function __construct()
    {
        // $this->host = config('services.calix.host', env('CALIX_HOST'));
        // $this->user = config('services.calix.user', env('CALIX_USER'));
        // $this->password = config('services.calix.password', env('CALIX_PASSWORD'));


        $this->host = "https://160.242.32.139:18443";
        $this->user = "stimane";
        $this->password = "Meusamores.1103";
    }

    /**
     * Make GET request with optional query parameters
     */
    public function get(string $endpoint, array $params = [])
    {
        $url = $this->host . $endpoint;

        return Http::withBasicAuth($this->user, $this->password)
            ->accept('application/json')
            ->beforeSending(function ($request) {
                Log::debug('Calix final URL', [
                    'url' => (string) $request->url(),
                ]);
            })
            ->withOptions(['verify' => false, 'timeout' => 30])
            ->get($this->host . $endpoint, $params)
            ->throw()
            ->json();
    }

    /**
     * Fetch GUI variables (with offset/limit)
     */
    public function exec_query($endpoint, $query, int $offset, int $limit)
    {

        $params = [
            'offset' => $offset,
            'limit' => $limit,
        ];

        return $this->get($endpoint, $params);
    }

    // app/Services/CalixService.php

    public function getSubscribers(int $limit = 5, int $offset = 0)
    {
        $endpoint = '/rest/v1/ems/subscriber';
        $params = [
            'limit' => $limit,
            'offset' => $offset,
        ];

        return $this->get($endpoint, $params);
    }

    public function getSubscriberById(string $customId)
    {
        $endpoint = "/rest/v1/ems/subscriber/{$customId}";

        return $this->get($endpoint);
    }

    public function getSubscriberByCustomId(string $customId): array
    {
        $endpoint = '/rest/v1/ems/view/subscriber';

        $params = [
            // ⚠️ Calix field name is case-sensitive
            //'filter' => "customId={$customId}",
            'filter' => "customId=ITC",
        ];

        // 🔍 Log request details
        Log::info('Calix getSubscriberByCustomId request', [
            'endpoint' => $endpoint,
            'params' => $params,
        ]);

        try {
            $response = $this->get($endpoint, $params);

            // 🔍 Log raw response (truncate if large)
            Log::info('Calix response received', [
                'has_items' => isset($response['items']),
                'items_count' => isset($response['items']) ? count($response['items']) : 0,
            ]);

            return $response;

        } catch (\Throwable $e) {


            Log::error('Calix API error', [
                'endpoint' => $endpoint,
                'params' => $params,
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ]);

            throw $e; // rethrow so controller still fails properly
        }

    }
}

