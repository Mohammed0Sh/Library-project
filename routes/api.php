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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['namespace'=>'Api'],function ()
{

    Route::get('/filters','HomeController@getFilters');
    Route::get('/item_detile','HomeController@show_item_detile');
    Route::post('/search','HomeController@Search_Result');
    Route::post('/login','HomeController@login');
    Route::post('/register','HomeController@addUserRequest');
    Route::get('/show_add_item_project_request','UserController@show_add_item_project_request');
    Route::get('/allTags','HomeController@getAllTags');
    Route::get('/download_file','HomeController@download_file');
});


Route::group(['namespace'=>'Api','middleware'=>'auth:api'],function ()
{
    //Route::post('/search','HomeController@Search_Result');

    Route::get('/getFavorate','UserController@getFavorate');

    Route::get('/getBorrows','UserController@show_my_borrows');

    Route::get('/getReservation','UserController@show_my_reservations');

    Route::post('/addFavorite','UserController@add_item_to_favorite');

    Route::post('/getReservationDetile','UserController@getReservationDetile');

    Route::post('/addReservation','UserController@add_item_to_reservation');
   
    Route::post('/storeExtendBorrow','UserController@store_extend_borrow');

    Route::get('/hasExtendBorrowingOnBorrow','UserController@hasExtendBorrowingOnBorrow');
    
   




});

