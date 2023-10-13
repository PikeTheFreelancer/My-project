<?php

use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\LogoutController;
use App\Http\Controllers\User\MyStoreController;

Route::match(['get', 'post'], '/login', [LoginController::class, 'login'])->name('login');
Route::middleware('auth:web')->group(function (){
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
    Route::get('/my-store', [MyStoreController::class, 'index'])->name('user.my-store');
    Route::post('/my-store/save', [MyStoreController::class, 'save'])->name('user.my-store.save');
    Route::post('/my-store/get-merchandise-fields', [MyStoreController::class, 'getMerchandiseFields'])->name('user.my-store.get-merchandise-fields');
});
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
