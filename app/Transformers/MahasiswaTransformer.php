<?php

namespace App\Transformers;

use App\Mahasiswa;
use App\User;
use App\Transformers\KendaraanTransformer;
use League\Fractal\TransformerAbstract;

class MahasiswaTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */

    protected $availableIncludes = [
        'kendaraans'
    ];
    public function transform(Mahasiswa $mahasiswa)
    {
        return [
            'nama'        => $mahasiswa->nama,
            'email'       => $mahasiswa->email,
            'nif'         => $mahasiswa->nif,
            'prodi'       => $mahasiswa->prodi,
            'registered'  => $mahasiswa->created_at->diffForHumans(),
        ];
    }

    public function includeKendaraan()
    {
        $kendaraans = $mahasiswa->kendaraan;
        return $this->collection($kendaraans, new KendaraanTransformer);
    }
}
