<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master\KabupatenKotaModel;
use App\Models\Master\KecamatanModel;
use App\Models\Master\DesaModel;

class DropdownController extends Controller
{
    public function kabupaten(Request $request)
    {
        $kabupaten = KabupatenKotaModel::where('ID_PROVINSI', $request->id_provinsi)
            ->orderBy('NAMA_KABUPATEN_KOTA', 'asc')
            ->get();
        return response()->json($kabupaten);
    }

    public function kecamatan(Request $request)
    {
        $kecamatan = KecamatanModel::where('ID_KABUPATEN_KOTA', $request->id_kabupaten_kota)
            ->orderBy('NAMA_KECAMATAN', 'asc')
            ->get();
        return response()->json($kecamatan);
    }

    public function desa(Request $request)
    {
        $desa = DesaModel::where('ID_KECAMATAN', $request->id_kecamatan)
            ->orderBy('NAMA_DESA', 'asc')
            ->get();
        return response()->json($desa);
    }
}
