<?php

use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\LogoutController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\MyStoreController;
use App\Http\Controllers\User\MarketController;
use App\Http\Controllers\User\UserController;

Route::match(['get', 'post'], '/login', [LoginController::class, 'login'])->name('login');
Route::middleware('auth:web')->group(function (){
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
    Route::get('/my-account', [UserController::class, 'index'])->name('user');
    Route::post('/my-account', [UserController::class, 'save'])->name('user.save');
    Route::get('/my-store', [MyStoreController::class, 'index'])->name('user.my-store');

    Route::post('/market/comment', [CommentController::class, 'comment'])->name('user.market.comment');
    Route::post('/market/edit-comment/{id}', [CommentController::class, 'edit'])->name('user.market.edit-comment');
    Route::post('/market/delete-comment', [CommentController::class, 'delete'])->name('user.market.edit-comment');
    Route::post('notification/send', [MarketController::class, 'sendNotification'])->name('notification.send');
    Route::post('notification/mark-as-read', [MarketController::class, 'markAsReadNoti'])->name('notification.mark-as-read');

    Route::post('/my-store/save', [MyStoreController::class, 'save'])->name('user.my-store.save');
    Route::post('/my-store/delete', [MyStoreController::class, 'delete'])->name('user.my-store.delete');
    Route::post('/my-store/get-merchandise-fields', [MyStoreController::class, 'getMerchandiseFields'])->name('user.my-store.get-merchandise-fields');
    Route::post('/my-store/save-merchandise-fields', [MyStoreController::class, 'saveMerchandiseFields'])->name('user.my-store.save-merchandise-fields');
});
Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/market/load-comments', [MarketController::class, 'loadPrevComments'])->name('load-comments');
Route::get('/market', [MarketController::class, 'index'])->name('market');
Route::get('/merchandise/{id}', [MarketController::class, 'merchandise'])->name('merchandise');