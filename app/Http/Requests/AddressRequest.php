<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'city_id' => 'required|min:1',
            'name.*' => 'required|string|min:3',
            'phones' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.*.required' => ':attribute обязательное поле',
            'city_id.min' => ':attribute обязательное поле',
            'city_id.required' => ':attribute обязательное поле',
            'phones.required' => ':attribute обязательное поле',

        ];
    }
    public function attributes()
    {
        return [
            'name.uk' => 'Адрес на украинском',
            'name.ru' => 'Адрес на русском',
            'city_id' => 'Город',
            'phones' => 'Номер телефона'
        ];
    }
}
