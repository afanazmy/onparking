<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Parking;
use App\Transformers\ParkingTransformer;
use Auth;
use Illuminate\Support\Facades\DB;

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

    public function add(Request $request, Parking $parking)
    {
        $userIs = Auth::user()->as;

        if($userIs == "Operator") {
            $this->validate($request, [
                'license_plate'       => 'required|min:5|unique:parkings',
                'garage_name'         => 'required',
            ]);

            $license_plate_exist = DB::table('vehicles')
                                ->where('license_plate', $request->license_plate)
                                ->exists();

            $garage_exist = DB::table('garages')
                            ->where('name', $request->garage_name)
                            ->exists();

            if($garage_exist == true && $license_plate_exist == true) {
                $garage = DB::table('garages')
                        ->where('name', $request->garage_name)
                        ->first();

                $parking = $parking->create([
                    'license_plate'     => $request->license_plate,
                    'user_id'           => Auth::user()->id,
                    'garage_id'         => $garage->id
                ]);

                $response = fractal()
                    ->item($parking)
                    ->transformWith(new ParkingTransformer)
                    ->toArray();

                return response()->json($response, 201);
            } else {
                return response()->json([
                    'message' => 'Data invalid.'], 422);
            }

        } else {
            return response()->json([
                'message' => 'Unauthenticated.'], 401);
        }

    }
}
