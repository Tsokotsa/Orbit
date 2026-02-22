<?php

use App\Http\Controllers\AssetsController;

Route::middleware(['auth', 'permission:view assets'])->group(function () {
    Route::get('/asset', [AssetsController::class, 'view'])->name('view_all_assets');
    Route::get('/assets/getAll', [AssetsController::class, 'get_all_ajax'])->name('get_all_assets_ajax');
});

Route::middleware(['auth', 'permission:create assets'])->group(function () {
    Route::get('/assets/add_new', [AssetsController::class, 'get_all_vendor_and_medium'])->name('get_all_vendor_and_medium_ajax');
    Route::post('/asset/store', [AssetsController::class, 'store'])->name('store_new_asset');
});

Route::middleware(['auth', 'permission:manage vendors'])->group(function () {
    Route::get('/vendors/get_all', [AssetsController::class, 'get_all_vendors_ajax'])->name('get_all_vendors_ajax');
    Route::post('/vendor/add', [AssetsController::class, 'add_vendor'])->name('add.vendor');
});

Route::middleware(['auth', 'permission:manage models'])->group(function () {
    Route::post('/model/add', [AssetsController::class, 'add_model'])->name('add_model_to_vendor');
});



