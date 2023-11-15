<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LogoutController;

Route::match(['get', 'post'], '/login', [LoginController::class, 'login'])->name('admin.login');
Route::middleware('auth:admin')->group(function (){
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/logout', [LogoutController::class, 'logout'])->name('admin.logout');
    Route::post('/save', [HomeController::class, 'save'])->name('home.save');
});