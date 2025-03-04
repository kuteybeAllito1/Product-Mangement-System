<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\productController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

Route::get('/products', [productController::class, 'index'])->name('products.index');
Route::get('/home', [productController::class, 'index'])->name('home');
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/check', [LoginController::class, 'check'])->name('check');

Route::middleware('permission:create_product')->group(function() {
    Route::get('/products/create', [productController::class, 'create'])->name('products.create');
    Route::post('/products', [productController::class, 'store'])->name('products.store');
});

Route::middleware('permission:edit_product')->group(function() {
    Route::get('/products/{product}/edit', [productController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [productController::class, 'update'])->name('products.update');
});

Route::middleware('permission:delete_product')->group(function() {
    Route::delete('/products/{product}', [productController::class, 'destroy'])->name('products.destroy');
});

Route::middleware('permission:promote_user')->group(function() {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/{user}/attach-role', [UserController::class,'attachRole'])->name('users.attachRole');
    Route::delete('/users/{user}/detach-role/{role}', [UserController::class,'detachRole'])->name('users.detachRole');

    
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::post('/roles/{role}/attach-permission', [RoleController::class, 'attachPermission'])->name('roles.attachPermission');
    Route::delete('/roles/{role}/detach-permission/{permission}', [RoleController::class, 'detachPermission'])->name('roles.detachPermission');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

    Route::get('/permissions', [PermissionController::class,'index'])->name('permissions.index');
    Route::post('/permissions', [PermissionController::class,'store'])->name('permissions.store');
    Route::delete('/permissions/{permission}', [PermissionController::class,'destroy'])->name('permissions.destroy');
});

