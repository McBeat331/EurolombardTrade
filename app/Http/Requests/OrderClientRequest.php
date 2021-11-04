<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderClientRequest extends FormRequest
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
            'rate_id' => 'required',
            'isOpt' => 'required|integer',

            'currency_sale' => 'required|string',
            'currency_buy' => 'required|string',

            'rate_sale' => 'required',
            'rate_buy' => 'required',

            'price_sale' => 'required',
            'price_buy' => 'required',

            'status' => 'required|integer',
            'fio' => 'required',
            'email' => 'required|email',
            'phone' => 'required'
        ];
    }
}
