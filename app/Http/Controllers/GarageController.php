<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Garage;
use App\Transformers\GarageTransformer;
use Auth;

class GarageController extends Controller
{
    public function garages(Garage $garage)
    {
        $garages = $garage->all();

        return fractal()
            ->collection($garages)
            ->transformWith(new GarageTransformer)
            ->toArray();
    }

    public function add(Request $request, Garage $garage)
    {
        $userIs = Auth::user()->as;

        //dd($userIs);

        if($userIs == "Operator") {
            $this->validate($request, [
                'name'     => 'required',
                'capacity' => 'required',
            ]);

            //"message": "Unauthenticated."

            $garage = $garage->create([
                'user_id'   => Auth::user()->id,
                'name'      => $request->name,
                'capacity'  => $request->capacity,
            ]);

            $response = fractal()
                ->item($garage)
                ->transformWith(new GarageTransformer)
                ->toArray();

            return response()->json($response, 201);
        } else {
            return response()->json([
                'message' => 'Unauthenticated.'], 401);
        }
    }

    public function update(Request $request, Garage $garage)
    {
        $userIs = Auth::user()->as;
        // dd($vehicle);

        if($userIs == "Operator") {
            $this->validate($request, [
                'name'      => 'required',
                'capacity'  => 'required',
            ]);

            $garage->name         = $request->get('name', $garage->name);
            $garage->capacity     = $request->get('capacity', $garage->capacity);
            $garage->user_id      = Auth::user()->id;
            $garage->save();

            return fractal()
                ->item($garage)
                ->transformWith(new GarageTransformer)
                ->toArray();
        } else {
            return response()->json([
                'message' => 'Unauthenticated.'], 401);
        }
    }

    public function delete(Garage $garage)
    {
        $userIs = Auth::user()->as;

        if($userIs == "Operator") {
            $garage->delete();

            return response()->json([
                'message' => 'Deleted.']);
        } else {
            return response()->json([
                'message' => 'Unauthenticated.'], 401);
        }

    }
}
