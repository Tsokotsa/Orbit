<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SystemLink;

class SystemController extends Controller
{
    public function fetchLinks()
    {
        $systemLinks = SystemLink::where('is_active', true)
            ->orderBy('sort_order')
            ->get();
    }

}
