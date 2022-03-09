<?php

namespace App\Services;

use App\Repository\AdminRepositoryInterface;
use App\Http\Requests\AdminRequest;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminService
{
    private $adminRepository;

    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function getAdmins($findById = null)
    {
        return $this->adminRepository->getAdmins($findById);
    }

    public function create(AdminRequest $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        $this->adminRepository->createWithRole($data,$request->role);
    }

    public function edit($id)
    {
        return $this->adminRepository->find($id);
    }

    public function update(AdminRequest $request, $id)
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
        $this->adminRepository->updateWithRole($id,$data,$request->role);
    }

    public function delete( $id)
    {
        $this->adminRepository->deleteWithRole($id);
    }

}