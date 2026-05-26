<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\SystemLink;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('*', function ($view) {

            $systemLinks = SystemLink::where('is_active', true)
                ->orderBy('section')
                ->orderBy('sort_order')
                ->get()
                ->groupBy('section');

            $view->with('systemLinks', $systemLinks);
        });
    }
}