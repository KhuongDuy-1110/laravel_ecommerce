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

    public function getOrdersPerUser($paginate = null)
    {
        return $this->userRepository->getAllOrdersPerUser();
    }

    public function getOrdersByUser($id)
    {
        return $this->userRepository->getAllOrdersPerUser($id);
    }

    public function updateOrderStatus($request)
    {
        $status = [
            'status' => $request->sta,
        ];
        return $this->orderRepository->updateStatus($request->id, $status);
    }

}