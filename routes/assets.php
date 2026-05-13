<?php

use App\Http\Controllers\AssetsController;

// Route::group(['middleware' => ['auth', 'permission:view assets']], function () {
//     Route::get('/asset', [AssetsController::class, 'view'])->name('view_all_assets');
//     Route::get('/assets/getAll', [AssetsController::class, 'get_all_ajax'])->name('get_all_assets_ajax');
// });

// Route::group(['middleware' => ['auth', 'permission:create assets']], function () {
//     Route::get('/assets/add_new', [
//         AssetsController::class,
//         'get_all_vendor_and_medium'
//     ])->name('get_all_vendor_and_medium_ajax');
//     Route::post('/asset/store', [AssetsController::class, 'store'])->name('store_new_asset');
// });

// Route::group(['middleware' => ['auth', 'permission:manage vendors']], function () {
//     Route::get('/vendors/get_all', [AssetsController::class, 'get_all_vendors_ajax'])->name('get_all_vendors_ajax');
//     Route::post('/vendor/add', [AssetsController::class, 'add_vendor'])->name('add.vendor');
// });

// Route::group(['middleware' => ['auth', 'permission:manage models']], function () {
//     Route::post('/model/add', [AssetsController::class, 'add_model'])->name('add_model_to_vendor');
// });

Route::middleware(['auth'])->group(function () {

    // ASSETS
    Route::prefix('asset')->group(function () {

        Route::get('/', [AssetsController::class, 'view'])
            ->name('assets.index')
            ->middleware('permission:assets.view');

        Route::get('/data', [AssetsController::class, 'get_all_ajax'])
            ->name('assets.data')
            ->middleware('permission:assets.view');

        Route::get('/create', [AssetsController::class, 'create'])
            ->name('assets.create')
            ->middleware('permission:assets.create');

        Route::post('/store', [AssetsController::class, 'store'])
            ->name('assets.store')
            ->middleware('permission:assets.create');
    });

    // VENDORS
    Route::prefix('vendors')->group(function () {

        Route::get('/get_all', [AssetsController::class, 'get_all_vendors_ajax'])
            ->name('vendors.data')
            ->middleware('permission:vendors.manage');

        Route::post('/add', [AssetsController::class, 'add_vendor'])
            ->name('vendors.store')
            ->middleware('permission:vendors.manage');
    });

    // MODELS
    Route::prefix('models')->group(function () {

        Route::post('/add', [AssetsController::class, 'add_model'])
            ->name('models.store')
            ->middleware('permission:models.manage');
    });

});




