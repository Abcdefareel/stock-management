<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockMovementController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;


// auth
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth')->group(function () {
    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // product
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/create', [ProductController::class, 'create']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::get('/products/{id}/edit', [ProductController::class, 'edit']);
    Route::put('/products/{id}', [ProductController::class, 'update'])->middleware('admin');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->middleware('admin');

    // category
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/create', [CategoryController::class, 'create']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit']);
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->middleware('admin');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->middleware('admin');

    // supplier
    Route::get('/suppliers', [SupplierController::class, 'index']);
    Route::get('/suppliers/create', [SupplierController::class, 'create']);
    Route::post('/suppliers', [SupplierController::class, 'store']);
    Route::get('/suppliers/{id}/edit', [SupplierController::class, 'edit']);
    Route::put('/suppliers/{id}', [SupplierController::class, 'update'])->middleware('admin');
    Route::delete('/suppliers/{id}', [SupplierController::class, 'destroy'])->middleware('admin');

    // stock-movement
    Route::get('/stock-movements', [StockMovementController::class, 'index']);
    Route::get('/stock-movements/create', [StockMovementController::class, 'create']);
    Route::post('/stock-movements', [StockMovementController::class, 'store']);
    Route::get('/stock-movements/{id}/edit', [StockMovementController::class, 'edit']);
    Route::put('/stock-movements/{id}', [StockMovementController::class, 'update'])->middleware('admin');
    Route::delete('/stock-movements/{id}', [StockMovementController::class, 'destroy'])->middleware('admin');
    Route::post('/stock-movements/{id_product}/reset', [StockMovementController::class, 'reset'])->middleware('admin');

    // logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
