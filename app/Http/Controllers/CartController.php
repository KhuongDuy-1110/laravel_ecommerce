<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Session\Session;

class CartController extends Controller
{
    public function index()
    {
        echo 'hihi';
    }

    public function AddCart(Request $request, $id)
    {
        $product = DB::table('product')->where('id',$id)->first();
        if($product){

            $oldCart = Session('cart') ? Session('cart') : null;
            $newCart = new Cart($oldCart);
            $newCart->addCart($product,$id);

            $request->session()->put('Cart',$newCart);
            dd(Session('cart'));
        }
        
    }
}
