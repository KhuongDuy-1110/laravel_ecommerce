<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class UserController extends Controller
{

    public function index()
    {
        
    }
    public function register(Request $request)
    {
        $user = DB::table("users")->insert([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "verification_code" => sha1(time()),
            "expired_at" => 
        ]);

        if($user == true)
        {
            $find = DB::table("users")->where("email","=",$request->email)->first();
            // send verrification mail
            MailController::verificationMail($find->email,$find->verification_code);
            return redirect(url('/login'))->with('flash_success', 'Check your mail to verify');
        }

        return redirect()->back();
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
         return redirect()->back()->with('flash_warning', 'Your password or email is wrong');
    }
    public function logout()
    {
        Auth::logout();
        return redirect(url('/login'));
    }

    public function verified(Request $request)
    {
        $find = DB::table("users")
        ->where("verification_code","=",$request->code)
        ->update(["email_verified_at" => Carbon::now()]);
        return redirect(url('/login'))->with('flash_success', 'Your mail was verified, log in now !');
    }
}
