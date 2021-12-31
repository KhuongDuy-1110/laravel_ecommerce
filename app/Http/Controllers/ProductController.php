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

        $data = json_decode($this->productRepository->all());
        return view('product',['data'=>$data,'title' => 'Product' ]);       
       
    }
}
