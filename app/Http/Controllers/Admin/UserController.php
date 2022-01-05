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
use App\Repository\UserRepositoryInterface;
use App\User;
use App\Role;

class UserController extends Controller
{

    private $userRepository;
    
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $data = $this->userRepository->read(5);
        return view('backend.UserRead',['data'=>$data, 'title'=>'Users']);
        
    }

    
    public function create()
    {
        return view('backend.UserCreateUpdate',['title'=>'Edit']);
        // $role = User::find(72)->roles;
        // dd($role[0]['name']);
    }

    
    public function store(UserRequest $request)
    {
        
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => Carbon::now(),
        ];


        $this->userRepository->createWithRole($data,$request->role);
        return redirect()->route('user.index');

    }

   
    public function show($id)
    {
        
    }

    
    public function edit($id)
    {
        $data = $this->userRepository->find($id);
        return view('backend.UserUpdate',['record'=>$data,'title'=>'Edit']);
    }

    
    public function update(UserRequest $request, $id)
    {
        if($request->password)
        {
            $data = [
                'name' => $request->name,
                'password' => $request->password,
            ];
        }
        else
        {
            $data = ['name' => $request->name];
        }
        $this->userRepository->updateWithRole($id, $data, $request->role );
        return redirect()->route('user.index');
    }

  
    public function destroy($id)
    {
        $this->userRepository->delete($id);
        return redirect()->route('user.index');
    }
}
