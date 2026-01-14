<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;

class SendTestTelegramJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    public $token;
    /**
     * Create a new job instance.
     */
    public function __construct($data, $token)
    {
        $this->data = $data;
        $this->token = $token;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $telegram = new Api($this->token);
        Log::info("Sending TEST Telegram Message to " .$this->data['to'] ." With content " .$this->data['msg']);
        $telegram->sendMessage([
            'chat_id' => $this->data['to'],
            'text' => $this->data['msg']
        ]);

        Log::info("<<<       Sending test message complete!       >>>>>");
    }
}
