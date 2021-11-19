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
            "expired_at" => Carbon::now()->addSecond(60),
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
             'password' => $request->input('password'),
         ], )){
             if(Auth::User()->role == 0)
             {
                if(Auth::User()->email_verified_at == null)
                    return redirect()->back()->with('flash_warning', 'Your mail was unverified');
                return redirect()->route('dashboard');
             }
             else if(Auth::User()->role == 1) {
                 return redirect(url('/admin'));
             }
             return redirect()->back();
             
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
        $find = DB::table("users")->where("verification_code","=",$request->code)->first();
        if($find != null && $find->email_verified_at == null )
        {
            if(Carbon::now() < $find->expired_at )
            {
                DB::table("users")->where("verification_code","=",$request->code)
                ->update(["email_verified_at" => Carbon::now()]);
                return redirect(url('/login'))->with('flash_success', 'Your mail was verified, log in now !');
            }
            return redirect(url('/login'))->with('flash_warning', 'Time expired');
        }
        return redirect(url('/login'))->with('flash_warning', 'Something went wrong !');
    }

    public function getpass(Request $request)
    {
        
    }
}
