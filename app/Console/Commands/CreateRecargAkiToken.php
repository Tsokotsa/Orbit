<?php

namespace App\Console\Commands;

use App\Models\PaymentGateway;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class CreateRecargAkiToken extends Command
{
    protected $signature = 'app:create-recarg-aki-token';
    protected $description = 'Create initial RECARGAKI access token';

    public function handle()
    {
        $gateway = PaymentGateway::first();

        if (!$gateway) {
            $this->error("No payment gateway found.");
            return;
        }

        try {
            $basicAuth = $gateway->basic_auth;

            $body = [
                'agent' => $gateway->agent ?? 'default agent',
                'expiremillis' => 600000
            ];

            $response = Http::withBasicAuth($basicAuth['user'], $basicAuth['pass'])
                ->withHeaders(['Content-Type' => 'application/json'])
                ->withoutVerifying()
                ->post($gateway->uri . 'a_a_c', $body);

            $data = $response->json();

            if (!isset($data['access_token'], $data['refresh_token'])) {
                $this->error("No tokens returned.");
                Log::error("RECARGAKI initial token failed", ['response' => $data]);
                return;
            }

            $gateway->update([
                'access_token' => $data['access_token'],
                'refresh_token' => $data['refresh_token'],
                'token_expires_at' => Carbon::now()->addMilliseconds($data['expires_in'] ?? 600000),
            ]);

            $this->info("Initial access token created successfully.");
            Log::info("RECARGAKI initial token created", ['gateway' => $gateway->id]);
        } catch (\Exception $e) {
            $this->error("Exception: " . $e->getMessage());
            Log::error("RECARGAKI initial token exception", ['gateway' => $gateway->id, 'error' => $e->getMessage()]);
        }
    }
}
