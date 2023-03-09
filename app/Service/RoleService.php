<?php

namespace App\Service;

use Spatie\Permission\Models\Role;

class RoleService
{
    public function index()
    {
        return Role::query()->paginate(10);
    }
}