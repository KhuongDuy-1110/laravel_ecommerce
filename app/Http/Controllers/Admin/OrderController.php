<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OrderService;

class OrderController extends Controller
{
    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $users = $this->orderService->getOrdersPerUser();
        return view('backend.OrderRead', ['users' => $users, 'title' => 'Order']);     
    }

    public function find(Request $request)
    {
        $user = $this->orderService->getOrdersByUser($request->id);
        // dd($user->toArray());
        return view('backend.OrderDetail',['user' => $user]);
    }
}
