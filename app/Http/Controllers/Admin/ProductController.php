<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Services\ProductService;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
        $this->authorizeResource(Product::class);
    }
    
    public function index()
    {
        $data = $this->productService->getProducts();
        return view('backend.ProductRead',['data'=>$data,'title'=>'Product']);
    }
  
    public function create()
    {
        return view('backend.ProductCreate',['title'=>'Product create']);      
    }

    public function store(ProductRequest $request)
    {
        $this->productService->create($request);
        return redirect()->route('product.index')->with('success','Product created successfully !');               
    }

    public function show($id)
    {
        
    }
   
    public function edit(Product $product)
    {       
        $product = $this->productService->edit($product->id);
        return view('backend.ProductUpdate',['record'=>$product, 'title'=>'Update']);   
    }
    
    public function update(ProductRequest $request, Product $product)
    {
        $this->productService->update($request,$product->id);
        return redirect()->route('product.index')->with('success','Product updated successfully !');        
    }
    
    public function destroy(Product $product)
    {
        $this->productService->delete($product->id);
        return redirect()->route('product.index')->with('success','Product deleted successfully !');
    }
}
