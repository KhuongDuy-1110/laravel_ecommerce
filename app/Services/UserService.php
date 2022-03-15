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

    public function update(UserRequest $request, $id)
    {
        if($request->password)
        {
            $data = [
                'name' => $request->name,
                'password' => Hash::make($request->password),
            ];
        }
        else
        {
            $data = [
                'name' => $request->name,
            ];
        }
        $this->userRepository->update($id,$data);
    }

    public function delete( $id)
    {
        $this->userRepository->delete($id);
    }

    public function getUsersByJoin($findById = null)
    {
        $dataSelect = [
            'users.id as userId',
            'users.email as userEmail',
            'users.name as userName',
            'roles.id as roleId',
            'roles.name as roleName',
        ];
        $table2Id = [
            'user' => 'role_user.user_id',
            'role' => 'role_user.role_id'
        ];

        return $this->userRepository->leftJoinUser('users','users.id','role_user',$table2Id,'roles','roles.id',$dataSelect,5,$findById);
    }
}