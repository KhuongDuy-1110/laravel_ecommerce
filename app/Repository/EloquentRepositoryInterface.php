<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;

interface EloquentRepositoryInterface 
{
    public function read(int $n);

    public function create(array $attr): Model;

    public function find($id);

    public function update($id, array $attr);

    public function delete($id);

    public function leftJoinTable($table,$table1Id, $dataSelect = [], $n, $table2Id);
}