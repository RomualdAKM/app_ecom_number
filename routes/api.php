<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function(){
    Route::post('register','register');
    Route::post('login','login');
});

Route::controller(ProductController::class)->group(function(){
        Route::get('get_products','get_products');
        Route::get('get_product/{id}','get_product');
        Route::get('get_related_products/{categoryId}/{currentProductId}','get_related_products');
});

Route::controller(CategoryController::class)->group(function(){
        Route::get('get_categories','get_categories');
        Route::get('get_category_products/{nameCategory}','get_category_products');
});
