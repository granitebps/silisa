<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\ProvinsiModel;
use Illuminate\Support\Facades\Session;

class ProvinsiController extends Controller
{
    public function index(Request $request)
    {
        $request = $request->all();
        if (empty($request) || (empty($request['nama_provinsi']) && empty($request['kode_provinsi']))) {
            // Search all data
            $data['provinsi'] = ProvinsiModel::orderBy('NAMA_PROVINSI', 'asc')->paginate(10);
        } else {
            // Cek validasi empty search
            if (!empty($request['nama_provinsi'])) {
                $nama_provinsi = $request['nama_provinsi'];
            } else {
                $nama_provinsi = null;
            }
            if (!empty($request['kode_provinsi'])) {
                $kode_provinsi = $request['kode_provinsi'];
            } else {
                $kode_provinsi = null;
            }

            // Proses search
            $data['provinsi'] = ProvinsiModel::orderBy('NAMA_PROVINSI', 'asc')
                ->when($nama_provinsi, function ($query, $nama_provinsi) {
                    return $query->where('NAMA_PROVINSI', 'like', '%' . $nama_provinsi . '%');
                })
                ->when($kode_provinsi, function ($query, $kode_provinsi) {
                    return $query->where('KODE_PROVINSI', 'like', '%' . $kode_provinsi . '%');
                })
                ->paginate(10);

            // Append URL
            if (!empty($request['kode_provinsi'])) {
                $data['provinsi']->appends(array(
                    'kode_provinsi' => $request['kode_provinsi'],
                ));
            }
            if (!empty($request['nama_provinsi'])) {
                $data['provinsi']->appends(array(
                    'nama_provinsi' => $request['nama_provinsi'],
                ));
            }
        }
        return view('master.provinsi.index', $data);
    }

    public function edit($id)
    {
        $data['provinsi'] = ProvinsiModel::find($id);
        return view('master.provinsi.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $provinsi = ProvinsiModel::find($id);
        $this->validate($request, [
            'kode_provinsi' => 'required',
            'nama_provinsi' => 'required'
        ]);

        $provinsi->update([
            'KODE_PROVINSI' => $request->kode_provinsi,
            'NAMA_PROVINSI' => $request->nama_provinsi
        ]);

        Session::flash('success', 'Master Provinsi Berhasil Diedit');
        return redirect()->route('provinsi.index');
    }

    public function destroy($id)
    {
        // $provinsi = ProvinsiModel::find($id);
        // $provinsi->delete();
        Session::flash('error', 'Master Provinsi Tidak Dapat Dihapus');
        return redirect()->route('provinsi.index');
    }
}
