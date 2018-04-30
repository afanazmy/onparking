<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mahasiswa;
use App\Http\Requests;
use App\Transformers\MahasiswaTransformer;

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
}
