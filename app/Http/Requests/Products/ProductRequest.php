<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'title'          =>  'required|max:30',
            'price'          =>  'required|numeric',
            'price_discount' =>  'required|numeric',
            'stock'          =>  'required|integer',
            'image'          =>  'required_without:id|image'
        ];
    }

}
