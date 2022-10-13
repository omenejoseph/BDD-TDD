<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetupUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
            'company_name' => 'required|string',
            'company_email' => 'required|email',
            'number_of_employees' => 'required|numeric'
        ];
    }
}
