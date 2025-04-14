<?php

use App\Http\Controllers\Admin\FoodController as AdminFoodController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/food');

Route::get('/food',[FoodController::class, 'index']);

Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('cart.add')->middleware('auth');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');


//Auth route
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// routes/web.php
Route::get('/vnpay-payment', [PaymentController::class, 'createPayment'])->name('vnpay.payment');
Route::get('/vnpay-return', [PaymentController::class, 'vnpayReturn'])->name('vnpay.return');


//don hang cua toi
Route::get('/don-hang-cua-toi', [OrderController::class, 'myOrders'])->middleware('auth');
Route::post('/order/create', [OrderController::class, 'createOrder'])->name('order.create');
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');



Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');




//admin route
Route::group(['middleware' => 'auth'], function () {

    Route::group(['middleware' => 'auth.admin'], function () {
        Route::get('/admin', [AdminFoodController::class, 'index']);
        Route::get('/admin/food', [AdminFoodController::class, 'index']);

        Route::get('/admin/food/create', [AdminFoodController::class, 'create']);
        Route::post('/admin/food', [AdminFoodController::class,'store']);
        
        Route::get('/admin/food/edit/{id}',[AdminFoodController::class, 'edit']);
        Route::put('/admin/food/edit/{id}',[AdminFoodController::class, 'update']);

        Route::get('/admin/orders', [AdminOrderController::class, 'index']);

        Route::put('/admin/orders/update-status/{id}', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    });
});
