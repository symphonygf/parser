<?php

namespace App\Import;

use App\DTO\CarDTO;

class CarImportRow implements ImportRowInterface
{
    public function __construct(private int $rowIndex, private CarDTO $car)
    {
    }

    public function getRowIndex(): int
    {
        return $this->rowIndex;
    }

    public function getCar(): CarDTO
    {
        return $this->car;
    }

    public function getData(): array
    {
        return $this->car->toArray();
    }
}
