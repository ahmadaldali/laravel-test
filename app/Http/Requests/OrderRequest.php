<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'order_status_uuid' => 'required|string|exists:order__statuses,uuid',
            'payment_uuid' => 'required|string|exists:payments,uuid',
            'products' => 'required|json',
            'address' => 'required|json',
        ];
    }
}