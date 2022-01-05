<?php

namespace App\Repository;

interface UserRepositoryInterface
{
    public function all();

    public function getDataFiltered($key,$value);

    public function createWithRole($data,$roleId);

    public function updateWithRole($id, array $arr, $roleId);

    public function deleteWithRole($id,$roleId);
    
}