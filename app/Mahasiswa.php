<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Kendaraan;

class Mahasiswa extends Model
{
    protected $table = "mahasiswas";

    protected $fillable = [
        'email', 'api_token', 'password', 'nama', 'nif', 'prodi',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function kendaraans()
    {
        return $this->hasOne(Kendaraan::class);
    }
}
