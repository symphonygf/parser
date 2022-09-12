<?php

namespace App\Factories;

use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Validation\Validator as Validation;

class ValidatorFactory implements ValidatorFactoryInterface
{
    public function createValidation(array $validationData, array $rules): Validation
    {
        return Validator::make($validationData, $rules);
    }
}
