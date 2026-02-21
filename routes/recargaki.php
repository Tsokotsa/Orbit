<?php

use App\Http\Controllers\RecargakiController;

Route::get('/recargaki/paid/{clientRef}', [RecargakiController::class, 'paidInvoicesByClient']);




