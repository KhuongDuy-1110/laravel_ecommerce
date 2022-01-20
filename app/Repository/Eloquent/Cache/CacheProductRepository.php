<?php

namespace App\Repository\Eloquent\Cache;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redis;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\ProductRepositoryInterface;
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

    }

    public function create(array $attr): Model
    {
        $data = $this->model->create($attr);

        if(Redis::get('product.'.$data->id))
        {
            Redis::del('product.'.$data->id);
        }
        Redis::set('product.'.$data->id,json_encode($data));
        Redis::expire('product.'.$data->id, self::CACHE_TTL);

        return $data;
    }

    public function find($id)
    {
        if(Redis::get('product.'.$id))
            return json_decode(Redis::get('product.'.$id));
        else
        {
            $data = $this->model->find($id);

            Redis::set('product.'.$id,json_encode($data));
            Redis::expire('product.'.$id, self::CACHE_TTL);

            return $data;
        }
    }

    public function update($id, array $attr)
    {
        $data = $this->model->find($id);
        if($data)
        {
            $data->update($attr);
            if(Redis::get('product.'.$id))
            {
                Redis::del('product.'.$id);
            }
            Redis::set('product.'.$id,json_encode($data));
            Redis::expire('product.'.$id, self::CACHE_TTL);

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
            if(Redis::get('product.'.$id))
            {
                Redis::del('product.'.$id);
            }
            $data->delete();           
            return true;
        }
        return false;
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
    //     if(Redis::get('product.all'))
    //         return json_decode(Redis::get('product.all'));
    //     else
    //     {
    //         $data = $this->model->leftJoin($table,$table1Id,'=',$table2Id)
    //                             ->select($dataSelect)
    //                             ->orderByDesc('id')
    //                             ->paginate($n);
    //         Redis::set('product.all',json_encode($data)); 
    //         Redis::expire('product.all', self::CACHE_TTL);

    //         return $data;
    //     }
    // }
}