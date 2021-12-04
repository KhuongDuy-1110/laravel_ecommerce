<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $product = null;
    public $totalPrice = 0;
    public $totalQuatity = 0;

    public function __construct($cart)
    {
        if($cart){
            $this->product = $cart->product;
            $this->totalPrice = $cart->totalPrice;
            $this->totalQuatity = $cart->totalQuantity;
        }
    }

    public function addCart($product, $id)
    {

        $newProduct = ['quantity' => 0, 'price' => $product->price, 'productInfo' => $product ];
        if($this->product){
            if(array_key_exists($id,$product)){
                $newProduct = $product[$id];
            }
        }
        $newProduct['quantity']++;
        $newProduct['price'] = $newProduct['quantity'] * $product->price;
        $this->product[$id] = $newProduct;
        $this->totalPrice += $product->price;
        $this->totalQuatity++;


    }

}
