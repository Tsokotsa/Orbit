<?php

use App\Http\Controllers\StarlinkController;
use App\Http\Controllers\StarlinkUsageController;

//Route::group(['middleware' => ['auth', 'permission:view starlink'], 'prefix' => 'starlink'], function () {
Route::group(['middleware' => ['permission: view starlink account']], function () {
    Route::get('/starlink', [StarlinkController::class, 'account']);
    //Route::get('/account/view', [StarlinkController::class, 'view_account']);
//Route::get('/terminals', [StarlinkController::class, 'terminals']);
//Route::get('/usage', [StarlinkController::class, 'dataUsage']);

    //Route::get('/subscribers/datatable', [StarlinkController::class, 'subscribersDatatable'])->name('starlink.subscribers.datatable');

    Route::get('/starlink/subscribers/ajax', [StarlinkController::class, 'subscribersAjax']);

    Route::get('/starlink/subscriber-view/{currentServiceLine}', [StarlinkController::class, 'view_subscriber']);

    Route::delete('/starlink/service-line/{serviceLineNumber}', [StarlinkController::class, 'deactivate_line']);

    Route::post('/starlink/top-up/{serviceLine}', [StarlinkController::class, 'top_up'])->name('starlink.topup');

    Route::put('/starlink/service-line/{serviceLineNumber}/product', [StarlinkController::class, 'activate_line']);

    Route::get('/starlink/telemetry', [StarlinkController::class, 'telemetry']);


    // Testing Graph

    Route::get('/starlink/{device}/graph', [StarlinkUsageController::class, 'graph']);
    Route::get('/starlink/{device}/data', [StarlinkUsageController::class, 'data']);

    Route::get(
        '/starlink/{device}/monthly-usage',
        [StarlinkUsageController::class, 'usageMonthly']
    )->name('starlink.monthly.usage');

});




