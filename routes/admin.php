<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\LoginController;
use App\Http\Controllers\Dashboard\MainCategoryController;
use App\Http\Controllers\Dashboard\SubCategoryController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\ShippingMethodController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
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
/*
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ,'auth']
    ], function(){

Route::group(['namespace'=>'Dashboard' , 'middleware'=>'auth:admin' ,'perfix'=>'admin'] , function ()
{

    Route::get('index' , [DashboardController::class , 'index'])->name('dashboard.index');
});

//'middleware'=>'guegetRawOriginalst:admin' to redirect admin if he hogin with outh login

Route::group(['namespace'=>'Dashboard'  ,'prefix'=>'admin'] , function ()
{
    Route::get('loginadmin',[LoginController::class , 'login'])->name('admin.login');
    Route::post('postlogin',[LoginController::class , 'postlogin'])->name('admin.post.login');
});

});

 */
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){


Route::group(['namespace'=>'Dashboard' , 'middleware'=>'auth:admin' ,'perfix'=>'admin'] , function ()
{

    Route::get('index' , [DashboardController::class , 'index'])->name('dashboard.index');
    Route::get('logout' ,[LoginController::class , 'logout'])->name('admin.logout');

    Route::group(['prefix'=>'profile'] , function()
    {
        Route::get('edit-profile' ,[ProfileController::class , 'editProfile'])->name('edit.profile');
        Route::post('update-profile' ,[ProfileController::class , 'updateProfile'])->name('update.profile');

    });

    // route for seting shipping
    Route::group(['prefix'=>'settings'] , function()
    {
        Route::get('edit-Shipping-Method/{type}', [ShippingMethodController::class ,'editShippingMethod'])->name('editShippingMethod');
        Route::post('update-Shipping-Method/{id}', [ShippingMethodController::class ,'updateShippingMethod'])->name('updateShippingMethod11');

    });

######################## route category################
    Route::group(['prefix'=>'category'] , function()
    {
        Route::get('/', [MainCategoryController::class ,'index'])->name('dashboard.Category.index');
        Route::get('create', [MainCategoryController::class ,'create'])->name('dashboard.Category.create');
        Route::post('store', [MainCategoryController::class ,'store'])->name('dashboard.Category.store');
        Route::get('edit/{id}', [MainCategoryController::class ,'edit'])->name('dashboard.Category.edit');
        Route::post('update/{id}', [MainCategoryController::class ,'update'])->name('dashboard.Category.update');
        Route::get('destroy/{id}', [MainCategoryController::class ,'destroy'])->name('dashboard.category.destroy');

    });
######################## end category################


######################## route subcategory################
Route::group(['prefix'=>'subCategory'] , function()
{
    Route::get('/', [SubCategoryController::class ,'index'])->name('dashboard.Sub.Category.index');
    Route::get('create', [SubCategoryController::class ,'create'])->name('dashboard.Sub.Category.create');
    Route::post('store', [SubCategoryController::class ,'store'])->name('dashboard.Sub.Category.store');
    Route::get('edit/{id}', [SubCategoryController::class ,'edit'])->name('dashboard.Sub.Category.edit');
    Route::post('update/{id}', [SubCategoryController::class ,'update'])->name('dashboard.Sub.Category.update');
    Route::get('destroy/{id}', [SubCategoryController::class ,'destroy'])->name('dashboard.Sub.Category.destroy');

});
######################## end subcategory################








});

//'middleware'=>'guest:admin' to redirect admin if he hogin with outh login

Route::group(['namespace'=>'Dashboard'  ,'prefix'=>'admin'] , function ()
{
    Route::get('login',[LoginController::class , 'login'])->name('admin.login');
    Route::post('postlogin',[LoginController::class , 'postlogin'])->name('admin.post.login');
});





        Route::get('/', function () {
            return view('welcome');
        });




    });
