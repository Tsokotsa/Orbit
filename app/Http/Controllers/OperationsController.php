<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OperationsController extends Controller
{
    public function view()
    {
        $user = Auth()->user();

        return view('ops.callout')->with(['user' => $user]);
    }

    public function calculate(Request $request)
    {
        $response = Http::withHeaders([
            'Authorization' => 'eyJvcmciOiI1YjNjZTM1OTc4NTExMTAwMDFjZjYyNDgiLCJpZCI6ImMzZTY1Y2ExNjE4ODQyNDU5NTkxZTdjZTUxZGNiYWU1IiwiaCI6Im11cm11cjY0In0=', // ✅ THIS IS REQUIRED
            'Content-Type' => 'application/json'
        ])->post(
                'https://api.openrouteservice.org/v2/directions/driving-car',
                [
                    'coordinates' => [
                        [
                            (float) $request->origin_lng,
                            (float) $request->origin_lat
                        ],
                        [
                            (float) $request->destination_lng,
                            (float) $request->destination_lat
                        ]
                    ]
                ]
            );

        if (!$response->successful()) {
            return response()->json([
                'error' => $response->json()
            ], 500);
        }

        $data = $response->json();

        $summary = $data['routes'][0]['summary'];

        return response()->json([
            'distance_km' => round($summary['distance'] / 1000, 2),
            'duration_hours' => round($summary['duration'] / 3600, 2)
        ]);
    }

    public function searchLocation(Request $request)
    {
        $query = $request->query('q');
        // https://api.geoapify.com/v1/geocode/autocomplete?text=Mosco&apiKey=cbd54ae057ff43ae834cc1f97304bb2d
        $response = Http::get(
            'https://api.geoapify.com/v1/geocode/autocomplete',
            [
                'text' => $query,
                'filter' => 'countrycode:mz',
                'limit' => 5,
                'format' => 'json',
                'apiKey' => 'cbd54ae057ff43ae834cc1f97304bb2d'
            ]
        );

        return response()->json(
            $response->json()
        );
    }


}

