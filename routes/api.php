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

Route::post   ( '/Userlogin'          , [ 'uses' => 'UserController@login'          , 'as' => 'User.login'     ] );
Route::post   ( '/Customerlogin'      , [ 'uses' => 'CustomerController@login'      , 'as' => 'Customer.login' ] );
Route::get    ( '/Sale'               , [ 'uses' => 'SaleController@getList'        , 'as' => 'Sale.getList'   ] );
Route::delete ( '/Sale'               , [ 'uses' => 'SaleController@delete'         , 'as' => 'Sale.delete'    ] );
Route::post   ( '/Sale'               , [ 'uses' => 'SaleController@create'         , 'as' => 'Sale.create'         , 'middleware' => 'auth:user'     ] );
Route::post   ( '/CustomerCreateUser' , [ 'uses' => 'CustomerController@CreateUser' , 'as' => 'Customer.CreateUser' , 'middleware' => 'auth:customer' ] );
