<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;
use Log;

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
            'method' => 'call',
            'params' => [
                'service' => 'common',
                'method' => 'authenticate',
                'args' => [
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
            'method' => 'call',
            'params' => [
                'service' => 'object',
                'method' => 'execute_kw',
                'args' => [
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

    public function get_client_by_id($client_id)
    {

        $query = $this->execute(
            'res.partner',
            'search_read',
            [
                [['id', '=', $client_id]],
            ],
            [
                'fields' => ['id', 'name', 'email', 'phone', 'company_type', 'create_date',],
                //'limit' => 5,
            ]
        );

        return $query[0];

    }

    // public function searchRead(string $model, array $domain = [], array $fields = [], int $limit = 100)
    // {
    //     return $this->execute(
    //         $model,
    //         'search_read',
    //         [$domain],
    //         [
    //             'fields' => $fields,
    //             'limit' => $limit,
    //         ]
    //     );
    // }

    public function searchRead(
        string $model,
        array $domain = [],
        array $fields = [],
        int $limit = 100,
        int $offset = 0,
        ?string $order = null
    ) {
        $kwargs = [
            'fields' => $fields,
            'limit' => $limit,
            'offset' => $offset,
        ];

        if ($order) {
            $kwargs['order'] = $order;
        }

        return $this->execute(
            $model,
            'search_read',
            [$domain],
            $kwargs
        );
    }



    public function getBillingContracts(array $filters = [])
    {
        try {
            Log::info('Odoo: Fetching billing contracts', [
                'filters' => $filters
            ]);

            $result = $this->execute(
                'billing.contract',
                'search_read',
                [$filters],
                [
                    'fields' => [
                        'name',
                        'partner_id',
                        'billing_method',
                        'billing_cycle_period',
                        'start_date',
                        'next_billing_date',
                        'amount_total_bill',
                        'user',
                        'state',
                        'create_uid',
                    ],
                ]
            );

            Log::info('Odoo: Billing contracts fetched', [
                'count' => count($result)
            ]);

            return $result;

        } catch (\Throwable $e) {
            Log::error('Odoo: Failed to fetch billing contracts', [
                'error' => $e->getMessage()
            ]);

            throw $e;
        }
    }

    /**
     * Get billing contracts by client (partner) ID
     */
    public function getBillingByClientID(int $clientId, int $limit = null)
    {
        try {
            Log::info('Odoo: Fetching billing contracts by client', [
                'client_id' => $clientId,
                'limit' => $limit,
            ]);

            $params = [
                'fields' => [
                    'name',
                    'partner_id',
                    'billing_method',
                    'billing_cycle_period',
                    'start_date',
                    'next_billing_date',
                    'amount_total_bill',
                    'user',
                    'state',
                    'create_uid',
                ],
                'order' => 'create_date desc',
            ];

            if ($limit !== null) {
                $params['limit'] = $limit;
            }

            return $this->execute(
                'billing.contract',
                'search_read',
                [
                    [
                        ['partner_id', 'child_of', $clientId],
                    ]
                ],
                $params
            );

        } catch (\Throwable $e) {
            Log::error('Odoo: Failed to fetch billing by client ID', [
                'client_id' => $clientId,
                'error' => $e->getMessage(),
            ]);

            throw $e;
        }
    }


    public function getAllModels(): array
    {
        // Search all models
        $domain = []; // empty domain = all
        $params = [
            'fields' => ['model', 'name'], // model technical name + human readable name
            'limit' => 0,                  // 0 = no limit
            'order' => 'name asc'
        ];

        return $this->execute('ir.model', 'search_read', $domain, $params);
    }

    /**
     * Retrieve all quotes (draft or sent)
     */
    public function getQuotes()
    {
        return $this->searchRead(
            'sale.order',
            [['state', 'in', ['draft', 'sent']]],
            ['name', 'partner_id', 'amount_total', 'date_order', 'state'],
            100
        );
    }


    /**
     * Get the last N billings for a specific customer
     */
    public function getLastBillings(int $partnerId, int $limit = 3)
    {
        return $this->searchRead(
            'billing.contract',
            [
                ['partner_id', '=', $partnerId],
                ['state', 'in', ['open', 'done']], // adjust if needed
            ],
            ['name', 'amount_total_bill', 'next_billing_date', 'billing_cycle_period', 'state'],
            $limit
        );
    }


    /**
     * Retrieve last N invoices for a specific customer
     */
    public function getLastInvoices(int $partnerId, int $limit = 3)
    {
        return $this->searchRead(
            'account.move',
            [
                ['partner_id', '=', $partnerId],
                ['move_type', '=', 'out_invoice']
            ],
            ['name', 'amount_total', 'invoice_date', 'state'],
            $limit
        );
    }

}
