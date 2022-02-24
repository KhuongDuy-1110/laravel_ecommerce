<?php

namespace App\Repository\Eloquent\Cache;

use App\Models\Category;
use Illuminate\Support\Collection;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

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

    public function getCategoriesByKey($key, $value, $paginate = null)
    {
        if($paginate)
        {
            $categories = Cache::remember('category.parent-'.request('page',1),self::CACHE_TTL, function() use ($key,$value,$paginate) {
                return $this->model->where($key,$value)->orderByDesc('id')->paginate($paginate);
            });
        }
        else
        {
            $categories = Cache::remember('category.all',self::CACHE_TTL, function (){
                return $this->model->where("parent_id",0)->orderByDesc('id')->get();
            });
        }
        
        return $categories;
    }

    public function create(array $attr): Model
    {
        $data = $this->model->create($attr);
        if($data)
        {
            Cache::flush();
            Cache::put('category.'.$data->id,$data,self::CACHE_TTL);
            return $data;
        }
        else
            return false;
    }

    public function find($id)
    {
        $category = Cache::remember('category.'.$id, self::CACHE_TTL, function() use ($id) {
            return $this->model->find($id);
        });
        return $category;
    }

    public function update($id, array $attr)
    {
        $category = $this->model->find($id);
        if($category)
        {
            $category->update($attr);
            Cache::flush();
            Cache::put('category.'.$category->id, $category, self::CACHE_TTL);

            return $category;
        }            
        else
            return false;
    }

    public function delete($id)
    {
        $data = $this->model->find($id);
        if($data)
        {
            $data->delete();           
            Cache::flush();
            return true;
        }
        return false;
    }
}