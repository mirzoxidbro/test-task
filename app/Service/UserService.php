<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserService
{

    public function index()
    {
        return User::query()->latest('created_at')->paginate(10);
    }

    public function register(array $params)
    {
        $user = User::create([
            "name" => $params['name'],
            "email" => $params['email'],
            "password" => Hash::make($params['password'])
        ]);
        $token =  $user->createToken('MyApp')->plainTextToken;
        $data['user'] = $user;
        $data['token'] = $token;
        return $data;
    }

    public function login($credentials)
    {
        if(Auth::attempt($credentials))
        {
            $user = auth()->user();
            $token =  $user->createToken('MyApp')->plainTextToken;
            return $token;
        }
        return 0;

    }


    public function giveRole(array $params)
    {
        $user = User::findOrFail($params['user_id']);
        $role = Role::findOrFail($params['role_id']);
        return $user->assignRole($role);
         
    }

}