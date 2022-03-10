<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Services\UserService;
use App\Models\User;
use App\Models\Role;
use Doctrine\DBAL\Query\QueryException;
use Exception;

class UserController extends Controller
{
    private $userService;
    
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->authorizeResource(User::class,'user');
    }

    public function index()
    {
        $data = $this->userService->getUsers();
        return view('backend.user.UserRead',['data'=>$data, 'title'=>'Users']);
    }
   
    public function create()
    {
        return view('backend.user.UserCreate',['title'=>'Edit']);
    }
    
    public function store(UserRequest $request)
    {
         try
         {
            $this->userService->create($request);
         }
         catch (Exception $e)
         {
             return redirect()->back()->with('error','Something wrong !');
         }
        return redirect()->route('user.index')->with('success','User created susessfully !');
    }
  
    public function show($id)
    {
        
    }
   
    public function edit(User $user)
    {
        $data = $this->userService->getUsers($user->id);
        return view('backend.user.UserUpdate',['record'=>$data,'title'=>'Edit']);
    }
   
    public function update(UserRequest $request, User $user)
    {
        $this->userService->update($request, $user->id);
        return redirect()->route('user.index')->with('success','User updated susessfully !');
    }
 
    public function destroy(User $user)
    {
        $this->userService->delete($user->id);
        return redirect()->route('user.index')->with('success','User deleted susessfully !');
    }
}