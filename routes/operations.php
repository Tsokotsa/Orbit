<?php

use App\Http\Controllers\OperationsController;

Route::middleware(['auth'])->group(function () {

    // ASSETS
    Route::prefix('ops')->group(function () {

        Route::get('/', [OperationsController::class, 'view'])
            ->name('ops.callout-calculation')
            ->middleware('permission:ops.callout-calculation');

        Route::post('/distance/calculate', [OperationsController::class, 'calculate'])
            ->name('distance.calculate');

        Route::get('/search-location', [OperationsController::class, 'searchLocation'])
            ->name('search.location');


    });

});




