<?php

namespace App\Models;

class Cart
{
    public $products = null;
    public $totalPrice = 0;
    public $totalQuantity = 0;

    public function __construct($cart)
    {
        if($cart){
            $this->products = $cart->products;
            $this->totalPrice = $cart->totalPrice;
            $this->totalQuantity = $cart->totalQuantity;
        }
    }

    public function addCart($product, $id)
    {

        $newProduct = ['quantity' => 0, 'price' => $product->price, 'productInfo' => $product ];
        if($this->products){
            if(array_key_exists($id,$this->products)){
                $newProduct = $this->products[$id];
            }
        }
        $newProduct['quantity']++;
        $newProduct['price'] = $newProduct['quantity'] * $product->price;

        $this->products[$id] = $newProduct;
        $this->totalPrice += $product->price;
        $this->totalQuantity++;
    }

    public function updateCart($request, $product, $id)
    {
        if($request->type === '0' && $this->products[$id]['quantity'] === 1)
        {
            $this->deleteCart($id);
        }
        elseif($request->type === '0')
        {
            $this->products[$id]['quantity']--;
            $this->totalPrice -= $this->products[$id]['price'];
            $this->totalQuantity -= $this->products[$id]['quantity'];     
        }
        else
        {
            $this->products[$id]['quantity']++;
            $this->totalPrice += $this->products[$id]['price'];
            $this->totalQuantity += $this->products[$id]['quantity']; 
        }       
    }

    public function deleteCart($id)
    {
        $this->totalPrice -= $this->products[$id]['price'];
        $this->totalQuantity -= $this->products[$id]['quantity'];
        unset($this->products[$id]);
    }

}
