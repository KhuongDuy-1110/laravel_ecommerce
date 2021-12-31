<?php

namespace App\Services;


use App\Repository\UserRepositoryInterface;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request; 

class UserService
{

    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function view()
    {
        return $this->userRepository->all();
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
                'password' => $request->password,
            ];
        }
        else
        {
            $data = ['name' => $request->name];
        }
        $this->userRepository->update($id,$data);
    }

    public function delete($id)
    {
        $this->userRepository->delete($id);
    }

}