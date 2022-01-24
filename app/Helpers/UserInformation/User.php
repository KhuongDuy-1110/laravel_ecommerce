<?php

namespace App\Helpers\UserInformation;

use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class User
{
    private $userService, $user;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->user = Auth::user();
    }

    public function getUserName()
    {
        $user = $this->userService->edit($this->user->id);
        return (isset($user->userName) ? $user->userName : '');
    }
}