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

Route::post('/login','homeController@login');
Route::post('/any','homeController@any');
Route::get('/home','homeController@getAll');
Route::get('/statistics','homeController@getStatistics');
Route::get('/best','homeController@getBest');
Route::get('/recentProjects','homeController@getRecentProjects');
Route::get('/project/{id}','homeController@getProject');
Route::get('/employees','homeController@getEmployees');
Route::get('/employee/{id}','homeController@getEmployee');
Route::get('/about','homeController@getAbout');
Route::put('/message','homeController@storeMessage');
