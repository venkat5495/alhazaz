<?php

use Illuminate\Http\Request;

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



/*Route::group(['prefix' => 'user'], function () {

    Route::post('login', 'Api\AuthController@login');
    Route::post('logout', 'Api\AuthController@logout');
    Route::post('refresh', 'Api\AuthController@refresh');
    Route::post('me', 'Api\AuthController@me');

}); */
Route::post('device/register', 'HomeController@register');
// Auth API
Route::group(['middleware' => ['localization']], function () {
    // Phase 1
    Route::post('/login', 'Api\LoginController@login');
    Route::post('/register', 'Api\LoginController@register');
    Route::post('/accountverify', 'Api\LoginController@accountverify');
    Route::post('/setpassword', 'Api\LoginController@setpassword');
    Route::post('/resendotp', 'Api\LoginController@resendotp');
    Route::post('/resetpassword', 'Api\LoginController@resendotp');
    Route::post('/selectprofile', 'Api\LoginController@selectprofile');

    // Phase 2
    Route::get('/gethomepage', 'Api\CategoryController@gethomepage');
    Route::get('/getbrandandcat', 'Api\CategoryController@getbrandandcat');
    Route::post('/getcatsproducts', 'Api\CategoryController@getcatsproducts');
    Route::post('/getmoreproducts', 'Api\CategoryController@more_products_brand_subcategory');
    Route::post('/getbrandproducts', 'Api\CategoryController@getbrandproducts');
    Route::post('/getproductdetails', 'Api\CategoryController@getproductdetails');
    Route::post('/getsearchproduct', 'Api\CategoryController@getsearchproduct');
    Route::post('/getsearchbarcode', 'Api\CategoryController@getsearchbarcode');
    Route::get('/filterleftmenu',  'Api\OrderController@filterleftmenu');



    Route::get('/getProductGroup/{productGroupId}',  'Api\CategoryController@getProductGroup');
    Route::get('/getProduct/{slug}',  'Api\CategoryController@getProduct');
    Route::get('/getBrand/{brandId}', 'Api\CategoryController@getBrand');
    Route::get('/ourCollection', 'Api\CategoryController@ourCollection');
    
    
    // Phase 3
    Route::post('/getreviewlist', 'Api\CategoryController@getreviewlist');
    Route::post('/getproductsfilter', 'Api\CategoryController@getproductsfilter');
    Route::get('/aboutus', 'Api\LoginController@aboutus');

    // Phase 4
    Route::post('/getcountries', 'Api\LoginController@getcountries');
    Route::post('/placeorder', 'Api\OrderController@placeorder');
    Route::get('/getoffers', 'Api\UserController@getoffers');
    Route::post('/getofferdetailspage', 'Api\UserController@getofferdetailspage');
    Route::post('/deleteaddress', 'Api\OrderController@deleteaddress');
    Route::post('/getseealllist', 'Api\CategoryController@getseealllist');
    Route::post('/checkavailableqty', 'Api\OrderController@checkavailableqty');
    Route::get('/getflashdeal', 'Api\OrderController@getflashdeal');
    Route::get('/getsetting', 'Api\OrderController@getsetting');
    Route::post('/get_delivery_details', 'Api\CategoryController@get_delivery_details');
    Route::get('/get_states', 'Api\CategoryController@get_states');
    Route::post('/get_cities', 'Api\CategoryController@get_cities');


   // Route::group(['middleware' => ['auth:api', 'user.token']], function () {
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('/my_wallet', 'Api\UserController@my_wallet');
        Route::post('/favouriteproduct', 'Api\CategoryController@favouriteproduct');
        Route::post('/submitreview', 'Api\CategoryController@submitreview');
        Route::post('/updateprofiledata', 'Api\UserController@updateprofiledata');
        Route::get('/getprofiledata', 'Api\UserController@getprofiledata');
        Route::post('/getfavouriteproducts', 'Api\CategoryController@getfavouriteproducts');
        Route::post('/changepassword', 'Api\UserController@changepassword');
        Route::post('/getmyorders', 'Api\OrderController@getmyorders');
        Route::post('/addeditaddress', 'Api\OrderController@addeditaddress');
        Route::post('/cancelorder', 'Api\OrderController@cancelorder');
        Route::get('/getmyaddress', 'Api\OrderController@getmyaddress');
        Route::post('/getreviewlike', 'Api\CategoryController@getreviewlike');
        Route::post('/submitquery', 'Api\LoginController@submitquery');
        Route::post('/sendnotification', 'Api\LoginController@sendnotification');
    });
});
