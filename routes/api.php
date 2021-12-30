<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiAuthController;

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

Route::post('/login','Api\AuthController@login');

// Route::middleware(['auth:sanctum','throttle:2,1'])->group(function () {

//     Route::post('/logout','ApiAuthController@logout');
//     Route::get('/user','Api\UserController@index');
    
// });

Route::middleware(['auth:sanctum','throttle:60,1'])->group(function () {

    Route::post('/logout','Api\AuthController@logout');
    Route::get('/user','Api\UserController@index');
    
});
