<?php

use App\Http\Controllers\StarlinkController;

Route::prefix('starlink')->group(function () {
    Route::get('/', [StarlinkController::class, 'account']);
    Route::get('/account/view', [StarlinkController::class, 'view_account']);
    Route::get('/terminals', [StarlinkController::class, 'terminals']);
    Route::get('/usage', [StarlinkController::class, 'dataUsage']);
});

Route::get('/starlink/subscribers/datatable', [StarlinkController::class, 'subscribersDatatable'])
    ->name('starlink.subscribers.datatable');
