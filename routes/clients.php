<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\OdooController;
use App\Http\Controllers\ServiceController;




// LIST All Clients 
//Route::get('/client', [OdooController::class, 'getClients'])->name('client_list');

Route::get('/client', [OdooController::class, 'index'])->name('client_list');
Route::get('/clients/data', [OdooController::class, 'getClients'])->name('clients.data');


//Route::get('/client/view', [OdooController::class, 'viewClient'])->name('clients.view');
Route::get('/client/view', [ClientController::class, 'view_client'])->name('clients.view');

Route::get('/assets/tab', [ClientController::class, 'get_all_assets'])->name('assets.tab');
Route::get('/clients/services', [ClientController::class, 'list_all_services'])->name('client.services');

// Dynamicaly load client data
Route::get('/client_tabs/{tab}', [ClientController::class, 'load']);
Route::get('/client/services/fiber', [ServiceController::class, 'get_service_fiber']);
Route::get('/client/services/wireless', [ServiceController::class, 'get_service_wireless']);
Route::get('/client/services/satt', [ServiceController::class, 'get_service_satt']);
Route::get('/assets/get_all', [ServiceController::class, 'get_ajax'])->name('Get_assets_ajax');

Route::post('/assets/store', [ClientController::class, 'store_asset'])->name('client-asset-store');


// Logging TESTS
Route::get('/odoo/test-open-invoices', [OdooController::class, 'logInvoices']);
Route::get('/odoo/test-models', [OdooController::class, 'logAllModels']);




//Route::get('/client/services/{service}', [ServiceController::class, 'load']);





