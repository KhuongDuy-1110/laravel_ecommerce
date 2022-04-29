<?php

namespace App\Repository\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Repository\EloquentRepositoryInterface;

class BaseRepository implements EloquentRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function read(int $n = null)
    {
        return $this->model->orderByDesc('id')->paginate($n);
    }

    public function create(array $attr): Model
    {
        return $this->model->create($attr);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function update($id, array $attr)
    {
        $data = $this->model->find($id);
        if($data)
        {
            $data->update($attr);
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
            $data->delete();
            return true;
        }
        return false;
    }

    public function leftJoinTable($table,$table1Id, $dataSelect = [], $n, $table2Id)
    {
        return $this->model->leftJoin($table,$table1Id,'=',$table2Id)
                            ->select($dataSelect)
                            ->orderByDesc('id')
                            ->paginate($n);
    }
}