<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\NewOrder;
use App\Orders;
use Illuminate\Support\Facades\Auth;
use App\Repository\OrderRepositoryInterface;

class OrderController extends Controller
{
    private $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function mailling(Request $request)
    {
        $user = Auth::user();

        if(session('cart'))
        {
            $orderDetail = session('cart');
        }

        $data = [
            'client_id' => $user->id,
            'client_name' => $user->name,
            'client_email' => $user->email,
            'client_address' => $request->address,
            'orderDetail' => json_encode($orderDetail),
        ];

        $result = $this->orderRepository->create($data);

        if($result)
        {
            // send comfimation mail to customer
            MailController::confirmOrderMail($request->email,$orderDetail);
            
            // send notification to channel in telegram
            event(new NewOrder($request->email));

            $request->session()->forget('cart');
            
            return back();
            
        }
    }
}
