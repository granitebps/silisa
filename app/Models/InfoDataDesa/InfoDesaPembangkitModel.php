<?php

namespace App\Models\InfoDataDesa;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InfoDesaPembangkitModel extends Model
{
    use SoftDeletes;
    protected $table = 'T_INFO_DESA_PEMBANGKIT';
    protected $primaryKey = 'ID_INFO_DESA_PEMBANGKIT';
    protected $guarded = ['created_at', 'updated_at'];
    protected $dates = ['deleted_at'];

    public function desa()
    {
        return $this->belongsTo('App\Models\Master\DesaModel', 'ID_DESA', 'ID_DESA');
    }
}
