<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Parking;
use App\Transformers\ParkingTransformer;

class ParkingController extends Controller
{
    public function parkings(Parking $parking)
    {
        $parkings = $parking->all();

        return fractal()
            ->collection($parkings)
            ->transformWith(new ParkingTransformer)
            ->toArray();
    }
}
