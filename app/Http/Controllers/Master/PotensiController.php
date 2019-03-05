<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\PotensiEnergiModel;
use Illuminate\Support\Facades\Session;

class PotensiController extends Controller
{
    public function index()
    {
        $data['potensi'] = PotensiEnergiModel::orderBy('NAMA_POTENSI_ENERGI', 'asc')->paginate(25);
        return view('master.potensi.index', $data);
    }

    public function create()
    {
        return view('master.potensi.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_potensi' => 'required'
        ]);
        PotensiEnergiModel::create([
            'NAMA_POTENSI_ENERGI' => $request->nama_potensi
        ]);

        Session::flash('success', 'Master Potensi Energi Berhasil Ditambah');
        return redirect()->route('potensi.index');
    }

    public function edit($id)
    {
        $data['potensi'] = PotensiEnergiModel::find($id);
        return view('master.potensi.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $potensi = PotensiEnergiModel::find($id);
        $this->validate($request, [
            'nama_potensi' => 'required'
        ]);
        $potensi->update([
            'NAMA_POTENSI_ENERGI' => $request->nama_potensi
        ]);

        Session::flash('success', 'Master Potensi Energi Berhasil Diedit');
        return redirect()->route('potensi.index');
    }

    public function destroy($id)
    {
        // $potensi = PotensiEnergiModel::find($id);
        // $potensi->delete();
        Session::flash('error', 'Master Potensi Energi Tidak Dapat Dihapus');
        return redirect()->route('potensi.index');
    }
}
