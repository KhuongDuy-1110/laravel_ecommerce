<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminRequest;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $data = DB::table('users')->orderBy('id','desc')->paginate(5);
        return view('backend.UserRead',['data'=>$data, 'title'=>'Users']);
    }

    public function create()
    {
        return view('backend.UserCreateUpdate',['title'=>'Edit']);
    }
    public function createPost(AdminRequest $request)
    {
        $user = DB::table("users")->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => Carbon::now(),
        ]);
        return redirect(url('/admin'));
    }

    public function update(Request $request)
    {
        $data = DB::table("users")->where("id","=",$request->id)->first();
        return view('backend.UserCreateUpdate',['record'=>$data,'title'=>'Edit']);
        
    }
    public function updatePost(AdminRequest $request)
    {
        if($request->password)
        {
            $user = DB::table("users")->where("id","=",$request->id)
            ->update([
                'name' => $request->name,
                'password' => $request->password,
            ]);
        }
        else
        $user = DB::table("users")->where("id","=",$request->id)
            ->update([
                'name' => $request->name,
            ]);
        return redirect(url('/admin'));
    }
    public function delete(Request $request)
    {
        $user = DB::table("users")->where("id","=",$request->id)->delete();
        return redirect(url('/admin'));
    }

}
