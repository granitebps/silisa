<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class PotensiEnergiModel extends Model
{
    protected $table = 'M_POTENSI_ENERGI';
    protected $primaryKey = 'ID_POTENSI_ENERGI';
    protected $guarded = ['created_at', 'updated_at'];

    public function info_desa()
    {
        return $this->belongsToMany('App\Models\InfoDataDesa\InfoDesaModel', 'T_INFO_DESA_ENERGI', 'ID_POTENSI_ENERGI', 'ID_INFO_DESA');
    }
}
