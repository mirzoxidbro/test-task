<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'passport' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'parent_name' => 'required',
            'position' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'company_name' => 'required'
        ];
    }
}
