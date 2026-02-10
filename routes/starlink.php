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


Route::get('/starlink/subscriber-view/{currentServiceLine}', [StarlinkController::class, 'view_subscriber']);

Route::delete('/starlink/service-line/{serviceLineNumber}', [StarlinkController::class, 'deactivate_line']);
//Route::post('/starlink/top-up/{serviceLine}', [StarlinkController::class, 'top_up']);
Route::post('/starlink/top-up/{serviceLine}', [StarlinkController::class, 'top_up'])->name('starlink.topup');


Route::put('/starlink/service-line/{serviceLineNumber}/product', [StarlinkController::class, 'activate_line']);
Route::get('/starlink/telemetry', [StarlinkController::class, 'telemetry']);




