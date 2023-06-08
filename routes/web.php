<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\MyHistoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserDataController;

Route::get('/', fn() => redirect(route('home')));

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/get-by-category', [ListController::class, 'getProductByCategory'])->name('getByCategory');

Route::middleware('auth')->group(function() {

    Route::get('/product-list/{product_id}', [ListController::class, 'product_detail'])->name('product.detail');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart/{product_id}', [CartController::class, 'show'])->name('cart.show');
    Route::post('/cart/{product_id}', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{transaction_id}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::post('/pesan/{isQtyLowerThanStock}', PesanController::class)->name('pesan')->middleware('data.lengkap');
    Route::get('/history', MyHistoryController::class)->name('history.index')->middleware('data.lengkap');

    Route::get('/user-data', [UserDataController::class, 'edit'])->name('userData.edit');
    Route::post('/user-data', [UserDataController::class, 'update'])->name('userData.update');

});

Route::middleware(['auth', 'admin', 'data.lengkap'])->group(function() {
    Route::resource('/product', ProductController::class);
    Route::resource('/category', CategoryController::class)->except('show');

    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::get('/order/{user_id}', [OrderController::class, 'show'])->name('order.show');
});