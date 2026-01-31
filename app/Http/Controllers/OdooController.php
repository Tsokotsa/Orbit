<?php

namespace App\Http\Controllers;

use App\Services\OdooService;
use Illuminate\Http\Request;
use Log;

class OdooController extends Controller
{
    public function index(OdooService $odoo)
    {
        $user = auth()->user();
        $customers = $odoo->execute(
            'res.partner',
            'search_read',
            [
                [['customer_rank', '>', 0]]
            ],
            [
                //'fields' => [],
                'fields' => ['id', 'name', 'email', 'phone', 'company_type', 'create_date',],
                'limit' => 5,
            ]
        );
        Log::info($customers);
        return view('clients.index');
    }
    public function getClients(Request $request, OdooService $odoo)
    {
        // DataTables parameters
        $draw = (int) $request->input('draw');
        $start = (int) $request->input('start', 0);   // offset
        $length = (int) $request->input('length', 5);  // page size

        // 1️⃣ Get TOTAL number of customers (no limit!)
        $totalRecords = $odoo->execute(
            'res.partner',
            'search_count',
            [[['customer_rank', '>', 0]]]
        );

        // 2️⃣ Get ONLY current page records
        $customers = $odoo->execute(
            'res.partner',
            'search_read',
            [[['customer_rank', '>', 0]]],
            [
                'fields' => [
                    'id',
                    'name',
                    'email',
                    'phone',
                    'company_type',
                    'create_date',
                ],
                'limit' => 5,    # Later i will retrieve all records instead of limiting
                'offset' => $start,
            ]
        );

        // Optional debug
        Log::info('Odoo customers pagination', [
            'draw' => $draw,
            'start' => $start,
            'length' => $length,
            'total' => $totalRecords,
            'returned' => count($customers),
        ]);

        // 3️⃣ DataTables-compliant response
        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords, // same unless you add search
            'data' => $customers,
        ]);
    }

    //  public function viewClient(OdooService $odoo, Request $request)
    public function viewCLient()
    {
        $client = "";
        //   $client_id = $request->query('client_id'); // retrieves 6170

        // $client_query = $odoo->execute(
        //     'res.partner',
        //     'search_read',
        //     [
        //         [['id', '=', $client_id]],
        //     ],
        //     [
        //         'fields' => ['id', 'name', 'email', 'phone', 'company_type', 'create_date',],
        //         //'limit' => 5,
        //     ]
        // );
        // $client = $client_query[0];
        //    Log::info("Retrieving Client wih ID:  $client_id");
        return view('clients.view', compact('client'));
    }

    public function billing()
    {
        Log::info("Accessing the ===        BILLING     ===     Zone");
        return view("billing.index");
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
