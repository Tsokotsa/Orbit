<?php

use App\Http\Controllers\RadiusUserController;
use App\Http\Controllers\RadiusProfileController;
use App\Http\Controllers\RadiusNasController;



Route::prefix('radius')->group(function () {

    Route::get('/', [RadiusUserController::class, 'index'])
        ->name('radius.view')->middleware('permission: radius.view');

    Route::get('/users/list', [RadiusUserController::class, 'listUsers'])
        ->name('radius.users-list');

    Route::get('/user/{username}', [RadiusUserController::class, 'getUser'])
        ->name('radius.user.details');

    Route::post('/users', [RadiusUserController::class, 'store'])
        ->name('radius.users.store');

    // Route::put('/users/{username}', [RadiusUserController::class, 'update'])
    //     ->name('radius.users.update');

    // Route::post('/users/{username}/suspend', [RadiusUserController::class, 'suspend'])
    //     ->name('radius.users.suspend');

    Route::delete('/user/{username}', [RadiusUserController::class, 'destroy'])
        ->name('radius.users.destroy');

    Route::get('/nas', [RadiusNasController::class, 'nasView'])
        ->name('nas.view')->middleware('permission: nas.view');


    Route::post(
        '/radius/users/update',
        [RadiusUserController::class, 'update']
    )
        ->name('radius.users.update');

    Route::post(
        '/radius/users/disconnect',
        [RadiusUserController::class, 'disconnect']
    )
        ->name('radius.users.disconnect');

    Route::post(
        '/radius/users/suspend',
        [RadiusUserController::class, 'suspend']
    )->name('radius.users.suspend');

    Route::post('/radius/users/unsuspend', [RadiusUserController::class, 'unsuspend'])
        ->name('radius.users.unsuspend');

    Route::post(
        '/radius/users/reset-password',
        [RadiusUserController::class, 'resetPassword']
    )
        ->name('radius.users.reset.password');


    // PROFILES
    Route::post('/profiles/store', [RadiusProfileController::class, 'store'])
        ->name('radius.profiles.store');
    Route::get('/profiles/list', [RadiusProfileController::class, 'list'])
        ->name('radius.profiles-list');

    Route::post('/profiles/{group}/update', [RadiusProfileController::class, 'update'])->name('radius.profiles.update');

    Route::get('/profiles/{group}', [RadiusProfileController::class, 'show'])->name('radius.profiles.show');

    Route::post('/profiles/{group}', [RadiusProfileController::class, 'destroy'])->name('radius.profiles.delete');

    // Route::post('/profiles/show', [RadiusProfileController::class, 'show']);

});


Route::prefix('radius/nas')->group(function () {

    // Route::get('/', [RadiusNasController::class, 'index'])->name('nas.index');

    Route::post('/store', [RadiusNasController::class, 'store'])->name('nas.store');

    Route::post('/update/{id}', [RadiusNasController::class, 'update'])->name('nas.update');

    Route::delete('/delete/{id}', [RadiusNasController::class, 'destroy'])->name('nas.delete');

});