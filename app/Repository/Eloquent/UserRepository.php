<?php

namespace App\Repository\Eloquent;

use App\Repository\Eloquent\BaseRepository;
use App\Repository\UserRepositoryInterface;
use App\Models\User;

use function PHPUnit\Framework\returnSelf;

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

    public function getUsers($findById = null)
    {
        if($findById)
        {
            return $this->model->find($findById);
        }
        return $this->model->orderByDesc('id')->paginate(5);
    }

    public function getDataFiltered($key,$value)
    {
        return $this->model->where($key,$value)->first();
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

    public function getAllOrdersPerUser($id = null)
    {
        if($id === null )
            return $this->model::withCount('orders')->orderByDesc('id')->get();
        else
        {
            return $this->model::with(['orders' => function ($query) {
                $query->orderBy('created_at','desc');
            } ])->find($id);
        }
    }
}