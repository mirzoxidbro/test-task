<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\GiveRoleRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Service\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(protected UserService $service)
    {
        
    }

    public function index()
    {
        $list = $this->service->index();
        return response()->json($list);
    }

    public function register(RegisterRequest $request)
    {
        $params = $request->validated();
        $user = $this->service->register($params);
        return response()->json($user);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $token = $this->service->login($credentials);
        if($token){
            return response()->json($token);
        } 
        else{ 
            return response()->json(['error'=>'Unauthorized']);
        }
    }

    public function me()
    {

        return response()->json(auth()->user());
    }

    public function logout()    
    {
        auth()->user()->tokens()->delete();
        return response()->json('Logged out');
    }

    public function giveRole(GiveRoleRequest $request)
    {
        $params = $request->validated();
        $data = $this->service->giveRole($params);
        return $data;
    }
}
