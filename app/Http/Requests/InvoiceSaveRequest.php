<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceSaveRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'no_invoice' => 'required',
            'date' => 'required',
            'profile_id' => 'required',
            'project_id' => 'required'
        ];
    }
}
