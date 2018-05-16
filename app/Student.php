<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\User;

class Student extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'nif', 'majors', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
