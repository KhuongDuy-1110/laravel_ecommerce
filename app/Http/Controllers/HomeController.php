<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\OrderService;
use App\Services\UserService;

class HomeController extends Controller
{
    private $orderService;
    private $userService;

    public function __construct(OrderService $orderService, UserService $userService)
    {
        $this->orderService = $orderService;
        $this->userService = $userService;
    }

    public function index()
    {
        return view('frontend/Home',['title'=>'Home']);
    }

    public function profile()
    {
        $user = $this->userService->getUsers(Auth::id());
        return view('frontend.UserProfile',['user'=>$user]);
    }

    public function editProfile(Request $request)
    {
        $this->userService->update($request, Auth::id());
        return redirect()->back()->with('success','Update profile successfully');
    }

    public function order()
    {
        $orders = $this->orderService->getOrdersByUser(Auth::id());
        return view('frontend.UserOrders',['orders'=>$orders]);
    }
}
