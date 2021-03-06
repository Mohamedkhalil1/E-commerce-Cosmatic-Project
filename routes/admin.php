<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

#define('PAGINATION_COUNT',5);
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ 

        
    Route::group(['namespace' =>'Admin','prefix' =>'admin'], function () {
        Route::get('/login','LoginController@getLogin')->name('get.admin.login');
        Route::post('/login','LoginController@Login')->name('admin.login');
        Route::get('/logout','LoginController@Logout')->name('admin.logout');
    });


    Route::group(['namespace' =>'Admin','middleware' => 'auth:admin','prefix' =>'admin'], function () {
            Route::get('/', 'DashboardController@index')->name('admin.dashboard');

            ## Shipping Routes 
            Route::group(['prefix' => 'settings'], function () {
                Route::get('shipping-methods/{type}','SettingsController@editShippingMethod')->name('edit.shipping.methods');
                Route::post('shipping-methods/{id}','SettingsController@updateShippingMethod')->name('update.shipping.methods');
            });
            ## end Shipping Routes
            
             ## Categories Routes 
             Route::group(['namespace' =>'Category','prefix' => 'categories'], function () {
                Route::get('/','CategoryController@index')->name('admin.categories');
                Route::get('/create','CategoryController@create')->name('admin.categories.create');
                Route::get('/{id}','CategoryController@show')->name('admin.categories.show');
                Route::post('/','CategoryController@store')->name('admin.categories.store');
                Route::get('/show/{id}','CategoryController@show')->name('admin.categories.show');
                Route::get('/edit/{id}','CategoryController@edit')->name('admin.categories.edit');
                Route::put('/{id}','CategoryController@update')->name('admin.categories.update');
                Route::get('delete/{id}','CategoryController@destroy')->name('admin.categories.delete');
            });
            ## end Categories Routes 

             ## Products Routes 
             Route::group(['namespace' =>'Products','prefix' => 'products'], function () {
                Route::get('/','ProductController@index')->name('admin.products');
                Route::get('/create','ProductController@create')->name('admin.products.create');
                Route::post('/','ProductController@store')->name('admin.products.store');
                Route::get('/edit/{id}','ProductController@edit')->name('admin.products.edit');
                Route::put('/{id}','ProductController@update')->name('admin.products.update');
                Route::get('delete/{id}','ProductController@destroy')->name('admin.products.delete');
            });
            ## end Produts Routes 

             ## SubCategory Routes 
             Route::group(['namespace' =>'Category','prefix' => 'subcategories'], function () {
                Route::get('/','SubCategoryController@index')->name('admin.subcategories');
                Route::get('/create','SubCategoryController@create')->name('admin.subcategories.create');
                Route::get('/{id}','SubCategoryController@show')->name('admin.subcategories.show');
                Route::post('/','SubCategoryController@store')->name('admin.subcategories.store');
                Route::get('/show/{id}','SubCategoryController@show')->name('admin.subcategories.show');
                Route::get('/edit/{id}','SubCategoryController@edit')->name('admin.subcategories.edit');
                Route::put('/{id}','SubCategoryController@update')->name('admin.subcategories.update');
                Route::get('delete/{id}','SubCategoryController@destroy')->name('admin.subcategories.delete');
            });
            ## end SubCategory Routes 

             ## Brand Routes 
             Route::group(['namespace' =>'Brand','prefix' => 'brand'], function () {
                Route::get('/','BrandController@index')->name('admin.brands');
                Route::get('/create','BrandController@create')->name('admin.brands.create');
                Route::get('/{id}','BrandController@show')->name('admin.brands.show');
                Route::post('/','BrandController@store')->name('admin.brands.store');
                Route::get('/show/{id}','BrandController@show')->name('admin.brands.show');
                Route::get('/edit/{id}','BrandController@edit')->name('admin.brands.edit');
                Route::put('/{id}','BrandController@update')->name('admin.brands.update');
                Route::get('delete/{id}','BrandController@destroy')->name('admin.brands.delete');
            });
            ## end Brand Routes 

             ## Divisions Routes 
             Route::group(['namespace' =>'Division','prefix' => 'divisions'], function () {
                Route::get('/','DivisionController@index')->name('admin.divisions');
                Route::get('/create','DivisionController@create')->name('admin.divisions.create');
                Route::get('/{id}','DivisionController@show')->name('admin.divisions.show');
                Route::post('/','DivisionController@store')->name('admin.divisions.store');
                Route::get('/show/{id}','DivisionController@show')->name('admin.divisions.show');
                Route::get('/edit/{id}','DivisionController@edit')->name('admin.divisions.edit');
                Route::put('/{id}','DivisionController@update')->name('admin.divisions.update');
                Route::get('delete/{id}','DivisionController@destroy')->name('admin.divisions.delete');
            });
            ## end Divisions Routes 


             ## Clients Routes 
             Route::group(['namespace' =>'Client','prefix' => 'clients'], function () {
                Route::get('/','ClientController@index')->name('admin.clients');
                Route::get('/create','ClientController@create')->name('admin.clients.create');
                Route::get('/{id}','ClientController@show')->name('admin.clients.show');
                Route::post('/','ClientController@store')->name('admin.clients.store');
                Route::get('/edit/{id}','ClientController@edit')->name('admin.clients.edit');
                Route::put('/{id}','ClientController@update')->name('admin.clients.update');
                Route::get('delete/{id}','ClientController@destroy')->name('admin.clients.delete');
            });
            ## end Clients Routes 


            ## Order Routes 
            Route::group(['namespace' =>'Order','prefix' => 'orders'], function () {
                Route::get('/','OrderController@index')->name('admin.orders');
                Route::get('/show/{id}','OrderController@show')->name('admin.orders.show');
               
                Route::get('/change-status/{id}','OrderController@changeStatus')->name('admin.orders.status');
                
            });
            ## end Order Routes 

            ## Users Routes 

            Route::group(['namespace' =>'User','prefix' => 'profile'], function () {
                Route::get('/','UserController@edit')->name('admin.user.edit');
                Route::put('/','UserController@update')->name('admin.user.update');
            });

            ## end Users Routes


            ## Ads Routes 
            Route::group(['namespace' =>'Ad','prefix' => 'ads'], function () {
                Route::get('/','AdController@index')->name('admin.ads');
                Route::get('/create','AdController@create')->name('admin.ads.create');
                Route::get('/{id}','AdController@show')->name('admin.ads.show');
                Route::post('/','AdController@store')->name('admin.ads.store');
                Route::get('/edit/{id}','AdController@edit')->name('admin.ads.edit');
                Route::put('/{id}','AdController@update')->name('admin.ads.update');
                Route::get('delete/{id}','AdController@destroy')->name('admin.ads.delete');

                
                Route::get('/products/{id}','AdController@products')->name('admin.ads.products');
                Route::get('/products/{id}/{product_id}','AdController@addProduct')->name('admin.ads.products.add');
                Route::get('/products/remove/{id}/{product_id}','AdController@removeProduct')->name('admin.ads.products.remove');
               
            });
            ## end Ads Routes
            

            ## Codes Routes 
            Route::group(['namespace' =>'Code','prefix' => 'codes'], function () {
                Route::get('/','CodeController@index')->name('admin.codes');
                Route::get('/create','CodeController@create')->name('admin.codes.create');
                Route::post('/','CodeController@store')->name('admin.codes.store');
                Route::get('/edit/{id}','CodeController@edit')->name('admin.codes.edit');
                Route::put('/{id}','CodeController@update')->name('admin.codes.update');
                Route::get('delete/{id}','CodeController@destroy')->name('admin.codes.delete');
            });
            ## end Codes Routes


            ## Shippings Routes 
            Route::group(['namespace' =>'Shipping','prefix' => 'shippings'], function () {
                Route::get('/','ShippingController@index')->name('admin.shippings');
                Route::get('/create','ShippingController@create')->name('admin.shippings.create');
                Route::post('/','ShippingController@store')->name('admin.shippings.store');
                Route::get('/edit/{id}','ShippingController@edit')->name('admin.shippings.edit');
                Route::put('/{id}','ShippingController@update')->name('admin.shippings.update');
                Route::get('delete/{id}','ShippingController@destroy')->name('admin.shippings.delete');
            });
            ## end Shippings Routes


            ## Contact US Routes 
            Route::group(['namespace' =>'Contact','prefix' => 'contactus'], function () {
                Route::get('/','ContactUsController@index')->name('admin.contactus');
            });
            ## end Contact US Routes


            
            
        });
        
});


