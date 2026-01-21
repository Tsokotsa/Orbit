<?php

namespace App\Http\Controllers;

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

}
