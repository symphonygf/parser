<?php

namespace App\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class CarDTO extends DataTransferObject
{
    public int $id;
    public string $mark;
    public string $model;
    public string $generation;
    public int $year;
    public int $run;
    public string $color;
    public string $bodyType;
    public string $engineType;
    public string $transmission;
    public string $gearType;
    public string $generationId;

    public function toArray(): array
    {
        return
        [
           'id' => $this->id,
           'mark' => $this->mark,
           'model' => $this->model,
           'generation' => $this->generation,
           'year' => $this->year,
           'run' => $this->run,
           'color' => $this->color,
           'bodyType' => $this->bodyType,
           'engineType' => $this->engineType,
           'transmission' => $this->transmission,
           'gearType' => $this->gearType,
           'generationId' => $this->generationId
        ];
    }

    public function toModel(): array
    {
        return
            [
                'id' => $this->id,
                'mark' => $this->mark,
                'model' => $this->model,
                'generation' => $this->generation,
                'year' => $this->year,
                'run' => $this->run,
                'color' => $this->color,
                'body_type' => $this->bodyType,
                'engine_type' => $this->engineType,
                'transmission' => $this->transmission,
                'gear_type' => $this->gearType,
                'generation_id' => $this->generationId
            ];
    }
}
