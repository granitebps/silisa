<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DesaPrioritasModel;

class DesaPrioritasController extends Controller
{
    public function desa_prioritas()
    {
        $data['desa_prioritas'] = DesaPrioritasModel::with('desa')->paginate(25);
        return view('desa_prioritas.desa_prioritas', $data);
    }
}
