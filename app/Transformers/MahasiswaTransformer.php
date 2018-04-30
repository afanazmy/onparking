<?php

namespace App\Transformers;

use App\Mahasiswa;
use League\Fractal\TransformerAbstract;

class MahasiswaTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
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
}
