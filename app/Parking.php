<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    protected $fillable = [
        'license_plate', 'user_id', 'garage_id',
    ];
}
