<?php

use App\Http\Controllers\CalixController;



Route::get('/calix', action: [CalixController::class, 'index'])->name('calix_dashbard');
Route::get(uri: '/calix/subscribers/list', action: [CalixController::class, 'list_subscribers'])->name('list.all-subscribers');
Route::get(uri: '/calix/subscribers', action: [CalixController::class, 'get_all_subscribers'])->name('subscribers.datatable');
Route::get(uri: '/calix/subscribers/{customID}', action: [CalixController::class, 'view_subscriber'])->name('view.subscriber');



