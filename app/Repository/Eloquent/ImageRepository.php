<?php

namespace App\Repository\Eloquent;

use App\Repository\ImageRepositoryInterface;
use App\Repository\Eloquent\BaseRepository;
use App\Models\Image;

class ImageRepository extends BaseRepository implements ImageRepositoryInterface
{
    public function __construct(Image $model)
    {
        parent::__construct($model);
    }

    public function getAllImage()
    {
        return $this->model->all();
    }

    public function getImageByType(int $type)
    {
        return $this->model->where('type',$type)->orderByDesc('id')->paginate(5);
    }
}