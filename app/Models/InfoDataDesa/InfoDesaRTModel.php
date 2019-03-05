<?php

namespace App\Models\InfoDataDesa;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InfoDesaRTModel extends Model
{
    use SoftDeletes;
    protected $table = 'T_INFO_DESA_RT';
    protected $primaryKey = 'ID_INFO_DESA_RT';
    protected $guarded = ['created_at', 'updated_at'];
    protected $dates = ['deleted_at'];

    public function desa()
    {
        return $this->belongsTo('App\Models\Master\DesaModel', 'ID_DESA', 'ID_DESA');
    }
}
