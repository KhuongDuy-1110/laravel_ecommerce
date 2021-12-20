<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Count;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Http\Requests\CheckoutRequest;
use App\Repository\ProductRepositoryInterface;

class CartController extends Controller
{
    
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        return view('cart',['title'=>'Cart']);
    }

    public function AddCart(Request $request, $id)
    {
        // $product = DB::table('product')->where('id',$id)->first();

        $product = $this->productRepository->find($id);

        if($product){
            $oldCart = Session('cart') ? Session('cart') : null;
            $newCart = new Cart($oldCart);
            
            $newCart->addCart($product,$id);

            $request->session()->put('cart',$newCart);        
        }
        return redirect(url('/cart')); 

    }

    public function updateCart(Request $request)
    {
        
    }

    public function deleteCart(Request $request, $id)
    {
        $oldCart = Session('cart') ? Session('cart') : null;
        $newCart = new Cart($oldCart);

        $newCart->deleteCart($id);
        
        if( Count($newCart->products) > 0 )
        {
            $request->session()->put('cart',$newCart);
        }
        else
        {
            $request->session()->forget('cart');
        }
        
        return redirect(url('/cart'));
    }

    public function checkOut()
    {
        $data = Auth::user();
        return view('cartCheckout',['title'=>'Check out','data'=>$data]);
    }

}
