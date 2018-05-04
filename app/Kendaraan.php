<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table = "kendaraan";

    protected $fillable = [
        'plat_nomor', 'jenis', 'merk', 'tipe', 'id_mahasiswa',
    ];
}
