<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('users')->orderBy('id','desc')->paginate(5);
        return view('backend.UserRead',['data'=>$data, 'title'=>'Users']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.UserCreateUpdate',['title'=>'Edit']);
    }

    
    public function store(UserRequest $request)
    {
        $user = DB::table("users")->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => Carbon::now(),
        ]);
        return redirect()->route('user.index');
    }

   
    public function show($id)
    {
        
    }

    
    public function edit($id)
    {
        $data = DB::table("users")->where("id","=",$id)->first();
        return view('backend.UserUpdate',['record'=>$data,'title'=>'Edit']);
    }

    
    public function update(UserRequest $request, $id)
    {
        if($request->password)
        {
            $user = DB::table("users")->where("id","=",$id)
            ->update([
                'name' => $request->name,
                'password' => $request->password,
            ]);
        }
        else
        $user = DB::table("users")->where("id","=",$id)
            ->update([
                'name' => $request->name,
            ]);
        return redirect()->route('user.index');
    }

  
    public function destroy($id)
    {
        $user = DB::table("users")->where("id","=",$id)->delete();
        return redirect()->route('user.index');
    }
}
