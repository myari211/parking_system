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

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'auth:api'], function() {
    // Route::get('user/detail', 'API\UserController@details');
    Route::post('logout', 'Api\UserController@logout');
    
    //admin
    Route::middleware('role:admin')->group(function() {
        Route::get('/admin/details', 'Api\AdminController@details');
        Route::post('/admin/report', 'Api\AdminController@report');
    });

    //petugas
    Route::middleware('role:petugas')->group(function() {
        Route::get('/petugas/details', 'Api\PetugasController@details');
        Route::post('/petugas/gate/in', 'Api\PetugasController@gateIn');
        Route::post('/petugas/gate/out', 'Api\PetugasController@gateOut');
        Route::post('/petugas/gate/generate', 'Api\PetugasController@generate');
    });
});
