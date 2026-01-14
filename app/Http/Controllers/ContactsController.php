<?php

namespace App\Http\Controllers;

use App\Helpers\Tsokotsa\generalHelpers;
use App\Imports\ContactsImport;
use Illuminate\Http\Request;
use App\Models\Contacts;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $GH = new generalHelpers();

        $sites = $GH->get_all_high_sites();
        $campaigns = $GH->get_all_Active_Campaigns();
        $contacts = Contacts::all();

        return view('contacts.index', ['user' => $user, 'sites' => $sites, 'campaigns' => $campaigns, 'contacts' => $contacts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add(Request $request)
    {
        $contact = new Contacts;

        $contact->name = $request->name;
        $contact->surname = $request->surname;
        $contact->address = $request->address;
        $contact->email = $request->email;
        $contact->enable_notification = $request->enable_notification;
        $contact->cell1 = $request->cell1;
        $contact->cell2 = $request->cell2;
        $contact->telegram_id = $request->telegram_id;
        $contact->linked_locations = json_encode($request->input('linked_location', []));
        $contact->notify_on = json_encode($request->input('notify_on', []));



        $contact->save();
    }

    /**
     * Store a newly created resource in storage.
     */

    public function addbulk()
    {
        $user = auth()->user();
        return view('contacts.add-bulk', ['user' => $user]);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        Log::info("+++++++++        Importing Contacts from CSV     +++++++++++");

        try {
            $import = Excel::import(new ContactsImport, $request->file('file'));
            //Store the uploaded file
            Log::info("Storing The file uploaded");
            //    $bundle_file = $request->file('bundle_file')->store('bulk-contacts/uploads', 'public');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            foreach ($failures as $failure) {
                // echo 'Row ' . $failure->row() . ' failed with error ' . implode(', ', $failure->errors()) . "\n";
                Log::info("Some Error Occurred During Import [ Row: " . $failure->row() . " ] | Atribute: " . $failure->attribute() . " | Errors: " . json_encode($failure->errors()) . " | Values: " . json_encode($failure->values()));
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function downloadTemplate()
    {
        $file = "bulk-contacts-template.csv";
        Log::debug("Starting Download Demo contacts template [ $file ] for USER");

        $path = "public/bulk-contacts";
        Log::info("Teplate will be downloaded from from $path");

        $full_path = "$path/$file";
        return Storage::download($full_path, 'template.csv');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function getAll(Request $request)
    {
        $query = $request->input('query');

        // Fetch users that match the query
        $contacts = Contacts::where('name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->get(['id', 'name', 'surname', 'email']);

        // Format the users for Tagify
        $formattedContacts = $contacts->map(function ($contact) {
            return [
                'value' => $contact->id,
                'name' => $contact->name ." " .$contact->surname,
                'email' => $contact->email,
            ];
        });

        return response()->json($formattedContacts);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
