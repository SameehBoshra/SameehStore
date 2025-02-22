<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\LoginController;
use App\Http\Controllers\Dashboard\MainCategoryController;
use App\Http\Controllers\Dashboard\SubCategoryController;
use App\Http\Controllers\Dashboard\BrandController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\ShippingMethodController;
use App\Http\Controllers\Dashboard\TagController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\AttributeController;
use App\Http\Controllers\Dashboard\OptionController;
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


######################## route brands################
Route::group(['prefix'=>'brands'] , function()
{
    Route::get('/', [BrandController::class ,'index'])->name('dashboard.brands.index');
    Route::get('create', [BrandController::class ,'create'])->name('dashboard.brands.create');
    Route::post('store', [BrandController::class ,'store'])->name('dashboard.brands.store');
    Route::get('edit/{id}', [BrandController::class ,'edit'])->name('dashboard.brands.edit');
    Route::post('update/{id}', [BrandController::class ,'update'])->name('dashboard.brands.update');
    Route::get('destroy/{id}', [BrandController::class ,'destroy'])->name('dashboard.brands.destroy');

});
######################## end brands################

########################  tags################
    Route::group( ['prefix' => 'tags'] ,function()
    {
        Route::get('/', [TagController::class ,'index'])->name('dashboard.tags.index');
        Route::get('create', [TagController::class ,'create'])->name('dashboard.tags.create');
        Route::post('store', [TagController::class ,'store'])->name('dashboard.tags.store');
        Route::get('edit/{id}', [TagController::class ,'edit'])->name('dashboard.tags.edit');
        Route::post('update/{id}', [TagController::class ,'update'])->name('dashboard.tags.update');
        Route::get('destroy/{id}', [TagController::class ,'destroy'])->name('dashboard.tags.destroy');
    });
######################## end tags################


    ########################  Products################
    Route::group( ['prefix' => 'products'] ,function()
    {
        // general
        Route::get('/', [ProductController::class ,'index'])->name('dashboard.product.index');
        Route::post('store_general', [ProductController::class ,'store'])->name('dashboard.product.store_general.store');
         // price
        Route::get('price/{id}', [ProductController::class ,'priceCreate'])->name('dashboard.product.price.create');
        Route::post('price/{id}', [ProductController::class ,'storePrice'])->name('dashboard.product.price.store');
         // stock
        Route::get('stock/{id}', [ProductController::class ,'stockCreate'])->name('dashboard.product.stock.create');
        Route::post('stock/{id}', [ProductController::class ,'stockStore'])->name('dashboard.product.stock.store');
        // photo
        Route::get('photo/{id}', [ProductController::class ,'photoCreate'])->name('dashboard.product.photo.create');
        Route::post('photo/{id}', [ProductController::class , 'photoStore'])->name('dashboard.product.photo.store');

        Route::get('edit/{id}', [ProductController::class ,'edit'])->name('dashboard.product.edit');
        Route::post('update/{id}', [ProductController::class ,'update'])->name('dashboard.product.update');
        Route::get('destroy/{id}', [ProductController::class ,'destroy'])->name('dashboard.product.destroy');
        Route::get('general', [ProductController::class ,'create'])->name('dashboard.product.general.create');

    });
######################## end products################

########################  attributes ################
Route::group( ['prefix' => 'attributes'] ,function()
{
    Route::get('/', [AttributeController::class ,'index'])->name('dashboard.attribute.index');
    Route::get('create', [AttributeController::class ,'create'])->name('dashboard.attribute.create');
    Route::post('store', [AttributeController::class ,'store'])->name('dashboard.attribute.store');
    Route::get('edit/{id}', [AttributeController::class ,'edit'])->name('dashboard.attribute.edit');
    Route::post('update/{id}', [AttributeController::class ,'update'])->name('dashboard.attribute.update');
    Route::get('destroy/{id}', [AttributeController::class ,'destroy'])->name('dashboard.attribute.destroy');
});
######################## end attributes################

########################  options ################
Route::group( ['prefix' => 'options'] ,function()
{
    Route::get('/', [OptionController::class ,'index'])->name('dashboard.option.index');
    Route::get('create', [OptionController::class ,'create'])->name('dashboard.option.create');
    Route::post('store', [OptionController::class ,'store'])->name('dashboard.option.store');
    Route::get('edit/{id}', [OptionController::class ,'edit'])->name('dashboard.option.edit');
    Route::post('update/{id}', [OptionController::class ,'update'])->name('dashboard.option.update');
    Route::get('destroy/{id}', [OptionController::class ,'destroy'])->name('dashboard.option.destroy');
});
######################## end options################



});

//'middleware'=>'guest:admin' to redirect admin if he hogin with outh login

Route::group(['namespace'=>'Dashboard'  ,'prefix'=>'admin'] , function ()
{
    Route::get('login',[LoginController::class , 'login'])->name('admin.login');
    Route::post('postlogin',[LoginController::class , 'postlogin'])->name('admin.post.login');
});



    });
