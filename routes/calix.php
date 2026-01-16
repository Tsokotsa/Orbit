<?php

use App\Http\Controllers\CalixController;



Route::get('/calix', [CalixController::class, 'index'])->name('calix_dashbard');



