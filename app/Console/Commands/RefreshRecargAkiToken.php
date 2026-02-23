<?php

namespace App\Console\Commands;

use App\Models\PaymentGateway;
use App\Services\PaymentGatewayService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class RefreshRecargAkiToken extends Command
{
    protected $signature = 'app:refresh-recarg-aki-token';
    protected $description = 'Refresh RECARGAKI token using refresh_token';

    public function handle()
    {
        $start = microtime(true);

        Log::info('RECARGAKI scheduled token refresh started.');

        try {

            // Attempt to fetch the gateway
            $gateway = PaymentGateway::first();

            if (!$gateway) {
                $message = 'No PaymentGateway found for RECARGAKI token refresh.';
                Log::warning($message);
                $this->warn($message);
                return 1; // stop execution
            }

            Log::info('RECARGAKI gateway found for refresh.', [
                'gateway_id' => $gateway->id,
                'agent' => $gateway->agent,
            ]);

            $service = new PaymentGatewayService($gateway);

            // Wrap token refresh in its own try/catch for granular logging
            try {
                $service->refreshToken();
            } catch (\Throwable $refreshEx) {
                $duration = round((microtime(true) - $start) * 1000, 2);

                Log::error('RECARGAKI token refresh failed during service execution.', [
                    'gateway_id' => $gateway->id,
                    'error' => $refreshEx->getMessage(),
                    'duration_ms' => $duration,
                ]);

                $this->error("Token refresh failed: " . $refreshEx->getMessage());
                return 1;
            }

            $duration = round((microtime(true) - $start) * 1000, 2);

            Log::info('RECARGAKI token refreshed successfully.', [
                'gateway_id' => $gateway->id,
                'expires_at' => $gateway->fresh()->token_expires_at,
                'duration_ms' => $duration,
            ]);

            $this->info('Token refreshed successfully.');

            return 0;

        } catch (\Throwable $e) {
            $duration = round((microtime(true) - $start) * 1000, 2);

            Log::critical('RECARGAKI scheduled refresh failed.', [
                'error' => $e->getMessage(),
                'gateway_id' => $gateway->id ?? null,
                'duration_ms' => $duration,
            ]);

            $this->error('Critical error: ' . $e->getMessage());
            return 1;
        }
    }


}
