<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SystemLink;
use Log;

class SystemController extends Controller
{
    public function fetchLinks()
    {
        $systemLinks = SystemLink::where('is_active', true)
            ->orderBy('sort_order')
            ->get();
    }

    public function store(Request $request)
    {
        try {

            $validated = $request->validate([
                'section' => 'required|string|max:255',
                'title' => 'required|string|max:255',
                'url' => 'required|url|max:1000',
                'icon' => 'nullable|string|max:255',
                'sort_order' => 'nullable|integer',
                'permission' => 'nullable|string|max:255',
                'environment' => 'required|string',
            ]);

            $link = SystemLink::create([
                'name' => $request->name,
                'section' => $request->section,
                'title' => $request->title,
                'url' => $request->url,
                'icon' => $request->icon,
                'sort_order' => $request->sort_order ?? 0,
                'permission' => $request->permission,
                'environment' => $request->environment,
                'new_tab' => $request->has('new_tab'),
                'is_active' => $request->has('is_active'),
                'visible_in_sidebar' => $request->has('visible_in_sidebar'),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'System link created successfully.',
                'data' => $link
            ]);
        } catch (\Exception $e) {

            Log::error($e);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

}
