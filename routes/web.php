<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

//Home Page
Route::get('/home', 'HomeController@index')->name('home');

//Frontend Route
Route::get('list/products', 'productController@productsList')->name('productsList');

//Cart
Route::get('add-to-cart/{id}', 'ProductController@addToCart')->name('addToCart');
Route::get('cart', 'ProductController@cart')->name('cart');
Route::patch('update/cart', 'ProductController@updateCart')->name('updateCart');


//Checkout
Route::get('checkout', 'ProductController@checkout')->name('checkout');

//Backend Route
Route::group(['prefix' => 'admin'], function(){
    //Admin Login,Logout route
    Route::get('/', 'Admin\UserController@loginView')->name('loginView');
    Route::get('login', 'Admin\UserController@loginView')->name('loginView');
    Route::get('logout','Admin\UserController@logout')->name('adminLogout');
    Route::post('login', 'Admin\UserController@login')->name('adminLogin');
});
Route::group(['prefix' => 'admin','middleware' => ['auth']],function(){
    //Admin dahsborad
    Route::get('dashboard', 'Admin\DashboardController@index')->name('adminDashboard');

    //Admin Product Module
    Route::get('products', 'Admin\ProductController@index')->name('adminProduct');
    Route::get('product/add', 'Admin\ProductController@addProduct')->name('addProduct');
    Route::post('product/store', 'Admin\ProductController@storeProduct')->name('storeProduct');

    //Admin Order Module
    Route::get('orders', 'Admin\OrderController@index')->name('adminOrder');
});
Auth::routes();


