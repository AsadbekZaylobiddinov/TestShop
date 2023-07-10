<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


//User

Route::post('/user',[UserController::class, 'store']);

Route::get('/user/{id}',[UserController::class, 'show']);

Route::get('/user',[UserController::class,'index']);

Route::post('/user',[UserController::class, 'store']);

Route::put('/user/{id}',[UserController::class, 'update']);

Route::delete('/user/{id}',[UserController::class, 'destroy']);

//Cart

Route::get('/user/{id}/cart',[Cart::class, 'show']);

Route::post('/user/{id}/cart',[Cart::class,'store']);

Route::delete('/user/{id}/cart',[Cart::class,'destroy ']);

//Product

Route::middleware(['admin'])->group(function () {

    Route::post('/product',[ProductController::class, 'store']);

    Route::put('/product/{id}',[ProductController::class, 'update']);

    Route::delete('/product/{id}',[ProductController::class, 'destroy']);

    Route::post('/product-image',[ProductController::class,'uploadProductImage']);

    Route::delete('/product-image',[ProductController::class,'destroyProductImage']);
});

Route::get('/product/{id}',[ProductController::class, 'show']);

Route::get('/product',[ProductController::class,'index']);





//Category 

Route::middleware(['admin'])->group(function () {

Route::post('/category',[CategoryController::class,'store']);

Route::post('category/add-subcategory',[CategoryController::class,'addSubCategory']);

Route::delete('/category/{id}',[CategoryController::class,'destroy']);
}); 


Route::get('/category/{id}',[CategoryController::class,'show']);

Route::put('/category/{name}',[CategoryController::class,'update']);





