<?php

namespace App\Http\Controllers;

use App\Services\OdooService;
use Illuminate\Http\Request;
use Log;
use Yajra\DataTables\DataTables;
use App\Models\OdooPartner;

class OdooController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        Log::info("Retrieving Clients :::       LOCAL DB     ::::");
        return view('clients.index')->with(['user' => $user]);

    }
    public function getClients(Request $request)
    {
        try {
            $clients = OdooPartner::query();
            $total = $clients->count();

            Log::info("Found {$total} clients in the DB");

            return DataTables::of($clients)->make(true);

        } catch (\Exception $e) {
            return response()->json([
                'draw' => (int) $request->input('draw'),
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => [],
                'error' => $e->getMessage(),
            ]);
        }
    }

    //  public function viewClient(OdooService $odoo, Request $request)
    // public function viewCLient()
    // {
    //     $client = "";
    //     return view('clients.view', compact('client'));
    // }

    public function billing()
    {
        $user = auth()->user();
        Log::info("Accessing the ===        BILLING     ===     Zone");
        return view("billing.index")->with(['user' => $user]);
    }


    public function get_all_ajax(Request $request, OdooService $odoo)
    {
        try {
            Log::info('BillingContractController@index called', [
                'ip' => $request->ip()
            ]);

            $contracts = $odoo->getBillingContracts();

            $data = collect($contracts)->map(function ($c) {
                return [
                    'name' => $c['name'] ?? null,

                    // Odoo many2one fields: [id, name]
                    'account_name' => $c['partner_id'][1] ?? null,
                    'account_id' => $c['partner_id'][0] ?? null,

                    'billing_method' => $c['billing_method'] ?? null,
                    'billing_cycle_period' => $c['billing_cycle_period'] ?? null,
                    'start_date' => $c['start_date'] ?? null,
                    'next_billing_date' => $c['next_billing_date'] ?? null,
                    'amount_total_bill' => $c['amount_total_bill'] ?? 0,

                    'username' => $c['user'][1] ?? null,
                    'user_id' => $c['user'][0] ?? null,

                    'state' => $c['state'] ?? null,

                    'created_by' => $c['create_uid'][1] ?? null,
                ];
            });

            return response()->json([
                'data' => $data
            ]);

        } catch (\Throwable $e) {
            Log::error('BillingContractController@index failed', [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'message' => 'Failed to load billing contracts'
            ], 500);
        }
    }

    // Test quotes retrieval
    public function quotes(OdooService $odoo)
    {
        $quotes = $odoo->getQuotes();
        dd($quotes); // dump & die for testing
    }

    // Test last 3 invoices for a specific customer
    public function lastInvoices(Request $request, OdooService $odoo)
    {
        $request->validate([
            'partner_id' => 'required|integer',
        ]);

        $invoices = $odoo->getLastInvoices($request->partner_id, 3);
        dd($invoices); // dump & die for testing
    }

    // Test last 3 billings for a specific customer
    public function lastBillings(Request $request, OdooService $odoo)
    {
        $request->validate([
            'partner_id' => 'required|integer',
        ]);

        $billings = $odoo->getLastBillings($request->partner_id, 3);
        dd($billings); // dump & die for testing
    }

    public function billingByClient(Request $request, OdooService $odoo)
    {
        $request->validate([
            'client_id' => 'required|integer',
        ]);

        $billings = $odoo->getBillingByClientID(
            $request->client_id,
            3 // last 3 billings
        );

        dd($billings);
    }




    public function logAllModels()
    {
        try {
            $odoo = new OdooService();

            // Retrieve all models
            $models = $odoo->getAllModels();

            Log::info("Retrieved " . count($models) . " Odoo models.");

            foreach ($models as $model) {
                Log::info('Odoo Model: ' . $model['model'] . ' - ' . $model['name']);
            }

            return response()->json([
                'success' => true,
                'message' => 'Odoo models logged successfully',
                'count' => count($models)
            ]);

        } catch (\Exception $e) {
            Log::error('Odoo models retrieval error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
