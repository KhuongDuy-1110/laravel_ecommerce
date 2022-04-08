<?php

namespace App\Services;

use App\Repository\ImageRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class ImageService
{

    private $imageRepository;

    public function __construct(ImageRepositoryInterface $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    /*
    type = 1 -> slide Homepage
    type = 2 -> slide Product
    type = 3 -> slide Cart
    */

    public function getImageByType($type)
    {
        return $this->imageRepository->getImageByType($type);
    }

    public function createImage($request)
    {
        if($request->hasFile('image')){
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('images',$fileNameToStore);
        }
        else
        {
            $fileNameToStore = 'noimage'.time().'.jpg';
        }

        $status = isset($request->imageActive) ? 1 : 0;

        $data = [
            'path' => $fileNameToStore,
            'type' => $request->type,
            'status' => $status,
        ];
        return $this->imageRepository->create($data);
    }

}