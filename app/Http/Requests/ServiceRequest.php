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
            'description.*' => 'nullable',
            'meta_title.*' => 'nullable',
            'meta_description.*' => 'nullable',
            'image' => 'nullable|mimes:jpeg,png,svg|max:1024',
        ];
    }
}
