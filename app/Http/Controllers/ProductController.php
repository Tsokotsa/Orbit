<?php

namespace App\Http\Controllers;
use App\Models\Service;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Str;

class ProductController extends Controller
{
    public function list_products()
    {
        $user = Auth()->user();

        // All Bandwidth Profiles 

        $speeds = DB::table('bandwidth_profiles')->where('active', 'y')->get();

        // Mediums 
        $mediums = DB::table('mediums')->where('active', 'y')->get();

        $stats = [
            'total' => Service::count(),
            'active' => Service::where('active', 'y')->count(),
            'public_ip' => Service::where('public_ip', 'y')->count(),
            'prepaid' => Service::where('is_prepaid', 'y')->count(),
            'topup' => Service::where('can_top_up', 'y')->count(),
            'avg_price' => Service::avg('price'),
        ];

        $products = Service::all();

        return view('product.index')->with(['speeds' => $speeds, 'mediums' => $mediums, 'products' => $products, 'stats' => $stats, 'user' => $user]);
    }

    public function show(Service $product)
    {
        return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }

    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'd_speed' => ['nullable', 'numeric', 'min:0'],
            'u_speed' => ['nullable', 'numeric', 'min:0'],
            'price' => ['required', 'numeric', 'min:0'],
            'medium_type' => ['required', 'string', 'max:255'],

            'public_ip' => ['required', 'in:y,n'],
            'active' => ['required', 'in:y,n'],
            'is_prepaid' => ['required', 'in:y,n'],

            'can_top_up' => ['nullable', 'in:y,n'],
            'top_up_period' => ['nullable', 'integer', 'min:1'],

            'profile' => ['nullable', 'string', 'max:255'],
            'details' => ['nullable', 'string'],

            'pops' => ['nullable', 'array'],
            'mediums' => ['nullable', 'array'],

            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,webp', 'max:2048'],
            'icon' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,webp', 'max:1024'],

        ]);

        /*
        |--------------------------------------------------------------------------
        | DATABASE TRANSACTION
        |--------------------------------------------------------------------------
        */

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | FILE UPLOADS
            |--------------------------------------------------------------------------
            */

            $logoPath = null;
            $iconPath = null;

            if ($request->hasFile('logo')) {

                $logoPath = $request->file('logo')
                    ->store('products/logos', 'public');

            }

            if ($request->hasFile('icon')) {

                $iconPath = $request->file('icon')
                    ->store('products/icons', 'public');

            }

            /*
            |--------------------------------------------------------------------------
            | TABLE IDENTIFIER
            |--------------------------------------------------------------------------
            */

            $tableIdentifier = strtolower(
                preg_replace('/[^a-zA-Z0-9]+/', '_', $validated['medium_type'])
            );

            /*
            |--------------------------------------------------------------------------
            | CREATE PRODUCT
            |--------------------------------------------------------------------------
            */

            $product = Service::create([

                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,

                'table_identifier' => $tableIdentifier,

                'd_speed' => $validated['d_speed'] ?? null,
                'u_speed' => $validated['u_speed'] ?? null,

                'profile' => $validated['profile'] ?? null,

                'logo' => $logoPath,
                'icon' => $iconPath,

                'pops' => $validated['pops'] ?? [],
                'mediums' => $validated['mediums'] ?? [],

                'public_ip' => $validated['public_ip'],
                'active' => $validated['active'],

                'can_top_up' => $validated['can_top_up'] ?? 'n',
                'top_up_period' => $validated['top_up_period'] ?? null,

                'is_prepaid' => $validated['is_prepaid'],

                'price' => $validated['price'],

                'amount_locked' => 'y',

                'details' => $validated['details'] ?? null,

            ]);

            DB::commit();

            /*
            |--------------------------------------------------------------------------
            | SUCCESS RESPONSE
            |--------------------------------------------------------------------------
            */

            return response()->json([

                'success' => true,
                'message' => 'Product created successfully',
                'data' => $product

            ], 201);

        } catch (\Throwable $e) {

            DB::rollBack();

            report($e);

            /*
            |--------------------------------------------------------------------------
            | ERROR RESPONSE
            |--------------------------------------------------------------------------
            */

            return response()->json([

                'success' => false,
                'message' => 'Failed to create product',
                'error' => config('app.debug') ? $e->getMessage() : null

            ], 500);

        }
    }

    public function update(Request $request, Service $product)
    {
        $validated = $request->validate([

            'name' => ['required'],
            'price' => ['required', 'numeric'],

            'public_ip' => ['required', 'in:y,n'],
            'active' => ['required', 'in:y,n'],
            'is_prepaid' => ['required', 'in:y,n'],

            'description' => ['nullable']

        ]);

        $product->update($validated);

        return response()->json([

            'success' => true,
            'message' => 'Product updated successfully'

        ]);
    }
}
