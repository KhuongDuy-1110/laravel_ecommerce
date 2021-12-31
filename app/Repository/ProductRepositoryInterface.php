<?php

namespace App\Repository;

use Illuminate\Support\Collection;
use App\Product;

interface ProductRepositoryInterface
{
    public function all();

    public function getHotProduct();

    public function updateProductList(): Collection;

    public function save();

    
}