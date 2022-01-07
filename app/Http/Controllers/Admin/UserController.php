<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Repository\UserRepositoryInterface;
use App\Services\UserService;
use App\User;
use App\Role;

class UserController extends Controller
{

    private $userService;
    private $data;
    
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->data = $this->userService->view();
    }

    public function index()
    {
        return view('backend.UserRead',['data'=>$this->data, 'title'=>'Users']);
    }

    
    public function create()
    {
        $this->authorize('create',User::class);
        return view('backend.UserCreateUpdate',['title'=>'Edit']);
    }

    
    public function store(UserRequest $request)
    {

        $this->authorize('create',User::class);
        $this->userService->create($request);
        return redirect()->route('user.index');

    }

   
    public function show($id)
    {
        
    }

    
    public function edit($id)
    {
        $data = $this->userService->view($id);
        $this->authorize('update',$data);
        return view('backend.UserUpdate',['record'=>$data,'title'=>'Edit']);
    }

    
    public function update(UserRequest $request, $id)
    {
        $this->authorize('update',$this->userService->edit($id));
        $this->userService->update($request, $id);
        return redirect()->route('user.index');
    }

  
    public function destroy($id)
    {
        $this->authorize('delete',$this->userService->edit($id));
        $this->userService->delete($id);
        return redirect()->route('user.index');
    }
}
