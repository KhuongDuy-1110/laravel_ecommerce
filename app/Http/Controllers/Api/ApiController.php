<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class ApiController extends Controller
{
    // protected $transfomer = null;

    public function response($data, $statusCode = 200, $headers = [] )
    {
        return response()->json($data, $statusCode,$headers);
    }

    public function responseSuccess($message,$headers = [])
    {
        return $this->response($message,201,$headers);
    }

    public function responseError($message, $statusCode)
    {
        return $this->response(
        [
            'errors' => [
                'message' => $message,
                'statusCode' => $statusCode,
            ]
        ],$statusCode);
    }

    public function responseUnauthorize($message = 'Unauthorize')
    {
        return $this->responseError($message,403);
    }

    public function responseLoginFail()
    {

        return $this->response([
            'errors' => [
                'Email or password' => 'is invalid',
            ]
        ],422);

    }
    
    public function responseWithTranformation($data,$resources, $statusCode = 200, $header = [])
    {
        return $this->response($resources::Collection($data),$statusCode, $header);
    }
    
    public function responseLogout()
    {
        return $this->response('Logged out');
    }
    
}
