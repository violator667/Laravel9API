<?php

namespace App\Http\Requests;

//use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Requests\ApiRequest;

class CompanyRequest extends ApiRequest
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
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'nip' => 'required|nip',
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'post_code' => 'required|regex:/^(?:\d{2}-\d{3})$/i'
        ];
    }
}
