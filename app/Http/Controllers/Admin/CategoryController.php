<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\CategoryRequest;
use App\Repository\CategoryRepositoryInterface;

class CategoryController extends Controller
{

    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
   
    public function index()
    {

        $data = $this->categoryRepository->getParent("parent_id",0);
        return view('backend.CategoryRead',['data'=>$data,'title'=>'Category']);

    }

    
    public function create()
    {
        return view('backend.CategoryCreate',['title'=>'create']);
    }

    
    public function store(CategoryRequest $request)
    {

        $data = $request->all();
        $this->categoryRepository->create($data);

        return redirect()->route('category.index');

    }
    
    public function show($id)
    {
        
    }

    
    public function edit($id)
    {

        $category = $this->categoryRepository->find($id);

        return view('backend.CategoryUpdate',['record'=>$category, 'title'=>'Update']);

    }

    
    public function update(CategoryRequest $request, $id)
    {

        $data = $request->all();
        $this->categoryRepository->update($id,$data);

        return redirect()->route('category.index');
    }

    
    public function destroy($id)
    {
        
        $this->categoryRepository->delete($id);

        return redirect()->route('category.index');

    }
}
