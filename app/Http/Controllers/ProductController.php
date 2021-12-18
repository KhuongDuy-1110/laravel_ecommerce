<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Product;
use Illuminate\Support\Facades\Redis;
use App\Repository\ProductRepositoryInterface;


class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {

        if($data = Redis::get('index.product'))
        {
            $data = json_decode($data);
        }
        else {
            $data = $this->productRepository->all();
            Redis::set('index.product',json_encode($data));
        }
        
        return view('product',['data'=>json_decode(Redis::get('index.product')) ]);
       
    }
}
