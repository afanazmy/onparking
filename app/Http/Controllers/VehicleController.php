<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehicle;
use App\User;
use App\Http\Requests;
use Auth;
use App\Transformers\VehicleTransformer;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{
    public function vehicles(Vehicle $vehicle)
    {
        $vehicles = $vehicle->all();

        return fractal()
            ->collection($vehicles)
            ->transformWith(new VehicleTransformer)
            ->toArray();
    }

    public function vehicle(Vehicle $vehicle, User $user)
    {
        $user = Auth::user()->id;

        $vehicle_exist = DB::table('vehicles')
            ->where('user_id', $user)
            ->exists();

        if ($vehicle_exist == true) {
            $find_vehicle = DB::table('vehicles')
                ->where('user_id', $user)
                ->first();

            $vehicle = $vehicle->find($find_vehicle->id);

            return fractal()
                ->item($vehicle)
                ->transformWith(new VehicleTransformer)
                ->toArray();
        } else {
            return response()->json([
                'message'   => 'Not found.'
            ], 404);
        }
    }

    public function add(Request $request, Vehicle $vehicle)
    {
        $this->validate($request, [
            'license_plate'     => 'required|min:5|unique:vehicles',
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

    public function update(Request $request, Vehicle $vehicle)
    {
        // dd($vehicle);

        $this->authorize('updateVehicle', $vehicle);

        $this->validate($request, [
            'license_plate'      => 'required',
            'kind'               => 'required',
            'brand'              => 'required',
            'type'               => 'required',
        ]);

        $vehicle->license_plate = $request->get('license_plate', $vehicle->license_plate);
        $vehicle->kind          = $request->get('kind', $vehicle->kind);
        $vehicle->brand         = $request->get('brand', $vehicle->brand);
        $vehicle->type          = $request->get('type', $vehicle->type);
        $vehicle->user_id       = Auth::user()->id;
        $vehicle->save();

        return fractal()
            ->item($vehicle)
            ->transformWith(new VehicleTransformer)
            ->toArray();
    }
}
