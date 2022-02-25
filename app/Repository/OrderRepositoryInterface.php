<?php

namespace App\Repository;

use Illuminate\Support\Collection;

interface OrderRepositoryInterface
{
    public function all($paginate = null);

    public function find($id);
}