<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ======== HALAMAN USER ========

// Homepage + katalog (filter berada di bagian bawah homepage)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Detail produk
Route::get('/katalog/{id}', [KatalogController::class, 'show'])->name('katalog.show');


// ======== AUTH ========

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// ======== ADMIN (HARUS LOGIN) ========

Route::middleware(['auth'])->group(function () {

    // Dashboard admin
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // CRUD Produk
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');

    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/update/{id}', [ProductController::class, 'update'])->name('products.update');

    Route::delete('/products/delete/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
});
