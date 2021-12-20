<?php

namespace App\Repository;

use Illuminate\Support\Collection;
use App\Product;

interface ProductRepositoryInterface
{
    public function all(): Collection;

    public function getHotProduct();
    
}