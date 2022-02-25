<?php

namespace App\Repository;

interface UserRepositoryInterface
{
    public function all();

    public function getDataFiltered($key,$value);

    public function createWithRole($data,$roleId);

    public function updateWithRole($id, array $arr, $roleId);

    public function deleteWithRole($id);

    public function leftJoinUser($table,$tableId,$table2,$table2Id = [],$table3,$table3Id,$dataSelect = [],$n,$findById = null);
    
    public function getUsers($findById = null);

    public function getAllOrdersPerUser($id = null);
}