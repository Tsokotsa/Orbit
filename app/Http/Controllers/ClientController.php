<?php

namespace App\Http\Controllers;

use App\Services\OdooService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Tsokotsa\ActivityHelper;
use Spatie\Activitylog\Models\Activity;
use Log;
use App\Models\OdooPartner;
use App\Models\OdooInvoice;
use App\Helpers\Tsokotsa\generalHelpers;
use App\Http\Controllers\ServiceController;



class ClientController extends Controller
{
    protected string $client_services_table;

    public function __construct(protected ActivityHelper $log)
    {
        $this->client_services_table = "client_service_";
    }

    public function view_cLient(Request $request)
    {
        $user = auth()->user();
        $client_id = $request->query('client_id'); // retrieves 6170

        $client = OdooPartner::query()
            ->where('odoo_id', $client_id)
            ->first();

        $log = new ActivityHelper;

        Log::info("Retrieving Client wih ID:  $client_id");
        //Log::info("This is the client found " . json_encode($client));

        $this->log->logActivity("Client Accessed by User " . $user->id, $client_id);


        return view(view: 'clients.view')->with(['client_id' => $client_id, 'client' => $client, 'user' => $user]);
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

                $client = OdooPartner::query()
                    ->where('odoo_id', $client_id)
                    ->first();

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
                    ->orderByDesc('invoice_date')->get();

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

        $asset_id = $request->asset_id;
        $client_id = $request->client_id;

        // ✅ Insert into client_assets table
        DB::table('client_assets')->insert([
            'client_id' => $client_id,
            'asset_id' => $asset_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Log::info("Inserting asset into client_assets table", [
            'client_id' => $request->input('client_id'),
            'asset_id' => $request->input('asset_id')
        ]);

        // Log Activity

        $this->log->logActivity("Linked asset $asset_id to client ", $client_id);

        return response()->json([
            'status' => 'success',
            'message' => 'Asset successfully assigned to client'
        ]);
    }

    public function add_service(Request $request)
    {
        $client = $request->client_id;
        $userId = auth()->id(); // currently logged-in user
        $package_id = $request->service_id;
        $GH = new generalHelpers();
        $package = $GH->get_packages_by_id($package_id);

        Log::info("You Hit The Function " . __FUNCTION__ . " That will add Services to client $client with package [ ID :::: $package_id  ::: ]");

        $table = "client_service_{$package->table_identifier}";
        try {

            Log::info('Inserting Service to DB', [
                'service_id' => $package->id,
                'client_id' => $client,
                'table' => $table
            ]);

            DB::table($table)->insert([
                'service_id' => $package->id,
                'client_id' => $client,
                'created_at' => now(),
            ]);

            $this->log->logActivity("Package {$package->id} linked to account", $client);

            return response()->json([
                'success' => true,
                'message' => 'Service Inserted'
            ], 200);

        } catch (\Throwable $e) {

            Log::error('Error inserting service to DB', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to insert package'
            ], 500);
        }

    }

    public function view_service(Request $request)
    {
        $srv = new ServiceController;

        $service = $srv->get_service_by_sid($request->servicetable, $request->service_id);

        Log::info("The variable Request has: " . json_encode($service));

        return view('clients.services.modals.partials.view-service-fiber')->with(['service' => $service]);
    }
}