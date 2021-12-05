<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

class Cart
{
    public $products = null;
    public $totalPrice = 0;
    public $totalQuantity = 0;

    public function __construct($cart)
    {
        if($cart){
            $this->products = $cart->product;
            $this->totalPrice = $cart->totalPrice;
            $this->totalQuantity = $cart->totalQuantity;
        }
    }

    public function addCart($product, $id)
    {

        $newProduct = ['quantity' => 0, 'price' => $product->price, 'productInfo' => $product ];
        if($this->products){
            if(array_key_exists($id,$products)){
                $newProduct = $products[$id];
            }
        }
        $newProduct['quantity']++;
        $newProduct['price'] = $newProduct['quantity'] * $product->price;

        $this->products[$id] = $newProduct;
        $this->totalPrice += $product->price;
        $this->totalQuantity++;
    }

}
