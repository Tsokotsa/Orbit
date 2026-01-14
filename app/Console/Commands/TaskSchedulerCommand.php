<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Console\Commands\SendSmsCommand;

class TaskSchedulerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task-scheduler-cmd';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(Schedule $schedule)
    {
        $tasks = DB::table('command_scheduler')
                ->where('enabled', '=', 'y')
                ->get();
        // Go through each task to dynamically set them up.

        Log::info("Running Scheduler and Found " .count($tasks) ." Active Tasks...");

        foreach ($tasks as $task) {
            if ($task->at) {
                $at = $task->at;
            } else {
                $at = '';
            }
            $frequency = $task->frequency;
            $day = $task->day_of_week;

            switch ($task->type) {
                case 'minute':
                //   Schedule::command(SendSmsCommand::class)->everyFifteenSeconds();
                
                    Schedule::job("'{$task->command_name}'")->$frequency();
                    // $event = Schedule::command("'{$task->command_name}'")->$frequency();
                    Log::debug("Event will run for job [ $task->command_name ] that should execute $frequency ");
                    break;

                case 'daily':
                    Schedule::command("'{$task->command_name}'")->dailyAt($at);
                    break;

                case 'weekly':
                    Schedule::command("'{$task->command_name}'")->weekly()->$day()->at($at);
                    break;

                case 'monthly':
                    $event = Schedule::command("'{$task->command_name}'")->monthlyOn($task->day_of_month, $at);
                    Log::debug("Event Expression is $event->expression and Next Run of Event is ");
                    break;
            }
       }
    }
}
