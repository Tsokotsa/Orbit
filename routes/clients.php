<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\OdooController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\OdooInvoiceController;


// LIST All Clients 
//Route::get('/client', [OdooController::class, 'getClients'])->name('client_list');

Route::group(['middleware' => ['auth', 'permission: clients.view']], function () {

    Route::get('/client', [OdooController::class, 'index'])->name('clients.list');
    Route::get('/clients/data', [OdooController::class, 'getClients'])->name('clients.data');
    Route::get('/client/view', [ClientController::class, 'view_client'])->name('clients.view');
});

Route::group(['middleware' => ['auth', 'permission: clients.view-services']], function () {
    Route::get('/assets/tab', [ClientController::class, 'get_all_assets'])->name('clients.assets-tab');
    Route::get('/clients/services', [ClientController::class, 'list_all_services'])->name('clients.services');

    // Dynamicaly load client data
    Route::get('/client_tabs/{tab}', [ClientController::class, 'load'])->name('clients.dynamic-tabs');
    Route::get('/client/services/fiber', [ServiceController::class, 'get_service_fiber'])->name('clients.services-fiber');
    Route::get('/client/services/wireless', [ServiceController::class, 'get_service_wireless']);
    Route::get('/client/services/satt', [ServiceController::class, 'get_service_satt']);
    Route::get('/assets/get_all', [ServiceController::class, 'get_ajax'])->name('Get_assets_ajax');

    Route::post('/client/assets/store', [ClientController::class, 'store_asset'])->name('client-asset-store');
});

Route::group(['middleware' => ['auth', 'permission: clients.odoo']], function () {
    // Logging TESTS
    Route::get('/odoo/test-open-invoices', [OdooController::class, 'logInvoices']);
    Route::get('/odoo/test-models', [OdooController::class, 'logAllModels']);

    // INVOICE 
    Route::get('/odoo/invoices', [OdooInvoiceController::class, 'index'])->name('odoo.invoices.index');

    Route::post("/client/add-service", [ClientController::class, 'add_service']);

    //Route::get("/client/view-service", [ClientController::class, 'view_service']);

});



