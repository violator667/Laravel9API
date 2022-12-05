<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * Class ApiRequest
 * @package App\Http\Requests
 */
class ApiRequest extends FormRequest
{
    /**
     * @param Validator $validator
     * @return HttpResponseException
     */
    public function failedValidation(Validator $validator) :HttpResponseException
    {
        throw new HttpResponseException(response()->json([
            'error'   => true,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
}
