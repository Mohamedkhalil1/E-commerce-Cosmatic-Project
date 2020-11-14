<?php

namespace App\Http\Requests\Suppliers;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            'name' => 'required|max:20',
            'address' => 'required',
            'phone' => 'required|numeric',
            'email' => 'nullable|email|max:50',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'يجب ادخال اسم المزود',
            'name.max'      =>'لا يجب ان يزيد اسم المزود عن 20 حرف',
            'address.required' => 'يجب ادخال عنوان المزود',
            'phone.required' => 'يجب ادخال رقم الهاتف الخاص بالمزود',
            'phone.numeric' => 'رقم الهاتف يجب ان يكون مجموعه ارقام',
            //'phone.max' => 'يجب ان يكون رقم الهاتف لا يزيد عن 15 رقم',
            //'phone.min' => 'لا يجب ان يكون رقم الهاتف اقل من 11 رقم', 
            'email.email' => 'البريد الالكتروني غير صحيح',
            'email.max' => 'لا يجب ان يزيد البريد الالكتروني عن 50 حرف'
        ];
    }
}
