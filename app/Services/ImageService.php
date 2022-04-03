<?php

namespace App\Services;

use App\Repository\ImageRepositoryInterface;

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

}