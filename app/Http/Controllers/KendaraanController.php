<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Kendaraan;
use App\Transformers\KendaraanTransformer;
use Auth;

class KendaraanController extends Controller
{
    public function tambah(Request $request, Kendaraan $kendaraan)
    {
        $this->validate($request, [
            'plat_nomor'    => 'required|unique:kendaraan',
            'jenis'         => 'required',
            'merk'          => 'required',
            'tipe'          => 'required',
        ]);

        $kendaraan = $kendaraan->create([
            'id_mahasiswa'  => Auth::user()->id,
            'plat_nomor'    => $request->plat_nomor,
            'jenis'         => $request->jenis,
            'merk'          => $request->merk,
            'tipe'          => $request->tipe,
        ]);

        $response = fractal()
            ->item($kendaraan)
            ->transformWith(new KendaraanTransformer)
            ->toArray();

        return response()->json($response, 201);
    }
}
