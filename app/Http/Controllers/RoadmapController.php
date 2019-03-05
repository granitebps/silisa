<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RoadmapRealisasiModel;
use App\RoadmapTargetModel;

class RoadmapController extends Controller
{
    public function target()
    {
        $data['target'] = RoadmapTargetModel::paginate(25);
        return view('roadmap.target', $data);
    }

    public function realisasi()
    {
        $data['realisasi'] = RoadmapRealisasiModel::paginate(25);
        return view('roadmap.realisasi', $data);
    }
}
