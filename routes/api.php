<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::apiResource('task', App\Http\Controllers\TaskController::class);


Route::apiResource('task', App\Http\Controllers\TaskController::class);

Route::apiResource('category', App\Http\Controllers\CategoryController::class);

Route::apiResource('product', App\Http\Controllers\ProductController::class);

Route::apiResource('shop', App\Http\Controllers\ShopController::class);

Route::apiResource('like', App\Http\Controllers\LikeController::class);

Route::apiResource('favorite', App\Http\Controllers\FavoriteController::class);

Route::apiResource('image', App\Http\Controllers\ImageController::class);

Route::apiResource('order', App\Http\Controllers\OrderController::class);

Route::apiResource('setting', App\Http\Controllers\SettingController::class);
