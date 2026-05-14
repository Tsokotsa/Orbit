<?php

namespace App\Services;

use App\Models\PaymentGateway;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Exception;
use DB;

class PaymentGatewayService
{
    protected PaymentGateway $gateway;

    public function __construct(PaymentGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /*
    |--------------------------------------------------------------------------
    | TOKEN MANAGEMENT (HYBRID)
    |--------------------------------------------------------------------------
    */

    protected function ensureValidToken(): string
    {
        if (
            !$this->gateway->access_token ||
            !$this->gateway->token_expires_at
        ) {
            Log::warning('[RECARGAKI] No token found. Triggering auto-refresh.');
            $this->refreshToken();
        }

        // If expired, fallback refresh
        if ($this->gateway->token_expires_at->isPast()) {
            Log::warning('[RECARGAKI] Token expired before scheduler refresh. Auto-refresh triggered.');
            $this->refreshToken();
        }

        return $this->gateway->access_token;
    }

    // protected function refreshToken(): void
    // {
    //     if (!$this->gateway->refresh_token) {
    //         throw new Exception('No refresh token available. Run initial token command.');
    //     }

    //     $basicAuth = $this->gateway->basic_auth;

    //     $response = Http::withBasicAuth($basicAuth['user'], $basicAuth['pass'])
    //         ->timeout(15)
    //         ->retry(2, 200)
    //         ->withoutVerifying()
    //         ->withHeaders([
    //             'Content-Type' => 'application/json',
    //         ])
    //         // ->post($this->gateway->uri . 'a_a_c' . '/agent_auth_refresh', [
    //         ->post($this->gateway->uri . 'a_a_c', [
    //             'agent' => $this->gateway->agent ?? 'default agent',
    //             'refresh_token' => $this->gateway->refresh_token,
    //         ]);

    //     if ($response->failed()) {
    //         Log::critical('[RECARGAKI] Token refresh failed', [
    //             'status' => $response->status(),
    //             'body' => $response->body(),
    //         ]);

    //         throw new Exception('Payment gateway token refresh failed.');
    //     }

    //     $data = $response->json();

    //     $this->gateway->forceFill([
    //         'access_token' => $data['access_token'],
    //         'refresh_token' => $data['refresh_token'],
    //         'token_expires_at' => Carbon::now()->addMilliseconds($data['expires_in']),
    //     ])->save();

    //     $this->gateway->refresh();

    //     Log::info('[RECARGAKI] Token refreshed successfully.');
    // }

    /*
    |--------------------------------------------------------------------------



    | CORE API CALLER
    |--------------------------------------------------------------------------
    */


    public function refreshToken(): void
    {
        DB::transaction(function () {

            $gateway = PaymentGateway::where('id', $this->gateway->id)
                ->lockForUpdate()
                ->first();

            if ($gateway->token_expires_at && $gateway->token_expires_at->isFuture()) {
                $this->gateway = $gateway;
                return;
            }

            if (!$gateway->refresh_token) {
                throw new \Exception('No refresh token available.');
            }

            $basicAuth = $gateway->basic_auth;

            $response = Http::withBasicAuth($basicAuth['user'], $basicAuth['pass'])
                ->timeout(20)
                ->retry(3, 300)
                ->withoutVerifying() // This to remove on prod
                ->acceptJson()
                ->asJson()
                ->post(
                    rtrim($gateway->uri, '/') . '/a_a_c',
                    [
                        'agent' => $gateway->agent,
                        'refresh_token' => $gateway->refresh_token,
                    ]
                );

            if ($response->failed()) {
                throw new \Exception('Token refresh failed.');
            }

            $data = $response->json();

            $gateway->update([
                'access_token' => $data['access_token'],
                'refresh_token' => $data['refresh_token'],
                'token_expires_at' => now()->addMilliseconds((int) $data['expires_in']),
            ]);

            $this->gateway = $gateway;
        });
    }


    protected function callTestInv(array $payload)
    {
        $token = $this->ensureValidToken();

        $body = [
            'compid' => $this->gateway->compid,
            'prodid' => $this->gateway->prodid,
            'agent' => $this->gateway->agent,
            'access_token' => $token,
            //'clientref' => '3234',
        ];

        $basicAuth = $this->gateway->basic_auth;

        $response = Http::withBasicAuth($basicAuth['user'], $basicAuth['pass'])
            ->timeout(20)
            ->retry(2, 300)
            ->withoutVerifying()
            ->withHeaders([
                'Content-Type' => 'application/json',
            ])
            ->post(
                rtrim($this->gateway->uri, '/') . '/client_invoice_last_sales',
                $body
            );

        /*
        |--------------------------------------------------------------------------
        | If unauthorized, force one refresh and retry once
        |--------------------------------------------------------------------------
        */
        if ($response->status() === 401) {

            Log::warning('[RECARGAKI] API returned 401. Forcing token refresh.');

            $this->refreshToken();

            $body['access_token'] = $this->gateway->access_token;

            $basicAuth = $this->gateway->basic_auth;

            $basicAuth = $this->gateway->basic_auth;

            $response = Http::withBasicAuth($basicAuth['user'], $basicAuth['pass'])
                ->timeout(20)
                ->retry(2, 300)
                ->withoutVerifying()
                ->withHeaders([
                    'Content-Type' => 'application/json',
                ])
                ->post(
                    rtrim($this->gateway->uri, '/') . '/client_invoice_last_sales',
                    $body
                );

        }

        if ($response->failed()) {
            Log::error('[RECARGAKI] client_invoice_last_sales failed', [
                'status' => $response->status(),
                'body' => $response->body(),
                'payload' => $body,
            ]);

            throw new Exception('Payment gateway request failed.');
        }

        return $response->json();
    }

    /*
    |--------------------------------------------------------------------------
    | PUBLIC METHODS
    |--------------------------------------------------------------------------
    */

    // Get Account Invoice By Client ID
    public function getPaidInvoicesByClient(string $clientRef, int $limit = 5)
    {
        $clientRef = "3234";
        return $this->callTestInv([
            'clientref' => $clientRef,
            'limit' => $limit,
        ]);
    }
}
