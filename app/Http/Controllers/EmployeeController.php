<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\StoreRequest;
use App\Http\Requests\Employee\UpdateRequest;
use App\Service\EmployeeService;
use Illuminate\Support\Facades\Gate;

class EmployeeController extends Controller
{
    public $service;
    public function __construct(EmployeeService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $lists = $this->service->index();

        if ($lists)
            return response()->json($lists);
        else
            return response()->json('Not Found', 404);
    }

    public function store(StoreRequest $request)
    {
        $user = auth()->user();
        if (! Gate::allows('create-employee', $user)) {
            abort(403);
        }

        $params = $request->validated();    
        $data = $this->service->store($params);
        if ($data)
            return response()->json($data);
        else
            return response()->json('Error creating');
    }

    public function show(int $id)
    {
        $data = $this->service->show($id);
        if ($data)
            return response()->json($data);
        else
            return response()->json('Nit found', 404);
    }

    public function update(UpdateRequest $request, int $id)
    {
        $user = auth()->user();
        if (! Gate::allows('update-employee', $user)) {
            abort(403);
        }

        $params = $request->validated();
        $data = $this->service->update($params, $id);
        if ($data)
            return response()->json($data);
        else
            return response()->json('Error updating', 404);
    }

    public function destroy(int $id)
    {
        $user = auth()->user();
        if (! Gate::allows('delete-employee', $user)) {
            abort(403);
        }

        $model = $this->service->delete($id);

        if ($model)
            return response()->successJson('Deleted successfully');
        else
            return response()->json('Not removed', 404);
    }
}
