<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\User;
use App\Student;
use App\Parking;
use App\Transformers\StudentTransformer;
use App\Transformers\OperatorTransformer;
use App\Transformers\VehicleTransformer;
use App\Transformers\ParkingTransformer;
use Illuminate\Support\Facades\DB;

class UserTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'student', 'operator', 'vehicle', 'parking'
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id'        => $user->id,
            'email'     => $user->email,
        ];
    }

    public function includeStudent(User $user)
    {
        $student = $user->student;

        return $this->item($student, new StudentTransformer);
    }

    public function includeOperator(User $user)
    {
        $operator = $user->operator;

        return $this->item($operator, new OperatorTransformer);
    }

    public function includeVehicle(User $user)
    {
        $vehicle = $user->vehicle;

        return $this->item($vehicle, new VehicleTransformer);
    }

    public function includeParking(User $user)
    {
        $parking = $user->parking;

        return $this->item($parking, new ParkingTransformer);
    }

}
