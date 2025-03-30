<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AdminLoginController;


Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/check', [LoginController::class, 'check'])->name('check');

Route::get('/home', [ProductController::class, 'index'])->name('home');

Route::middleware(['auth', 'admin.only'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/{user}/attach-role', [UserController::class, 'attachRole'])->name('users.attachRole');
    Route::delete('/users/{user}/detach-role/{role}', [UserController::class, 'detachRole'])->name('users.detachRole');
    Route::put('/users/{user}/grant-admin-access',[UserController::class,'grantAdminAccess'])->name('users.grantAdminAccess');
    Route::put('/users/{user}/revoke-admin-access',[UserController::class,'revokeAdminAccess'])->name('users.revokeAdminAccess');


    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::post('/roles/{role}/attach-permission', [RoleController::class, 'attachPermission'])->name('roles.attachPermission');
    Route::delete('/roles/{role}/detach-permission/{permission}', [RoleController::class, 'detachPermission'])->name('roles.detachPermission');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');

    Route::get('/products', [ProductController::class, 'adminIndex'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])
     ->name('admin.login');

Route::post('/admin/login', [AdminLoginController::class, 'login'])
     ->name('admin.login.submit');

Route::post('/admin/logout', [AdminLoginController::class, 'logout'])
     ->name('admin.logout');
