<?php

use App\Mail\VerifyMail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

# ================Frontend================== #

Route::group(['middleware'=>'lang'], function() {
    Route::get('/change-language/{language}','LanguageController@change');
    Route::get('/', 'HomeController@index');
    Route::get('/products','ProductController@index');
    Route::get('/products/{id}','ProductController@categoryFilter');
    Route::get('/products/detail/{id}','ProductController@detail');
    Route::group(['middleware'=>'auth','prefix'=>'cart'], function()
    {
        Route::get('/','CartController@index');
        Route::get('/addcart/{id}','CartController@AddCart');
        Route::get('/updateCart/{id}/{type?}','CartController@updateCart');
        Route::get('/deleteCart/{id}','CartController@deleteCart');
        Route::get('/checkout','CartController@checkOut');
        Route::post('/order','OrderController@mailling');
    });
    Route::get('/telegram-message','TelegramController@updateActivity');
});

# ===============Backend=================== #

Route::get('/login', function (){
    return view('frontend/LoginForm',['title'=>'login']);
})->name('login');
Route::post('/login','AuthController@authenticate');
Route::get('/register', function (){
    return view('frontend/RegisterForm',['title'=>'register']);
});
Route::post('/register','AuthController@register');
Route::get('/logout','AuthController@logout');
Route::get('/get-password','AuthController@getpass');
Route::get('/verify','AuthController@verified');

# ==================================

Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard', function (){
        return view('dashboard',['title'=>'welcome']);
    })->name('dashboard');
   
    Route::group(['middleware' => 'adminRole','prefix' => 'admin'],function (){
        Route::get('/','Admin\DashboardController@index');
        Route::resources([
            'user' => Admin\UserController::class,
            'category'=> Admin\CategoryController::class,
            'product' => Admin\ProductController::class,
        ]);
        Route::group(['prefix' => 'order'], function(){
            Route::get('/','Admin\OrderController@index');
        });
    });   
});

# ==================================