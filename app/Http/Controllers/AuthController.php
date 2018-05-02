<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Mahasiswa;
use App\Transformers\MahasiswaTransformer;
use Illuminate\Support\Facades\Auth;

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

        $response = fractal()
            ->item($mahasiswa)
            ->transformWith(new MahasiswaTransformer)
            ->addMeta([
                'token' => $mahasiswa->api_token,
            ])
            ->toArray();

        return response()->json($response, 201);
    }

    public function login(Request $request, Mahasiswa $mahasiswa)
    {
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(['error' => 'Your credential is wrong'], 401);
        }

        $mahasiswa = $mahasiswa->find(Auth::user()->id);

        return fractal()
            ->item($mahasiswa)
            ->transformWith(new MahasiswaTransformer)
            ->addMeta([
                'token' => $mahasiswa->api_token,
            ])
            ->toArray();
    }
}
