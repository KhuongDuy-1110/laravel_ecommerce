<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;

class CategoryController extends Controller
{

    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
   
    public function index()
    {

        $data = $this->categoryService->view();
        return view('backend.CategoryRead',['data'=>$data,'title'=>'Category']);

    }

    
    public function create()
    {
        return view('backend.CategoryCreate',['title'=>'create']);
    }

    
    public function store(CategoryRequest $request)
    {

        $this->categoryService->create($request)        ;
        return redirect()->route('category.index');

    }
    
    public function show($id)
    {
        
    }

    
    public function edit($id)
    {

        $category = $this->categoryService->edit($id);
        return view('backend.CategoryUpdate',['record'=>$category, 'title'=>'Update']);

    }

    
    public function update(CategoryRequest $request, $id)
    {
        
        $this->categoryService->update($request,$id);
        return redirect()->route('category.index');
        
    }

    
    public function destroy($id)
    {
        
        $this->categoryService->delete($id);
        return redirect()->route('category.index');

    }
}
