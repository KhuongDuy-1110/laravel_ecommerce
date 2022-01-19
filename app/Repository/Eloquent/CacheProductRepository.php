<?php

namespace App\Repository\Eloquent;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redis;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\ProductRepositoryInterface;

class CacheProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    const CACHE_TTL = 60;

    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function all()
    {
        if(Redis::get('product.all'))
        {
            return json_decode(Redis::get('product.all'));
        }
        else
        {
            $data = $this->model->all();
            Redis::set('product.all',json_encode($data));
            Redis::expire('product.all', self::CACHE_TTL);
        }
        return json_decode(Redis::get('product.all'));
    }

    public function getHotProduct()
    {
        if(Redis::get('product.hot'))
            return json_decode(Redis::get('product.hot'));
        else
        {
            $data = $this->model->where('hot',1)->get();
            Redis::set('product.hot',json_encode($data));
            Redis::expire('product.hot', self::CACHE_TTL);
        }
        return json_decode(Redis::get('product.hot'));
    }
    
    public function filterByCategory($id)
    {
        if(Redis::get('product.category_id.'.$id))
            return json_decode(Redis::get('product.category_id.'.$id));
        else
        {
            $data = $this->model->where('category_id',$id)->get();
            Redis::set('product.category_id.'.$id, json_encode($data));
            Redis::expire('product.category_id.'.$id, self::CACHE_TTL);
        }
        return json_decode(Redis::get('product.category_id.'.$id));
    }

    // public function leftJoinTable($table,$table1Id, $dataSelect = [], $n, $table2Id)
    // {

    //     $rawProducts = Redis::get('product.leftJoin');

    //     if(!$rawProducts)
    //     {

    //         $data = $this->model->leftJoin($table,$table1Id,'=',$table2Id)
    //                             ->select($dataSelect)
    //                             ->orderByDesc('id')
    //                             ->paginate($n);
            
    //         $rawProducts = Redis::set('product.leftJoin',json_encode($data));
            
    //     }
    //     return $rawProducts;
    // }

    public function save()
    {      

    }

    public function updateProductList():collection
    {
        // $products = $this->all();

        // Redis::del('product.all');
        // Redis::set('product.all', json_encode($products));
        // Redis::expire('product.all', self::CACHE_TTL);

        // return $products;
    }
}