<?php

namespace App\Services;

use App\Http\Controllers\MailController;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request; 
use App\Models\Role;
use App\Models\User;

class UserService
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUsers($findById = null)
    {
        return $this->userRepository->getUsers($findById);
    }

    public function register($request)
    {
        $data = [
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "address" => $request->address,
            "dob" => $request->dob,
            "password" => Hash::make($request->password),
            "verification_code" => sha1(time()),
            "expired_at" => Carbon::now('Asia/Ho_Chi_Minh')->addSecond(300),
        ];

        $user = $this->userRepository->create($data);

        if($user)
        {
            MailController::verificationMail($user->email, $user->verification_code);
            return true;
        }
        else
        {
            return false;
        }
    }

    public function authenticate($request)
    {
        
    }

    public function create(UserRequest $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => Carbon::now(),
        ];

        $this->userRepository->create($data);
    }

    public function edit($id)
    {
        return $this->userRepository->find($id);
    }

    public function update($request, $id)
    {
        if($request->password)
        {
            $data = $request->all();
            $data['password'] = Hash::make($request->password);
        }
        else
        {
            $data = $request->all();
        }
        $this->userRepository->update($id,$data);
    }

    public function delete( $id)
    {
        $this->userRepository->delete($id);
    }

    public function sendLinkForgotPassword($data)
    {
        $user = $this->userRepository->getDataFiltered('email',$data['email']);
        if(!empty($user) && $user->phone === $data['phone']) {
            $verification_code = sha1(time());
            $data = [
                'verification_code' => $verification_code,
                'expired_at' => Carbon::now('Asia/Ho_Chi_Minh')->addSecond(300)
            ];
            $checkUpdate = $this->userRepository->update($user->id, $data);
            if($checkUpdate) {
                MailController::sendActionDefaultPassword($user->email, $verification_code);
                return true;
            }
            return false;
        }
        return false;
    }

    public function setPasswordToDefault($verification_code)
    {
        $user = $this->userRepository->getDataFiltered('verification_code',$verification_code);
        if(!empty($user) && Carbon::now('Asia/Ho_Chi_Minh') < $user->expired_at)
        {
            $this->userRepository->update($user->id,[
                'password' => Hash::make('12345678'),
            ]);
            return true;
        }
        return false;
    }

    public function changePassword($data)
    {
        $user = $this->userRepository->find($data['id']);
        if( !empty($user) && Hash::check($data['oldPassword'], $user->password)) {
            $this->userRepository->update($user->id,[
                'password' => Hash::make($data['password']),
            ]);
            return true;
        }
        return false;
    }
}