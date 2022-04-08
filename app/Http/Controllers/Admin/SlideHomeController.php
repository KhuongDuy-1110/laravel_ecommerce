<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ImageService;
use App\Http\Requests\ImageRequest;

class SlideHomeController extends Controller
{
    
    private $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $data = $this->imageService->getImageByType(1);
        return view('backend.image.ImageRead',[
            'data' => $data,
            'nameOfImages' => 'Image slide for hompage'
        ]);
    }

    public function create()
    {
        return view('backend.image.ImageCreate');
    }

    public function store(ImageRequest $request)
    {
        $request->request->add([
            'type' => 1
        ]);
        $this->imageService->createImage($request);
        return redirect()->route('slide-image.index')->with('success','Your image has been created successfully !');
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
        //
    }

    public function destroy($id)
    {
        //
    }
}
