<?php

namespace App\Http\Requests\Branches;

use Illuminate\Foundation\Http\FormRequest;

class BranchReuqest extends FormRequest
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
            'name'     =>  'required|max:20',
            'address'  =>  'required',
            'city'     =>  'required|max:15',
            'admin_id' => 'required'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'يجب ادخال اسم الفرع',
            'name.max' => 'يجب ان يكون اقصى عدد من الاحراف لاسم 20 حرف',
            'address.required' => 'يجب ادخال عنوان الفرع',
            'city.required' => 'يجب ادخال المدينه التى يوجد بيها الفرع',
            'city.max' => 'يجب ان يكون اقصى عدد من الاحراف لمدينه 15 حرف' ,
            'admin_id' => 'يجب ادخال الادمن'
        ];
    }
}
