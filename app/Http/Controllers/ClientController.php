<?php

namespace App\Http\Controllers;

use App\Services\OdooService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ActivityHelper;
use Spatie\Activitylog\Models\Activity;
use Log;
use App\Models\OdooPartner;
use App\Models\OdooInvoice;

class ClientController extends Controller
{

    // Class property
    protected OdooService $odooservice;
    protected $client_services_table;

    // Constructor to initialize it
    public function __construct(OdooService $odoo)
    {
        $this->client_services_table = "client_service_"; // example, could come from auth() or request
        $this->odooservice = $odoo;
    }

    public function view_cLient(Request $request)
    {
        $client_id = $request->query('client_id'); // retrieves 6170

        // $client = $this->odooservice->get_client_by_id($client_id);
        $client = OdooPartner::query()
            ->where('odoo_id', $client_id)
            ->first();

        Log::info("Retrieving Client wih ID:  $client_id");
        Log::info("This is the client found " . json_encode($client));

        return view('clients.view')->with(['client_id' => $client_id, 'client' => $client]);
    }

    public function get_all_assets()
    {
        $assets = DB::table("client_assets")->get();

        Log::info("Retrieved Many clients from DB $assets");

        return view('clients.tabs.assets', [
            'assets' => $assets
        ]);
    }

    public function list_all_services()
    {
        return view('clients.service-list');
    }

    public function load($tab, Request $request)
    {
        $client_id = $request->query('client_id');

        // Log::info("Got from Request $client_id");
        // return false;

        switch ($tab) {
            case 'overview':

                $client = $this->odooservice->get_client_by_id($client_id);

                Log::info("Retrieved Many clients from DB " . json_encode($client));
                Log::info("This is the cliet ID that was passed on the [ $tab ] TAB $client_id");

                return view('clients.tabs.overview')->with(['client_id' => $client_id, 'client' => $client]);

            case 'assets':
                $clientId = $request->query('client_id');

                $assets = DB::table('client_assets as c')
                    ->join('assets as a', 'c.asset_id', '=', 'a.id')
                    ->join('vendor as v', 'a.vendor_id', '=', 'v.id')
                    ->join('vendor_models as m', 'a.model', '=', 'm.id')
                    ->where('c.client_id', $clientId)
                    ->select(
                        'c.*',         // all columns from client_assets
                        'a.serial as asset_serial',
                        'a.asset_name as asset_name',
                        'a.created_at as created_at',
                        'v.name as vendor_name',
                        'm.name as model_name'
                    )->get();

                Log::info("Retrieved assets for client $clientId: " . $assets->count());

                return view('clients.tabs.assets', [
                    'assets' => $assets,
                    'cid' => $clientId
                ]);


            case 'services':

                $clientId = $request->query('client_id');

                Log::info("Retrieving all Services for client $clientId");

                // 1️⃣ Get distinct table_identifiers
                $serviceGroups = DB::table('services')
                    ->select('table_identifier')
                    ->distinct()
                    ->get();

                $clientServices = [];

                foreach ($serviceGroups as $group) {

                    $tableIdentifier = $group->table_identifier;
                    $table = $this->client_services_table . $tableIdentifier;

                    // 2️⃣ Get service IDs for this table_identifier
                    $serviceIds = DB::table('services')
                        ->where('table_identifier', $tableIdentifier)
                        ->pluck('id');

                    // 3️⃣ Count client services in the dynamic table
                    $count = DB::table($table)
                        ->where('client_id', $clientId)
                        ->whereIn('service_id', $serviceIds)
                        ->count();

                    if ($count > 0) {
                        // 4️⃣ Get display data (icon, speed, etc.)
                        $serviceMeta = DB::table('services')
                            ->where('table_identifier', $tableIdentifier)
                            ->first();

                        $clientServices[] = [
                            'service_name' => $tableIdentifier,
                            'icon' => $serviceMeta->icon,
                            'd_speed' => $serviceMeta->d_speed,
                            'count' => $count,
                        ];
                    }

                }

                Log::info("This is the cliet ID that was passed on the [ $tab ] TAB $clientId");
                return view('clients.tabs.services', [
                    'client_id' => $clientId,
                    'client_services' => $clientServices
                ]);

            case 'billing':
                $clientId = $request->query('client_id');
                $userId = auth()->id(); // currently logged-in user

                Log::info("This is the cliet ID that was passed on the [ $tab ] TAB $clientId");
                $invoices = OdooInvoice::where('partner_odoo_id', $clientId)
                    ->orderByDesc('invoice_date')
                    ->paginate(5);

                return view('clients.tabs.billing', [
                    'client_id' => $clientId,
                    'invoices' => $invoices
                ]);


            case 'logs':
                $clientId = $request->query('client_id');
                $userId = auth()->id(); // currently logged-in user

                Log::info("This is the cliet ID that was passed on the [ $tab ] TAB $clientId");
                $logs = Activity::where('causer_id', $userId)
                    ->whereJsonContains('properties->acc_id', $clientId)
                    ->latest()
                    ->get();

                Log::info($logs);


                return view('clients.tabs.logs', [
                    'client_id' => $clientId,
                    'activity' => $logs
                ]);

            case 'contacts':

                $clientId = $request->query('client_id');
                $userId = auth()->id(); // currently logged-in user

                $contacts = OdooPartner::query()
                    ->where('parent_odoo_id', $clientId)
                    ->get();

                //dd($contacts);
                Log::info("Retrieving Contacts for client $clientId: " . $contacts->count());

                return view('clients.tabs.contacts', [
                    'contacts' => $contacts,
                    'cid' => $clientId
                ]);

            case 'finance':

                $clientId = $request->query('client_id');
                $userId = auth()->id(); // currently logged-in user

                $partner = OdooPartner::where('odoo_id', $clientId)
                    ->first([
                        'invoice_ids',
                        'prim_invoices_ids',
                        'sale_order_ids',
                        'subscription_ids',
                        'opportunity_ids'
                    ]);

                $docs = [];

                foreach ($partner->invoice_ids ?? [] as $id) {
                    $docs[] = ['id' => $id, 'type' => 'Invoice'];
                }

                foreach ($partner->prim_invoices_ids ?? [] as $id) {
                    $docs[] = ['id' => $id, 'type' => 'Primary Invoice'];
                }

                foreach ($partner->sale_order_ids ?? [] as $id) {
                    $docs[] = ['id' => $id, 'type' => 'Sales Order'];
                }

                foreach ($partner->subscription_ids ?? [] as $id) {
                    $docs[] = ['id' => $id, 'type' => 'Subscription'];
                }

                foreach ($partner->opportunity_ids ?? [] as $id) {
                    $docs[] = ['id' => $id, 'type' => 'Opportunity'];
                }

                //dd($contacts);
                Log::info("Retrieving Finance Data for client $clientId: ");

                return view('clients.tabs.finance-data', [
                    'docs' => $docs,
                    'cid' => $clientId
                ]);

            default:
                return response()
                    ->view('clients.tabs.default', [], 404);
            //  return response('Invalid tab', 404);
        }
    }

    public function store_asset(Request $request)
    {
        // ✅ Insert into client_assets table
        DB::table('client_assets')->insert([
            'client_id' => $request->input('client_id'),
            'asset_id' => $request->input('asset_id'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Asset successfully assigned to client'
        ]);
    }
}