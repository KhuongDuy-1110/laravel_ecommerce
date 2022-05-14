<?php

namespace App\Repository\Eloquent;

use App\Repository\PostRepositoryInterface;
use App\Repository\Eloquent\BaseRepository;
use App\Models\Post;

class PostRepository extends BaseRepository implements PostRepositoryInterface 
{
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    public function getPosts($n = null)
    {
        return $this->model->with('user')->orderByDesc('id')->simplePaginate($n);
    }

    public function getRecommendedPosts()
    {   
        // 1 -> recommend ; 2 -> unrecommend
        return $this->model->where('is_recommend',1)->get();
    }

    public function getLastest()
    {
        return $this->model->with('user')->latest()->first();
    }
}