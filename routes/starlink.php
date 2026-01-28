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


Route::get('/starlink/service-lines/{serviceLineNumber}',[StarlinkController::class, 'view_subscriber']);

Route::delete('/starlink/service-line/{serviceLineNumber}',[StarlinkController::class, 'deactivate_line']);

Route::put( '/starlink/service-line/{serviceLineNumber}/product',  [StarlinkController::class, 'activate_line']);



