<?php

namespace App\Policies;

use App\User;
use App\Operator;
use Illuminate\Auth\Access\HandlesAuthorization;

class OperatorPolicy
{
    use HandlesAuthorization;

    public function updateOperator(User $user, Operator $operator)
    {
        return $user->ownOperator($operator);
    }
}
