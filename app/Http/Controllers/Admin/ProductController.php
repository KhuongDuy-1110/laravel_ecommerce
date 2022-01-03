<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\User;
use App\Roles;
// use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductRequest;
// use App\Repository\ProductRepositoryInterface;
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

    }

    
    public function create()
    {

        // $data = Auth::user();
        $this->authorize('create',Product::class);
        return view('backend.ProductCreate',['title'=>'Product create']);
        // $data = User::find(3)->userRole->role_id;
        // dd(Auth::us);
        

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
        return view('backend.ProductUpdate',['record'=>$product, 'title'=>'Update']);
    
    }

    
    public function update(ProductRequest $request, $id)
    {
        
        $this->productService->update($request,$id);
        return redirect()->route('product.index');
        
    }

    
    public function destroy($id)
    {

        $this->productService->delete($id);
        return redirect()->route('product.index');

    }

}
