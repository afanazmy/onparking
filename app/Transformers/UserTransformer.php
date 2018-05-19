<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\User;
use App\Student;
use App\Transformers\StudentTransformer;
use App\Transformers\OperatorTransformer;
use App\Transformers\VehicleTransformer;

class UserTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'student', 'operator', 'vehicle'
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

}
