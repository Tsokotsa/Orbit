<?php

namespace App\Jobs;

use App\Services\PrepaidBillingService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ExportPrepaidBillingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(PrepaidBillingService $service): void
    {
        try {

            // 🔥 Current period YYYY-MM
            $period = Carbon::now()->format('Y-m');

            Log::info('[PrepaidBillingJob] Starting export', [
                'period' => $period
            ]);

            // 1️⃣ Generate + Export (returns full local path)
            $localFilePath = $service->exportForPeriod($period, 'prepaid');

            // 2️⃣ Remote FTP filename
            $remoteFileName = basename($localFilePath);

            // 3️⃣ Upload to FTP
            Storage::disk('ftp_local')->put(
                $remoteFileName,
                fopen($localFilePath, 'r')
            );

            Log::info('[PrepaidBillingJob] FTP upload successful', [
                'file' => $remoteFileName
            ]);

        } catch (\Throwable $e) {

            Log::error('[PrepaidBillingJob] Failed', [
                'error' => $e->getMessage()
            ]);

            throw $e; // allows retry if queue configured
        }
    }
}
