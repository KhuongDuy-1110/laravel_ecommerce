<?php

namespace App\Repository\Eloquent;

use App\Models\Orders;
use Illuminate\Support\Collection;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\OrderRepositoryInterface;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function __construct(Orders $model)
    {
        parent::__construct($model);
    }

    public function all($paginate = null)
    {
        return $this->model::with('user')->orderByDesc('id')->paginate($paginate);
    } 
}