<?php

namespace App\Command;

use App\DTO\CarDTO;
use App\Models\Car;
use Illuminate\Support\Facades\Log;

class ImportCarCommandHandler implements ImportCarCommandHandlerInterface
{
    public function handle(CarDTO $car): void
    {
        Log::info('В фиде описана машина: ' . serialize($car));
        Car::firstOrCreate($car->toModel());
    }
}
