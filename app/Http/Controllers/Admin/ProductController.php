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
    // private $productRepository;

    // public function __construct(ProductRepositoryInterface $productRepository)
    // {
    //     $this->productRepository = $productRepository;
    // }
    
    // public function index()
    // {

    //     $data = $this->productRepository->read(5);
    //     return view('backend.ProductRead',['data'=>$data,'title'=>'Product']);

    // }

    
    // public function create()
    // {
        
    //     $this->authorize('create',Product::class);
    //     return view('backend.ProductCreate',['title'=>'Product create']);

    // }

    
    // public function store(ProductRequest $request)
    // {

    //     if($request->hasFile('photo')){
    //         $filenameWithExt = $request->file('photo')->getClientOriginalName();
    //         $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
    //         $extension = $request->file('photo')->getClientOriginalExtension();
    //         $fileNameToStore = $filename.'_'.time().'.'.$extension;
    //         $path = $request->file('photo')->storeAs('images',$fileNameToStore);
    //     }
    //     else
    //     {
    //         $fileNameToStore = 'noimage'.time().'.jpg';
    //     }

    //     $data = [
    //         'name' => $request->name,
    //         'title' => $request->title,
    //         'price' => $request->price,
    //         'category_id' => $request->category,
    //         'hot' => isset($request->hot)?1:0,
    //         'description' => $request->description,
    //         'photo' => $fileNameToStore,
    //     ];

    //     $this->productRepository->create($data);

    //     return redirect()->route('product.index'); 
        
        
    // }

    
    // public function show($id)
    // {
    //     //
    // }

    
    // public function edit($id)
    // {

    //     $product = $this->productRepository->find($id);
    //     $this->authorize('update',$product);
    //     return view('backend.ProductUpdate',['record'=>$product, 'title'=>'Update']);
    // }

    
    // public function update(ProductRequest $request, $id)
    // {
        
    //     $product = $this->productRepository->find($id);
        
    //     $this->authorize('update',$product);

    //     if($request->hasFile('photo')){
    //         Storage::delete('images/'.$product->photo);
    //         $filenameWithExt = $request->file('photo')->getClientOriginalName();
    //         $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
    //         $extension = $request->file('photo')->getClientOriginalExtension();
    //         $fileNameToStore = $filename.'_'.time().'.'.$extension;
    //         $path = $request->file('photo')->storeAs('images',$fileNameToStore);
    //     }
    //     else
    //     {
    //         $fileNameToStore = $product->photo;
    //     }

    //     $data = [
    //         'name' => $request->name,
    //         'title' => $request->title,
    //         'price' => $request->price,
    //         'category_id' => $request->category,
    //         'hot' => isset($request->hot)?1:0,
    //         'description' => $request->description,
    //         'photo' => $fileNameToStore,
    //     ];

    //     $this->productRepository->update($id,$data);
    //     return redirect()->route('product.index');
        
    // }

    
    // public function destroy($id)
    // {

    //     $product = $this->productRepository->find($id);
    //     $this->authorize('delete',$product);
    //     $this->productRepository->delete($id);
    //     Storage::delete('images/'.$product->photo);
    //     return redirect()->route('product.index');

    // }


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
