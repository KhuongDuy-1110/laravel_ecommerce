<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminRequest;

class AdminController extends Controller
{

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');        

        if(Auth::guard('admin')->attempt($credentials))
        {
            return redirect(url('/admin'));
            
        }
        return redirect()->back()->with('error', 'Your password or email is wrong');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login');
    }
}
