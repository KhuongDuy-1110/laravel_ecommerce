<?php

namespace App\Repository\Eloquent;

use App\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redis;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\ProductRepositoryInterface;

class CacheProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    // const CACHE_TTL = 600;

    public function __construct(Product $model)
    {
        parent::__construct($model);
    }


    public function all()
    {

        $rawProducts = Redis::get('product.all');

        if(!$rawProducts)
        {
            $data = $this->model->all();
            $rawProducts = Redis::set('product.all',json_encode($data));
        }

        return $rawProducts;

    }

    public function getHotProduct()
    {

        $hotProduct = Redis::get('product.hot');

        if(!$hotProduct)
        {
            $data = $this->model->where('hot',1)->get();
            $hotProduct = Redis::set('product.all',json_encode($data));
        }

        return $hotProduct;

    }


    public function updateProductList():collection
    {
        // $products = $this->all();

        // Redis::del('product.all');
        // Redis::set('product.all', json_encode($products));
        // Redis::expire('product.all', self::CACHE_TTL);

        // return $products;
    }

    public function save()
    {
        
        return 0;
    }

    

    

}