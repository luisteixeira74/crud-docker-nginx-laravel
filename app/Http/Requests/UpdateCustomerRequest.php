<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $customerId = $this->route('customer')->id;

        return [
            'name' => 'sometimes|required|string|max:255',
            'email' => "sometimes|required|email|unique:customers,email,{$customerId}",
            'phone' => 'nullable|string|max:20',
        ];
    }
}
