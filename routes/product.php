<?php

use App\Http\Controllers\ProductController;


Route::get('/product/list', [ProductController::class, 'list_products'])->name('product.list');
Route::get('/product/show', [ProductController::class, 'list_products'])->name('product.show');
Route::post('/product/edit', [ProductController::class, 'list_products'])->name('product.edit');
Route::post('/product/store', [ProductController::class, 'list_products'])->name('product.store');
