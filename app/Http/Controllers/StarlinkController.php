<?php

namespace App\Http\Controllers;

use App\Models\StarlinkAccount;
use App\Services\StarlinkService;
use Illuminate\Http\JsonResponse;
use Throwable;
use Log;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StarlinkController extends Controller
{
    protected StarlinkService $starlink;

    public function __construct(StarlinkService $starlink)
    {
        $this->starlink = $starlink;
    }



    public function account()
    {
        try {
            $account = $this->starlink->account();
            $subscribers = $this->starlink->allSubscribers();

            Log::info("Account Retrieved " . json_encode($account));

            return view('starlink.index', [
                'account' => $account,
                'subscribers' => $subscribers
            ]);

        } catch (Throwable $e) {
            report($e);

            return view('starlink.index', [
                'error' => 'Unable to fetch Starlink account',
            ]);
        }
    }

    public function subscribersDatatable(Request $request)
    {


        // try {
        //     $subscribers = $this->starlink->allSubscribers();

        //     return $subscribers;
        //     return DataTables::of($subscribers)->make(true);

        // } catch (\Throwable $e) {
        //     \Log::error('Subscribers DataTable failed', ['error' => $e->getMessage()]);
        //     return response()->json(['data' => []], 500);
        // }



        // try {
        //     $subscribers = $this->starlink->allSubscribers();

        //     return response()->json([
        //         'data' => $subscribers
        //     ]);
        // } catch (\Throwable $e) {
        //     \Log::error('Subscribers DataTable failed', ['error' => $e->getMessage()]);
        //     return response()->json(['data' => []], 500);
        // }
    }

    public function view_subscriber(Request $request)
    {
        $subscriber = $this->starlink->getServiceLine("SL-DF-9722641-79642-67");

        // Log::info(json_encode($subscriber));

        dd($subscriber);

    }

    public function deactivate_line(string $serviceLineNumber): JsonResponse
    {
        $serviceLineNumber = "SL-DF-9678649-75021-72";

        $starlink_acc = StarlinkAccount::where('id', 2)->first();  // IMPACT ACC

        try {
            // $response = $this->starlink->deactivateServiceLine($serviceLineNumber);
            $response = $this->starlink->deactivateServiceLine($serviceLineNumber, true, $starlink_acc->id);

            Log::info("Starlink Deactivation Response: " . json_encode($response));

            return response()->json([
                'success' => true,
                'message' => 'Service line deactivated successfully',
                'data' => $response,
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to deactivate service line',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function activate_line(string $serviceLineNumber): JsonResponse
    {
        $serviceLineNumber = "SL-DF-9678649-75021-72";

        $starlink_acc = StarlinkAccount::where('id', 2)->first();  // IMPACT ACC

        Log::info("This is the Account used " .$starlink_acc->id);

        try {
            // $response = $this->starlink->deactivateServiceLine($serviceLineNumber);
            $response = $this->starlink->resumeServiceLine($serviceLineNumber, $starlink_acc->id);

            Log::info("Starlink Activation Response: " . json_encode($response));

            return response()->json([
                'success' => true,
                'message' => 'Service Activated successfully',
                'data' => $response,
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to Activate service line',
                'error' => $e->getMessage(),
            ], 500);
        }

    }


}
