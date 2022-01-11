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
        
        return $this->update($id,$arr)->roles()->attach($roleId);
    }

    public function deleteWithRole($id)
    {
        $result = $this->find($id)->roles()->detach();
        return $this->delete($id);
    }

    public function leftJoinUser($table,$tableId,$table2,$table2Id = [],$table3,$table3Id,$dataSelect = [],$n, $findById = null)
    {
        if($findById == null)
        {
            return $this->model->leftJoin($table2,$table2Id['user'],'=',$tableId)
                                ->leftJoin($table3,$table2Id['role'],'=',$table3Id)
                                ->select($dataSelect)
                                ->orderByDesc($table.'.id')
                                ->paginate($n);
        }
        else
        {
            return $this->model->leftJoin($table2,$table2Id['user'],'=',$tableId)
                                ->leftJoin($table3,$table2Id['role'],'=',$table3Id)
                                ->where($table.'.id',$findById)
                                ->select($dataSelect)
                                ->first();
        }

    }

}