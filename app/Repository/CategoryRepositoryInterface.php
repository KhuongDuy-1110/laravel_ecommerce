<?php

namespace App\Repository;

interface CategoryRepositoryInterface
{
    public function all();
    public function getParent($key,$value);
}