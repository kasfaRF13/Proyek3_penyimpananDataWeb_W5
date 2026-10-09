<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// 1. Jalur Halaman Utama (Langsung Arahkan ke Login)
Route::get('/', function () {
    return redirect('/login');
});

// 2. Jalur Login (Tampilkan Form & Proses Input)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// 3. Jalur Dashboard (Hanya Bisa Diakses Jika Sudah Login)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
});

// 4. Jalur Logout
Route::post('/logout', [AuthController::class, 'logout']);