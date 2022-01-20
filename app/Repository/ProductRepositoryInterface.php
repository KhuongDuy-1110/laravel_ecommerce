<?php

namespace App\Repository;

use Illuminate\Support\Collection;

interface ProductRepositoryInterface
{
    public function all();

    public function getHotProduct();

    public function filterByCategory($id);
}