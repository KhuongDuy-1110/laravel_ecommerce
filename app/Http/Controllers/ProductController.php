<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Redis;
use Cache;

class ProductController extends Controller
{
    public function index()
    {

        // $data = Product::orderByDesc('id')->paginate(5);
        // Redis::set('index.product',json_encode($data));
        // $get = Redis::get('index.product');


        dd(Redis::get('index.product'));
        // return view('product',)
    }
}
