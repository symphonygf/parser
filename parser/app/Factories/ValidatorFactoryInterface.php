<?php

namespace App\Factories;

use Illuminate\Contracts\Validation\Validator as Validation;

interface ValidatorFactoryInterface
{
    public function createValidation(array $validationData, array $rules): Validation;
}
