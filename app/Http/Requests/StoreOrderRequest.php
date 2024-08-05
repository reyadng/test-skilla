<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'description' => 'required|string|max:10000',
            'address' => 'required|string|max:1000',
            'amount' => 'required|integer|min:1',
            'type_id' => 'required|integer|exists:order_types,id',
            'date' => 'required|date_format:Y-m-d',
        ];

    }
}
