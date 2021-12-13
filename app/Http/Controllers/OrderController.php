<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\NewOrder;

class OrderController extends Controller
{
    public function mailling(Request $request)
    {
        MailController::confirmOrderMail($request->email); 
        event(new NewOrder($request->email));
        return back();
    }
}
