<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DesaModel extends Model
{
    protected $table = 'M_DESA';
    protected $primaryKey = 'ID_DESA';
    protected $guarded = ['created_at', 'updated_at'];

    public function kecamatan()
    {
        return $this->belongsTo('App\Models\Master\KecamatanModel', 'ID_KECAMATAN', 'ID_KECAMATAN');
    }

    public function info_desa()
    {
        return $this->hasOne('App\Models\InfoDataDesa\InfoDesaModel', 'ID_DESA', 'ID_DESA');
    }

    public function info_desa_rt()
    {
        return $this->hasOne('App\Models\InfoDataDesa\InfoDesaRTModel', 'ID_DESA', 'ID_DESA');
    }

    public function info_desa_pembangkit()
    {
        return $this->hasOne('App\Models\InfoDataDesa\InfoDesaPembangkitModel', 'ID_DESA', 'ID_DESA');
    }

    public function roadmap_realisasi()
    {
        return $this->hasOne('App\Models\RoadmapSilisa\RoadmapRealisasiModel', 'ID_DESA', 'ID_DESA');
    }

    public function roadmap_target()
    {
        return $this->hasOne('App\Models\RoadmapSilisa\RoadmapTargetModel', 'ID_DESA', 'ID_DESA');
    }

    public function desa_prioritas()
    {
        return $this->hasOne('App\Models\DesaPrioritas\DesaPrioritasModel', 'ID_DESA', 'ID_DESA');
    }
}
