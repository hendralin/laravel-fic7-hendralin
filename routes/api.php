<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UploadController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\PaymentCallbackController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('image/upload', [UploadController::class, 'uploadImage'])->middleware('auth:sanctum');
Route::post('image/upload-multiple', [UploadController::class, 'uploadMultipleImage'])->middleware('auth:sanctum');

Route::post('orders', [OrderController::class, 'order'])->middleware('auth:sanctum');

Route::post('midtrans/notification/handling', [PaymentCallbackController::class, 'callback']);

Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class);
