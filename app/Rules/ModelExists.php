<?php

namespace App\Rules;

use App\Repositories\HasExistenceCheck;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ModelExists implements ValidationRule
{
    public function __construct(
        private HasExistenceCheck $repository,
    ) {
    }

    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->repository->exists($value)) {
            $fail("Model :attribute = $value not found");
        }
    }
}
