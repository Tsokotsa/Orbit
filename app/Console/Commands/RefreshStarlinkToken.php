<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\StarlinkService;
use App\Models\StarlinkAccount;
use Log;
use App\Models\StarlinkToken;

class RefreshStarlinkToken extends Command
{
    protected $signature = 'starlink:refresh-token';
    protected $description = 'Refresh Starlink API token';
    public function handle()
    {
        $accounts = StarlinkAccount::all();

        foreach ($accounts as $account) {

       Log::info("Refreshing Token For $account->name");     
            $cmd = <<<CURL
curl -s -i -X POST https://starlink.com/api/auth/connect/token \
    -H "Content-Type: application/x-www-form-urlencoded" \
    -d "client_id={$account->client_id}" \
    -d "client_secret={$account->client_secret}" \
    -d "grant_type=client_credentials"
CURL;

            $raw = shell_exec($cmd);
            [$headers, $body] = explode("\r\n\r\n", $raw, 2);
            $data = json_decode($body, true);

            if (isset($data['access_token'])) {
                StarlinkToken::updateOrCreate(
                    ['account_id' => $account->id],
                    [
                        'access_token' => $data['access_token'],
                        'expires_in' => $data['expires_in'],
                        'expires_at' => now()->addSeconds($data['expires_in']),
                        'raw_response' => $data,
                    ]
                );
            }
        }

    }
}