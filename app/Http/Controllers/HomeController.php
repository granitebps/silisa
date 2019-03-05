<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master\ProvinsiModel;
use App\Models\Master\KabupatenKotaModel;
use App\Models\Master\KecamatanModel;
use App\Models\Master\DesaModel;
use App\Models\InfoDataDesa\InfoDesaModel;
use App\Models\InfoDataDesa\InfoDesaRTModel;
use App\Models\InfoDataDesa\InfoDesaPembangkitModel;
use App\Models\RoadmapSilisa\RoadmapTargetModel;
use App\Models\RoadmapSilisa\RoadmapRealisasiModel;
use App\Models\Master\PotensiEnergiModel;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function tambah()
    {
        $data['potensi'] = PotensiEnergiModel::all();
        return view('tambah', $data);
    }

    public function tambah_proses(Request $request)
    {


        Session::flash('success', 'Tambah/Edit Data Berhasil');
        return redirect()->route('home');
    }

    public function autocomplete_provinsi(Request $request)
    {
        $term = $request->nama_provinsi;
        $items = ProvinsiModel::where('NAMA_PROVINSI', 'like', '%' . $term . '%')->get();
        foreach ($items as $item) {
            $nama_provinsi[] = $item;
        }
        return $nama_provinsi;
    }

    public function autocomplete_kabupaten(Request $request)
    {
        $term = $request->nama_kabupaten_kota;
        $id_provinsi = $request->id_provinsi;
        $items = KabupatenKotaModel::where('NAMA_KABUPATEN_KOTA', 'like', '%' . $term . '%')
            ->where('ID_PROVINSI', $id_provinsi)
            ->get();
        foreach ($items as $item) {
            $nama_kabupaten_kota[] = $item;
        }
        return $nama_kabupaten_kota;
    }

    public function autocomplete_kecamatan(Request $request)
    {
        $term = $request->nama_kecamatan;
        $id_kabupaten_kota = $request->id_kabupaten_kota;
        $items = KecamatanModel::where('NAMA_KECAMATAN', 'like', '%' . $term . '%')
            ->where('ID_KABUPATEN_KOTA', $id_kabupaten_kota)
            ->get();
        foreach ($items as $item) {
            $nama_kecamatan[] = $item;
        }
        return $nama_kecamatan;
    }

    public function autocomplete_desa(Request $request)
    {
        $term = $request->nama_desa;
        $id_kecamatan = $request->id_kecamatan;
        $items = DesaModel::with('info_desa_rt', 'info_desa_pembangkit', 'info_desa.potensi_energi')
            // ->join('T_INFO_DESA', 'M_DESA.ID_DESA', '=', 'T_INFO_DESA.ID_DESA')
            // ->join('T_INFO_DESA_ENERGI', 't_info_desa_energi.ID_INFO_DESA', '=', 't_info_desa.ID_INFO_DESA')
            ->where('NAMA_DESA', 'like', '%' . $term . '%')
            // ->join('T_INFO_DESA_RT', 'M_DESA.ID_DESA', '=', 'T_INFO_DESA_RT.ID_DESA')
            // ->join('T_INFO_DESA_PEMBANGKIT', 'M_DESA.ID_DESA', '=', 'T_INFO_DESA_PEMBANGKIT.ID_DESA')
            ->where('ID_KECAMATAN', $id_kecamatan)
            ->get();
        foreach ($items as $item) {
            $nama_desa[] = $item;
        }
        return $nama_desa;
    }

    public function autocomplete_roadmap(Request $request)
    {
        $term = $request->nama_desa;
        $id_kecamatan = $request->id_kecamatan;
        $items = DesaModel::with('roadmap_target', 'roadmap_realisasi')
            ->where('NAMA_DESA', 'like', '%' . $term . '%')
            // ->join('T_INFO_DESA', 'M_DESA.ID_DESA', '=', 'T_INFO_DESA.ID_DESA')
            // ->join('T_INFO_DESA_RT', 'M_DESA.ID_DESA', '=', 'T_INFO_DESA_RT.ID_DESA')
            // ->join('T_INFO_DESA_PEMBANGKIT', 'M_DESA.ID_DESA', '=', 'T_INFO_DESA_PEMBANGKIT.ID_DESA')
            ->where('ID_KECAMATAN', $id_kecamatan)
            ->get();
        foreach ($items as $item) {
            $nama_desa[] = $item;
        }
        return $nama_desa;
    }

    public function autocomplete_desa_prioritas(Request $request)
    {
        $term = $request->nama_desa;
        $id_kecamatan = $request->id_kecamatan;
        $items = DesaModel::with('desa_prioritas')
            ->where('NAMA_DESA', 'like', '%' . $term . '%')
            // ->join('T_INFO_DESA', 'M_DESA.ID_DESA', '=', 'T_INFO_DESA.ID_DESA')
            // ->join('T_INFO_DESA_RT', 'M_DESA.ID_DESA', '=', 'T_INFO_DESA_RT.ID_DESA')
            // ->join('T_INFO_DESA_PEMBANGKIT', 'M_DESA.ID_DESA', '=', 'T_INFO_DESA_PEMBANGKIT.ID_DESA')
            ->where('ID_KECAMATAN', $id_kecamatan)
            ->get();
        foreach ($items as $item) {
            $nama_desa[] = $item;
        }
        return $nama_desa;
    }
}
