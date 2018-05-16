<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\User;
use App\Student;
use App\Transformers\StudentTransformer;
use App\Transformers\OperatorTransformer;

class UserTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'student', 'operator',
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
            'name'      => $user->name,
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
}
