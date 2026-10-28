<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\StockMovementController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/items');

Route::resource('items', ItemController::class)->except(['show']);
Route::get('items/{item}', [ItemController::class, 'show'])->name('items.show');
Route::post('items/{item}/movements', [StockMovementController::class, 'store'])->name('movements.store');
