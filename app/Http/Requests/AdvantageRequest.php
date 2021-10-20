<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvantageRequest extends FormRequest
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
            'description.*' => 'required',
            'meta_title.*' => 'nullable',
            'meta_description.*' => 'nullable',
            'image' => 'required|mimes:jpeg,png,svg|max:1024',
            'sort' => 'required|integer|min:1'
        ];
    }
    public function messages()
    {
        return [
            'title.*.required' => ':attribute обязательное поле',
            'description.*.required' => ':attribute обязательное поле',
            'sort.required' => ':attribute обязательное поле',
            'sort.integer' => 'Поле :attribute должно содержать только цифры',
            'sort.min' => 'Поле :attribute должно быть > или = 1',
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
            'sort' => 'Сортировка',
            'image' => 'Картинка',
        ];
    }
}
