<?php

namespace App\Models\RoadmapSilisa;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoadmapRealisasiModel extends Model
{
    use SoftDeletes;
    protected $table = 'T_ROADMAP_REALISASI';
    protected $primaryKey = 'ID_ROADMAP_REALISASI';
    protected $guarded = ['created_at', 'updated_at'];
    protected $dates = ['deleted_at'];

    public function desa()
    {
        return $this->belongsTo('App\Models\Master\DesaModel', 'ID_DESA', 'ID_DESA');
    }
}
