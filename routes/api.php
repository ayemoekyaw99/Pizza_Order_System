<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;

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

//category
    Route::get('category/list',[CategoryController::class,'categoryList']);
    Route::get('category/list/{id}',[CategoryController::class,'categoryListById']);

    Route::post('create/category',[CategoryController::class,'createCategory']);

    Route::post('delete/category',[CategoryController::class,'deleteCategory']);
    Route::get('delete/category/{id}',[CategoryController::class,'deleteCategoryById']);

    Route::post('update/category',[CategoryController::class,'updateCategory']);



//product
    Route::get('product/list',[ProductController::class,'productList']);
    Route::get('product/list/{id}',[ProductController::class,'productListById']);

    Route::post('product/create',[ProductController::class,'createProduct']);

/**
 *
 * api for another application or language
 *
 *
 *   for category
 *   http://127.0.0.1:8000/api/category/list  (get)
 *   http://127.0.0.1:8000/api/category/list/{id}  (get)
 *
 *   http://127.0.0.1:8000/api/create/category (post)
 *
 *   http://127.0.0.1:8000/api/delete/category (post)
 *   http://127.0.0.1:8000/api/delete/category/{id} (get)
 *
 *   http://127.0.0.1:8000/api/update/category (post) (key)=>(name),(id)
 *
 *
 *  for product call in postman this link
 *   http://127.0.0.1:8000/api/product/list
 *
 *


 *
 *
 *
 *
 *
 *
 *
 *

 */
