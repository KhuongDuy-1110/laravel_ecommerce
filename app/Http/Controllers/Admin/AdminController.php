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
        $this->authorizeResource(Admin::class,'account');
    }
   
    public function index()
    {
        $admins = $this->adminService->getAdmins();
        return view('backend.admin.AdminRead',['admins' => $admins]);
    }

    public function create()
    {
        return view('backend.admin.AdminCreate',['title'=>'Create']);
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

    public function edit(Admin $account)
    {
        $admin = $this->adminService->getAdmins($account->id);
        return view('backend.admin.AdminUpdate',['record' => $admin]);
    }

    public function update(AdminRequest $request, Admin $account)
    {
        $this->adminService->update($request, $account->id);
        return redirect()->route('account.index')->with('success','Update successfully');
    }

    public function destroy(Admin $account)
    {
        $this->adminService->delete($account->id);
        return redirect()->route('account.index')->with('success','Deleted successfully');
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
