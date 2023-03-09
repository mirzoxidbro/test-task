<?php

namespace App\Http\Requests\Employee;

use App\Rules\PassportRule;
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
            'passport' => ['required', new PassportRule],
            'firstname' => 'required',
            'lastname' => 'required|string',
            'parent_name' => 'required|string',
            'position' => 'required|string',
            'phone' => 'required|max:15|regex:/^(998)[0-9]{9}$/',
            'address' => 'required|string',
            'company_name' => 'required|string'
        ];
    }
}
