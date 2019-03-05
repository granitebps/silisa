<?php

namespace App\Http\Controllers\ListrikMasukDesa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\DesaModel;
use App\Models\Master\ProvinsiModel;
use App\Models\RoadmapSilisa\RoadmapTargetModel;
use App\Models\RoadmapSilisa\RoadmapRealisasiModel;
use Illuminate\Support\Facades\Session;
use App\Models\Master\PotensiEnergiModel;

class RoadMapSilisaController extends Controller
{
    public function index(Request $request)
    {
        $request = $request->all();
        if (empty($request) || (empty($request['provinsi']) && empty($request['kabupaten']) && empty($request['kecamatan']) && empty($request['kode_desa']) && empty($request['nama_desa']) && empty($request['tahun']) && empty($request['triwulan']))) {
            // Search all data
            $data['roadmap_silisa'] = DesaModel::with('kecamatan.kabupaten.provinsi')
                ->has('roadmap_realisasi')
                ->has('roadmap_target')
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
            $data['roadmap_silisa'] = DesaModel::orderBy('nama_desa', 'asc')
                ->has('roadmap_realisasi')
                ->has('roadmap_target')
                ->join('m_kecamatan', 'm_desa.id_kecamatan', '=', 'm_kecamatan.id_kecamatan')
                ->join('m_kabupaten_kota', 'm_kecamatan.id_kabupaten_kota', '=', 'm_kabupaten_kota.id_kabupaten_kota')
                ->join('m_provinsi', 'm_kabupaten_kota.id_provinsi', '=', 'm_provinsi.id_provinsi')
                ->join('t_roadmap_target', 'm_desa.id_desa', '=', 't_roadmap_target.id_desa')
                ->join('t_roadmap_realisasi', 'm_desa.id_desa', '=', 't_roadmap_realisasi.id_desa')
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
                    return $query->where('t_roadmap_target.tahun', 'like', '%' . $tahun . '%');
                })
                ->when($triwulan, function ($query, $triwulan) {
                    return $query->where('t_roadmap_target.triwulan', 'like', '%' . $triwulan . '%');
                })
                ->whereNull('t_roadmap_target.deleted_at')
                ->whereNull('t_roadmap_realisasi.deleted_at')
                ->paginate(25);
            // Append url page
            if (!empty($provinsi)) {
                $data['roadmap_silisa']->appends(array(
                    'provinsi' => $provinsi
                ));
            }
            if (!empty($kabupaten)) {
                $data['roadmap_silisa']->appends(array(
                    'kabupaten' => $kabupaten
                ));
            }
            if (!empty($kecamatan)) {
                $data['roadmap_silisa']->appends(array(
                    'kecamatan' => $kecamatan
                ));
            }
            if (!empty($kode_desa)) {
                $data['roadmap_silisa']->appends(array(
                    'kode_desa' => $kode_desa
                ));
            }
            if (!empty($nama_desa)) {
                $data['roadmap_silisa']->appends(array(
                    'nama_desa' => $nama_desa
                ));
            }
            if (!empty($tahun)) {
                $data['roadmap_silisa']->appends(array(
                    'tahun' => $tahun
                ));
            }
            if (!empty($triwulan)) {
                $data['roadmap_silisa']->appends(array(
                    'triwulan' => $triwulan
                ));
            }
        }

        $data['provinsi'] = ProvinsiModel::all();
        return view('listrik_masuk_desa.roadmap_silisa.index', $data);
    }

    public function create()
    {
        $data['potensi'] = PotensiEnergiModel::all();
        return view('listrik_masuk_desa.roadmap_silisa.create', $data);
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
        // Table Roadmap Target
        $roadmap_target = RoadmapTargetModel::firstOrNew([
            'ID_DESA' => $desa->id_desa,
            'TARGET_PEMBANGKIT' => $request->target_pembangkit,
            'TARGET_JTM' => $request->target_jtm,
            'TARGET_JTR' => $request->target_jtr,
            'TARGET_GARDU' => $request->target_gardu,
            'TARGET_PELANGGAN' => $request->target_pelanggan,
            'KETERANGAN' => $request->keterangan_target,
            'TAHUN' => $request->tahun_roadmap_target,
            'TRIWULAN' => $request->triwulan_roadmap_target
        ]);
        if (!$roadmap_target->exists) {
            $get_roadmap_target = RoadmapTargetModel::where('ID_DESA', $roadmap_target->ID_DESA)->where('TAHUN', $roadmap_target->TAHUN)->where('TRIWULAN', $roadmap_target->TRIWULAN)->first();
            if (!is_null($get_roadmap_target)) {
                $get_roadmap_target->delete();
            }
            $roadmap_target->SOURCE = 'MANUAL';
            $roadmap_target->save();
        }

        // Table Roadmap Realisasi
        $roadmap_realisasi = RoadmapRealisasiModel::firstOrNew([
            'ID_DESA' => $desa->id_desa,
            'REALISASI_PEMBANGKIT' => $request->realisasi_pembangkit,
            'REALISASI_JTM' => $request->realisasi_jtm,
            'REALISASI_JTR' => $request->realisasi_jtr,
            'REALISASI_GARDU' => $request->realisasi_gardu,
            'REALISASI_PELANGGAN' => $request->realisasi_pelanggan,
            'KETERANGAN' => $request->keterangan_realisasi,
            'TAHUN' => $request->tahun_roadmap_realisasi,
            'TRIWULAN' => $request->triwulan_roadmap_realisasi
        ]);
        if (!$roadmap_realisasi->exists) {
            $get_roadmap_realisasi = RoadmapRealisasiModel::where('ID_DESA', $roadmap_realisasi->ID_DESA)->where('TAHUN', $roadmap_realisasi->TAHUN)->where('TRIWULAN', $roadmap_realisasi->TRIWULAN)->first();
            if (!is_null($get_roadmap_realisasi)) {
                $get_roadmap_realisasi->delete();
            }
            $roadmap_realisasi->SOURCE = 'MANUAL';
            $roadmap_realisasi->save();
        }

        Session::flash('success', 'Data Roadmap LISA Berhasil Ditambah/Diedit');
        return redirect()->route('roadmap_silisa.index');
    }

    public function show($id)
    {
        $data['roadmap_silisa'] = DesaModel::with('kecamatan.kabupaten.provinsi')
            ->where('ID_DESA', $id)
            ->first();
        return view('listrik_masuk_desa.roadmap_silisa.show', $data);
    }

    public function edit($id)
    {
        $data['roadmap_silisa'] = DesaModel::with('kecamatan.kabupaten.provinsi')
            ->where('ID_DESA', $id)
            ->first();
        return view('listrik_masuk_desa.roadmap_silisa.edit', $data);
    }

    public function update(Request $request, $id)
    {
        // Table Roadmap Target
        $roadmap_target_temp = RoadmapTargetModel::firstOrNew([
            'ID_DESA' => $id,
            'TARGET_PEMBANGKIT' => $request['target_pembangkit'],
            'TARGET_JTM' => $request['target_jtm'],
            'TARGET_JTR' => $request['target_jtr'],
            'TARGET_GARDU' => $request['target_gardu'],
            'TARGET_PELANGGAN' => $request['target_pelanggan'],
            'KETERANGAN' => $request['keterangan_target'],
        ]);

        if (!$roadmap_target_temp->exists) {
            $roadmap_target = RoadmapTargetModel::where('ID_DESA', $id)->first();
            $tahun = $roadmap_target['TAHUN'];
            $triwulan = $roadmap_target['TRIWULAN'];
            $roadmap_target->delete();
            $roadmap_target_temp->TAHUN = $tahun;
            $roadmap_target_temp->TRIWULAN = $triwulan;
            $roadmap_target_temp->SOURCE = 'MANUAL';
            $roadmap_target_temp->save();
        }

        // Table Roadmap Realisasi
        $roadmap_realisasi_temp = RoadmapRealisasiModel::firstOrNew([
            'ID_DESA' => $id,
            'REALISASI_PEMBANGKIT' => $request['realisasi_pembangkit'],
            'REALISASI_JTM' => $request['realisasi_jtm'],
            'REALISASI_JTR' => $request['realisasi_jtr'],
            'REALISASI_GARDU' => $request['realisasi_gardu'],
            'REALISASI_PELANGGAN' => $request['realisasi_pelanggan'],
            'KETERANGAN' => $request['keterangan_realisasi'],
        ]);

        if (!$roadmap_realisasi_temp->exists) {
            $roadmap_realisasi = RoadmapRealisasiModel::where('id_desa', $id)->first();
            $tahun = $roadmap_realisasi['TAHUN'];
            $triwulan = $roadmap_realisasi['TRIWULAN'];
            $roadmap_realisasi->delete();
            $roadmap_realisasi_temp->TAHUN = $tahun;
            $roadmap_realisasi_temp->TRIWULAN = $triwulan;
            $roadmap_realisasi_temp->SOURCE = 'MANUAL';
            $roadmap_realisasi_temp->save();
        }

        Session::flash('success', 'Roadmap Lisa Berhasil Diedit');
        return redirect()->route('roadmap_silisa.index');
    }

    public function destroy($id)
    {
        $roadmap_silisa = DesaModel::find($id);
        $roadmap_silisa->roadmap_realisasi->delete();
        $roadmap_silisa->roadmap_target->delete();
        // $roadmap_realisasi = RoadmapRealisasiModel::where('ID_DESA', $id)->first();
        // $roadmap_realisasi->delete();
        // $roadmap_target = RoadmapTargetModel::where('ID_DESA', $id)->first();
        // $roadmap_target->delete();
        Session::flash('error', 'Roadmap LISA Berhasil Dihapus');
        // Session::flash('error', 'Roadmap LISA Tidak Dapat Dihapus');
        return redirect()->route('roadmap_silisa.index');
    }
}
