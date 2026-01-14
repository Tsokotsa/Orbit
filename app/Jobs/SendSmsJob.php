<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $service;


    public function __construct()
    {

    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $phone = "258861191191";
        $msg = "olaaaa";
        //$host = ['10.229.42.144:8805', '10.229.42.145:8805'];
        $host = '10.229.42.144:8805';
        $port = 8805;
        $username = 'intersol';
        $password = 'snter#24';
        $sender_id = 'NTT DATA';
        $bind_type = 'transmitter';



      //  Log::info("Starting the SMS to host [ $host ] with bind type ===== $bind_type =====");
     //   echo("Starting the SMS to host [ $host ] with bind tyle ===== $bind_type =====");
        // $service = new Sender([$host], $username, $password, $bind_type);
        // $smsId = $service->send(258861191191, "Mais um teste", "NTT DATA");
        // $sender = new Sender('smpp_host', 'smpp_port', 'system_id', 'password', [
        //     'timeout' => 60, // Set a higher timeout
        //     'retries' => 5,  // Retry sending a few times
        // ]);
       // $sender->send(258861191191, "Mais um teste", "NTT DATA");
        Log::info("SMPP Connection end =======+++++++++++++++++++++++=================");
        echo("SMPP Connection end =======+++++++++++++++++++++++=================");
    }
    
}
