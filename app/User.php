<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Student;
use App\Operator;
use App\Vehicle;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'as', 'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function operator()
    {
        return $this->hasOne(Operator::class);
    }

    public function vehicle()
    {
        return $this->hasOne(Vehicle::class);
    }

    public function ownStudent(Student $student)
    {
        return Auth::user()->id == $student->user->id;
    }

    public function ownOperator(Operator $operator)
    {
        return Auth::user()->id == $operator->user->id;
    }

    public function ownVehicle(Vehicle $vehicle)
    {
        return Auth::user()->id == $vehicle->user->id;
    }
}
