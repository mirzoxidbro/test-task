<?php

namespace App\Service;

use App\Models\Company;

class CompanyService
{

    public function index()
    {
        $user = auth()->user();
        $role = $user->hasRole('admin');
        if($role)
        {
            return Company::query()->select(['id', 'company_name', 'director', 'address', 'email', 'website', 'phone', 'updated_at'])->paginate(10);
        }

        return Company::query()->where('user_id', $user->id)->select(['id', 'company_name', 'director', 'address', 'email', 'website', 'phone', 'updated_at'])->paginate(10);

    }   
    
    

    public function store(array $params)
    {
        $user = auth()->user();
        $role = $user->hasRole('admin');
        if($role)
        {
            $user_id = $params['user_id'];
        }

       return Company::create([
            'user_id' => $user_id ?? $user->id,
            'company_name' => $params['company_name'],
            'director' => $params['director'],
            'address' => $params['address'],
            'website' => $params['website'],
            'email' => $params['email'],
            'phone' => $params['phone']
        ]);
    }

    public function show(int $id)
    {
        
        return Company::query()->where('id', $id)->select(['user_id', 'id', 'company_name', 'director', 'address', 'email', 'website', 'phone', 'updated_at'])->get();
        
    }

    public function update(array $params, int $id)
    {
            $company = Company::query()->findOrFail($id);
            $company->update($params);
            return $company;
    }

    public function delete(int $id)
    {
        $company = Company::query()->findOrFail($id);
        return ($company) ? $company->delete() : false;
        
    }
}