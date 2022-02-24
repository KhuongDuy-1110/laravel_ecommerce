<?php

namespace App\Services;

use App\Repository\OrderRepositoryInterface;

class OrderService
{
    private $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getOrders($paginate = null)
    {
        return $this->orderRepository->all($paginate);
    }

}