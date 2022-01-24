<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Services\CategoryService;

class CategoryComposer
{
    private $categoryService; 

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function compose (View $view)
    {
        $data = $this->categoryService->getCategories();
        $view->with('Category',$data);
    }
}