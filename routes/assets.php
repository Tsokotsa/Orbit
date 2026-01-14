<?php

use App\Http\Controllers\AssetsController;



Route::get('/asset', action: [AssetsController::class, 'view'])->name('view_all_assets');
Route::get('/assets/getAll', action: [AssetsController::class, 'get_all_ajax'])->name('get_all_assets_ajax');
Route::get('/assets/add_new', action: [AssetsController::class, 'get_all_vendor_and_medium'])->name('get_all_vendor_and_medium_ajax');
Route::post('/asset/store', [AssetsController::class, 'store'])->name('store_new_asset');
Route::get('/vendors/get_all', action: [AssetsController::class, 'get_all_vendors_ajax'])->name('get_all_vendors_ajax');
Route::post('/vendor_model/add', [AssetsController::class, 'add_model'])->name('add_vendor_model');







