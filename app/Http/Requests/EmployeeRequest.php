<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Requests\ApiRequest;

class EmployeeRequest extends ApiRequest
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
     * @return array
     */
    public function rules() :array
    {
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone_number' => 'nullable|numeric',
            'email' => 'required|email',
            'company_id' => 'required'
        ];
    }
}
