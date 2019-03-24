<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\AreaModel;
use Illuminate\Support\Facades\Session;

class AreaController extends Controller
{
    public function index(Request $request)
    {
        $request = $request->all();
        if (empty($request) && empty($request['nama_area'])) {
            // Search all data
            $data['area'] = AreaModel::orderBy('NAMA_AREA', 'asc')
                ->paginate(25);
        } else {
            // Cek Validasi Empty Search
            if (!empty($request['nama_area'])) {
                $nama_area = $request['nama_area'];
            } else {
                $nama_area = null;
            }

            // Proses Search
            $data['area'] = AreaModel::orderBy('NAMA_AREA', 'asc')
                ->when($nama_area, function ($query, $nama_area) {
                    return $query->where('NAMA_AREA', 'like', '%' . $nama_area . '%');
                })
                ->paginate(25);

            // Append URL
            if (!empty($request['nama_area'])) {
                $data['area']->appends(array(
                    'nama_area' => $request['nama_area'],
                ));
            }
        }
        return view('master.area.index', $data);
    }

    public function edit($id)
    {
        $data['area'] = AreaModel::find($id);
        return view('master.area.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $area = AreaModel::find($id);
        $this->validate($request, [
            'nama_area' => 'required'
        ]);

        $area->update([
            'NAMA_AREA' => $request->nama_area
        ]);

        Session::flash('success', 'Master Area Berhasil Diedit');
        return redirect()->route('area.index');
    }

    public function destroy($id)
    {
        // $provinsi = ProvinsiModel::find($id);
        // $provinsi->delete();
        Session::flash('error', 'Master Area Tidak Dapat Dihapus');
        return redirect()->route('area.index');
    }
}
