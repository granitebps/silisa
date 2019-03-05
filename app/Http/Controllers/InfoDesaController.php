<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InfoDesaModel;
use App\InfoDesaRTModel;
use App\InfoDesaPembangkitModel;
use App\ProvinsiModel;
use DB;

class InfoDesaController extends Controller
{
    public function info_desa(Request $request)
    {
        $request = $request->all();
        if (empty($request) || (empty($request['provinsi']) && empty($request['kabupaten']) && empty($request['kecamatan']) && empty($request['desa']))) {
            // Search all data
            $data['info_desa'] = DB::table('info_desa')
                ->join('m_desa', 'info_desa.id_desa', '=', 'm_desa.id_desa')
                ->join('m_kecamatan', 'm_desa.id_kecamatan', '=', 'm_kecamatan.id_kecamatan')
                ->join('m_kabupaten_kota', 'm_kecamatan.id_kabupaten_kota', '=', 'm_kabupaten_kota.id_kabupaten_kota')
                ->join('m_provinsi', 'm_kabupaten_kota.id_provinsi', '=', 'm_provinsi.id_provinsi')
                ->orderBy('m_desa.nama_desa', 'asc')
                ->paginate(25);
        } else {
            if (empty($request['desa']) && $request['kecamatan'] == 0 && $request['kabupaten'] == 0) {
                // Searh only provinsi
                $data['info_desa'] = DB::table('info_desa')
                    ->join('m_desa', 'info_desa.id_desa', '=', 'm_desa.id_desa')
                    ->join('m_kecamatan', 'm_desa.id_kecamatan', '=', 'm_kecamatan.id_kecamatan')
                    ->join('m_kabupaten_kota', 'm_kecamatan.id_kabupaten_kota', '=', 'm_kabupaten_kota.id_kabupaten_kota')
                    ->join('m_provinsi', 'm_kabupaten_kota.id_provinsi', '=', 'm_provinsi.id_provinsi')
                    ->where('m_provinsi.id_provinsi', $request['provinsi'])
                    ->orderBy('m_desa.nama_desa', 'asc')
                    ->paginate(25);
            } elseif (empty($request['desa']) && $request['kecamatan'] == 0) {
                // Searh provinsi & kabupaten
                $data['info_desa'] = DB::table('info_desa')
                    ->join('m_desa', 'info_desa.id_desa', '=', 'm_desa.id_desa')
                    ->join('m_kecamatan', 'm_desa.id_kecamatan', '=', 'm_kecamatan.id_kecamatan')
                    ->join('m_kabupaten_kota', 'm_kecamatan.id_kabupaten_kota', '=', 'm_kabupaten_kota.id_kabupaten_kota')
                    ->join('m_provinsi', 'm_kabupaten_kota.id_provinsi', '=', 'm_provinsi.id_provinsi')
                    ->where('m_kabupaten_kota.id_kabupaten_kota', $request['kabupaten'])
                    ->orderBy('m_desa.nama_desa', 'asc')
                    ->paginate(25);
            } elseif (empty($request['desa'])) {
                // Searh provinsi, kabupaten & kecamatan
                $data['info_desa'] = DB::table('info_desa')
                    ->join('m_desa', 'info_desa.id_desa', '=', 'm_desa.id_desa')
                    ->join('m_kecamatan', 'm_desa.id_kecamatan', '=', 'm_kecamatan.id_kecamatan')
                    ->join('m_kabupaten_kota', 'm_kecamatan.id_kabupaten_kota', '=', 'm_kabupaten_kota.id_kabupaten_kota')
                    ->join('m_provinsi', 'm_kabupaten_kota.id_provinsi', '=', 'm_provinsi.id_provinsi')
                    ->where('m_kecamatan.id_kecamatan', $request['kecamatan'])
                    ->orderBy('m_desa.nama_desa', 'asc')
                    ->paginate(25);
            } else {
                // Searh provinsi, kabupaten, kecamatan & desa
                $data['info_desa'] = DB::table('info_desa')
                    ->join('m_desa', 'info_desa.id_desa', '=', 'm_desa.id_desa')
                    ->join('m_kecamatan', 'm_desa.id_kecamatan', '=', 'm_kecamatan.id_kecamatan')
                    ->join('m_kabupaten_kota', 'm_kecamatan.id_kabupaten_kota', '=', 'm_kabupaten_kota.id_kabupaten_kota')
                    ->join('m_provinsi', 'm_kabupaten_kota.id_provinsi', '=', 'm_provinsi.id_provinsi')
                    ->where('m_desa.nama_desa', 'like', '%' . $request['desa'] . '%')
                    ->orderBy('m_desa.nama_desa', 'asc')
                    ->paginate(25);
                $data['desa']->appends(array(
                    'desa' => $request['desa']
                ));
            }
            $data['info_desa']->appends(array(
                'provinsi' => $request['provinsi'],
                'kabupaten' => $request['kabupaten'],
                'kecamatan' => $request['kecamatan']
            ));
        }
        $data['provinsi'] = ProvinsiModel::all();
        // $data['info_desa'] = InfoDesaModel::paginate(25);
        return view('info.info_desa', $data);
    }

    public function info_desa_rt()
    {
        $data['provinsi'] = ProvinsiModel::all();
        $data['info_desa_rt'] = InfoDesaRTModel::paginate(25);
        return view('info.info_desa_rt', $data);
    }

    public function info_desa_pembangkit()
    {
        $data['provinsi'] = ProvinsiModel::all();
        $data['info_desa_pembangkit'] = InfoDesaPembangkitModel::paginate(25);
        return view('info.info_desa_pembangkit', $data);
    }

    public function info_desa_potensi()
    {
        $data['provinsi'] = ProvinsiModel::all();
        $data['info_desa_potensi'] = InfoDesaModel::paginate(25);
        return view('info.info_desa_potensi', $data);
    }
}
