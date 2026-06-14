<?php

namespace App\Http\Controllers;

use App\Models\Rfo;
use App\Models\RfoTimeline;
use App\Models\RfoApproval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use Carbon\Carbon;
use Str;
use \Spatie\LaravelPdf\Facades\Pdf;

class RfoController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LIST PAGE
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $user = Auth()->user();
        $all_users = User::all();

        $rfos = Rfo::with('preparer:id,name,surname')->get();

        //dd($rfos->first()->timelines);

        //dd($rfos);

        return view('rfos.index')->with(['user' => $user, 'users' => $all_users, 'rfos' => $rfos]);
    }

    /*
    |--------------------------------------------------------------------------
    | DATATABLE AJAX
    |--------------------------------------------------------------------------
    */


    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {

        DB::beginTransaction();

        try {

            $isUpdate = $request->filled('rfo_id');

            $rfo = $isUpdate
                ? Rfo::findOrFail($request->rfo_id)
                : new Rfo();

            $duration = null;

            if ($request->filled('detection_time') && $request->filled('full_restore_time')) {
                $duration = now()->parse($request->detection_time)
                    ->diffInMinutes(now()->parse($request->full_restore_time));
            }

            $rfo->fill([

                'title' => $request->title,
                'prepared_by' => Auth::id(),
                'classification' => $request->classification,
                'document_version' => $request->document_version ?? '1.0',

                'incident_date' => $request->incident_date,
                'detection_time' => $request->detection_time,
                'partial_restore_time' => $request->partial_restore_time,
                'full_restore_time' => $request->full_restore_time,

                'total_duration_minutes' => $duration,

                'severity' => $request->severity,
                'affected_services' => json_decode($request->affected_services, true),
                // 'affected_services' => $request->affected_services,
                'affected_region' => json_decode($request->affected_pop, true),

                'root_cause' => $request->root_cause,
                'service_impact' => $request->service_impact,
                'partial_restoration_notes' => $request->partial_restoration_notes,
                'full_restoration_notes' => $request->full_restoration_notes,
                'data_integrity' => $request->data_integrity,
                'corrective_actions' => $request->corrective_actions,

                'apology_statement' => $request->apology_statement,
                'contact_name' => $request->contact_name,
                'contact_email' => $request->contact_email,
                'contact_phone' => $request->contact_phone,

            ]);

            $rfo->save();

            /*
            |--------------------------------------------------------------------------
            | TIMELINE (ONLY ON CREATE OR REPLACE IF YOU WANT)
            |--------------------------------------------------------------------------
            */

            if ($request->has('timeline_time')) {

                RfoTimeline::where('rfo_id', $rfo->id)->delete();

                foreach ($request->timeline_time as $key => $time) {

                    if (!$time)
                        continue;

                    RfoTimeline::create([
                        'rfo_id' => $rfo->id,
                        'timeline_time' => $time,
                        'timeline_action' => $request->timeline_action[$key]
                    ]);
                }
            }

            /*
            |--------------------------------------------------------------------------
            | APPROVER (ONLY CREATE IF NOT EXISTS)
            |--------------------------------------------------------------------------
            */

            RfoApproval::updateOrCreate(
                ['rfo_id' => $rfo->id],
                [
                    'approver_id' => $request->approver_id,
                    'status' => 'pending'
                ]
            );

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => $isUpdate ? 'RFO Updated' : 'RFO Created',
                'rfo_id' => $rfo->id,
                'rfo_number' => $rfo->rfo_number
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function edit(Rfo $rfo)
    {
        $rfo->load('timelines');

        return response()->json($rfo);
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(Rfo $rfo)
    {
        $rfo->load([
            'timelines',
            'approvals.approver',
            'preparer'
        ]);

        return response()->json($rfo);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, Rfo $rfo)
    {
        // return "OK";
        DB::beginTransaction();

        try {

            $duration = null;

            if (
                $request->filled('detection_time') &&
                $request->filled('full_restore_time')
            ) {
                $duration = Carbon::parse($request->detection_time)
                    ->diffInMinutes(Carbon::parse($request->full_restore_time));
            }

            // 🔴 MAIN UPDATE
            $rfo->update([

                'title' => $request->title,
                'classification' => $request->classification,
                'document_version' => $request->document_version,

                'incident_date' => $request->incident_date,
                'detection_time' => $request->detection_time,
                'partial_restore_time' => $request->partial_restore_time,
                'full_restore_time' => $request->full_restore_time,

                'total_duration_minutes' => $duration,

                'severity' => $request->severity,
                'affected_services' => json_decode($request->affected_services, true),
                'affected_region' => json_decode($request->affected_pop, true),

                'root_cause' => $request->root_cause,
                'service_impact' => $request->service_impact,
                'partial_restoration_notes' => $request->partial_restoration_notes,
                'full_restoration_notes' => $request->full_restoration_notes,

                'data_integrity' => $request->data_integrity,
                'corrective_actions' => $request->corrective_actions,

                'apology_statement' => $request->apology_statement,
                'contact_name' => $request->contact_name,
                'contact_email' => $request->contact_email,
                'contact_phone' => $request->contact_phone,
            ]);

            // 🔴 TOKEN + STATUS (MUST SAVE)
            if (!$request->filled('is_draft')) {

                $rfo->approval_token = Str::uuid();
                $rfo->approval_token_expires_at = now()->addDays(7);
                $rfo->status = 'pending_approval';
                $rfo->approval_status = 'submited';
                $rfo->save();
            }
            /*
            |--------------------------------------------------------------------------
            | TIMELINE (REPLACE OLD ON UPDATE)
            |--------------------------------------------------------------------------
            */

            if ($request->has('timeline_time')) {

                // 🔥 prevent duplicates
                // RfoTimeline::where('rfo_id', $rfo->id)->delete();

                foreach ($request->timeline_time as $key => $time) {

                    if (!$time)
                        continue;

                    RfoTimeline::create([
                        'rfo_id' => $rfo->id,
                        'timeline_time' => $time,
                        'timeline_action' => $request->timeline_action[$key] ?? null
                    ]);
                }
            }

            /*
            |--------------------------------------------------------------------------
            | APPROVER
            |--------------------------------------------------------------------------
            */

            RfoApproval::updateOrCreate(
                ['rfo_id' => $rfo->id],
                [
                    'approver_id' => $request->approver_id,
                    'status' => 'pending'
                ]
            );

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'RFO Updated'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy(Rfo $rfo)
    {
        $rfo->delete();

        return response()->json([

            'success' => true
        ]);
    }

    public function pdf($id)
    {
        $rfo = Rfo::with(['preparer', 'timelines'])
            ->findOrFail($id);

        $logo = base64_encode(
            file_get_contents(public_path('/assets/media/auth/paratus-login.png'))
        );

        return Pdf::view('pdf.templates.rfo', [
            'rfo' => $rfo,
        ])
            ->headerView('pdf.templates.header', [
                'rfo' => $rfo,
                'logo' => $logo,
            ])
            ->footerView('pdf.templates.footer', [
                'rfo' => $rfo,
            ])
            ->margins(
                top: 35,
                bottom: 10,
                left: 12,
                right: 12
            )
            ->name("RFO-{$rfo->rfo_number}.pdf");
    }


}