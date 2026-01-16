<?php

namespace App\Http\Controllers;

use App\Services\CalixService;

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
        $variables = $this->calix->getGuiVariable("Maputo", 0);

        return view('calix.dashboard', compact('variables'));
    }
}
