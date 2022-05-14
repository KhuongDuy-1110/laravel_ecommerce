<?php

use App\Http\Controllers\Api\AuthController;
use App\Mail\VerifyMail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

# ================Frontend================== #

Route::group(['middleware' => 'lang'], function () {
    Route::get('/change-language/{language}', 'LanguageController@change');

    Route::get('/', 'HomeController@index')->name('homePage');

    Route::get('/products', 'ProductController@index');
    Route::get('/products/{id}', 'ProductController@categoryFilter');
    Route::get('/products/detail/{id}', 'ProductController@detail')->name('productDetailCl');

    Route::group(['middleware' => 'auth.user'], function () {
        
        Route::group(['prefix' => 'cart'], function () {
            Route::get('/', 'CartController@index');
            Route::get('/addcart/{id}', 'CartController@AddCart');
            Route::get('/updateCart/{id}/{type?}', 'CartController@updateCart');
            Route::get('/deleteCart/{id}', 'CartController@deleteCart');
            Route::get('/checkout', 'CartController@checkOut');
            Route::post('/order', 'OrderController@mailling');
        });

        Route::get('user/profile', 'HomeController@profile')->name('profile');
        Route::post('user/profile', 'HomeController@editProfile');
        Route::post('user/password', 'HomeController@changePassword')->name('changePassword');
        Route::get('user/order', 'HomeController@order');

    });
    Route::get('/telegram-message', 'TelegramController@updateActivity');
    Route::get('/posts/{id}', 'HomeController@showPostDetail')->name('showPostDetail');

    Route::get('/login', function () {
        return view('frontend/LoginForm', ['title' => 'login']);
    })->name('user.login');
    Route::post('/login', 'AuthController@authenticate');
    Route::get('/register', function () {
        return view('frontend/RegisterForm', ['title' => 'register']);
    });
    Route::post('/register', 'AuthController@register');
    Route::get('/logout', 'AuthController@logout');
    Route::get('/get-password', 'AuthController@getpass');
    Route::get('/verify', 'AuthController@verified');
    Route::get('/forgot-password', 'AuthController@forgotPassword')->name('forgotPassword');
    Route::post('/forgot-password', 'AuthController@sendLink');
    Route::get('/set-default-password', 'AuthController@setDefaultPassword');
    Route::get('/search','HomeController@search')->name('search');

});

# ===============Backend=================== #

Route::get('/admin/login', function () {
    return view('backend/Login', ['title' => 'login']);
})->name('login');
Route::post('/admin/login', 'Admin\AdminController@authenticate');
Route::get('/admin/logout', 'Admin\AdminController@logout');

Route::group(['middleware' => ['auth:admin']], function () {

    Route::get('/dashboard', function () {
        return view('dashboard', ['title' => 'welcome']);
    })->name('dashboard');

    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', 'Admin\DashboardController@index');
        Route::resources([
            'account' => Admin\AdminController::class,
            'image' => Admin\ImageController::class,
            'user' => Admin\UserController::class,
            'category' => Admin\CategoryController::class,
            'product' => Admin\ProductController::class,
            'image' => Admin\ImageController::class,
            'post' => Admin\PostController::class,
        ]);
        Route::group(['prefix' => 'order'], function () {
            Route::get('/', 'Admin\OrderController@index');
            Route::get('/detail/{id}', 'Admin\OrderController@find');
            Route::post('/status/{id}', 'Admin\OrderController@updateOrderStatus');
        });
    });
});

# ==================================