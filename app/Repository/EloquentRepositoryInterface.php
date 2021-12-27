<?php

namespace App\Repository;
use Illuminate\Database\Eloquent\Model;

interface EloquentRepositoryInterface 
{
    public function read(int $n);

    public function create(array $attr): Model;

    public function find($id): ?Model;

    public function update($id, array $attr);

    public function delete($id);
    
}