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
        return view('backend.order.OrderRead', ['users' => $users, 'title' => 'Order']);     
    }

    public function find(Request $request)
    {
        $user = $this->orderService->getOrdersByUser($request->id);
        return view('backend.order.OrderDetail',['user' => $user]);
    }

    public function updateOrderStatus(Request $request)
    {
        $result = $this->orderService->updateOrderStatus($request);
        return redirect()->back()->with('success','Update order status successfully');
    }
}
