<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentGateway;
use App\Services\PaymentGatewayService;
use Log;
use Exception;

class RecargakiController extends Controller
{
    /**
     * Get paid invoices for specific client
     */
    public function paidInvoicesByClient(string $clientRef)
    {
        try {

            $clientRef = "3234";
            $gateway = PaymentGateway::firstOrFail();

            $service = new PaymentGatewayService($gateway);

            $response = $service->getPaidInvoicesByClient($clientRef, 5);

            return response()->json($response);

        } catch (Exception $e) {

            Log::error('[RECARGAKI CLIENT INVOICES] Failed', [
                'clientRef' => $clientRef,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
