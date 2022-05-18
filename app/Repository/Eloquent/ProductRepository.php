<?php

namespace App\Repository\Eloquent;

use App\Models\Product;
use Illuminate\Support\Collection;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function all()
    {
        return $this->model->orderByDesc('id')->paginate(6);
    }

    public function getHotProduct()
    {
        return $this->model->where('hot',1)->get();
    }

    public function filterByCategory($id)
    {
        return $this->model->where('category_id',$id)->orderByDesc('id')->get();
    }

    public function getCategoryByProductDetail($id)
    {
        return $this->model->with('category')->where('id',$id)->first();
    }

    public function updateProductList(): Collection
    {

    }

    public function save()
    {
        
    }
}