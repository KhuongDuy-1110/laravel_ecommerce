<?php

namespace App\Repository\Eloquent;

use App\Repository\Eloquent\BaseRepository;
use App\Repository\CategoryRepositoryInterface;
use App\Models\Category;


class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{

    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function getParent($key,$value)
    {
        return $this->model->where($key,$value)->get();
    }

    public function getCategoriesByKey($key, $value, $paginate)
    {
        return $this->model->where($key, $value)->paginate($paginate);
    }

}