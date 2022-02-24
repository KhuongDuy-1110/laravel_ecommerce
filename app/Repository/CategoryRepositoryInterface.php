<?php

namespace App\Repository;

interface CategoryRepositoryInterface
{
    public function all();
    
    public function getCategoriesByKey($key, $value, $paginate);
}