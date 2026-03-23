<?php

namespace App\Jobs;

use App\Services\Starlink\TelemetryProcessor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PollStarlinkTelemetryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 600; // 10 min per account
    public $tries = 1;

    public int $jobId;
    public int $accountId;

    public function __construct(int $jobId, int $accountId)
    {
        $this->jobId = $jobId;
        $this->accountId = $accountId;
    }

    public function handle()
    {
        Log::info("Polling Starlink telemetry for account {$this->accountId}, job {$this->jobId}");

        // Resolve processor inside handle to avoid serialization issues
        $processor = app(TelemetryProcessor::class);

        $count = $processor->pollAndProcess($this->accountId);

        // Update job tracker notes safely
        DB::table('starlink_telemetry_refresh')
            ->where('id', $this->jobId)
            ->increment('records_updated', $count);

        Log::info("Account {$this->accountId} updated $count records for job {$this->jobId}");

        // Optional: mark as done if no more pending jobs for this jobId
        $pending = DB::table('jobs')
            ->where('queue', 'default')
            ->whereRaw('JSON_EXTRACT(payload, "$.data.accountId") = ?', [$this->accountId])
            ->exists();

        if (!$pending) {
            DB::table('starlink_telemetry_refresh')
                ->where('id', $this->jobId)
                ->update([
                    'status' => 'done',
                    'notes' => 'Telemetry refresh completed',
                    'updated_at' => now(),
                ]);
        }
    }

    public function failed(\Throwable $exception)
    {
        Log::error("Starlink telemetry job failed: " . $exception->getMessage());

        DB::table('starlink_telemetry_refresh')
            ->where('id', $this->jobId)
            ->update([
                'status' => 'failed', // Make sure 'failed' is allowed in ENUM
                'notes' => $exception->getMessage(),
                'updated_at' => now(),
            ]);
    }
}