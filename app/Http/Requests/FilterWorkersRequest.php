<?php

namespace App\Http\Requests;

use App\Repositories\IWorkerRepository;
use App\Rules\ModelExists;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class FilterWorkersRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(IWorkerRepository $repository): array
    {
        return [
            'order_type_ids' => 'required|array',
            'order_type_ids.*' => ['integer', new ModelExists($repository)],
            'limit' => 'nullable|integer|min:1|max:5',
            'start' => 'nullable|integer|min:0',
        ];

    }
}
