<?php

namespace App\Http\Requests\Invoices;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceAddProductRequest extends FormRequest
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
            'quantity' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'quantity.required' => 'يجب ادخال الكميه',
            'quantity.integer'  => 'الكميه يجب ان تكون رقم صحيح'
        ];
    }
}
