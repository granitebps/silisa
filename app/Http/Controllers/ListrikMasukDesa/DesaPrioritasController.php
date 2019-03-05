<?php

namespace App\Http\Controllers\ListrikMasukDesa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\DesaModel;
use App\Models\Master\ProvinsiModel;
use App\Models\DesaPrioritas\DesaPrioritasModel;
use Illuminate\Support\Facades\Session;
use App\Models\Master\PotensiEnergiModel;

class DesaPrioritasController extends Controller
{
    public function index(Request $request)
    {
        $request = $request->all();
        if (empty($request) || (empty($request['provinsi']) && empty($request['kabupaten']) && empty($request['kecamatan']) && empty($request['kode_desa']) && empty($request['nama_desa']) && empty($request['tahun']) && empty($request['triwulan']))) {
            // Search all data
            $data['desa_prioritas'] = DesaModel::with('kecamatan.kabupaten.provinsi')
                ->has('desa_prioritas')
                ->orderBy('NAMA_DESA', 'asc')
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
            $data['desa_prioritas'] = DesaModel::orderBy('nama_desa', 'asc')
                ->has('desa_prioritas')
                ->join('m_kecamatan', 'm_desa.id_kecamatan', '=', 'm_kecamatan.id_kecamatan')
                ->join('m_kabupaten_kota', 'm_kecamatan.id_kabupaten_kota', '=', 'm_kabupaten_kota.id_kabupaten_kota')
                ->join('m_provinsi', 'm_kabupaten_kota.id_provinsi', '=', 'm_provinsi.id_provinsi')
                ->join('t_desa_prioritas', 'm_desa.id_desa', '=', 't_desa_prioritas.id_desa')
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
                    return $query->where('nama_desa', 'like', '%' . $nama_desa . '%');
                })
                ->when($kode_desa, function ($query, $kode_desa) {
                    return $query->where('kode_desa', 'like', '%' . $kode_desa . '%');
                })
                ->when($tahun, function ($query, $tahun) {
                    return $query->where('t_desa_prioritas.tahun', 'like', '%' . $tahun . '%');
                })
                ->when($triwulan, function ($query, $triwulan) {
                    return $query->where('t_desa_prioritas.triwulan', 'like', '%' . $triwulan . '%');
                })
                ->whereNull('t_desa_prioritas.deleted_at')
                ->paginate(25);
            // Append url page
            if (!empty($provinsi)) {
                $data['desa_prioritas']->appends(array(
                    'provinsi' => $provinsi
                ));
            }
            if (!empty($kabupaten)) {
                $data['desa_prioritas']->appends(array(
                    'kabupaten' => $kabupaten
                ));
            }
            if (!empty($kecamatan)) {
                $data['desa_prioritas']->appends(array(
                    'kecamatan' => $kecamatan
                ));
            }
            if (!empty($kode_desa)) {
                $data['desa_prioritas']->appends(array(
                    'kode_desa' => $kode_desa
                ));
            }
            if (!empty($nama_desa)) {
                $data['desa_prioritas']->appends(array(
                    'nama_desa' => $nama_desa
                ));
            }
            if (!empty($tahun)) {
                $data['desa_prioritas']->appends(array(
                    'tahun' => $tahun
                ));
            }
            if (!empty($triwulan)) {
                $data['desa_prioritas']->appends(array(
                    'triwulan' => $triwulan
                ));
            }
        }

        $data['provinsi'] = ProvinsiModel::all();
        return view('listrik_masuk_desa.desa_prioritas.index', $data);
    }

    public function create()
    {
        $data['potensi'] = PotensiEnergiModel::all();
        return view('listrik_masuk_desa.desa_prioritas.create', $data);
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
        // Table Desa Prioritas
        $desa_prioritas = DesaPrioritasModel::firstOrNew([
            'ID_DESA' => $desa->id_desa,
            'TERTINGGAL' => $request->tertinggal,
            'TERDEPAN_DAN_TERLUAR' => $request->terdepan_dan_terluar,
            'PKSN' => $request->pksn,
            'LOKPRI_BNPP' => $request->lokpri_bnpp,
            'TAHUN' => $request->tahun_desa_prioritas,
            'TRIWULAN' => $request->triwulan_desa_prioritas
        ]);
        if (!$desa_prioritas->exists) {
            $get_desa_prioritas = DesaPrioritasModel::where('ID_DESA', $desa_prioritas->ID_DESA)->where('TAHUN', $desa_prioritas->TAHUN)->where('TRIWULAN', $desa_prioritas->TRIWULAN)->first();
            if (!is_null($get_desa_prioritas)) {
                $get_desa_prioritas->delete();
            }
            $desa_prioritas->SOURCE = 'MANUAL';
            $desa_prioritas->save();
        }
        Session::flash('success', 'Data Desa Prioritas Berhasil Ditambah/Diedit');
        return redirect()->route('desa_prioritas.index');
    }

    public function show($id)
    {
        $data['desa_prioritas'] = DesaModel::find($id);
        return view('listrik_masuk_desa.desa_prioritas.show', $data);
    }

    public function edit($id)
    {
        $data['desa_prioritas'] = DesaModel::find($id);
        return view('listrik_masuk_desa.desa_prioritas.edit', $data);
    }

    public function update(Request $request, $id)
    {
        // Table Desa Prioritas
        $desa_prioritas_temp = DesaPrioritasModel::firstOrNew([
            'ID_DESA' => $id,
            'TERTINGGAL' => $request['tertinggal'],
            'TERDEPAN_DAN_TERLUAR' => $request['terdepan_dan_terluar'],
            'PKSN' => $request['pksn'],
            'LOKPRI_BNPP' => $request['lokpri_bnpp'],
        ]);

        if (!$desa_prioritas_temp->exists) {
            $desa_prioritas = DesaPrioritasModel::where('ID_DESA', $id)->first();
            $tahun = $desa_prioritas['TAHUN'];
            $triwulan = $desa_prioritas['TRIWULAN'];
            $desa_prioritas->delete();
            $desa_prioritas_temp->TAHUN = $tahun;
            $desa_prioritas_temp->TRIWULAN = $triwulan;
            $desa_prioritas_temp->SOURCE = 'MANUAL';
            $desa_prioritas_temp->save();
        }

        Session::flash('success', 'Desa Prioritas Berhasil Diedit');
        return redirect()->route('desa_prioritas.index');
    }

    public function destroy($id)
    {
        $desa_prioritas = DesaModel::find($id);
        $desa_prioritas->desa_prioritas->delete();
        Session::flash('error', 'Desa Prioritas Berhasil Dihapus');
        // Session::flash('error', 'Desa Prioritas Tidak Dapat Dihapus');
        return redirect()->route('desa_prioritas.index');
    }
}
