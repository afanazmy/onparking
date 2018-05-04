<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Kendaraan;

class KendaraanTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Kendaraan $kendaraan)
    {
        return [
            'plat_nomor'    => $kendaraan->plat_nomor,
            'jenis'         => $kendaraan->jenis,
            'merk'          => $kendaraan->merk,
            'tipe'          => $kendaraan->tipe,
            'id_mahasiswa'  => $kendaraan->id_mahasiswa
        ];
    }
}
