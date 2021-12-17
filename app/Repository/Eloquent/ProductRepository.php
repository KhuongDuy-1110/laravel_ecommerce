<?php

namespace App\Repository\Eloquent;

use App\Product;
use Illuminate\Support\Collection;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return $this->model->all();
    }
}