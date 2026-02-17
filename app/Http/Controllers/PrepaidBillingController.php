<?php


// app/Http/Controllers/PrepaidBillingController.php

namespace App\Http\Controllers;

use App\Jobs\GeneratePrepaidBillingJob;

class PrepaidBillingController extends Controller
{
    public function run()
    {
        dispatch(new GeneratePrepaidBillingJob());

        return response()->json([
            'status' => 'Prepaid billing job dispatched'
        ]);
    }
}