<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\WilayahModel;
use App\Models\Master\DesaModel;
use Illuminate\Support\Facades\Session;

class WilayahController extends Controller
{
    public function index(Request $request)
    {
        $request = $request->all();
        if (empty($request) && empty($request['nama_wilayah'])) {
            // Search all data
            $data['wilayah'] = WilayahModel::orderBy('NAMA_WILAYAH', 'asc')
                ->paginate(25);
        } else {
            // Cek Validasi Empty Search
            if (!empty($request['nama_wilayah'])) {
                $nama_wilayah = $request['nama_wilayah'];
            } else {
                $nama_wilayah = null;
            }

            // Proses Search
            $data['wilayah'] = WilayahModel::orderBy('NAMA_WILAYAH', 'asc')
                ->when($nama_wilayah, function ($query, $nama_wilayah) {
                    return $query->where('NAMA_WILAYAH', 'like', '%' . $nama_wilayah . '%');
                })
                ->paginate(25);

            // Append URL
            if (!empty($request['nama_wilayah'])) {
                $data['wilayah']->appends(array(
                    'nama_wilayah' => $request['nama_wilayah'],
                ));
            }
        }
        return view('master.wilayah.index', $data);
    }

    public function edit($id)
    {
        $data['wilayah'] = WilayahModel::find($id);
        return view('master.wilayah.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $wilayah = WilayahModel::find($id);
        $this->validate($request, [
            'nama_wilayah' => 'required'
        ]);

        $wilayah->update([
            'NAMA_WILAYAH' => $request->nama_wilayah
        ]);

        Session::flash('success', 'Master Wilayah Berhasil Diedit');
        return redirect()->route('wilayah.index');
    }

    public function destroy($id)
    {
        // $provinsi = ProvinsiModel::find($id);
        // $provinsi->delete();
        Session::flash('error', 'Master Wilayah Tidak Dapat Dihapus');
        return redirect()->route('wilayah.index');
    }
}
