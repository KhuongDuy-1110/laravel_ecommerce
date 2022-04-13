<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ImageService;
use App\Http\Requests\ImageRequest;

class ImageController extends Controller
{
    private $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index(Request $request)
    {
        $data = $this->imageService->getImageByType($request->type);
        return view('backend.image.ImageRead',[
            'data' => $data,
            'type' => $request->type,
            'nameOfImages' => 'Image slide for hompage'
        ]);
    }

    public function create()
    {
        return view('backend.image.ImageCreate',['type' => request()->type]);
    }

    public function store(ImageRequest $request)
    {
        $request->request->add([
            'type' => $request->type,
        ]);
        $this->imageService->createImage($request);
        return redirect()->route('image.index',['type' => $request->type])->with('success','Your image has been created successfully !');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        // 
    }

    public function update(Request $request, $id)
    {
        $this->imageService->updateStatus($request, $id);
        return redirect()->route('image.index',['type' => $request->type])->with('success','Update status successfully !');
    }

    public function destroy(Request $request, $id)
    {
        $this->imageService->deleteImage($id);
        return redirect()->route('image.index',['type' => $request->type])->with('success','Delete image successfully !');
    }
}
