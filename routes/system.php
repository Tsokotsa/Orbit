<?php

use App\Http\Controllers\SystemController;

// routes/web.php

use App\Http\Controllers\SystemLinkController;

Route::post('/link/store', [SystemController::class, 'store'])
    ->name('system.link-store');