<?php

namespace App\Http\Controllers;


use App\Helpers\Tsokotsa\generalHelpers;
use App\Jobs\SendSmsJob;
use App\Models\Sms as SMS;
use Illuminate\Http\Request;
use Illuminate\Queue\Jobs\JobName;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use SoapClient;
use SoapFault;
use SoapParam;



class SmsController extends Controller
{
    protected $transmitter;
    private $campaign_type = "Sms";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function test()
    {
        // Get all routes
        $routes = collect(Route::getRoutes())->map(function ($route) {
            return [
                'uri' => $route->uri(),
                'name' => $route->getName(),
                'action' => $route->getActionName(),
                'methods' => $route->methods(),
            ];
        });

        // Pass the routes to the view
        return view('test', compact('routes'));
    }

    public function send_test(Request $request)
    {

        // SMPP server connection details
        $phone = $request['sms-test-number'];
        $msg = $request['sms-test-text'];
        $username = 'smsbrand_intersolut';
        $password = 'solni@24';
        $sender_id = 'NTT DATA';

        $wsdl = "http://10.229.42.145:8804/bulkapi?wsdl";

        // Options for the SOAP client
        $options = [
            'trace' => true, // Enable tracing to debug
            'exceptions' => true, // Throw exceptions on errors
            'CPCode'        => "INTSOLUTION",
            'User' => $username, // If required
            'Password' => $password, // If required
        ];

        try {
            // Create a SOAP client
            $client = new SoapClient($wsdl, $options);


            // Prepare request parameters
            $params = [
                'User'          => $username,
                'Password'      => $password,
                'ReceiverID'    => $phone,
                'ServiceID'     => $sender_id,
                'Content'       => $msg,
                'CPCode'        => "INTSOLUTION",
                'RequestID'     => 1,
                'UserID'        => $phone,
                'CommandCode'   => 'bulksms',
                'ContentType'   => 0
            ];

            // Call the SOAP method
            // $response = $client->__soapCall('yourSoapMethod', [$params]);
            Log::info("Request is running =====  ");
            $response = $client->__soapCall('wsCpMt', [$params]);
            Log::info("Request was made  and params are ===========" . json_encode($response));


            // Debugging - get the last request and response
            $lastRequest = $client->__getLastRequest();
            $lastResponse = $client->__getLastResponse();

            // Return the response or handle it
            return response()->json($response);
        } catch (SoapFault $e) {
            // Handle the error
            return response()->json(['error' => $e->getMessage()], 500);
        }

        // SendSmsJob::dispatch();
        return $response;
        // return response()->json(['message' => 'Nao falha nadaaaa'], 200);

    }

    public function getSubscribers()
    {

        $GH = new generalHelpers();
        $campaign_id = $GH->get_campaign_typeID($this->campaign_type);
        $subscribers = DB::table('contacts')
            ->orwhereJsonContains('notify_on', "$campaign_id")
            ->get();

        Log::info("Finished getting all subscribers for this campign id " . $campaign_id . " Using Function: " . __FUNCTION__);

        return $subscribers;
    }

    /**
     * Store a newly created resource in storage.
     */

    /**
     * Display the specified resource.
     */
    public function show(Sms $sms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sms $sms)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sms $sms)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sms $sms)
    {
        //
    }

    public function makeSoapRequest()
    {
        try {
            // SOAP client options
            $options = [
                'location' => 'http://10.229.42.144:8804/bulkapi?wsdl',  // Replace with your SOAP service location
                'uri' => 'http://10.229.42.144:8804/bulkapi?wsdl',     // Replace with your SOAP service namespace URI
                'soap_version' => SOAP_1_1,                   // or SOAP_1_2 depending on your version
                'trace' => 1,                                 // Enable tracing to get detailed error information
            ];

            // Initialize the SOAP client without a WSDL
            $client = new \SoapClient(null, $options);

            // Construct the SOAP envelope
            $xml = <<<XML
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:impl="http://impl.bulkSms.ws/">
   <soapenv:Header/>
   <soapenv:Body>
      <impl:wsCpMt>
         <User>smsbrand_intersolut</User>
         <Password>solni@24</Password>
         <CPCode> INTSOLUTION</CPCode>
         <RequestID>1</RequestID>
         <UserID>258861191191</UserID>
         <ReceiverID>258861191191</ReceiverID> 
         <ServiceID>NTT DATA</ServiceID>
         <CommandCode>bulksms</CommandCode>
         <Content>Test Message from my Application</Content>
         <ContentType>0</ContentType>
      </impl:wsCpMt>
   </soapenv:Body>
</soapenv:Envelope>
XML;

            // Make the SOAP request
            $response = $client->__doRequest($xml, 'http://example.com/service', '', SOAP_1_1);

            // Handle the response (parsing, error handling, etc.)
            return response()->json([
                'status' => 'success',
                'response' => $response,
            ]);
        } catch (\Exception $e) {
            // Handle any exceptions (like connection errors, SOAP faults, etc.)
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
