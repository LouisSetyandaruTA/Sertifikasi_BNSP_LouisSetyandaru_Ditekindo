<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GameProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;

//Landing Page
Route::get('/', function () {
    if (Auth::check() && Auth::user()->role == 'admin') {
        return redirect()->route('dashboard');
    }
    return redirect()->route('gameproducts.index');
});

// Etalase Umum
Route::get('/shop', [GameProductController::class, 'index'])->name('gameproducts.index');

//Guest Only
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});
// Auth User
Route::middleware(['auth'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/add-to-cart/{gameproduct}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/remove-from-cart', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    // Admin Only
    Route::middleware(['auth', 'is_admin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('gameproducts', GameProductController::class)->except(['index']);
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/pdf', [DashboardController::class, 'exportPDF'])->name('dashboard.pdf');
    });

    // Route Profile & History
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});
