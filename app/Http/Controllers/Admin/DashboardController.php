<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\UserInformation\User;

class DashboardController extends Controller
{
    public function index()
    {
        $data = Auth::guard('admin')->user();
        return view('backend.DashboardAdmin',['title'=>'Administrator','data'=>$data]);
    }
}
