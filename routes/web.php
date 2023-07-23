<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;
use  App\Http\Controllers\UserListController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//login , register  ,first a user start /  ,a website firstly show a loginPage or registerPage
Route::middleware(['admin_auth'])->group(function(){
    Route::redirect('/', 'loginPage');
    Route::get('loginPage', [AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');
});

//check a user whether has been loginned or registered,if done,may allow following link
Route::middleware(['auth'])->group(function () {

    //dashboard, if a user login or register has been loginned or registered,a user go to what page,if user user homepage ,if admin admin homepage
    Route::get('/dashboard',[CategoryController::class,'dashboard']);

    //admin auth
    Route::middleware(['admin_auth'])->group(function(){

        //category
        Route::prefix('category')->group(function(){
            Route::get('list',[CategoryController::class,'list'])->name('category#list');
            Route::get('create',[CategoryController::class,'create'])->name('category#create');
            Route::post('store',[CategoryController::class,'store'])->name('category#store');

            Route::get('delete/{id}', [CategoryController::class,'destroy'])->name('category#delete');

            Route::get('show/{id}', [CategoryController::class,'show'])->name('category#show');

            Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');

            Route::post('update',[CategoryController::class,'update'])->name('category#update');
        });
        //admin account
        Route::prefix('admin')->group(function(){
            //password
            Route::get('changePasswordPage',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('changePassword',[AdminController::class,'changePassword'])->name('admin#changePassword');

            // account info
            Route::get('accountInfo',[AdminController::class,'accountInfo'])->name('admin#accountInfo');
            Route::get('editProfilePage',[AdminController::class,'editProfilePage'])->name('admin#editProfilePage');
            Route::post('updateProfile',[AdminController::class,'updateProfile'])->name('admin#updateProfile');

            //admin list
            Route::get('list',[AdminController::class,'list'])->name('admin#list');
            Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
            Route::get('changeRole/{id}',[AdminController::class,'changeRole'])->name('admin#changeRole');
            Route::post('updateRole/{id}',[AdminController::class,'updateRole'])->name('admin#updateRole');
        });

        //admin product
       Route::prefix('product')->group(function(){
        Route::get('list',[ProductController::class,'index'])->name('product#list');
        Route::get('create',[ProductController::class,'create'])->name('product#create');
        Route::post('store',[ProductController::class,'store'])->name('product#store');
        Route::get('show/{id}',[ProductController::class,'show'])->name('product#show');
        Route::get('edit/{id}',[ProductController::class,'edit'])->name('product#edit');
        Route::post('update/{id}',[ProductController::class,'update'])->name('product#update');
        Route::get('delete/{id}',[ProductController::class,'destroy'])->name('product#delete');
       });

       // admin  can mange order
       Route::prefix('order')->group(function(){
            Route::get('list',[OrderController::class,'index'])->name('order#list');
            Route::get('status/change',[OrderController::class,'statusChange'])->name('order#statusChange');
            Route::get('status/changeDb',[OrderController::class,'statusChangeDb'])->name('order#statusChangeDb');
            Route::get('product/list/{order_code}',[OrderController::class,'productList'])->name('order#productList');
       });

       // admin can mange users
       Route::prefix('user')->group(function(){
            Route::get('list', [UserListController::class,'list'])->name('user#list');
            Route::get('ajax/change/role', [UserListController::class,'changeRole'])->name('user#changeRole');
            Route::get('ajax/deleteUser', [UserListController::class,'deleteUser'])->name('user#deleteUser');
            Route::get('edit/profile/{id}', [UserListController::class,'editUser'])->name('user#editUser');
            Route::post('update/profile/', [UserListController::class,'updateUser'])->name('user#updateUser');
       });

       //admin can mange  user contact lists
       Route::prefix('contact')->group(function(){
        Route::get('list',[ContactController::class,'list'])->name('user#contactList');
        Route::get('ajax/delete',[ContactController::class,'ajaxDelete'])->name('user#ajaxDelete');
        Route::get('ajax/edit',[ContactController::class,'ajaxEdit'])->name('user#ajaxEdit');
       });

    });


    // //user
    // Route::group(['prefix'=>'user','middleware'=>'user_auth'],function(){
    //     Route::get('/home', function () {
    //         return view('user.home');
    //     })->name('user#home');
    // });

    //user auth domain
    Route::middleware('user_auth')->group(function(){
        Route::prefix('user')->group(function(){
          Route::get('/home',[UserController::class,'home'])->name('user#home');

            //password
            Route::prefix('password')->group(function(){
                Route::get('changePassword',[UserController::class,'changePasswordPage'])->name('user#changePasswordPage');
                Route::post('changePassword',[UserController::class,'changePassword'])->name('user#changePassword');
            });

            //account
            Route::prefix('account')->group(function(){
                Route::get('accountInfo',[UserController::class,'accountInfo'])->name('user#accountInfo');
                Route::get('editProfile',[UserController::class,'editProfilePage'])->name('user#editProfilePage');
                Route::post('editProfile',[UserController::class,'editProfile'])->name('user#editProfile');
            });

            // filter by Category Name
            Route::prefix('filter')->group(function(){
                Route::get('product/{id}',[UserController::class,'filter'])->name('user#filter');
            });

            //pizza detail
            Route::prefix('pizza')->group(function(){
                Route::get('detail/{id}',[UserController::class,'pizzaDetail'])->name('user#pizzaDetail');
            });

            //user ajax
            Route::prefix('ajax')->group(function(){
                Route::get('pizzaList', [AjaxController::class,'pizzaList'])->name('ajax#pizzaList');
                Route::get('addCart',[AjaxController::class,'addCart'])->name('ajax#addCart');
                Route::get('orderList',[AjaxController::class,'orderList'])->name('ajax#orderList');
                Route::get('btnRemove',[AjaxController::class,'btnRemove'])->name('ajax#btnRemove');
                Route::get('btnCartClear',[AjaxController::class,'btnCartClear'])->name('ajax#btnCartClear');
                Route::get('addViewCount',[AjaxController::class,'addViewCount'])->name('ajax#addViewCount');

            });

            //cart
            Route::prefix('cart')->group(function(){
                Route::get('list',[UserController::class,'cartList'])->name('user#cartList');
                Route::get('history',[UserController::class,'history'])->name('user#history');
            });

            //myCart list
             Route::get('myCart',[UserController::class,'myCart'])->name('user#myCart');

            //contact
            Route::get('/contact',[ContactController::class,'contactPage'])->name('user#contactPage');
            Route::post('/contact',[ContactController::class,'contact'])->name('user#contact');
        });
    });

});