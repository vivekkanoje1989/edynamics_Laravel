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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['middleware' => 'api'], function () {
    Route::get('/getMasterData', 'backend\AdminController@getMasterData'); 
    Route::post('/authenticate', 'backend\Auth\LoginController@authenticate');
    Route::post('/checkUserCredentials', 'backend\Auth\LoginController@checkUserCredentials'); 
    Route::get('/getEmployees', 'backend\AdminController@getEmployees'); 
    Route::post('/getCities','backend\AdminController@getCities');
    Route::post('/getMenuItems', 'backend\AdminController@getMenuItems');
    Route::post('/checkDomainExists', 'backend\Auth\LoginController@checkDomainExists');
});

