<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Transformers\UserTransformer;
use App\User;
use Auth;

class UserController extends Controller
{
    public function users(User $user)
    {
        $users = $user->all();

        return fractal()
            ->collection($users)
            ->transformWith(new UserTransformer)
            ->toArray();
    }

    public function studentProfile(User $user)
    {
        $user = $user->find(Auth::user()->id);

        return fractal()
            ->item($user)
            ->transformWith(new UserTransformer)
            ->includeStudent()
            ->toArray();
    }

    public function operatorProfile(User $user)
    {
        $user = $user->find(Auth::user()->id);

        return fractal()
            ->item($user)
            ->transformWith(new UserTransformer)
            ->includeOperator()
            ->toArray();
    }
}
