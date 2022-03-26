<?php

namespace App\Repository\Eloquent;

use App\Repository\ImageRepositoryInterface;
use App\Repository\Eloquent\BaseRepository;
use App\Models\Image;
use Illuminate\Database\Eloquent\Model;

class ImageRepository extends BaseRepository implements ImageRepositoryInterface
{
    public function __construct(Image $model)
    {
        parent::__construct($model);
    }
    /*
    type = 1 -> slide Homepage
    type = 2 -> slide Product
    type = 3 -> slide Cart
    */
    public function getImageByType(int $type)
    {
        return $this->model->where('type',$type)->get();
    }
}