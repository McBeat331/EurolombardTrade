<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'user_id' => 'required|integer',
            'address_id' => 'required|integer',

            'currency_from' => 'required|string',
            'currency_to' => 'required|string',

            'rate_from' => 'required',
            'rate_to' => 'required',

            'price_from' => 'required',
            'price_to' => 'required',

            'status' => 'required|integer',
        ];
    }
}
