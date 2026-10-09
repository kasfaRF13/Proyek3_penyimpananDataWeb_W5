<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;

// Halaman Daftar Barang
Route::get('/index', [CartController::class, 'index'])->name('barang.index');
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');

// Halaman Keranjang Belanja
Route::get('/keranjang', [CartController::class, 'showCart'])->name('cart.show');
Route::post('/cart/update/{id}', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class, 'removeItem'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');