<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Services\ProductService;

class HotProductsComposer
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function compose (View $view)
    {
        $data = $this->productService->getHotProduct();
        $view->with('HotProducts',$data);
    }
}