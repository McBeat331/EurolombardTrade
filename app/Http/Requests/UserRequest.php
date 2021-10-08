<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $update = request('id') ? ',' . request('id') : '';
        return [
            'name' => 'request|string|min:3',
            'lastname' => 'nullable|string',
            'phone' => 'nullable|integer',
            'email' => 'request|email|unique:users,email'.$update,
        ];
    }
}
