<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\OrderService;
use App\Services\UserService;
use App\Services\ImageService;

class HomeController extends Controller
{
    private $orderService;
    private $userService;
    private $imageService;

    public function __construct(OrderService $orderService, UserService $userService, ImageService $imageService)
    {
        $this->orderService = $orderService;
        $this->userService = $userService;
        $this->imageService = $imageService;
    }

    public function index()
    {
        $slides = $this->imageService->getImageByType(1, 1);
        return view('frontend/Home',[
            'title'=>'Home',
            'slides' => $slides,
        ]);
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
