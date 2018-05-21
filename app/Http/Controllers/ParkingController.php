<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Parking;
use App\User;
use App\Transformers\ParkingTransformer;
use Auth;
use Illuminate\Support\Facades\DB;

class ParkingController extends Controller
{
    public function parkings(Parking $parking)
    {
        $userIs = Auth::user()->as;

        if($userIs == "Operator") {
            $parkings = $parking->all();

            return fractal()
                ->collection($parkings)
                ->transformWith(new ParkingTransformer)
                ->toArray();
        } else {
            return response()->json([
                'message'   => "Unauthenticated."
            ], 401);
        }

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

    public function update(Request $request, Parking $parking)
    {

        $userIs = Auth::user()->as;

        if($userIs == "Operator") {
            $this->validate($request, [
                'license_plate'       => 'required|min:5',
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

                $parking->license_plate = $request->get('license_plate', $parking->license_plate);
                $parking->user_id       = Auth::user()->id;
                $parking->garage_id     = $garage->id;
                $parking->save();

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

    public function delete(Parking $parking)
    {
        $userIs = Auth::user()->as;

        if($userIs == "Operator") {
            $parking->delete();

            return response()->json([
                'message' => 'Deleted.']);
        } else {
            return response()->json([
                'message' => 'Unauthenticated.'], 401);
        }
    }

    public function student(Parking $parking, User $user)
    {
        $user = Auth::user()->id;

        $vehicle_exist = DB::table('vehicles')
            ->where('user_id', $user)
            ->exists();

        if($vehicle_exist == true) {
            $vehicle = DB::table('vehicles')
                ->where('user_id', $user)
                ->first();

            $parking_exist = DB::table('parkings')
                ->where('license_plate', $vehicle->license_plate)
                ->exists();

            if ($parking_exist == true) {
                $find_parking = DB::table('parkings')
                    ->where('license_plate', $vehicle->license_plate)
                    ->first();

                $parking = $parking->find($find_parking->id);

                return fractal()
                    ->item($parking)
                    ->transformWith(new ParkingTransformer)
                    ->toArray();
            } else {
                return response()->json([
                    'message'   => 'Not found.'
                ], 404);
            }
        } else {
            return response()->json([
                'message'   => 'Not found.'
            ], 404);
        }


    }
}
