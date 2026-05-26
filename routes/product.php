<?php

use App\Http\Controllers\ProductController;


Route::get('/product/list', [ProductController::class, 'list_products'])->name('product.list');

Route::get('/product/{product}', [ProductController::class, 'show'])
    ->name('product.show');

Route::put('/product/{product}', [ProductController::class, 'update'])
    ->name('product.update');

Route::post('/product/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
