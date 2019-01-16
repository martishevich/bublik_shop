<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductValidation extends FormRequest
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
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|between:3,64',
            'price'       => 'required|regex:/^\s*(?=.*[1-9])\d*(?:\.\d{1,2})?\s*$/',
            'is_active'   => 'required|boolean',
            'description' => 'required|max:4000',
            'short_disc'  => 'required|max:255',
            'image'       => 'mimes:jpeg,jpg'
        ];
    }

    public function messages()
    {
        return [
            'required'           => 'Just do it! The :attribute field is required!',
            'category_id.exists' => 'Hmmm... This category was not found!',
            'price.regex'        => 'I want digit between 0.01 and 99999999999999.99',
            'image.mimes'        => 'I can use only jpeg/jpg formats less than 8Mb!'
        ];
    }
}
