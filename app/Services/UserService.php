<?php

namespace App\Services;

use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request; 
use App\Role;
use App\User;

class UserService
{

    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function view($findById = null)
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

    public function create(UserRequest $request)
    {

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => Carbon::now(),
        ];

        $this->userRepository->createWithRole($data,$request->role);

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
            $data = ['name' => $request->name];
        }
        $this->userRepository->updateWithRole($id,$data,$request->role);
    }

    public function delete( $id)
    {
        $this->userRepository->deleteWithRole($id);
    }

}