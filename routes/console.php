<?php

use App\Jobs\CountMsgsJob;
use App\Jobs\QueueCampaignJob;
use App\Jobs\SyncOdooInvoicesJob;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;
use App\Jobs\PollStarlinkTelemetryJob;
use App\Services\StarlinkService;
use App\Jobs\SyncOdooPartnersJob;
use App\Jobs\ExportPrepaidBillingJob;

// Send SMS
// Schedule::command('send-sms-cmd')->everyFifteenSeconds(); // This Works

// Queue campaigns to be processed 
// Schedule::call(function () {
//     (new \App\Jobs\QueueCampaignJob)->handle();
// })->everyTenSeconds();

// Count All Processed SMS and send log to Dashboard Trends
// Schedule::job(new CountMsgsJob)->everyFifteenMinutes(); // This Works
// Schedule::job(new CountMsgsJob)->everyMinute(); // Use the above, this is for test

//Schedule::command('send-email-cmd')->everyFifteenSeconds(); // This Test

Schedule::command('starlink:refresh-token')->everyTenMinutes();

//Schedule::job(new PollStarlinkTelemetryJob)->everyThreeMinutes();

//Schedule::job(new SyncOdooPartnersJob)->everyFifteenMinutes();

//Schedule::job(new SyncOdooInvoicesJob)->everyMinute();

Schedule::job(new ExportPrepaidBillingJob)->everyMinute();

//Schedule::command('starlink:sync-devices')->everyTenMinutes();

// Schedule::command('task-scheduler-cmd')->everyMinute(); // This Test
