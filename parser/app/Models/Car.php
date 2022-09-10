<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static firstOrCreate(array $array)
 */
class Car extends Model
{
    /**
     * @var string
     */
    protected $table = 'car';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'mark',
        'model',
        'generation',
        'year',
        'run',
        'color',
        'body_type',
        'engine_type',
        'transmission',
        'gear_type',
        'generation_id'
    ];
}
