<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// header('Access-Control-Allow-Origin : *');
// header('Access-Control-Allow-Headers : Content-Type,X-Auth-Token,Authorization,Origin');
// header('Access-Control-Allow-Methods :GET, POST, PUT, DELETE, OPTIONS');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ->middleware('AuthCheckApi');
Route::namespace('App\Http\Controllers\Api')->group(function() {

    Route::get('get-categories','ProductController@getCategories');
    Route::get('get-products','ProductController@getProducts');
    Route::get('get-category-products/{id}','ProductController@getCategoryProduct');
    Route::get('get-product/{id}','ProductController@getProduct');

    //Feature Product API
    Route::get('popular','ProductController@getpopular');
    Route::get('featured','ProductController@getfeatured');
    Route::get('bestseller','ProductController@getbestseller');
    Route::get('dealsday','ProductController@getdealsday');

    //Contact Us
    Route::post('contact-us','ContactController@addContact');
    //Subscriber
    Route::post('subscriber','ContactController@addSubscriber');


    //Customer api
    Route::post('register-customer','CustomerController@registerCustomer');
    Route::post('customer/login','CustomerController@login');
    Route::post('customer/logout','CustomerController@logout');
    Route::match(['get','post'],'get-edit-customer/{id?}','CustomerController@getEditCustomer')->middleware('AuthCheckApi');
    Route::post('customer/change-password','CustomerController@changePassPost')->middleware('AuthCheckApi');
    Route::get('get-customer-addresses/{customer_id}','CustomerController@getCustomerAddresses')->middleware('AuthCheckApi');
    Route::get('add-customer-addresses/{customer_id}','CustomerController@addCustomerAddresses')->middleware('AuthCheckApi');

    //Order Api
    Route::post('order','OrderController@order');
    Route::get('get-customer-orders/{customer_id}','OrderController@getCustomerOrders')->middleware('AuthCheckApi');
    // ->middleware('AuthCheckApi')

    //shipping Charges 
    Route::get('get-shipping-charges','GeneralController@getShippingCharges');
    //shipping Zones 
    Route::get('get-shipping-zones','GeneralController@getShippingZones');

    //FAQs 
    Route::get('get-faqs','GeneralController@getFaqs');


    // Contents
    //Homepage Banner
    Route::get('homepage-banner','PagemanagementController@hompageBanner');
    //Homepage Advertisement
    Route::get('homepage-advertisement','PagemanagementController@homepageAdvertisement');
    //Footer Banner
    Route::get('footer-banner','PagemanagementController@footerBanner');
    //Footer Advertisement
    Route::get('footer-advertisement','PagemanagementController@footerAdvertisement');
    //Social media
    Route::get('social-media','PagemanagementController@socialMediaManagement');
    //Footer Management
    Route::get('footer-management','PagemanagementController@footerManagement');
    // END Frontend management

});