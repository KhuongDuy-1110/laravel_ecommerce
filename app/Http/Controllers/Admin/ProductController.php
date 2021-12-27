<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductRequest;
use App\Repository\ProductRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    
    public function index()
    {

        $data = $this->productRepository->read(5);
        return view('backend.ProductRead',['data'=>$data,'title'=>'Product']);

    }

    
    public function create()
    {
        
        $this->authorize('create',Product::class);
        return view('backend.ProductCreate',['title'=>'Product create']);

    }

    
    public function store(ProductRequest $request)
    {
        // $product = new Product;

        if($request->hasFile('photo')){
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('photo')->storeAs('images',$fileNameToStore);
        }
        else
            $fileNameToStore = 'noimage'.time().'.jpg';
   
        // $product->name = $request->name;
        // $product->title = $request->title;
        // $product->price = $request->price;
        // $product->category_id = $request->category;
        // $product->hot = isset($request->hot)?1:0;
        // $product->description = $request->description;
        // $product->photo = $fileNameToStore;

        // $product->save();

        $data = [
            'name' => $request->name,
            'title' => $request->title,
            'price' => $request->price,
            'category_id' => $request->category,
            'hot' => isset($request->hot)?1:0,
            'description' => $request->description,
            'photo' => $fileNameToStore,
        ];

        $this->productRepository->create($data);

        return redirect()->route('product.index'); 
        
        
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {

        // $product = Product::find($id);
        $product = $this->productRepository->find($id);
        $this->authorize('update',$product);
        return view('backend.ProductUpdate',['record'=>$product, 'title'=>'Update']);
    }

    
    public function update(ProductRequest $request, $id)
    {
        
        $product = $this->productRepository->find($id);
        
        $this->authorize('update',$product);

        if($request->hasFile('photo')){
            Storage::delete('images/'.$product->photo);
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('photo')->storeAs('images',$fileNameToStore);
        }
        else
        {
            $fileNameToStore = $product->photo;
        }

        $data = [
            'name' => $request->name,
            'title' => $request->title,
            'price' => $request->price,
            'category_id' => $request->category,
            'hot' => isset($request->hot)?1:0,
            'description' => $request->description,
            'photo' => $fileNameToStore,
        ];

        $this->productRepository->update($id,$data);
        return redirect()->route('product.index');
        
    }

    
    public function destroy($id)
    {

        $product = $this->productRepository->find($id);
        $this->authorize('delete',$product);
        $this->productRepository->delete($id);
        Storage::delete('images/'.$product->photo);
        return redirect()->route('product.index');

    }
}
