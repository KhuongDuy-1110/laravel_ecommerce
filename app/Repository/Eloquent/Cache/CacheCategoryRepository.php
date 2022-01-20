<?php

namespace App\Repository\Eloquent\Cache;

use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redis;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\CategoryRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Model;

class CacheCategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    const CACHE_TTL = 30 * 60;

    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function all()
    {
        
    }

    public function create(array $attr): Model
    {
        $data = $this->model->create($attr);
        if($data)
        {
            Redis::set('category.'.$data->id,json_encode($data));
            Redis::expire('category.'.$data->id, self::CACHE_TTL);
            return $data;
        }
        else
            return false;
    }

    public function find($id)
    {
        if(Redis::get('category.'.$id))
            return json_decode(Redis::get('category.'.$id));
        else
        {
            $data = $this->model->find($id);

            Redis::set('category.'.$id,json_encode($data));
            Redis::expire('category.'.$id, self::CACHE_TTL);

            return $data;
        }
    }

    public function update($id, array $attr)
    {
        $data = $this->model->find($id);
        if($data)
        {
            $data->update($attr);
            if(Redis::get('category.'.$id))
            {
                Redis::del('category.'.$id);
            }
            Redis::set('category.'.$id,json_encode($data));
            Redis::expire('category.'.$id, self::CACHE_TTL);

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
            if(Redis::get('category.'.$id))
            {
                Redis::del('category.'.$id);
            }
            $data->delete();           
            return true;
        }
        return false;
    }

    public function getParent($key, $value)
    {
        if(Redis::get('category.parent'))
            return json_decode(Redis::get('category.parent'));
        else
        {
            $data = $this->model->where($key,$value)->get();

            Redis::set('category.parent',json_encode($data));
            Redis::expire('category.parent',self::CACHE_TTL);

            return $data;
        }
    }
}