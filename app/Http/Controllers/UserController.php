<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{

    public function index()
    {
        
    }
    public function register(Request $request)
    {
        DB::table("users")->insert([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);
        return redirect(url("/login"));
    }
    public function authenticate(Request $request)
    {
        // $this->validate($request, [
        //     'email' => 'required|email:filter',
        //      'password' => 'required'
        //  ]);
 
         if(Auth::attempt([
             'email' => $request->input('email'),
             'password' => $request->input('password')
         ], )){
             if(Auth::User()->email_verified_at == null)
                 return view('loginForm',['title'=>'Login','warning' => 'Your mail was unverified !']);
             return redirect()->route('dashboard');
         }
         return redirect()->back();
    }
    public function logout()
    {
        Auth::logout();
        return redirect(url('/login'));
    }
}
