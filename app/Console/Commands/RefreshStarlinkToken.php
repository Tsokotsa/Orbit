<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\StarlinkService;
use Log;
use App\Models\StarlinkToken;

class RefreshStarlinkToken extends Command
{
    protected $signature = 'starlink:refresh-token';
    protected $description = 'Refresh Starlink API token';

    // public function handle(StarlinkService $service)
    // {
    //     $service->account(); // triggers token generation if needed
    //     $this->info('Starlink token refreshed');
    // }

    public function handle()
    {
        $clientId = env('STARLINK_CLIENT_ID');
        $clientSecret = env('STARLINK_CLIENT_SECRET');

        $cmd = <<<CURL
curl -s -i -X POST https://starlink.com/api/auth/connect/token \
  -H "Content-Type: application/x-www-form-urlencoded" \
  -d "client_id={$clientId}" \
  -d "client_secret={$clientSecret}" \
  -d "grant_type=client_credentials"
CURL;

        Log::info("::::     Running Command Executed to refresh Starlink Token      ::::");

        $raw = shell_exec($cmd);

        // Split headers and body
        [$headers, $body] = explode("\r\n\r\n", $raw, 2);

        $data = json_decode($body, true);

        if (!isset($data['access_token'])) {
            $this->error('Token not found in response');
            logger()->error('Starlink token curl failed', [
                'raw' => $raw,
            ]);
            return Command::FAILURE;
        } else {
            StarlinkToken::updateOrCreate(
                ['id' => 1],
                [
                    'access_token' => $data['access_token'],
                    'expires_in' => $data['expires_in'],
                    'expires_at' => now()->addSeconds($data['expires_in']),
                    'raw_response' => $data,
                ]
            );
        }

        // 🔍 LOG for testing
        logger()->info('Starlink token generated via curl', [
            'expires_in' => $data['expires_in'],
            'token_type' => $data['token_type'],
        ]);



        $this->info('Token generated successfully (logged)');

        return Command::SUCCESS;


    }
}