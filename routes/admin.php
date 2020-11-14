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
            
             ## Branches Routes 
             Route::group(['namespace' =>'Branches','prefix' => 'branches'], function () {
                Route::get('/','BranchController@index')->name('admin.branches');
                Route::get('/create','BranchController@create')->name('admin.branches.create');
                Route::post('/','BranchController@store')->name('admin.branches.store');
                Route::get('/show/{id}','BranchController@show')->name('admin.branches.show');
                Route::get('/edit/{id}','BranchController@edit')->name('admin.branches.edit');
                Route::put('/{id}','BranchController@update')->name('admin.branches.update');
                Route::get('delete/{id}','BranchController@destroy')->name('admin.branches.delete');
            });
            ## end Branches Routes 

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

             ## Suppliers Routes 
             Route::group(['namespace' =>'Suppliers','prefix' => 'suppliers'], function () {
                Route::get('/','SupplierController@index')->name('admin.suppliers');
                Route::get('/create','SupplierController@create')->name('admin.suppliers.create');
                Route::post('/','SupplierController@store')->name('admin.suppliers.store');
                Route::get('/show/{id}','SupplierController@show')->name('admin.suppliers.show');
                Route::get('/edit/{id}','SupplierController@edit')->name('admin.suppliers.edit');
                Route::put('/{id}','SupplierController@update')->name('admin.suppliers.update');
                Route::get('delete/{id}','SupplierController@destroy')->name('admin.suppliers.delete');
            });
            ## end Suppliers Routes 

             ## Clients Routes 
             Route::group(['namespace' =>'Clients','prefix' => 'clients'], function () {
                Route::get('/','ClientController@index')->name('admin.clients');
                Route::get('/create','ClientController@create')->name('admin.clients.create');
                Route::post('/','ClientController@store')->name('admin.clients.store');
                Route::get('/show/{id}','ClientController@show')->name('admin.clients.show');
                Route::get('/edit/{id}','ClientController@edit')->name('admin.clients.edit');
                Route::put('/{id}','ClientController@update')->name('admin.clients.update');
                Route::get('delete/{id}','ClientController@destroy')->name('admin.clients.delete');
            });
            ## end Clients Routes 

             ## Employees Routes 
             Route::group(['namespace' =>'Employees','prefix' => 'employees'], function () {
                Route::get('/','EmployeeController@index')->name('admin.employees');
                Route::get('/create','EmployeeController@create')->name('admin.employees.create');
                Route::post('/','EmployeeController@store')->name('admin.employees.store');
                Route::get('/show/{id}','EmployeeController@show')->name('admin.employees.show');
                Route::get('/edit/{id}','EmployeeController@edit')->name('admin.employees.edit');
                Route::put('/{id}','EmployeeController@update')->name('admin.employees.update');
                Route::get('delete/{id}','EmployeeController@destroy')->name('admin.employees.delete');
            });
            ## end Employees Routes 

            ## Invoices Routes 
            Route::group(['namespace' =>'Invoices','prefix' => 'invoices'], function () {
                Route::get('/','InvoiecController@index')->name('admin.invoices');

                Route::get('/create','InvoiecController@create')->name('admin.invoices.create');
                Route::post('/','InvoiecController@store')->name('admin.invoices.store');
                Route::get('/show/{id}','InvoiecController@show')->name('admin.invoices.show');
                Route::get('/edit/{id}','InvoiecController@edit')->name('admin.invoices.edit');
                Route::put('/{id}','InvoiecController@update')->name('admin.invoices.update');
                Route::put('/{id}','InvoiecController@update')->name('admin.invoices.update');
                Route::get('delete/{id}','InvoiecController@destroy')->name('admin.invoices.delete');


                Route::get('/show_product/{id}','InvoiecController@showProduct')->name('admin.invoices.showProduct');
                Route::post('/add_product/{id}','InvoiecController@addProduct')->name('admin.invoices.addProduct');
                Route::get('/remove_product/{id}/{product_id}','InvoiecController@removeProduct')->name('admin.invoices.removeProduct');
                Route::get('/finish_invoice/{id}','InvoiecController@finish')->name('admin.invoices.finish');
            });
            ## end Invoices Routes 

             ## Invoice Employees Routes 
             Route::group(['namespace' =>'Invoices','prefix' => 'employeesInvoice'], function () {
                Route::get('/','EmployeeInvoiecController@index')->name('admin.employeesInvoice');
                Route::get('/create','EmployeeInvoiecController@create')->name('admin.employeesInvoice.create');
                Route::post('/','EmployeeInvoiecController@store')->name('admin.employeesInvoice.store');
                Route::get('/edit/{id}','EmployeeInvoiecController@edit')->name('admin.employeesInvoice.edit');
                Route::put('/{id}','EmployeeInvoiecController@update')->name('admin.employeesInvoice.update');
                Route::get('delete/{id}','EmployeeInvoiecController@destroy')->name('admin.employeesInvoice.delete');
            });
            ## end Invoice Employees Routes 


            ## Invoice Suppliers Routes 
            Route::group(['namespace' =>'Invoices','prefix' => 'suppliersInvoice'], function () {
                Route::get('/','SupplierInvoiecController@index')->name('admin.suppliersInvoice');
                Route::get('/create','SupplierInvoiecController@create')->name('admin.suppliersInvoice.create');
                Route::post('/','SupplierInvoiecController@store')->name('admin.suppliersInvoice.store');
                Route::get('/edit/{id}','SupplierInvoiecController@edit')->name('admin.suppliersInvoice.edit');
                Route::put('/{id}','SupplierInvoiecController@update')->name('admin.suppliersInvoice.update');
                Route::get('delete/{id}','SupplierInvoiecController@destroy')->name('admin.suppliersInvoice.delete');
            });
            ## end Invoice Suppliers Routes 

            ## Users Routes 

            Route::group(['namespace' =>'User','prefix' => 'profile'], function () {
                Route::get('/','UserController@edit')->name('admin.user.edit');
                Route::put('/','UserController@update')->name('admin.user.update');
            });

            ## end Users Routes

            
            
        });
        
});


