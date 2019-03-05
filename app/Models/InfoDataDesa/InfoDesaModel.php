<?php

namespace App\Models\InfoDataDesa;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InfoDesaModel extends Model
{
    use SoftDeletes;
    protected $table = 'T_INFO_DESA';
    protected $primaryKey = 'ID_INFO_DESA';
    protected $guarded = ['created_at', 'updated_at'];
    protected $dates = ['deleted_at'];

    public function desa()
    {
        return $this->belongsTo('App\Models\Master\DesaModel', 'ID_DESA', 'ID_DESA');
    }

    public function potensi_energi()
    {
        return $this->belongsToMany('App\Models\Master\PotensiEnergiModel', 'T_INFO_DESA_ENERGI', 'ID_INFO_DESA', 'ID_POTENSI_ENERGI');
    }
}
