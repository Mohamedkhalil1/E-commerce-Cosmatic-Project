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
            'name'          =>  'required|max:30',
            'description'   =>  'required',
            'price'         =>  'required|numeric',
            'stock'         => 'required|integer',
            'branch_id'     => 'required'
        ];
    }

    public function messages(){
        return [
            'name.required'             => 'يجب ادخال اسم المنتج',
            'name.max'                  => 'يجب ان يكون اقصى عدد من الاحراف لاسم 30 حرف',
            'description.required'      => 'يجب ادخال وصف المنتج',
            'price.required'            => 'يجب ادخال سعر المنتج',
            'price.numeric'             => 'السعر يجب ان يكون رقم',
            'stock.required'            => 'يجب ادخال كميه المنتج',
            'stock.integer'             => 'الكميه يجب ان تكون رقم صحيح',
            'branch_id.required'        =>  'يجب ادخال الفرع الخاص بالمنتج'
        ];
    }
}
