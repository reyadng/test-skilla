<?php

namespace App\Http\Requests;

use App\Repositories\IWorkerRepository;
use App\Rules\ModelExists;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AssignWorkerRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(IWorkerRepository $repository): array
    {
        return [
            'worker_id' => ['required', 'integer', new ModelExists($repository)],
            'amount' => 'required|integer|min:0',
        ];

    }
}
