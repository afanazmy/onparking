<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = "mahasiswas";

    protected $fillable = [
        'email', 'api_token', 'password', 'nama', 'nif', 'prodi',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
