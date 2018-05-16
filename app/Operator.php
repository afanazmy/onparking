<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\User;

class Operator extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'operator_number', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
