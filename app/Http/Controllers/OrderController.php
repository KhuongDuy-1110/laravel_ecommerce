<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\NewOrder;
use App\Orders;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function mailling(Request $request)
    {
        $user = Auth::user();

        if(session('cart'))
        {
            $orderDetail = session('cart');
        }

        $result = Orders::create([
            'client_id' => $user->id,
            'client_name' => $user->name,
            'client_email' => $user->email,
            'client_address' => $request->address,
            'orderDetail' => json_encode($orderDetail),
        ]);
        if($result)
        {
            MailController::confirmOrderMail($request->email,$orderDetail);
            event(new NewOrder($request->email));
            $request->session()->forget('cart');
            return back();
        }
    }
}
