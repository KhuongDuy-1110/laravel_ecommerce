<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
        $this->authorizeResource(Category::class);
    }
   
    public function index()
    {
        $data = $this->categoryService->getCategories(5);
        return view('backend.CategoryRead',['data'=>$data,'title'=>'Category']);
    }
    
    public function create()
    {
        return view('backend.CategoryCreate',['title'=>'create']);
    }
   
    public function store(CategoryRequest $request)
    {
        $this->categoryService->create($request);
        return redirect()->route('category.index')->with('success','Category created successfully !');
    }
    
    public function show($id)
    {
        
    }
   
    public function edit(Category $category)
    {
        $category = $this->categoryService->edit($category->id);
        return view('backend.CategoryUpdate',['record'=>$category, 'title'=>'Update']);
    }
   
    public function update(CategoryRequest $request, Category $category)
    {
        $this->categoryService->update($request,$category->id);
        return redirect()->route('category.index')->with('success','Category updated successfully !');   
    }
    
    public function destroy(Category $category)
    {
        $this->categoryService->delete($category->id);
        return redirect()->route('category.index')->with('success','Category deleted successfully !');
    }
}
