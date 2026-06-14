<?php

use App\Http\Controllers\RfoController;
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

        // Route::get('/rfo', [OperationsController::class, 'rfo'])
        //     ->name('ops.rfo-create')
        //     ->middleware('permission:ops.rfo-create');


    });

    // RFO
    Route::prefix('rfos')->group(function () {

        Route::get('/', [RfoController::class, 'index'])->name('rfo.index');

        Route::get('/datatable', [RfoController::class, 'datatable'])->name('rfos.datatable');

        Route::post('/store', [RfoController::class, 'store'])->name('rfo.store');

        Route::get('/{rfo}/edit', [RfoController::class, 'edit'])->name('rfo.edit');

        Route::get('/{rfo}', [RfoController::class, 'show'])->name('rfo.show');

        Route::put('/{rfo}', [RfoController::class, 'update'])->name('rfo.update');

        Route::delete('/{rfo}', [RfoController::class, 'destroy'])->name('rfo.destroy');

        Route::get('/{rfo}/pdf', [RfoController::class, 'pdf'])->name('rfo.pdf');

        // Route::post(
        //     '/{rfo}/approve',
        //     [RfoApprovalController::class, 'approve']
        // )->name('approve');

        // Route::post(
        //     '/{rfo}/reject',
        //     [RfoApprovalController::class, 'reject']
        // )->name('reject');
    });


});




