<?php

namespace App\Http\Controllers\ListrikMasukDesa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\ProvinsiModel;
use App\Models\Master\DesaModel;
use App\Models\InfoDataDesa\InfoDesaModel;
use App\Models\InfoDataDesa\InfoDesaRTModel;
use App\Models\InfoDataDesa\InfoDesaPembangkitModel;
use Illuminate\Support\Facades\Session;
use App\Models\Master\PotensiEnergiModel;
use App\Models\Master\KabupatenKotaModel;
use App\Models\Master\KecamatanModel;

class InfoDataDesaController extends Controller
{
    public function index(Request $request)
    {
        $request = $request->all();
        if (empty($request) || (empty($request['provinsi']) && empty($request['kabupaten']) && empty($request['kecamatan']) && empty($request['kode_desa']) && empty($request['nama_desa']) && empty($request['tahun']) && empty($request['triwulan']))) {
            // Search all data
            $data['info_data_desa'] = DesaModel::with('kecamatan.kabupaten.provinsi')
                ->has('info_desa')
                ->has('info_desa_rt')
                ->has('info_desa_pembangkit')
                ->orderBy('nama_desa', 'asc')
                ->paginate(25);
        } else {
            // Validasi empty
            if (!empty($request['provinsi'])) {
                $provinsi = $request['provinsi'];
            } else {
                $provinsi = null;
            }
            if (!empty($request['kabupaten'])) {
                $kabupaten = $request['kabupaten'];
            } else {
                $kabupaten = null;
            }
            if (!empty($request['kecamatan'])) {
                $kecamatan = $request['kecamatan'];
            } else {
                $kecamatan = null;
            }
            if (!empty($request['kode_desa'])) {
                $kode_desa = $request['kode_desa'];
            } else {
                $kode_desa = null;
            }
            if (!empty($request['nama_desa'])) {
                $nama_desa = $request['nama_desa'];
            } else {
                $nama_desa = null;
            }
            if (!empty($request['tahun'])) {
                $tahun = $request['tahun'];
            } else {
                $tahun = null;
            }
            if (!empty($request['triwulan'])) {
                $triwulan = $request['triwulan'];
            } else {
                $triwulan = null;
            }
            // Proses search
            $data['info_data_desa'] = DesaModel::orderBy('NAMA_DESA', 'asc')
                ->join('m_kecamatan', 'm_desa.id_kecamatan', '=', 'm_kecamatan.id_kecamatan')
                ->join('m_kabupaten_kota', 'm_kecamatan.id_kabupaten_kota', '=', 'm_kabupaten_kota.id_kabupaten_kota')
                ->join('m_provinsi', 'm_kabupaten_kota.id_provinsi', '=', 'm_provinsi.id_provinsi')
                ->join('t_info_desa', 'm_desa.id_desa', '=', 't_info_desa.id_desa')
                ->join('t_info_desa_rt', 'm_desa.id_desa', '=', 't_info_desa_rt.id_desa')
                ->join('t_info_desa_pembangkit', 'm_desa.id_desa', '=', 't_info_desa_pembangkit.id_desa')
                ->when($provinsi, function ($query, $provinsi) {
                    return $query->where('m_provinsi.id_provinsi', $provinsi);
                })
                ->when($kabupaten, function ($query, $kabupaten) {
                    return $query->where('m_kabupaten_kota.id_kabupaten_kota', $kabupaten);
                })
                ->when($kecamatan, function ($query, $kecamatan) {
                    return $query->where('m_kecamatan.id_kecamatan', $kecamatan);
                })
                ->when($nama_desa, function ($query, $nama_desa) {
                    return $query->where('NAMA_DESA', 'like', '%' . $nama_desa . '%');
                })
                ->when($kode_desa, function ($query, $kode_desa) {
                    return $query->where('KODE_DESA', 'like', '%' . $kode_desa . '%');
                })
                ->when($tahun, function ($query, $tahun) {
                    return $query->where('t_info_desa.tahun', 'like', '%' . $tahun . '%');
                })
                ->when($triwulan, function ($query, $triwulan) {
                    return $query->where('t_info_desa.triwulan', 'like', '%' . $triwulan . '%');
                })
                ->whereNull('t_info_desa.deleted_at')
                ->whereNull('t_info_desa_rt.deleted_at')
                ->whereNull('t_info_desa_pembangkit.deleted_at')
                ->paginate(25);
            // Append url page
            if (!empty($provinsi)) {
                $data['info_data_desa']->appends(array(
                    'provinsi' => $provinsi
                ));
            }
            if (!empty($kabupaten)) {
                $data['info_data_desa']->appends(array(
                    'kabupaten' => $kabupaten
                ));
            }
            if (!empty($kecamatan)) {
                $data['info_data_desa']->appends(array(
                    'kecamatan' => $kecamatan
                ));
            }
            if (!empty($kode_desa)) {
                $data['info_data_desa']->appends(array(
                    'kode_desa' => $kode_desa
                ));
            }
            if (!empty($nama_desa)) {
                $data['info_data_desa']->appends(array(
                    'nama_desa' => $nama_desa
                ));
            }
            if (!empty($tahun)) {
                $data['info_data_desa']->appends(array(
                    'tahun' => $tahun
                ));
            }
            if (!empty($triwulan)) {
                $data['info_data_desa']->appends(array(
                    'triwulan' => $triwulan
                ));
            }
        }

        $data['provinsi'] = ProvinsiModel::all();
        return view('listrik_masuk_desa.info_data_desa.index', $data);
    }

    public function create()
    {
        $data['potensi'] = PotensiEnergiModel::all();
        return view('listrik_masuk_desa.info_data_desa.create', $data);
    }

    public function store(Request $request)
    {
        // Table Provinsi
        $nama_provinsi = strtoupper($request->nama_provinsi);
        $provinsi = ProvinsiModel::firstOrCreate([
            'NAMA_PROVINSI' => $nama_provinsi
        ]);
        // Table Kabupaten/Kota
        $nama_kabupaten_kota = strtoupper($request->nama_kabupaten_kota);
        $kabupaten_kota = KabupatenKotaModel::firstOrCreate([
            'ID_PROVINSI' => $provinsi->ID_PROVINSI,
            'NAMA_KABUPATEN_KOTA' => $nama_kabupaten_kota
        ]);
        // Table Kecamatan
        $nama_kecamatan = strtoupper($request->nama_kecamatan);
        $kecamatan = KecamatanModel::firstOrCreate([
            'ID_KABUPATEN_KOTA' => $kabupaten_kota->ID_KABUPATEN_KOTA,
            'NAMA_KECAMATAN' => $nama_kecamatan
        ]);
        // Table Desa
        $nama_desa = strtoupper($request->nama_desa);
        $desa = DesaModel::firstOrCreate([
            'ID_KECAMATAN' => $kecamatan->ID_KECAMATAN,
            'KODE_DESA' => $request->kode_desa,
            'NAMA_DESA' => $nama_desa,
            'WILAYAH' => $request->wilayah,
            'AREA' => $request->area,
            'RAYON' => $request->rayon,
            'LINTANG' => $request->lintang,
            'BUJUR' => $request->bujur
        ]);
        // Table Info Desa
        $info_desa = InfoDesaModel::firstOrNew([
            'ID_DESA' => $desa->ID_DESA,
            'DESA_BERLISTRIK' => $request->desa_berlistrik,
            'DESA_BERLISTRIK_LTSHE' => $request->desa_berlistrik_ltshe,
            'DESA_BERLISTRIK_NON_PLN' => $request->desa_berlistrik_non_pln,
            'DESA_BELUM_BERLISTRIK' => $request->desa_belum_berlistrik,
            'JARAK_DARI_JARINGAN_EKSISTENSI' => $request->jarak_dari_jaringan_eksistensi,
            'KETERANGAN' => $request->keterangan_info_desa,
            'TAHUN' => $request->tahun,
            'TRIWULAN' => $request->triwulan
        ]);
        if (!$info_desa->exists) {
            $get_info_desa = InfoDesaModel::where('ID_DESA', $info_desa->ID_DESA)->where('TAHUN', $info_desa->TAHUN)->where('TRIWULAN', $info_desa->TRIWULAN)->first();
            if (!is_null($get_info_desa)) {
                $get_info_desa->delete();
            }
            $info_desa->SOURCE = 'MANUAL';
            $info_desa->save();
        }
        $cek = $info_desa->potensi_energi()->exists();
        if ($cek) {
            $info_desa->potensi_energi()->sync($request->potensi);
        } else {
            $info_desa->potensi_energi()->attach($request->potensi);
        }
        // Table Info Desa RT
        $info_desa_rt = InfoDesaRTModel::firstOrNew([
            'ID_DESA' => $desa->ID_DESA,
            'TOTAL_RT' => $request->total_rt,
            'RT_LISTRIK_PLN' => $request->rt_listrik_pln,
            'RT_LISTRIK_PLN_MENYALUR' => $request->rt_listrik_pln_menyalur,
            'RT_LISTRIK_NON_PLN_LTSHE' => $request->rt_listrik_non_pln_ltshe,
            'RT_LISTRIK_NON_PLN' => $request->rt_listrik_non_pln,
            'RT_TIDAK_BERLISTRIK' => $request->rt_tidak_berlistrik,
            'RT_AKAN_DILISTRIK' => $request->rt_akan_dilistrik,
            'RT_BELUM_DAPAT_DILISTRIK' => $request->rt_belum_dapat_dilistrik,
            'JUMLAH_CALON_PENERIMA_SUBSIDI' => $request->jumlah_calon_penerima_subsidi,
            'UPDATE_JMLH_CALON_PENERIMA_SUBSIDI' => $request->update_jmlh_calon_penerima_subsidi,
            'TAHUN' => $request->tahun,
            'TRIWULAN' => $request->triwulan
        ]);
        if (!$info_desa_rt->exists) {
            $get_info_desa_rt = InfoDesaRTModel::where('ID_DESA', $info_desa_rt->ID_DESA)->where('TAHUN', $info_desa_rt->TAHUN)->where('TRIWULAN', $info_desa_rt->TRIWULAN)->first();
            if (!is_null($get_info_desa_rt)) {
                $get_info_desa_rt->delete();
            }
            $info_desa_rt->SOURCE = 'MANUAL';
            $info_desa_rt->save();
        }
        // Table Info Desa Pembangkit
        $info_desa_pembangkit = InfoDesaPembangkitModel::firstOrNew([
            'ID_DESA' => $desa->id_desa,
            'PLN_GRID_ISOLATED' => $request->pln_grid_isolated,
            'JENIS_PEMBANGKIT_ISOLATED' => $request->jenis_pembangkit_isolated,
            'JAM_NYALA_PLN' => $request->jam_nyala_pln,
            'GRID_KOMUNAL_STANDALONE' => $request->grid_komunal_standalone,
            'JENIS_PEMBANGKIT' => $request->jenis_pembangkit,
            'JAM_NYALA_NON_PLN' => $request->jam_nyala_non_pln,
            'STATUS_KONDISI_PASOKAN_LISTRIK' => $request->status_kondisi_pasokan_listrik,
            'KETERANGAN' => $request->keterangan_info_desa_pembangkit,
            'TAHUN' => $request->tahun,
            'TRIWULAN' => $request->triwulan
        ]);
        if (!$info_desa_pembangkit->exists) {
            $get_info_desa_pembangkit = InfoDesaPembangkitModel::where('ID_DESA', $info_desa_pembangkit->ID_DESA)->where('TAHUN', $info_desa_pembangkit->TAHUN)->where('TRIWULAN', $info_desa_pembangkit->TRIWULAN)->first();
            if (!is_null($get_info_desa_pembangkit)) {
                $get_info_desa_pembangkit->delete();
            }
            $info_desa_pembangkit->SOURCE = 'MANUAL';
            $info_desa_pembangkit->save();
        }
        Session::flash('success', 'Info Data Desa Berhasil Ditambah/Diedit');
        return view('listrik_masuk_desa.info_data_desa.index');
    }

    public function show($id)
    {
        $data['info_data_desa'] = DesaModel::with('kecamatan.kabupaten.provinsi')
            ->with('info_desa.potensi_energi')
            ->where('ID_DESA', $id)
            ->first();
        return view('listrik_masuk_desa.info_data_desa.show', $data);
    }

    public function edit($id)
    {
        $data['info_data_desa'] = DesaModel::with('kecamatan.kabupaten.provinsi')
            ->with('info_desa.potensi_energi')
            ->where('ID_DESA', $id)
            ->first();
        $data['potensi'] = PotensiEnergiModel::all();
        return view('listrik_masuk_desa.info_data_desa.edit', $data);
    }

    public function update(Request $request, $id)
    {
        // Table Info Desa
        $info_desa_temp = InfoDesaModel::firstOrNew([
            'ID_DESA' => $id,
            'DESA_BERLISTRIK' => $request['desa_berlistrik'],
            'DESA_BERLISTRIK_LTSHE' => $request['desa_berlistrik_ltshe'],
            'DESA_BERLISTRIK_NON_PLN' => $request['desa_berlistrik_non_pln'],
            'DESA_BELUM_BERLISTRIK' => $request['desa_belum_berlistrik'],
            'JARAK_DARI_JARINGAN_EKSISTENSI' => $request['jarak_dari_jaringan_eksistensi'],
            'KETERANGAN' => $request['keterangan_info_desa'],
        ]);
        if (!$info_desa_temp->exists) {
            $info_desa = InfoDesaModel::where('ID_DESA', $id)->first();
            $tahun = $info_desa['TAHUN'];
            $triwulan = $info_desa['TRIWULAN'];
            $info_desa->delete();
            $info_desa_temp->TAHUN = $tahun;
            $info_desa_temp->TRIWULAN = $triwulan;
            $info_desa_temp->SOURCE = 'MANUAL';
            $info_desa_temp->save();
        }
        $cek = $info_desa_temp->potensi_energi()->exists();
        if ($cek) {
            $info_desa_temp->potensi_energi()->sync($request->potensi);
        } else {
            $info_desa_temp->potensi_energi()->attach($request->potensi);
        }

        // Table Info Desa RT
        $info_desa_rt_temp = InfoDesaRTModel::firstOrNew([
            'ID_DESA' => $id,
            'TOTAL_RT' => $request['total_rt'],
            'RT_LISTRIK_PLN' => $request['rt_listrik_pln'],
            'RT_LISTRIK_PLN_MENYALUR' => $request['rt_listrik_pln_menyalur'],
            'RT_LISTRIK_NON_PLN_LTSHE' => $request['rt_listrik_non_pln_ltshe'],
            'RT_LISTRIK_NON_PLN' => $request['rt_listrik_non_pln'],
            'RT_TIDAK_BERLISTRIK' => $request['rt_tidak_berlistrik'],
            'RT_AKAN_DILISTRIK' => $request['rt_akan_dilistrik'],
            'RT_BELUM_DAPAT_DILISTRIK' => $request['rt_belum_dapat_dilistrik'],
            'JUMLAH_CALON_PENERIMA_SUBSIDI' => $request['jumlah_calon_penerima_subsidi'],
            'UPDATE_JMLH_CALON_PENERIMA_SUBSIDI' => $request['update_jmlh_calon_penerima_subsidi']
        ]);
        if (!$info_desa_rt_temp->exists) {
            $info_desa_rt = InfoDesaRTModel::where('ID_DESA', $id)->first();
            $tahun = $info_desa_rt['TAHUN'];
            $triwulan = $info_desa_rt['TRIWULAN'];
            $info_desa_rt->delete();
            $info_desa_rt_temp->TAHUN = $tahun;
            $info_desa_rt_temp->TRIWULAN = $triwulan;
            $info_desa_rt_temp->SOURCE = 'MANUAL';
            $info_desa_rt_temp->save();
        }

        // Table Info Desa Pembangkit
        $info_desa_pembangkit_temp = InfoDesaPembangkitModel::firstOrNew([
            'ID_DESA' => $id,
            'PLN_GRID_ISOLATED' => $request['pln_grid_isolated'],
            'JENIS_PEMBANGKIT_ISOLATED' => $request['jenis_pembangkit_isolated'],
            'JAM_NYALA_PLN' => $request['jam_nyala_pln'],
            'GRID_KOMUNAL_STANDALONE' => $request['grid_komunal_standalone'],
            'JENIS_PEMBANGKIT' => $request['jenis_pembangkit'],
            'JAM_NYALA_NON_PLN' => $request['jam_nyala_non_pln'],
            'STATUS_KONDISI_PASOKAN_LISTRIK' => $request['status_kondisi_pasokan_listrik'],
            'KETERANGAN' => $request['keterangan_info_desa_pembangkit']
        ]);
        if (!$info_desa_pembangkit_temp->exists) {
            $info_desa_pembangkit = InfoDesaPembangkitModel::where('id_desa', $id)->first();
            $tahun = $info_desa_pembangkit['TAHUN'];
            $triwulan = $info_desa_pembangkit['TRIWULAN'];
            $info_desa_pembangkit->delete();
            $info_desa_pembangkit_temp->TAHUN = $tahun;
            $info_desa_pembangkit_temp->TRIWULAN = $triwulan;
            $info_desa_pembangkit_temp->SOURCE = 'MANUAL';
            $info_desa_pembangkit_temp->save();
        }

        Session::flash('success', 'Info Data Desa Berhasil Diedit');
        return redirect()->route('info_data_desa.index');
    }

    public function destroy($id)
    {
        $info_data_desa = DesaModel::find($id);

        $info_data_desa->info_desa_rt->delete();
        $info_data_desa->info_desa_pembangkit->delete();
        $info_data_desa->info_desa->potensi_energi()->detach();
        $info_data_desa->info_desa->delete();

        Session::flash('error', 'Info Data Desa Berhasil Dihapus');
        // Session::flash('error', 'Info Data Desa Belum Dapat Dihapus');
        return redirect()->route('info_data_desa.index');
    }
}
