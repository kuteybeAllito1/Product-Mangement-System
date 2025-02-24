<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\productController;
use App\Http\Controllers\UserController;

Route::get('/products', [productController::class, 'index'])->name('products.index');

Route::get('/home', [productController::class, 'index'])->name('home');

Route::get('/', [LoginController::class, 'index'])->name('login');

Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/check', [LoginController::class, 'check'])->name('check');

Route::middleware('admin.seller')->group(function() {
    Route::get('/products/create', [productController::class, 'create'])->name('products.create');
    Route::post('/products', [productController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [productController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [productController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [productController::class, 'destroy'])->name('products.destroy');
});

Route::middleware('admin.only')->group(function() {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/{id}/make-seller', [UserController::class, 'makeSeller'])->name('users.makeSeller');
    Route::post('/users/{id}/make-user', [UserController::class, 'makeUser'])->name('users.makeUser');
});
