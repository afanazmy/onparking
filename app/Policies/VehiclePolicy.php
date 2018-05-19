<?php

namespace App\Policies;

use App\User;
use App\Vehicle;
use Illuminate\Auth\Access\HandlesAuthorization;

class VehiclePolicy
{
    use HandlesAuthorization;

    public function updateVehicle(User $user, Vehicle $vehicle)
    {
        return $user->ownVehicle($vehicle);
    }
}
