<?php

namespace App\Http\Controllers;
use App\Service\RoleService;

class RoleController extends Controller
{
    public function __construct(protected RoleService $service)
    {
        
    }

    public function index()
    {
        $list = $this->service->index();
        return response()->json($list);
    }
}
