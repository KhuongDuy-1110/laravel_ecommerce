<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\OrderService;

class HomeController extends Controller
{
    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        return view('frontend/Home',['title'=>'Home']);
    }

    public function profile(Request $request)
    {
        dd('ok');
    }

    public function order(Request $request)
    {
        $orders = $this->orderService->getOrdersByUser($request->id);
        return view('frontend.UserOrders',['orders'=>$orders]);
    }
}
