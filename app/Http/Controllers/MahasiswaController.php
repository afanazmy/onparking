<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mahasiswa;
use App\Http\Requests;
use App\Transformers\MahasiswaTransformer;
use Auth;

class MahasiswaController extends Controller
{
    public function mahasiswas(Mahasiswa $mahasiswa)
    {
        $mahasiswas = $mahasiswa->all();

        return fractal()
            ->collection($mahasiswas)
            ->transformWith(new MahasiswaTransformer)
            ->toArray();
    }

    public function profil(Mahasiswa $mahasiswa)
    {
        $mahasiswa = $mahasiswa->find(Auth::user()->id);

        return fractal()
            ->item($mahasiswa)
            ->transformWith(new MahasiswaTransformer)
            ->includeKendaraan()
            ->toArray();
    }
}
