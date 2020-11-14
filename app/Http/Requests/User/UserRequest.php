<?php

namespace App\Http\Requests\User;

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
        return [
            'name' => 'required|max:20',
            'email' => 'nullable|email',
            'phone' => 'required|numeric',
            'old_password' => 'nullable',
            'password' => 'nullable|confirmed',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'يجب ادخال اسم العميل',
            'name.max'      =>'لا يجب ان يزيد اسم العميل عن 20 حرف',
            'address.required' => 'يجب ادخال عنوان العميل',
            'phone.required' => 'يجب ادخال رقم الهاتف الخاص بالعميل',
            'phone.numeric' => 'رقم الهاتف يجب ان يكون مجموعه ارقام',
            'email.email' => 'البريد الالكتروني غير صحيح',
            'password.confirmed' => 'الرقم المرور غير مطابقه'
        ];
    }
}
