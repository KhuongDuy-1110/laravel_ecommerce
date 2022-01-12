<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Services\CategoryService;
use App\Product;

class CategoryComposer
{
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function compose (View $view)
    {
        $data = $this->categoryService->view();
        $view->with('Category',$data);
    }

}