<?php

namespace App\Repository;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

interface OrderRepositoryInterface
{
    public function all($paginate = null);

    public function find($id);

    public function updateStatus($id, array $status);
}