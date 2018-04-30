<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Mahasiswa;

class AuthController extends Controller
{
    public function register(Request $request, Mahasiswa $mahasiswa)
    {
        $this->validate($request, [
            'email'     => 'required|email|unique:mahasiswas',
            'password'  => 'required|min:8',
            'nama'      => 'required',
            'nif'       => 'required',
            'prodi'     => 'required'
        ]);

        $mahasiswa = $mahasiswa->create([
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'api_token' => bcrypt($request->email),
            'nama'      => $request->nama,
            'nif'       => $request->nif,
            'prodi'     => $request->prodi
        ]);

        return fractal()
            ->item($mahasiswa['nama'])
            ->transformWith(new MahasiswaTransformer)
            ->toArray();
    }
}
