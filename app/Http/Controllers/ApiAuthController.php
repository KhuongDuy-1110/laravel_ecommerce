<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repository\UserRepositoryInterface;
use App\Http\Resources\UserResource;
use App\User;

class ApiAuthController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    public function login(Request $request)
    {
        
        $user = $this->userRepository->getDataFiltered('email',$request->email);
        if(!$user || !Hash::check($request->password,$user->password)){
            return response([
                'message' => ['no record found'],
            ], 404);
        }
        $token = $user->createToken('app-token')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response,201);
    }

    public function logout(Request $request)
    {

        Auth::user()->tokens()->delete();

        return [
            'message' => 'Logged out',
        ];
    }

}