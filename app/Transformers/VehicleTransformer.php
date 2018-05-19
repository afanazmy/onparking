<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Vehicle;

class VehicleTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Vehicle $vehicle)
    {
        return [
            'id'            =>  $vehicle->id,
            'license_plate' =>  $vehicle->license_plate,
            'kind'          =>  $vehicle->kind,
            'brand'         =>  $vehicle->brand,
            'type'          =>  $vehicle->type,
            'registered'    =>  $vehicle->created_at->diffForHumans(),
        ];
    }
}
