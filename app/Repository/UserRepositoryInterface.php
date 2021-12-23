<?php

namespace App\Repository;

interface UserRepositoryInterface
{
    public function all();
    public function getDataFiltered($key,$value);
    
}