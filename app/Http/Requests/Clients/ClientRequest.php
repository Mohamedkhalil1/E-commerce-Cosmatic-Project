<?php

namespace App\Http\Requests\Clients;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'name.required' => 'يجب ادخال اسم العميل',
            'name.max'      =>'لا يجب ان يزيد اسم العميل عن 20 حرف',
            'address.required' => 'يجب ادخال عنوان العميل',
            'phone.required' => 'يجب ادخال رقم الهاتف الخاص بالعميل',
            'phone.numeric' => 'رقم الهاتف يجب ان يكون مجموعه ارقام',
            //'phone.max' => 'يجب ان يكون رقم الهاتف لا يزيد عن 15 رقم',
            'email.email' => 'البريد الالكتروني غير صحيح',
            'email.max' => 'لا يجب ان يزيد البريد الالكتروني عن 50 حرف'
        ];
    }
}
