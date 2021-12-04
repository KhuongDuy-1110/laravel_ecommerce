<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::orderByDesc('id')->paginate(5);
        return view('backend.ProductRead',['data'=>$data,'title'=>'Product']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.ProductCreate',['title'=>'Product create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = new Product;

        if($request->hasFile('photo')){
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('photo')->storeAs('images',$fileNameToStore);
        }
        else
            $fileNameToStore = 'noimage'.time().'.jpg';
   
        $product->name = $request->name;
        $product->title = $request->title;
        $product->price = $request->price;
        $product->category_id = $request->category;
        $product->hot = isset($request->hot)?1:0;
        $product->description = $request->description;
        $product->photo = $fileNameToStore;

        $product->save();
        

        return redirect()->route('product.index'); 
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('backend.ProductUpdate',['record'=>$product, 'title'=>'Update']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);

        if($request->hasFile('photo')){
            Storage::delete('images/'.$product->photo);
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('photo')->storeAs('images',$fileNameToStore);
        }
        else
            $fileNameToStore = $product->photo;
   
        $product->name = $request->name;
        $product->title = $request->title;
        $product->price = $request->price;
        $product->category_id = $request->category;
        $product->hot = isset($request->hot)?1:0;
        $product->description = $request->description;
        $product->photo = $fileNameToStore;

        $product->save();
        
        return redirect()->route('product.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        Storage::delete('images/'.$product->photo);
        return redirect()->route('product.index');
    }
}
