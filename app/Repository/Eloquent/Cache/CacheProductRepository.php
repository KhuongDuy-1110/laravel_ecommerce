<?php

namespace App\Repository\Eloquent\Cache;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redis;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\ProductRepositoryInterface;
use Illuminate\Support\Facades\Cache;
use Exception;
use Illuminate\Database\Eloquent\Model;

class CacheProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    const CACHE_TTL = 30 * 60;

    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function all()
    {
        $products = Cache::remember('product-page-'.request('page',1),self::CACHE_TTL, function (){
            return $this->model->with('category')->orderByDesc('id')->paginate(5);
        });
        return $products;
    }

    public function create(array $attr): Model
    {
        $data = $this->model->create($attr);

        // if(Redis::get('product.'.$data->id))
        // {
        //     Redis::del('product.'.$data->id);
        // }
        // Redis::set('product.'.$data->id,json_encode($data));
        // Redis::expire('product.'.$data->id, self::CACHE_TTL);

        Cache::put('product.'.$data->id,$data,self::CACHE_TTL);
        $this->deleteOldCache(5);

        return $data;
    }

    public function find($id)
    {
        $product = Cache::remember('product.'.$id,self::CACHE_TTL,function() use ($id) {
            return $this->model->find($id);
        });
        return $product;
    }

    public function update($id, array $attr)
    {
        $data = $this->model->find($id);
        if($data)
        {
            $data->update($attr);
            $this->deleteOldCache(5);
            return $data;
        }            
        else
            return false;
    }

    public function delete($id)
    {
        $data = $this->model->find($id);
        if($data)
        {
            if(Cache::has('product.'.$id))
                Cache::forget('product.'.$id);
            $data->delete();           
            $this->deleteOldCache(5);
            return true;
        }
        return false;
    }

    public function getHotProduct()
    {
        $hotProducts = Cache::remember('product.hot',self::CACHE_TTL, function(){
            return $this->model->where('hot',1)->get();
        });
        return $hotProducts;
    }
    
    public function filterByCategory($id)
    {
        $products = Cache::remember('product.category_id.'.$id,self::CACHE_TTL, function() use ($id) {
            return $this->model->where('category_id',$id)->get();
        } );
        return $products;
    }

    public function deleteOldCache($n)
    {
        Cache::flush();
    }

    public function leftJoinTable($table,$table1Id, $dataSelect = [], $n, $table2Id)
    {
        // if(Redis::get('product.all'))
        //     return json_decode(Redis::get('product.all'));
        // else
        // {
        //     $data = $this->model->leftJoin($table,$table1Id,'=',$table2Id)
        //                         ->select($dataSelect)
        //                         ->orderByDesc('id')
        //                         ->paginate($n);
        //     Redis::expire('product.all', self::CACHE_TTL);

        //     return $data;
        // }
        
    }
}