<?php

namespace App\Command;

use App\DTO\CarDTO;

interface ImportCarCommandHandlerInterface
{
    public function handle(CarDTO $car): void;
}
