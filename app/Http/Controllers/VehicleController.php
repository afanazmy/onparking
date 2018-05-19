<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehicle;
use App\Http\Requests;
use Auth;
use App\Transformers\VehicleTransformer;

class VehicleController extends Controller
{
    public function add(Request $request, Vehicle $vehicle)
    {
        $this->validate($request, [
            'license_plate'     => 'required|min:8|unique:vehicles',
            'kind'              => 'required',
            'brand'             => 'required',
            'type'              => 'required',
        ]);

        $vehicle = $vehicle->create([
            'user_id'       => Auth::user()->id,
            'license_plate' => $request->license_plate,
            'kind'          => $request->kind,
            'brand'         => $request->brand,
            'type'          => $request->type,
        ]);

        $response = fractal()
            ->item($vehicle)
            ->transformWith(new VehicleTransformer)
            ->toArray();

        return response()->json($response, 201);
    }
}
