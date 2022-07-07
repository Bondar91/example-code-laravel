<?php

use App\Http\Controllers\API\LocationController;
use App\Http\Controllers\API\ShipmentMethodController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\DiscountCouponController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\FormController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\TpayController;
use App\Http\Controllers\API\PaypalController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'admin'], function () {
    Route::put('order/{order}/payment-status/update', [OrderController::class, 'updatePaymentStatus']);
    Route::post('user', [UserController::class, 'store']);
    Route::post('user/{user}/edit', [UserController::class, 'update']);
});

Route::post('form/update/order', [FormController::class, 'updateOrder']);
Route::post('form/create/user', [FormController::class, 'createAddress']);


