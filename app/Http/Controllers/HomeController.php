<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class HomeController extends Controller
{
    public function index(){
        $hotProduct = Product::where('hot',1)->get();
        return view('home',['data'=>$hotProduct,'title'=>'Ecommerce']);
    }
}
