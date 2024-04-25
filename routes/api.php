<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CodeController;
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
    Route::get('getAuthUser','getAuthUser');
    Route::put('updateProfil/{user}','updateProfil');
    Route::put('changePasswd/{user}','changePasswd');
});

Route::controller(ProductController::class)->group(function(){
        Route::get('get_products','get_products');
        Route::get('get_product/{id}','get_product');
        Route::get('get_related_products/{categoryId}/{currentProductId}','get_related_products');
        Route::post('store_user_products','store_user_products');

        Route::post('storeProduct','store');
        Route::put('updateProduct/{id}','update');
        Route::delete('destroyProduct/{id}','destroy');
});

Route::controller(CategoryController::class)->group(function(){
        Route::get('get_categories','get_categories');
        Route::get('get_category_products/{nameCategory}','get_category_products');

        Route::post('storeCategory','store');
        Route::get('editCategory/{id}','edit');
        Route::put('updateCategory/{id}','update');
        Route::delete('destroyCategory/{id}','destroy');
});
Route::controller(CodeController::class)->group(function(){
    Route::get('get_codes','get_codes');
    Route::post('storeCode','store');
    Route::get('editCode/{id}','edit');
    Route::put('updateCode/{id}','update');
    Route::delete('destroyCode/{id}','destroy');

});


