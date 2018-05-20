<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Garage;

class GarageTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Garage $garage)
    {
        return [
            'id'        => $garage->id,
            'name'      => $garage->name,
            'capacity'  => $garage->capacity,
        ];
    }
}
