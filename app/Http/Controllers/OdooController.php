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
}
