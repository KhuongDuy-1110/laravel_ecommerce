<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Count;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Http\Requests\CheckoutRequest;
use App\Repository\ProductRepositoryInterface;
use App\Services\ImageService;

class CartController extends Controller
{
    
    private $productRepository, $cart;
    private $imageService;

    public function __construct(ProductRepositoryInterface $productRepository, ImageService $imageService)
    {
        $this->productRepository = $productRepository;
        $this->imageService = $imageService;
    }

    public function index()
    {
        $slides = $this->imageService->getImageByType(3,1);
        return view('frontend/Cart',[
            'slides' => $slides,
            'title'=>'Cart'
        ]);
    }

    public function AddCart(Request $request, $id)
    {
        $product = $this->productRepository->find($id);

        if($product){
            $oldCart = Session('cart') ? Session('cart') : null;
            $newCart = new Cart($oldCart);
            
            $newCart->addCart($product,$id);

            $request->session()->put('cart',$newCart);
        }
        return redirect(url('/cart'));
    }

    public function updateCart(Request $request, $id)
    {
        $product = $this->productRepository->find($id);

        $oldCart = Session('cart') ? Session('cart') : null;
        if($oldCart)
        {
            $newCart = new Cart($oldCart);
            $newCart->updateCart($request, $product, $id);
            $request->session()->put('cart',$newCart);
            return redirect(url('/cart'));
        }
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
        return view('frontend/CartCheckout',['title'=>'Check out','data'=>$data]);
    }

}
