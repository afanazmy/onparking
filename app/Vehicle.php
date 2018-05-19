<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Vehicle extends Model
{
    protected $fillable = [
        'user_id', 'license_plate', 'kind', 'brand', 'type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
