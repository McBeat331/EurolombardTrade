<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'title.*' => 'required',
            'email' => 'nullable|email',
            'link' => 'nullable|url',
            'description.*' => 'nullable',
            'meta_title.*' => 'nullable',
            'meta_description.*' => 'nullable',
            'image' => 'mimes:jpeg,png,svg|max:1024',
        ];
    }
    public function messages()
    {
        return [
            'title.*.required' => ':attribute обязательное поле',
            'description.*.required' => ':attribute обязательное поле',
            'image.required' => ':attribute обязательное поле',
            'image.mimes' => ':attribute должна быть в jpeg,png,svg формате',
            'image.max' => ':attribute должна быть меньше 1 мБ ',
        ];
    }
    public function attributes()
    {
        return [
            'title.uk' => 'Заголовок на украинском',
            'title.ru' => 'Заголовок на русском',
            'description.uk' => 'Описание на украинском',
            'description.ru' => 'Описание на русском',
            'image' => 'Картинка',
        ];
    }
}
