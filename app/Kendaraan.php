<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Kendaraan extends Model
{
    protected $table = "kendaraan";

    protected $fillable = [
        'plat_nomor', 'jenis', 'merk', 'tipe', 'id_mahasiswa',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(User::class);
    }
}
