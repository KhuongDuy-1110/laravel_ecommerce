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

    public function all()
    {
        return $this->model->all();
    }

    public function getDataFiltered($key,$value)
    {
        return $this->model->where($key,$value)->first();
    }

    public function createWithRole($data,$roleId)
    {
        return $this->create($data)->roles()->attach($roleId);
    }

    public function updateWithRole($id, array $arr, $roleId)
    {
        $result = $this->find($id)->roles()->detach();
        // if($result)
        // {
        //     dd(1);
        // }
        // else {
        //     dd(1231);
        // }
        return $this->update($id,$arr)->roles()->attach($roleId);
    }

    public function deleteWithRole($id,$roleId)
    {

    }

}