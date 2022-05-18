<?php

namespace App\Repository\Eloquent\Cache;

use App\Models\Product;
use Illuminate\Support\Collection;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\ProductRepositoryInterface;
use Illuminate\Support\Facades\Cache;
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
            return $this->model->with('category')->orderByDesc('id')->paginate(6);
        });
        return $products;
    }

    public function create(array $attr): Model
    {
        $data = $this->model->create($attr);
        $this->deleteOldCache();
        Cache::put('product.'.$data->id,$data,self::CACHE_TTL);

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
            $this->deleteOldCache();
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
            $this->deleteOldCache();
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
            return $this->model->where('category_id',$id)->orderByDesc('id')->get();
        } );
        return $products;
    }

    public function deleteOldCache()
    {
        Cache::flush();
    }

    public function getCategoryByProductDetail($id)
    {
        return $this->model->with('category')->where('id',$id)->first();
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