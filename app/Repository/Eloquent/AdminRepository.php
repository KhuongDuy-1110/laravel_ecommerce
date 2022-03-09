<?php

namespace App\Repository\Eloquent;

use App\Repository\AdminRepositoryInterface;
use App\Repository\Eloquent\BaseRepository;
use App\Models\Admin;

class AdminRepository extends BaseRepository implements AdminRepositoryInterface
{
    public function __construct(Admin $model)
    {
        parent::__construct($model);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function getAdmins($findById = null)
    {
        if($findById)
        {
            return $this->model->with('roles')->find($findById);
        }
        return $this->model->with('roles')->orderByDesc('id')->paginate(5);
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
}