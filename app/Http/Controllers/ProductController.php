<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Redis;
use App\Repository\ProductRepositoryInterface;
use App\Services\ProductService;


class ProductController extends Controller
{
    private $productRepository, $productService;

    public function __construct(ProductRepositoryInterface $productRepository, ProductService $productService)
    {
        $this->productRepository = $productRepository;
        $this->productService = $productService;
    }

    public function index()
    {
        $data = json_decode($this->productRepository->all());
        return view('product',['data'=>$data,'title' => 'Product' ]);             
    }

    public function categoryFilter(Request $request)
    {
        $data = $this->productService->categoryFilter($request->id);
        return view('product',['data'=>$data, 'title' => 'Product']);
    }

    public function detail(Request $request)
    {
        $data = $this->productRepository->find($request->id);
        return view('productDetail',['data'=>$data]);
    }

}
