<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Parking;

class ParkingTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Parking $parking)
    {
        return [
            'id'            => $parking->id,
            'license_plate' => $parking->license_plate,
            'user_id'       => $parking->user_id,
            'garage_id'     => $parking->garage_id,
        ];
    }
}
