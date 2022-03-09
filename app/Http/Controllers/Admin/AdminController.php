<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminRequest;
use App\Services\AdminService;
use App\Models\Admin;

class AdminController extends Controller
{
    private $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }
   
    public function index()
    {
        $admins = $this->adminService->getAdmins();
        return view('backend.AdminRead',['admins' => $admins]);
    }

    public function create()
    {
        return view('backend.AdminCreate',['title'=>'Create']);
    }

    public function store(AdminRequest $request)
    {
        $this->adminService->create($request);
        return redirect()->route('account.index')->with('success','Account created successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit(Admin $admin)
    {
        $admin = $this->adminService->getAdmins($admin->id);
        return view('backend.AdminUpdate',['record'=>$admin]);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

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
