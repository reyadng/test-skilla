<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignWorkerRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'worker_id' => 'required|integer|exists:workers,id',
            'amount' => 'required|integer|min:0',
        ];

    }
}
