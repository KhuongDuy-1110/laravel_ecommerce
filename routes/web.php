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
});
Route::post('/login','UserController@authenticate');
Route::get('/register', function (){
    return view('registerForm',['title'=>'register']);
});
Route::post('/register','UserController@register');

Route::get('/dashboard', function (){
    return view('dashboard',['title'=>'welcome']);
})->name('dashboard');
Route::get('/logout','UserController@logout');

#mailling
// Route::get('/mailling', function() {
//     $details = [
//         'title' => 'Incoming mail from Khuong Pham',
//         'body' => 'Mail testing'
//     ];
//     Mail::to('khuongc3@gmail.com')->send(new VerifyMail($details));
//     return redirect(url('/login'))->with('flash_success', 'Check your mail to verify');
// } );

# verify mail
Route::get('/verify','UserController@verified');
