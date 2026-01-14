<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class OdooService
{
    protected string $url;
    protected string $db;
    protected string $username;
    protected string $apiKey;
    protected int $uid;

    public function __construct()
    {
        $this->url = rtrim(config('odoo.url'), '/');
        $this->db = config('odoo.db');
        $this->username = config('odoo.username');
        $this->apiKey = config('odoo.api_key');

        $this->uid = $this->authenticate();
    }

    /**
     * Base HTTP client (DEV only disables SSL)
     */
    protected function http()
    {
        return Http::withOptions([
            'verify' => app()->environment('local') ? false : true,
        ]);
    }

    /**
     * Authenticate user and get UID
     */
    protected function authenticate(): int
    {
        $response = $this->http()->post($this->url . '/jsonrpc', [
            'jsonrpc' => '2.0',
            'method'  => 'call',
            'params'  => [
                'service' => 'common',
                'method'  => 'authenticate',
                'args'    => [
                    $this->db,
                    $this->username,
                    $this->apiKey,
                    [],
                ],
            ],
            'id' => 1,
        ]);

        if (!$response->ok() || empty($response['result'])) {
            throw new Exception('Odoo authentication failed');
        }

        return (int) $response['result'];
    }

    /**
     * Execute Odoo model method
     */
    public function execute(
        string $model,
        string $method,
        array $domain = [],
        array $params = []
    ) {
        $response = $this->http()->post($this->url . '/jsonrpc', [
            'jsonrpc' => '2.0',
            'method'  => 'call',
            'params'  => [
                'service' => 'object',
                'method'  => 'execute_kw',
                'args'    => [
                    $this->db,
                    $this->uid,
                    $this->apiKey,
                    $model,
                    $method,
                    $domain,
                    $params,
                ],
            ],
            'id' => rand(1, 999999),
        ]);

        if (!$response->ok()) {
            throw new Exception('Odoo API call failed');
        }

        if (isset($response['error'])) {
            throw new Exception($response['error']['data']['message'] ?? 'Odoo error');
        }

        return $response['result'];
    }
}
