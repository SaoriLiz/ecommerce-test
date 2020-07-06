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

Route::post('users/login', 'API\UserController@login');
Route::post('users/register', 'API\UserController@register');

Route::group(['middleware' => ['auth:api']], function(){
    Route::post('users/details', 'API\UserController@details');
    Route::post('users/logout', 'API\UserController@logout');
});

Route::group(['middleware' => ['auth:api', 'isAdmin']], function(){
    Route::get('users', 'API\UserController@index');
    Route::get('users/{id}', 'API\UserController@show');
    Route::delete('users/{id}', 'API\UserController@destroy');
    Route::put('users/{id}', 'API\UserController@update');
});


//products mangement routes with only access for admin
Route::group(['middleware' => ['auth:api', 'isAdmin']], function(){
    Route::post('products', 'API\ProductController@store');
    Route::put('products/{id}', 'API\ProductController@update');
    Route::delete('products/{id}', 'API\ProductController@destroy');
});

//public product routes
Route::get('products', 'API\ProductController@index');
Route::get('products/{id}', 'API\ProductController@show');
