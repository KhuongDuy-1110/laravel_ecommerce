<?php

namespace App\Services;

use App\Repository\OrderRepositoryInterface;
use App\Repository\UserRepositoryInterface;

class OrderService
{
    private $orderRepository;
    private $userRepository;

    public function __construct(OrderRepositoryInterface $orderRepository, UserRepositoryInterface $userRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
    }

    public function getOrders($paginate = null)
    {
        return $this->orderRepository->all($paginate);
    }

    public function getOrdersByUser($id)
    {
        return $this->userRepository->getAllOrdersPerUser($id);
    }

}