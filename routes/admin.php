<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LogoutController;
use App\Http\Controllers\Admin\PostCategoriesController;
use App\Http\Controllers\Admin\UsersController;

// Route::match(['get', 'post'], '/login', [LoginController::class, 'login'])->name('admin.login');
// Route::middleware('auth:admin')->group(function (){
//     Route::get('/', [HomeController::class, 'index'])->name('dashboard');
//     Route::get('/logout', [LogoutController::class, 'logout'])->name('admin.logout');
//     Route::post('/save', [HomeController::class, 'save'])->name('home.save');
//     Route::get('/users', [UsersController::class, 'index'])->name('admin.users');
//     Route::get('/users/ban/{id}', [UsersController::class, 'banUser'])->name('admin.users.ban');
//     Route::get('/users/delete/{id}', [UsersController::class, 'deleteUser'])->name('admin.users.delete');
//     Route::get('/categories', [PostCategoriesController::class, 'index'])->name('admin.categories');
//     Route::get('/categories/delete/{id}', [PostCategoriesController::class, 'delete'])->name('admin.categories.delete');
//     Route::get('/categories/edit/{id}', [PostCategoriesController::class, 'edit'])->name('admin.categories.edit');
//     Route::post('/categories/save', [PostCategoriesController::class, 'save'])->name('admin.categories.save');
// });