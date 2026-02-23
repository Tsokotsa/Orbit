<?php

use App\Http\Controllers\AssetsController;

Route::group(['middleware' => ['auth', 'permission:view assets']], function () {
    Route::get('/asset', [AssetsController::class, 'view'])->name('view_all_assets');
    Route::get('/assets/getAll', [AssetsController::class, 'get_all_ajax'])->name('get_all_assets_ajax');
});

Route::group(['middleware' => ['auth', 'permission:create assets']], function () {
    Route::get('/assets/add_new', [
        AssetsController::class,
        'get_all_vendor_and_medium'
    ])->name('get_all_vendor_and_medium_ajax');
    Route::post('/asset/store', [AssetsController::class, 'store'])->name('store_new_asset');
});

Route::group(['middleware' => ['auth', 'permission:manage vendors']], function () {
    Route::get('/vendors/get_all', [AssetsController::class, 'get_all_vendors_ajax'])->name('get_all_vendors_ajax');
    Route::post('/vendor/add', [AssetsController::class, 'add_vendor'])->name('add.vendor');
});

Route::group(['middleware' => ['auth', 'permission:manage models']], function () {
    Route::post('/model/add', [AssetsController::class, 'add_model'])->name('add_model_to_vendor');
});




