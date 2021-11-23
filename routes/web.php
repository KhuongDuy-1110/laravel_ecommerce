<?php

use App\Mail\VerifyMail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;


Route::get('/', function () {
    return view('welcome');
});

#user sign up, sign in
Route::get('/login', function (){
    return view('loginForm',['title'=>'login']);
})->name('login');
Route::post('/login','UserController@authenticate');
Route::get('/register', function (){
    return view('registerForm',['title'=>'register']);
});
Route::post('/register','UserController@register');

Route::get('/logout','UserController@logout');
Route::get('/get-password','UserController@getpass');

# verify mail
Route::get('/verify','UserController@verified');

# user login successfully

#login required
Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard', function (){
        return view('dashboard',['title'=>'welcome']);
    })->name('dashboard');
   
    Route::group(['middleware' => 'adminRole','prefix' => 'admin'],function (){
    
        #user CRUD
        Route::get('/','Admin\AdminController@index');
        Route::prefix('user')->group(function (){
            Route::get('create','Admin\AdminController@create');
            Route::post('create','Admin\AdminController@createPost');
            Route::get('update/{id}','Admin\AdminController@update');
            Route::post('update/{id}','Admin\AdminController@updatePost');
            Route::get('delete/{id}','Admin\AdminController@delete');
        });
    });
    
});

