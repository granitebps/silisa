<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\DesaModel;
use App\Models\Master\ProvinsiModel;
use Illuminate\Support\Facades\Session;

class DesaController extends Controller
{
    public function index(Request $request)
    {
        $request = $request->all();
        if (empty($request) || (empty($request['provinsi']) && empty($request['kabupaten']) && empty($request['kecamatan']) && empty($request['kode_desa']) && empty($request['nama_desa']))) {
            // Search all data
            $data['desa'] = DesaModel::with('kecamatan.kabupaten.provinsi')
                ->orderBy('NAMA_DESA', 'asc')
                ->paginate(25);
        } else {
            // Cek Validasi Empty Search
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

            // Proses Search
            $data['desa'] = DesaModel::orderBy('NAMA_DESA', 'asc')
                ->join('m_kecamatan', 'm_desa.id_kecamatan', '=', 'm_kecamatan.id_kecamatan')
                ->join('m_kabupaten_kota', 'm_kecamatan.id_kabupaten_kota', '=', 'm_kabupaten_kota.id_kabupaten_kota')
                ->join('m_provinsi', 'm_kabupaten_kota.id_provinsi', '=', 'm_provinsi.id_provinsi')
                ->when($provinsi, function ($query, $provinsi) {
                    return $query->where('m_provinsi.id_provinsi', $provinsi);
                })
                ->when($kabupaten, function ($query, $kabupaten) {
                    return $query->where('m_kabupaten_kota.id_kabupaten_kota', $kabupaten);
                })
                ->when($kecamatan, function ($query, $kecamatan) {
                    return $query->where('m_kecamatan.id_kecamatan', $kecamatan);
                })
                ->when($kode_desa, function ($query, $kode_desa) {
                    return $query->where('kode_desa', 'like', '%' . $kode_desa . '%');
                })
                ->when($nama_desa, function ($query, $nama_desa) {
                    return $query->where('nama_desa', 'like', '%' . $nama_desa . '%');
                })
                ->paginate(25);

            // Append URL
            if (!empty($request['provinsi'])) {
                $data['desa']->appends(array(
                    'provinsi' => $request['provinsi'],
                ));
            }
            if (!empty($request['kabupaten'])) {
                $data['desa']->appends(array(
                    'kabupaten' => $request['kabupaten'],
                ));
            }
            if (!empty($request['kecamatan'])) {
                $data['desa']->appends(array(
                    'kecamatan' => $request['kecamatan'],
                ));
            }
            if (!empty($request['kode_desa'])) {
                $data['desa']->appends(array(
                    'kode_desa' => $request['kode_desa'],
                ));
            }
            if (!empty($request['nama_desa'])) {
                $data['desa']->appends(array(
                    'nama_desa' => $request['nama_desa'],
                ));
            }
        }

        $data['provinsi'] = ProvinsiModel::orderBy('NAMA_PROVINSI', 'asc')->get();
        return view('master.desa.index', $data);
    }

    public function edit($id)
    {
        $data['desa'] = DesaModel::where('ID_DESA', $id)->with('kecamatan.kabupaten.provinsi')->first();
        return view('master.desa.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $desa = DesaModel::find($id);
        $this->validate($request, [
            'kode_desa' => 'required',
            'nama_desa' => 'required'
        ]);

        $desa->update([
            'KODE_DESA' => $request->kode_desa,
            'NAMA_DESA' => $request->nama_desa
        ]);

        Session::flash('success', 'Master Desa Berhasil Diedit');
        return redirect()->route('desa.index');
    }

    public function destroy($id)
    {
        // $desa = DesaModel::find($id);
        // $desa->delete();
        Session::flash('error', 'Master Desa Tidak Dapat Dihapus');
        return redirect()->route('desa.index');
    }
}
