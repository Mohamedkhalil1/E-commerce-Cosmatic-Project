<?php

namespace App\Http\Requests\Invoices;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'date' => 'required|date',
            'client_id' => 'required|integer|exists:clients,id',
            'branch_id' => 'required|integer|exists:branches,id'
        ];
    }

    public function messages()
    {
        return [
            'date.required' => 'يجب ادخال تاريخ الفاتوره',
            'date.date' => 'التاريخ غير صالح',
            'client_id.required' => 'يجب ادخال العميل صاحب الفاتوره',
            'client_id.integer' => 'يرجو التأكد من اختيار العميل',
            'client_id.exists' => 'العميل غير موجود',
            'branch_id.required' => 'يجب ادخال الفرع صاحب الفاتوره',
            'branch_id.integer' => 'يرجو التأكد من اختيار الفرع',
            'branch_id.exists' => 'الفرع غير موجود',
            
        ];
    }

}
