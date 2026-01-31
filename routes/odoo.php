<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\OdooController;
use App\Http\Controllers\ServiceController;


Route::get('/billing', [OdooController::class, 'billing'])->name('billing.view');
Route::get('/billing/list', [OdooController::class, 'get_all_ajax'])->name('billing.getAjax');

Route::get('/client/sales-order', [OdooController::class, 'sales_order'])->name('view.sales.orders');

// TESTE
Route::get('/odoo/quotes', [OdooController::class, 'quotes']);
Route::get('/odoo/invoices', [OdooController::class, 'lastInvoices']);
Route::get('/odoo/billings', [OdooController::class, 'lastBillings']);






