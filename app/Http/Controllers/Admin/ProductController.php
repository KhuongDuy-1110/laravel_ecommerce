<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Auth;
use App\Services\ProductService;

class ProductController extends Controller
{

    private $productService;

    public function __construct(ProductService $productService)
    {

        $this->productService = $productService;

    }
    
    public function index()
    {

        $data = $this->productService->view();
        return view('backend.ProductRead',['data'=>$data,'title'=>'Product']);
        // dd($data);

    }

    
    public function create()
    {

        $this->authorize('create',Product::class);
        return view('backend.ProductCreate',['title'=>'Product create']);      

    }

    
    public function store(ProductRequest $request)
    {

        $this->productService->create($request);
        return redirect()->route('product.index');       
        
    }

    
    public function show($id)
    {
        
    }

    
    public function edit($id)
    {
        
        $product = $this->productService->edit($id);
        $this->authorize('update',$product);
        return view('backend.ProductUpdate',['record'=>$product, 'title'=>'Update']);
    
    }

    
    public function update(ProductRequest $request, $id)
    {

        $this->authorize('update',$this->productService->edit($id));
        $this->productService->update($request,$id);
        return redirect()->route('product.index');
        
    }

    
    public function destroy($id)
    {

        $this->authorize('delete',$this->productService->edit($id));
        $this->productService->delete($id);
        return redirect()->route('product.index');

    }

}
