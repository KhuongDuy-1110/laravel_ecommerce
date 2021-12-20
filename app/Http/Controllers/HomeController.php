<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Repository\ProductRepositoryInterface;

class HomeController extends Controller
{

    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index(){

        $hotProduct = $this->productRepository->getHotProduct();
        return view('home',['data'=>$hotProduct,'title'=>'Ecommerce']);
        
        // echo json_encode($hotProduct);

    }
}
