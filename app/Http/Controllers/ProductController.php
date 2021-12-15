<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Redis;


class ProductController extends Controller
{

    public function __construct()
    {
        
    }

    public function index()
    {
       
        if($data = Redis::get('index.product'))
        {
            $data = json_decode($data);
        }
        else {
            $data = Product::orderByDesc('id')->get();
            Redis::set('index.product',json_encode($data));
        }
        
        return view('product',['data'=>json_decode(Redis::get('index.product')) ]);
       
    }
}
