<?php

namespace App\Repository\Eloquent;

use App\Repository\Eloquent\BaseRepository;
use App\Repository\UserRepositoryInterface;
use App\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function getDataFiltered($key,$value)
    {
        return $this->model->where($key,$value)->first();
    }

}