<?php

namespace App\Service;

use App\Models\Employee;

class EmployeeService
{
    public function index()
    {
        $company_id = auth()->user()->company->id;
        $user = auth()->user();
        $role = $user->hasRole('admin');
        if($role)
        {
            return Employee::query()->select(['id', 'company_id', 'passport', 'firstname', 'lastname', 'parent_name', 'phone', 'position', 'address', 'company_name'])->paginate(10);
        }

        return Employee::query()->where('user_id', $company_id)->select(['id', 'company_id', 'passport', 'firstname', 'lastname', 'parent_name', 'phone', 'position', 'address', 'company_name'])->paginate(10);

    }
    
    public function store(array $params)
    {
        $params['company_id'] = auth()->user()->company->id;
       return Employee::create($params);
    }

    public function show(int $id)
    {
        
        return Employee::query()->where('id', $id)->select(['id', 'company_id', 'passport', 'firstname', 'lastname', 'parent_name', 'phone', 'position', 'address', 'company_name'])->get();
        
    }

    public function update(array $params, int $id)
    {
            $company = Employee::query()->findOrFail($id);
            $company->update($params);
            return $company;
    }

    public function delete(int $id)
    {
        $company = Employee::query()->findOrFail($id);
        return ($company) ? $company->delete() : false;
        
    }
}