<?php

namespace App\Repository;

use Illuminate\Support\Collection;
use App\Orders;

interface OrderRepositoryInterface
{
    public function all(): Collection;
}