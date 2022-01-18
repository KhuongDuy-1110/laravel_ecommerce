<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Repository\UserRepositoryInterface;
use App\Http\Resources\UserResource;
use App\Models\User;

class AuthController extends ApiController
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    public function login(Request $request)
    {
        
        $user = $this->userRepository->getDataFiltered('email',$request->email);
        if(!$user || !Hash::check($request->password,$user->password))
        {
            return $this->responseLoginFail();
        }
        $token = $user->createToken('app-token')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return $this->responseSuccess($response,['Content-Type', 'text/html']);
    }

    public function logout(Request $request)
    {
        Auth::user()->tokens()->delete();
        return $this->responseLogout();
    }

}