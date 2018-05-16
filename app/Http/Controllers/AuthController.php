<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Student;
use App\Operator;
use App\Transformers\UserTransformer;
use App\Transformers\RegisterTransformer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function studentRegister(Request $request, User $user, Student $student)
    {
        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:8',
            'nif'       => 'required|unique:students',
            'majors'    => 'required',
        ]);

        $user = $user->create([
            'name'           => $request->name,
            'email'          => $request->email,
            'password'       => bcrypt($request->password),
            'as'             => "Student",
            'api_token'      => bcrypt($request->email),
        ]);

        $userRegister = DB::table('users')->where('name', $request->name)->first();

        $student = $student->create([
            'nif'       => $request->nif,
            'majors'    => $request->majors,
            'user_id'   => $userRegister->id
        ]);

        $response = fractal()
            ->item($user)
            ->transformWith(new RegisterTransformer)
            ->addMeta([
                'token' => $user->api_token,
            ])
            ->toArray();

        return response()->json($response, 201);
    }

    public function operatorRegister(Request $request, User $user, Operator $operator)
    {
        $this->validate($request, [
            'name'              => 'required',
            'email'             => 'required|email|unique:users',
            'password'          => 'required|min:8',
            'operator_number'   => 'required|unique:operators',
        ]);

        $user = $user->create([
            'name'           => $request->name,
            'email'          => $request->email,
            'password'       => bcrypt($request->password),
            'as'             => "Operator",
            'api_token'      => bcrypt($request->email),
        ]);

        $userRegister = DB::table('users')->where('name', $request->name)->first();

        $operator = $operator->create([
            'operator_number'       => $request->operator_number,
            'user_id'               => $userRegister->id
        ]);

        $response = fractal()
            ->item($user)
            ->transformWith(new RegisterTransformer)
            ->addMeta([
                'token' => $user->api_token,
            ])
            ->toArray();

        return response()->json($response, 201);
    }

    public function Login(Request $request, User $user)
    {
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(['error' => 'Your credential is wrong'], 401);
        }

        $user = $user->find(Auth::user()->id);

        return fractal()
            ->item($user)
            ->transformWith(new UserTransformer)
            ->addMeta([
                'token' => $user->api_token,
            ])
            ->toArray();
    }
}
