<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterWorkersRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'order_type_ids' => 'required|array',
            'order_type_ids.*' => 'integer|exists:order_types,id',
        ];

    }
}
