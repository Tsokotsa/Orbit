<?php

namespace App\Http\Controllers;

use App\Services\CalixService;
use Illuminate\Http\Request;
use Http;
use DB;
use Log;
use Yajra\DataTables\DataTables;
use function PHPUnit\Framework\returnArgument;

class CalixController extends Controller
{
    protected CalixService $calix;

    public function __construct(CalixService $calix)
    {
        $this->calix = $calix;
    }

    /**
     * Show GUI variables
     */
    public function index()
    {
        $calix_settings = DB::table(table: "calix_settings")->get();
        $query = $calix_settings[0]->region;

        Log::info("$calix_settings");
        $endpoint = "/rest/v1/config/device/gui/{$query}";

        $endpoint2 = "/rest/v1/config/globalont/unassigned-ont";
        $query2_variable = "unassigned-ont";

        $settings = json_decode($calix_settings[0]->settings, true);

        $offset = $settings['offset']; // 0
        $limit = $settings['limit'];  // 20


        Log::info("Settings for the [CALIX] are ::: Offset $offset and Limit $limit ");

        $variables = $this->calix->exec_query($endpoint, $query, $offset, $limit);
        $unassigned = $this->calix->exec_query($endpoint2, $query2_variable, $offset, $limit);

        return view(view: 'calix.dashboard')->with(["variables" => $variables, "unassigned" => $unassigned]);

    }

    public function list_subscribers()
    {
        return view(view: 'calix.subscribers');

    }

    public function get_all_subscribers()
    {
        $calix_settings = DB::table(table: "calix_settings")->get();
        Log::info("$calix_settings");

        $allSubscribers = $this->calix->getSubscribers(); // fetch all in prod

        return DataTables::of($allSubscribers)
            ->addColumn('name', function ($subscriber) {
                return $subscriber['name'] ?? '-';
            })
            ->addColumn('street', function ($subscriber) {
                return $subscriber['locations'][0]['address'][0]['streetLine1'] ?? '-';
            })
            ->addColumn('phone', function ($subscriber) {
                return $subscriber['locations'][0]['contacts'][0]['phone'] ?? '-';
            })
            ->addColumn('email', function ($subscriber) {
                return $subscriber['locations'][0]['contacts'][0]['email'] ?? '-';
            })
            ->addColumn('actions', function ($subscriber) {
                return '<a href="/edit/' . $subscriber['customId'] . '" class="btn btn-sm btn-primary me-1">Edit</a>';
            })
            ->rawColumns(['actions'])
            ->make(true);

        return DataTables::of($allSubscribers)
            ->addColumn('actions', function ($subscriber) {
                return '<a href="/edit/' . $subscriber['customId'] . '" class="btn btn-sm btn-primary me-1">Edit</a>
                        <a href="/delete/' . $subscriber['customId'] . '" class="btn btn-sm btn-danger">Delete</a>';
            })
            ->rawColumns(['actions']) // important to render HTML
            ->make(true);

        $settings = json_decode($calix_settings[0]->settings, true);

        $offset = $settings['offset']; // 0
        $limit = $settings['limit'];  // 20
        $subscribers = $this->calix->getSubscribers();

        // Log::info("Connection made and returned subscribers: $subscribers");

        //return view(view: 'calix.subscribers')->with(["subscribers" => $subscribers]);


    }

    public function view_subscriber(string $customId)
    {
        $calix_settings = DB::table(table: "calix_settings")->get();
        $query = $calix_settings[0]->region;

        $cid = $customId;

        Log::info("Trying to get subscribers for $cid");

        $subscriber = $this->calix->getSubscriberByCustomId($cid);

        // if (empty($subscriber)) {
        //     return response()->view(
        //         'calix.subscribers.partials.not-found',
        //         [],
        //         404
        //     );
        // }

        Log::info("Returned Subscriber:" .json_encode($subscriber));

        return view('calix.modals.partials.subscriber-partial-modal', compact('subscriber'));
    }


}
