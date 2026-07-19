<?php

use App\Http\Controllers\AnalysisController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/analisis', [AnalysisController::class, 'index'])->name('analisis');
    Route::post('/analisis', [AnalysisController::class, 'store'])->name('analisis.store');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
