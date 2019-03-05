<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\KabupatenKotaModel;
use App\Models\Master\ProvinsiModel;
use Illuminate\Support\Facades\Session;

class KabupatenKotaController extends Controller
{
    public function index(Request $request)
    {
        $request = $request->all();
        if (empty($request) || (empty($request['provinsi']) && empty($request['nama_kabupaten_kota']) && empty($request['kode_kabupaten_kota']))) {
            // Search all data
            $data['kabupatenkota'] = KabupatenKotaModel::orderBy('NAMA_KABUPATEN_KOTA', 'asc')->paginate(25);
        } else {
            // Cek Validasi Empty Search
            if (!empty($request['provinsi'])) {
                $provinsi = $request['provinsi'];
            } else {
                $provinsi = null;
            }
            if (!empty($request['nama_kabupaten_kota'])) {
                $nama_kabupaten_kota = $request['nama_kabupaten_kota'];
            } else {
                $nama_kabupaten_kota = null;
            }
            if (!empty($request['kode_kabupaten_kota'])) {
                $kode_kabupaten_kota = $request['kode_kabupaten_kota'];
            } else {
                $kode_kabupaten_kota = null;
            }

            // Proses Search
            $data['kabupatenkota'] = KabupatenKotaModel::orderBy('NAMA_KABUPATEN_KOTA', 'asc')
                ->when($provinsi, function ($query, $provinsi) {
                    return $query->where('ID_PROVINSI', $provinsi);
                })
                ->when($nama_kabupaten_kota, function ($query, $nama_kabupaten_kota) {
                    return $query->where('NAMA_KABUPATEN_KOTA', 'like', '%' . $nama_kabupaten_kota . '%');
                })
                ->when($kode_kabupaten_kota, function ($query, $kode_kabupaten_kota) {
                    return $query->where('KODE_KABUPATEN_KOTA', 'like', '%' . $kode_kabupaten_kota . '%');
                })
                ->paginate(25);

            // Append URL
            if (!empty($request['provinsi'])) {
                $data['kabupatenkota']->appends(array(
                    'provinsi' => $request['provinsi']
                ));
            }
            if (!empty($request['nama_kabupaten_kota'])) {
                $data['kabupatenkota']->appends(array(
                    'nama_kabupaten_kota' => $request['nama_kabupaten_kota']
                ));
            }
            if (!empty($request['kode_kabupaten_kota'])) {
                $data['kabupatenkota']->appends(array(
                    'kode_kabupaten_kota' => $request['kode_kabupaten_kota']
                ));
            }
        }
        $data['provinsi'] = ProvinsiModel::orderBy('NAMA_PROVINSI', 'asc')->get();
        return view('master.kabupatenkota.index', $data);
    }

    public function edit($id)
    {
        $data['kabupatenkota'] = KabupatenKotaModel::find($id);
        return view('master.kabupatenkota.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $kabupatenkota = KabupatenKotaModel::find($id);
        $this->validate($request, [
            'kode_kabupaten_kota' => 'required',
            'nama_kabupaten_kota' => 'required'
        ]);

        $kabupatenkota->update([
            'KODE_KABUPATEN_KOTA' => $request->kode_kabupaten_kota,
            'NAMA_KABUPATEN_KOTA' => $request->nama_kabupaten_kota
        ]);

        Session::flash('success', 'Master Kabupaten/Kota Berhasil Diedit');
        return redirect()->route('kabupatenkota.index');
    }

    public function destroy($id)
    {
        // $kabupatenkota = KabupatenKotaModel::find($id);
        // $kabupatenkota->delete();
        Session::flash('error', 'Master Kabupaten/Kota Tidak Dapat Dihapus');
        return redirect()->route('kabupatenkota.index');
    }
}
