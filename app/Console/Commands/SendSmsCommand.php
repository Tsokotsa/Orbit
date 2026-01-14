<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use SoapClient;
use SoapFault;


class SendSmsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-sms-cmd';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send scheduled SMS messages';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Options for the SMS service to trace and show errors
        $options = [
            'trace' => true, // Enable tracing to debug
            'exceptions' => true, // Throw exceptions on errors
            'CPCode'        => "INTSOLUTION",
            'User' => 'smsbrand_intersolut', // If required
            'Password' => 'solni@24', // If required
        ];

        $providers   = DB::table("providers")->where('short_name', 'mvtl')->where('status', 'Active')->get();

        foreach ($providers as $provider) {
            $wsdl = $provider->url;
            Log::info("Setting Params variable array ");
            $params = [
                'username'      => $provider->login,
                'password'      => $provider->password,
                'from'          => $provider->sender,
            ];
        }

        Log::info("Starting the ======          Send SMS        ========= script ");
        $messages = DB::table("msgs_queue")
            ->where('queue_type', 2)
            ->Where('status', 'Queued')
            ->get();
        if ($messages->isEmpty()) {
            Log::info("========     No messages found for processing going Idle.    =========");
        } else {
            Log::info("Found " . count($messages) . " messages to process ");
            $counter = 0;
            foreach ($messages as $msg) {
                $counter++;
                
                Log::info("Sending message to $msg->recipient | SMS #: {$counter}");

                $params['to']           = $msg->recipient;
                $params['content']      = $msg->content;
                // $params['UserID']       = $msg->recipient;

                // Send the sms
                try {

                    Log::info("Initiating SOAP call Using server $provider->host");

                    // Call SOAP method
                    $client = new SoapClient($wsdl, $options);
                    $response = $client->__soapCall('sendSMS', [$params]);

                    // Convert response to array
                    $responseData = json_decode(json_encode($response), true);

                    Log::info("The response is - " . json_encode($responseData));

                    if (isset($responseData['response']['desc']) && $responseData['response']['desc'] === 'Success') {
                        Log::alert("Message was successful! sent to: $msg->recipient ");
                        Log::info("Mark message with ID $msg->id as processed. Updating Db ......");
                        DB::table('msgs_queue')->where('id', $msg->id)
                            ->update([
                                'status' => 'Processed',
                                'response' => json_encode($response)
                            ]);
                    } else {
                        Log::error("Message Could Not be sent to $msg->recipient !");
                        DB::table('msgs_queue')->where('id', $msg->id)
                            ->update([
                                'status' => 'Error',
                                'response' => json_encode($response)
                            ]);
                    }
                } catch (SoapFault $e) {
                    // This only runs if an exception (SOAP fault) occurs
                    Log::error("SOAP Fault: " . $e->getMessage());
                }
            }
        }
    }
}
