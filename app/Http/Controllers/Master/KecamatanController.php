<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\KecamatanModel;
use App\Models\Master\ProvinsiModel;
use Illuminate\Support\Facades\Session;

class KecamatanController extends Controller
{
    public function index(Request $request)
    {
        $request = $request->all();
        if (empty($request) || (empty($request['provinsi']) && empty($request['kabupaten']) && empty($request['nama_kecamatan']) && empty($request['kode_kecamatan']))) {
            // Search all data
            $data['kecamatan'] = KecamatanModel::with('kabupaten.provinsi')
                ->orderBy('nama_kecamatan', 'asc')
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
            if (!empty($request['kode_kecamatan'])) {
                $kode_kecamatan = $request['kode_kecamatan'];
            } else {
                $kode_kecamatan = null;
            }
            if (!empty($request['nama_kecamatan'])) {
                $nama_kecamatan = $request['nama_kecamatan'];
            } else {
                $nama_kecamatan = null;
            }

            // Proses Search
            $data['kecamatan'] = KecamatanModel::orderBy('NAMA_KECAMATAN', 'asc')
                ->join('m_kabupaten_kota', 'm_kecamatan.id_kabupaten_kota', '=', 'm_kabupaten_kota.id_kabupaten_kota')
                ->join('m_provinsi', 'm_kabupaten_kota.id_provinsi', '=', 'm_provinsi.id_provinsi')
                ->when($provinsi, function ($query, $provinsi) {
                    return $query->where('m_provinsi.id_provinsi', $provinsi);
                })
                ->when($kabupaten, function ($query, $kabupaten) {
                    return $query->where('m_kabupaten_kota.id_kabupaten_kota', $kabupaten);
                })
                ->when($kode_kecamatan, function ($query, $kode_kecamatan) {
                    return $query->where('m_kecamatan.kode_kecamatan', 'like', '%' . $kode_kecamatan . '%');
                })
                ->when($nama_kecamatan, function ($query, $nama_kecamatan) {
                    return $query->where('m_kecamatan.nama_kecamatan', 'like', '%' . $nama_kecamatan . '%');
                })
                ->paginate(25);

            // Append URL
            if (!empty($request['provinsi'])) {
                $data['kecamatan']->appends(array(
                    'provinsi' => $request['provinsi'],
                ));
            }
            if (!empty($request['kabupaten'])) {
                $data['kecamatan']->appends(array(
                    'kabupaten' => $request['kabupaten'],
                ));
            }
            if (!empty($request['kode_kecamatan'])) {
                $data['kecamatan']->appends(array(
                    'kode_kecamatan' => $request['kode_kecamatan'],
                ));
            }
            if (!empty($request['nama_kecamatan'])) {
                $data['kecamatan']->appends(array(
                    'nama_kecamatan' => $request['nama_kecamatan'],
                ));
            }
        }
        $data['provinsi'] = ProvinsiModel::orderBy('NAMA_PROVINSI', 'asc')->get();
        return view('master.kecamatan.index', $data);
    }

    public function edit($id)
    {
        $data['kecamatan'] = KecamatanModel::where('ID_KECAMATAN', $id)->with('kabupaten.provinsi')->first();
        return view('master.kecamatan.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $kecamatan = KecamatanModel::find($id);

        $this->validate($request, [
            'kode_kecamatan' => 'required',
            'nama_kecamatan' => 'required'
        ]);

        $kecamatan->update([
            'KODE_KECAMATAN' => $request->kode_kecamatan,
            'NAMA_KECAMATAN' => $request->nama_kecamatan
        ]);

        Session::flash('success', 'Master Kecamatan Berhasil Diedit');
        return redirect()->route('kecamatan.index');
    }

    public function destroy($id)
    {
        // $kecamatan = KecamatanModel::find($id);
        // $kecamatan->delete();

        Session::flash('error', 'Master Kecamatan Tidak Dapat Dihapus');
        return redirect()->route('kecamatan.index');
    }
}
