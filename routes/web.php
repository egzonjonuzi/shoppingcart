<?php

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

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', 'AdminController@index')->name('admin');
    Route::get('/admin/shipping', 'AdminController@get_shipping')->name('admin_shipping');
    Route::post('/admin/shipping', 'AdminController@post_add_shipping_fee')->name('admin_shipping');
    Route::get('/admin/payment', 'AdminController@get_payment')->name('admin_payment');
    Route::post('/admin/payment', 'AdminController@post_add_payment_fee');



    Route::post('/admin/shipping_method_add', 'AdminController@post_add_shipping_method')->name('admin_shipping_method_add');
    Route::post('/admin/payment_method_add', 'AdminController@post_add_payment_method')->name('admin_payment_method_add');



});

Route::get('/shopping/email', 'MailController@basic_email');

Route::resource('/', 'ShoppingController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Shopping
Route::group(array('prefix' => 'shopping'), function () {

    Route::get('/', 'ShoppingController@get_shopping_products')->name('products');
    Route::post('/', 'ShoppingController@post_shopping_products')->name('products_post');

    Route::get('/contact', 'ShoppingController@get_shopping_client_information')->name('contact');
    Route::post('/contact', 'ShoppingController@post_shopping_client_information')->name('contact_post');

    Route::get('/address', 'ShoppingController@get_shopping_client_address')->name('address');
    Route::post('/address', 'ShoppingController@post_shopping_client_address')->name('address_post');

    Route::get('/shipping', 'ShoppingController@get_shopping_shipping_information')->name('shipping');
    Route::post('/shipping', 'ShoppingController@post_shopping_shipping_information')->name('shipping_post');

    Route::get('/payment', 'ShoppingController@get_shopping_payment_information')->name('payment');
    Route::post('/payment', 'ShoppingController@post_shopping_payment_information')->name('payment_post');

    Route::get('/overall', 'ShoppingController@get_shopping_summary_information')->name('overall');
    Route::post('/overall', 'ShoppingController@post_shopping_summary_information')->name('overall_post');

    Route::get('/complete', 'ShoppingController@get_shopping_order_complete')->name('complete');

});