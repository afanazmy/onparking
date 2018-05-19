<?php

namespace App\Policies;

use App\User;
use App\Student;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentPolicy
{
    use HandlesAuthorization;

    public function updateStudent(User $user, Student $student)
    {
        return $user->ownStudent($student);
    }
}
