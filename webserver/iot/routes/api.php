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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'v1'], function(){
    Route::post('signup','SystemController@signup');
    Route::post('signin','SystemController@signin');
    Route::post('setMinTemp','SystemController@set_min_temp');
    Route::post('setMaxTemp','SystemController@set_max_temp');
    Route::post('setMaxHumidity','SystemController@set_max_humidity');
    Route::post('setMinHumidity','SystemController@set_min_humidity');
    Route::post('retrieve_temp','DataController@retrieve_temp');
    Route::post('retrieve_humidity','DataController@retrieve_humidity');
    Route::post('retrieve_data','DataController@retrieve_data');
    Route::post('new_data','DataController@new_data');
    Route::post('editSystemInformation','SystemController@edit_system_information');
});