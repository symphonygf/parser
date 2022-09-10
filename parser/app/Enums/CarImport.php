<?php

namespace App\Enums;

enum CarImport: string
{
    case ID = 'id';
    case MARK = 'mark';
    case MODEL = 'model';
    case GENERATION = 'generation';
    case YEAR = 'year';
    case RUN = 'run';
    case COLOR = 'color';
    case BODY_TYPE = 'body-type';
    case ENGINE_TYPE = 'engine-type';
    case TRANSMISSION = 'transmission';
    case GEAR_TYPE = 'gear-type';
    case GENERATION_ID = 'generation_id';
}
