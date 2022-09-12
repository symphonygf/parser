<?php

namespace App\Import;

use App\DTO\CarDTO;

interface CarImportRowInterface extends ImportRowInterface
{
    public function getCar(): CarDTO;
}
