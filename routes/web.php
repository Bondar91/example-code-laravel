<?php

use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DpdController;
use App\Http\Controllers\Admin\DiscountCouponController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ShipmentMethodController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin'], function () {
    Route::get('login', [LoginController::class, 'showLoginForm']);
    Route::post('login', [LoginController::class, 'authenticate'])->name('login');
    Route::get('logout', [LoginController::class, 'logout']);
    Route::get('login/test', [LoginController::class, 'test']);
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:Super Admin']], function () {
    Route::resource('products', ProductController::class);

    /*** USERS ***/
    Route::get('admins', [UserController::class, 'indexAdmins']);
    Route::get('admins/create', [UserController::class, 'createAdmins']);
    Route::post('admins/create', [UserController::class, 'storeAdmins']);
    Route::get('admins/{user}/edit', [UserController::class, 'editAdmins']);
    Route::put('admins/{user}', [UserController::class, 'updateAdmin']);
    Route::delete('admins/{user}', [UserController::class, 'destroyAdmins']);
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:Super Admin|admin|shipping|marketing']], function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('users/all', [UserController::class, 'index']);

    /*** ORDERS ***/
    Route::get('orders/import', [OrderController::class, 'fileImportView']);
    Route::post('orders/import', [OrderController::class, 'fileImport'])->name('fileImport');
    Route::resource('orders', OrderController::class);


    /*** DISCOUNT COUPONS ***/
    Route::get('discount-coupons/generate', [DiscountCouponController::class, 'generateCouponsView']);
    Route::post('discount-coupons/generate', [DiscountCouponController::class, 'generateCoupons']);
    Route::resource('discount-coupons', DiscountCouponController::class);
});

