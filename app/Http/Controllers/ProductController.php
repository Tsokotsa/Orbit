<?php

namespace App\Http\Controllers;
use App\Models\Service;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function list_products()
    {
        $user = Auth()->user();

        $stats = [
            'total' => Service::count(),
            'active' => Service::where('active', 'y')->count(),
            'public_ip' => Service::where('public_ip', 'y')->count(),
            'prepaid' => Service::where('is_prepaid', 'y')->count(),
            'topup' => Service::where('can_top_up', 'y')->count(),
            'avg_price' => Service::avg('price'),
        ];

        $products = Service::all();

        return view('product.index')->with(['products' => $products, 'stats' => $stats, 'user' => $user]);
    }
}
