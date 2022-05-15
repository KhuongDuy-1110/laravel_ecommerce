<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\ProductRepositoryInterface;
use App\Services\ProductService;
use App\Services\ImageService;


class ProductController extends Controller
{
    private $productRepository, $productService;
    private $imageService;

    public function __construct(ProductRepositoryInterface $productRepository, ProductService $productService, ImageService $imageService)
    {
        $this->productRepository = $productRepository;
        $this->productService = $productService;
        $this->imageService = $imageService;
    }

    public function index()
    {
        $data = $this->productRepository->all();
        return view('frontend/Product',['data'=>$data,'title' => 'Product', 'paginate' => true ]);             
    }

    public function categoryFilter(Request $request)
    {
        $data = $this->productService->categoryFilter($request->id);
        $slides = $this->imageService->getImageByType(2,1);
        return view('frontend/Product',[
            'data' => $data, 
            'slides' => $slides,
            'title' => 'Product'
        ]);
    }

    public function detail(Request $request)
    {
        $data = $this->productRepository->getCategoryByProductDetail($request->id);
        return view('frontend/ProductDetail',['data'=>$data]);
    }

}
