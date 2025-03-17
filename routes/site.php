<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\WishlistController;
use App\Http\Controllers\Site\CategoryController;
use App\Http\Controllers\Site\CartController;
use App\Http\Controllers\Site\ProductController;
use App\Http\Controllers\Site\VerificationCodeController;
use App\Http\Controllers\Site\CartTestController;
use App\Models\WishList;
use Illuminate\Support\Facades\Auth;
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
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'  ]
    ], function(){

        route::get('/', [HomeController::class ,'home'])->name('home')->middleware('verifiedUser');


        route::get('category/{slug}', [CategoryController::class ,'productsBySlug'])->name('category');
        route::get('product/{slug}', [ProductController::class ,'productsBySlug'])->name('product.details');

        Route::get('profile', function () {
            return 'auth';
        });
    Route::middleware(['web'])->group(function () {
        Auth::routes();
    });


     /**
         *  Cart routes
         */
        Route::group(['prefix' => 'cart'], function () {

            Route::get('/', [CartController::class,'index'])->name('site.cart.index');
            Route::post('/cart/add', [CartController::class, 'postAdd'])->name('site.cart.add');
            Route::post('/update/{slug}', [CartController::class ,'update'])->name('site.cart.update');
            Route::post('/update-all', [CartController::class,'postUpdateAll'])->name('site.cart.update-all');
        });



Route::group(['namespace'=>'Site' , 'middleware'=>['auth'] ,'perfix'=>'site'] , function ()
{
    Route::post('verify_usee' ,[VerificationCodeController::class , 'verify'])->name('verifyUser');
    Route::get('verify' ,[VerificationCodeController::class , 'getVerifyPage'])->name('get.verification.form');

});

Route::group(['namespace' => 'Site', 'middleware' => 'auth'], function () {
    Route::post('/category/wishlist/add', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
    Route::post('wishlist', [WishlistController::class ,'store'])->name('wishlist.store');
    Route::delete('wishlist', [WishlistController::class,'destroy'])->name('wishlist.destroy');
    Route::get('wishlist/products', [WishlistController::class ,'index'])->name('wishlist.products.index');

});








    });





