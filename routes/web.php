<?php

use Illuminate\Support\Facades\Route;

// CONTROLLERS
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/katalog/{id}', [KatalogController::class, 'show'])->name('katalog.show');

/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.process');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::resource('products', ProductController::class);
        Route::resource('users', UserController::class)->only(['index', 'show']);
        
        // Transactions Management (New - for Cart/Checkout)
        Route::get('/transactions', [\App\Http\Controllers\Admin\TransactionController::class, 'index'])->name('transactions.index');
        Route::get('/transactions/{transaction}', [\App\Http\Controllers\Admin\TransactionController::class, 'show'])->name('transactions.show');
        Route::get('/transactions/{transaction}/view-bukti', [\App\Http\Controllers\Admin\TransactionController::class, 'viewBukti'])->name('transactions.view-bukti');
        Route::post('/transactions/{transaction}/verify', [\App\Http\Controllers\Admin\TransactionController::class, 'verify'])->name('transactions.verify');
        Route::post('/transactions/{transaction}/reject', [\App\Http\Controllers\Admin\TransactionController::class, 'reject'])->name('transactions.reject');
        
        Route::get('/activity-logs', [AdminController::class, 'activityLogs'])->name('activity-logs');
    });

/*
|--------------------------------------------------------------------------
| USER ROUTES (Profile, Cart, Checkout)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'changePassword'])->name('profile.password');
    Route::delete('/profile/delete', [ProfileController::class, 'deleteAccount'])->name('profile.delete');
    
    // History / Riwayat Pembelian
    Route::get('/history', [ProfileController::class, 'history'])->name('history');
    Route::get('/history/bukti/{transaction}', [ProfileController::class, 'viewBukti'])->name('history.bukti');
    
    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add/{product}', [CartController::class, 'store'])->name('cart.add');
    Route::get('/cart/delete/{id}', [CartController::class, 'destroy'])->name('cart.delete');
    
    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.page');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
});