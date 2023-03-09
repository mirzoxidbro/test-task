<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\StoreRequest;
use App\Http\Requests\Company\UpdateRequest;
use App\Http\Resources\CompanyResource;
use App\Service\CompanyService;
use Illuminate\Support\Facades\Gate;

class CompanyController extends Controller
{

    public function __construct(private CompanyService $service)
    {
        
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
        if (! Gate::allows('view-company', $data)) {
            abort(403);
        }
        if ($data)
            return response()->json($data);
        else
            return response()->json('Not Found', 404);
    }

    //berilgan shartga muvofiq faqat company role dagi foydalanuvchilar
    //o'zlariga tegishli xodim ma'lumotlarini yarata oladi taxrirlay oladi va o'chira oladi

    public function update(UpdateRequest $request, int $id)
    {
        $data = $this->service->show($id);
        if (! Gate::allows('update-company', $data)) {
            abort(403);
        }

        $params = $request->validated();
        $data = $this->service->update($params, $id);
        if ($data)
            return response()->json($data);
        else
            return response()->json('Error while updating', 404);
    }

    public function destroy(int $id)
    {
        $data = $this->service->show($id);
        if (! Gate::allows('delete-company', $data)) {
            abort(403);
        }
        $model = $this->service->delete($id);

        if ($model)
            return response()->json('Deleted successfully');
        else
            return response()->json('Not removed', 404);
    }
}
