<?php

namespace App\Http\Requests\Company;

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
            'user_id' => 'nullable|integer|exists:users,id',
            'company_name' => 'nullable|string',
            'director' => 'nullable|string',
            'address' => 'nullable|string',
            'email' => 'nullable|string',
            'website' => 'nullable|string',
            'phone' => 'nullable|max:15|regex:/^(998)[0-9]{9}$/'
        ];
    }
}
