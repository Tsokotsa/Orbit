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

    // public function handle(PrepaidBillingService $service): void
    // {
    //     $start = microtime(true);
    //     $period = now()->format('Y-m');

    //     try {

    //         Log::info('[PrepaidBillingJob] Started', [
    //             'period' => $period
    //         ]);

    //         // 1️⃣ Generate export
    //         $localFilePath = $service->exportForPeriod($period, 'prepaid');

    //         if (!file_exists($localFilePath)) {
    //             throw new \Exception("Exported file not found: {$localFilePath}");
    //         }

    //         $remoteFileName = basename($localFilePath);

    //         // 2️⃣ Upload to FTP
    //         $stream = fopen($localFilePath, 'r');

    //         if (!$stream) {
    //             throw new \Exception("Unable to open file for reading.");
    //         }

    //         $uploaded = Storage::disk('ftp_local')->put($remoteFileName, $stream);

    //         fclose($stream);

    //         if (!$uploaded) {
    //             throw new \Exception("FTP upload failed.");
    //         }

    //         $duration = round((microtime(true) - $start) * 1000, 2);

    //         Log::info('[PrepaidBillingJob] Completed successfully', [
    //             'file' => $remoteFileName,
    //             'duration_ms' => $duration
    //         ]);

    //     } catch (\Throwable $e) {

    //         $duration = round((microtime(true) - $start) * 1000, 2);

    //         Log::critical('[PrepaidBillingJob] Failed', [
    //             'period' => $period,
    //             'error' => $e->getMessage(),
    //             'duration_ms' => $duration
    //         ]);

    //         throw $e; // allows retry if queued
    //     }
    // }


    public function handle(PrepaidBillingService $service): void
    {
        $period = now()->format('Y-m');

        Log::info('[PrepaidBillingJob] Started', [
            'period' => $period,
            'job_id' => optional($this->job)->getJobId(),
        ]);

        try {

            // 1️⃣ Generate file (max 200 rows as you configured)
            $localFilePath = $service->exportForPeriod($period, 'prepaid');

            if (!file_exists($localFilePath)) {
                throw new \Exception("Exported file not found at path: {$localFilePath}");
            }

            $remoteFileName = basename($localFilePath);

            Log::info('[PrepaidBillingJob] Checking FTP connection...');

            $disk = Storage::disk('ftp_local');

            // 2️⃣ Explicit FTP connectivity check
            try {
                $disk->files(); // lightweight test call
            } catch (\Throwable $ftpConnectionException) {

                Log::error('[PrepaidBillingJob] FTP connection failed', [
                    'error' => $ftpConnectionException->getMessage(),
                ]);

                throw new \Exception('FTP connection failed: ' . $ftpConnectionException->getMessage());
            }

            Log::info('[PrepaidBillingJob] FTP connection OK');

            // 3️⃣ Upload file
            $stream = fopen($localFilePath, 'r');

            if (!$stream) {
                throw new \Exception("Failed to open file for reading: {$localFilePath}");
            }

            $uploaded = $disk->put($remoteFileName, $stream);

            fclose($stream);

            if (!$uploaded) {
                throw new \Exception("FTP upload returned false for file: {$remoteFileName}");
            }

            Log::info('[PrepaidBillingJob] FTP upload successful', [
                'file' => $remoteFileName,
                'period' => $period,
            ]);

        } catch (\Throwable $e) {

            Log::error('[PrepaidBillingJob] FAILED', [
                'period' => $period,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Let Laravel retry if configured
            throw $e;
        }
    }


}
