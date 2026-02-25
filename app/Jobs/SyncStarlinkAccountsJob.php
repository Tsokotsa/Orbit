<?php

namespace App\Jobs;

use App\Models\StarlinkAccount;
use App\Models\StarlinkToken;
use App\Services\StarlinkService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class SyncStarlinkAccountsJob implements ShouldQueue
{
    public function handle(): void
    {
        Log::info('Starlink sync started');

        $tokens = StarlinkToken::all();

        foreach ($tokens as $token) {

            try {

                $service = new StarlinkService();

                $normalized = $service->fetchAccountData($token->account_id);

                if (!$normalized) {
                    continue;
                }

                $account = StarlinkAccount::where('id', $token->account_id)
                    ->where('active', 'y')
                    ->first();

                if (!$account) {
                    Log::warning('Starlink sync skipped - account not found or inactive', [
                        'account_id' => $token->account_id
                    ]);
                    continue;
                }

                $account->update([
                    'account_number' => $normalized['account_number'],
                    'account_name' => $normalized['account_name'],
                    'region_code' => $normalized['region_code'],
                    'is_valid' => $normalized['is_valid'],
                    'has_suspension' => $normalized['has_suspension'],
                    'suspension_payload' => $normalized['suspension_payload'],
                    'raw_payload' => $normalized['raw_payload'],
                    'last_synced_at' => now(),
                ]);

                Log::info('Starlink account synced', [
                    'account_number' => $normalized['account_number'],
                ]);

            } catch (\Throwable $e) {

                Log::error('Starlink sync failed', [
                    'account_id' => $token->account_id,
                    'error' => $e->getMessage(),
                ]);

                continue;
            }
        }

        Log::info('Starlink sync finished');
    }
}
