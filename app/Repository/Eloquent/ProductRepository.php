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

    public function all()
    {
        return $this->model->all();
    }

    public function getHotProduct()
    {
        return $this->model->where('hot',1)->get();
    }

    public function updateProductList(): Collection
    {

    }

    public function save()
    {
        
    }

    public function leftJoinTable($table,$tableId, $dataSelect = [],$n)
    {
        return $this->model->leftJoin($table,$tableId,'=','product.category_id')
                            ->select($dataSelect)->orderByDesc('id')->paginate($n);
                            // ->get();
    }

}