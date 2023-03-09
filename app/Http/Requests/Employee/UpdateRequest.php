<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'passport' => 'nullable',
            'firstname' => 'nullable',
            'lastname' => 'nullable',
            'parent_name' => 'nullable',
            'position' => 'nullable',
            'phone' => 'nullable',
            'address' => 'nullable',
            'company_name' => 'nullable'
        ];
    }
}
