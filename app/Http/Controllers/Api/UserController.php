<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Repository\UserRepositoryInterface;

class UserController extends ApiController
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        // $data = UserResource::Collection($this->userRepository->all());
        // return $this->responseSuccess($data);

        $data = $this->userRepository->all();
        
        return $this->responseWithTranformation($data,UserResource::class);

    }



    
}
