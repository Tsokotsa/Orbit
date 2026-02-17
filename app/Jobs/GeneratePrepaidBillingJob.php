<?php

// app/Jobs/GeneratePrepaidBillingJob.php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Services\PrepaidBillingService;
use App\Models\PPBillingService;

class GeneratePrepaidBillingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $start = microtime(true);
        $period = now()->format('Y-m');

        Log::info('[PrepaidBilling] Job started', [
            'period' => $period,
        ]);

        $billingService = app(PrepaidBillingService::class);

        // 1️⃣ Ensure billing ledger is up to date
        $billingService->generateForPeriod($period);

        // 2️⃣ Fetch what WOULD be exported
        $rows = PPBillingService::where('billing_period', $period)
            ->where('payment_status', 'pending')
            ->get();

        Log::info('[PrepaidBilling] Export preview', [
            'rows' => $rows->count(),
        ]);

        foreach ($rows as $row) {
            Log::info('[PrepaidBilling] Export row', [
                'client_id' => $row->client_id,
                'service_id' => $row->service_id,
                'amount' => $row->amount,
                'currency' => $row->currency,
                'billing_period' => $row->billing_period,
            ]);
        }

        Log::info('[PrepaidBilling] Job finished', [
            'duration_ms' => round((microtime(true) - $start) * 1000),
        ]);
    }
}
