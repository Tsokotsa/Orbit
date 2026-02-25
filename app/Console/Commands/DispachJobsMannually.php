<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SyncStarlinkAccountsJob;

class DispachJobsMannually extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:dispach-jobs-mannually';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is used to Mannually dispatch jobs. Mostly for testing';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        dispatch(new SyncStarlinkAccountsJob);
        $this->info('Job dispatched successfully!');
    }
}
