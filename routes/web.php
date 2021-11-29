<?php

use App\Mail\VerifyMail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;


Route::get('/', function () {
    return view('welcome');
});

# ==================================

#user sign up, sign in
Route::get('/login', function (){
    return view('loginForm',['title'=>'login']);
})->name('login');
Route::post('/login','AuthController@authenticate');
Route::get('/register', function (){
    return view('registerForm',['title'=>'register']);
});
Route::post('/register','AuthController@register');
Route::get('/logout','AuthController@logout');
Route::get('/get-password','AuthController@getpass');
# verify mail
Route::get('/verify','AuthController@verified');

# ==================================

#login required
Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard', function (){
        return view('dashboard',['title'=>'welcome']);
    })->name('dashboard');
   
    Route::group(['middleware' => 'adminRole','prefix' => 'admin'],function (){
    
        #user CRUD
        Route::get('/','Admin\UserController@index');
        // Route::prefix('user')->group(function (){
        //     Route::get('create','Admin\UserController@create');
        //     Route::post('create','Admin\UserController@createPost');
        //     Route::get('update/{id}','Admin\UserController@update');
        //     Route::post('update/{id}','Admin\UserController@updatePost');
        //     Route::get('delete/{id}','Admin\UserController@delete');
        // });
        Route::resource('user','Admin\UserController');
    });
    
});

# ==================================

Route::get('/respond_test',function(){
    return response('hello-world',200)->header('Content-Type','text/plain');
});

Route::get('test','AuthController@test');

