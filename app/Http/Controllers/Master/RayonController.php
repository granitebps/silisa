<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\RayonModel;
use Illuminate\Support\Facades\Session;

class RayonController extends Controller
{
    public function index(Request $request)
    {
        $request = $request->all();
        if (empty($request) && empty($request['nama_rayon'])) {
            // Search all data
            $data['rayon'] = RayonModel::orderBy('NAMA_RAYON', 'asc')
                ->paginate(25);
        } else {
            // Cek Validasi Empty Search
            if (!empty($request['nama_rayon'])) {
                $nama_rayon = $request['nama_rayon'];
            } else {
                $nama_rayon = null;
            }

            // Proses Search
            $data['rayon'] = RayonModel::orderBy('NAMA_RAYON', 'asc')
                ->when($nama_rayon, function ($query, $nama_rayon) {
                    return $query->where('NAMA_RAYON', 'like', '%' . $nama_rayon . '%');
                })
                ->paginate(25);

            // Append URL
            if (!empty($request['nama_rayon'])) {
                $data['rayon']->appends(array(
                    'nama_rayon' => $request['nama_rayon'],
                ));
            }
        }
        return view('master.rayon.index', $data);
    }

    public function edit($id)
    {
        $data['rayon'] = RayonModel::find($id);
        return view('master.rayon.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $rayon = RayonModel::find($id);
        $this->validate($request, [
            'nama_rayon' => 'required'
        ]);

        $rayon->update([
            'NAMA_RAYON' => $request->nama_rayon
        ]);

        Session::flash('success', 'Master Rayon Berhasil Diedit');
        return redirect()->route('rayon.index');
    }

    public function destroy($id)
    {
        // $provinsi = ProvinsiModel::find($id);
        // $provinsi->delete();
        Session::flash('error', 'Master Rayon Tidak Dapat Dihapus');
        return redirect()->route('rayon.index');
    }
}
