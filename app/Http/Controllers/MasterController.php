<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProvinsiModel;
use App\KabupatenKotaModel;
use App\KecamatanModel;
use App\DesaModel;
use Illuminate\Support\Facades\DB;
use App\PotensiEnergiModel;

class MasterController extends Controller
{
    public function desa()
    {
        $data['desa'] = DB::table('m_desa')
            ->join('m_kecamatan', 'm_desa.id_kecamatan', '=', 'm_kecamatan.id_kecamatan')
            ->join('m_kabupaten_kota', 'm_kecamatan.id_kabupaten_kota', '=', 'm_kabupaten_kota.id_kabupaten_kota')
            ->join('m_provinsi', 'm_kabupaten_kota.id_provinsi', '=', 'm_provinsi.id_provinsi')
            ->paginate(25);
        return view('master.desa', $data);
    }

    public function potensi()
    {
        $data['potensi'] = PotensiEnergiModel::orderBy('nama_potensi_energi', 'asc')->paginate(25);
        return view('master.potensi', $data);
    }
}
